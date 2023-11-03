<?php
require_once('lib/db_login.php');
if (isset($_POST["submit"])) {
    $valid = TRUE;
    $name = test_input($_POST['name']) ?? "";

    // Validasi terhadap field name
    if ($name == '') {
        $error_name = "Nama harus diisi";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Hanya huruf dan spasi yang diperbolehkan";
        $valid = FALSE;
    }

    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = "Email harus diisi";
        $valid = FALSE;
    }

    // Validasi terhadap field alamat
    $alamat = test_input($_POST['alamat']);
    if ($alamat == '') {
        $error_alamat = "Alamat harus diisi";
        $valid = FALSE;
    }

    if(!isset($_POST['jenis_kelamin'])){
        $error_jenis_kelamin = "Jenis kelamin harus diisi";
        $valid = FALSE;
    }

    // Validasi terhadap field provinsi
    $provinsi = $_POST['provinsi'];
    if ($provinsi == '' || $provinsi == 'none') {
        $error_provinsi = "Provinsi harus diisi";
        $valid = FALSE;
    }

    // Validasi terhadap field kabupaten
    $kabupaten = $_POST['kabupaten'];
    if ($kabupaten == '' || $kabupaten == 'none') {
        $error_kabupaten = "Provinsi harus diisi";
        $valid = FALSE;
    }

    // Update data into database
    if ($valid) {
        $query = "INSERT INTO responsi (name, email, genderId, alamat, provinsiId, kabupatenId) VALUES (?, ?, ?, ?, ?, ?)";

        // Persiapkan statement SQL
        $stmt = $db->prepare($query);

        // Periksa apakah persiapan statement berhasil
        if (!$stmt) {
            die("Gagal mempersiapkan statement: " . $db->error);
        }

        // Bind parameter ke placeholder
        $stmt->bind_param("ssssdd", $name, $email, $jenis_kelamin, $alamat, $provinsiId, $kabupatenId);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Data berhasil dimasukkan.";
            $db->close();
            header('Location: form_input.php');
        } else {
            echo "Gagal memasukkan data: " . $stmt->error;
        }
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Form Input Pendaftaran</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($name)) {echo $name;}?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group mt-2">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($email)) {echo $email;}?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>
            <div class="form-group mt-2">
            <label>Jenis Kelamin</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?php if(isset($jenis_kelamin) && $jenis_kelamin=="pria") {echo "checked";}?>>Pria
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if(isset($jenis_kelamin) && $jenis_kelamin=="wanita") {echo "checked";}?>>Wanita
                    </label>
                </div>
                <div class="error"><?php if(isset($error_jenis_kelamin)) echo $error_jenis_kelamin?></div>

            </div>
            <div class="form-group mt-2">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="5"><?php if(isset($alamat)) {echo $alamat;}?></textarea>
                <div class="error"><?php if (isset($error_alamat)) echo $error_alamat ?></div>
            </div>
            <div class="form-group mt-2">
                <label for="provinsi">Provinsi:</label>
                <select name="provinsi" id="provinsi" class="form-control" required>
                    <option value="none" <?php if (!isset($provinsi)) echo 'selected' ?>>Pilih Provinsi</option>
                    
                </select>
                <div class="error"><?php if (isset($error_provinsi)) echo $error_provinsi ?></div>
            </div>
            <div class="form-group mt-2">
                <label for="kabupaten">Kabupaten:</label>
                <select name="kabupaten" id="kabupaten" class="form-control" required>
                    <option value="none" <?php if (!isset($kabupaten)) echo 'selected' ?>>Pilih Kabupaten</option>
                    
                </select>
                <div class="error"><?php if (isset($error_kabupaten)) echo $error_kabupaten ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary w-100" name="submit" value="submit">Submit</button>
            
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>