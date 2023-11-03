<?php
// Nama : Resma Adi Nugroho
// Nim  : 24060121120021
// lab  : D1

include('header.html');

require_once 'lib/db_login.php';

/*TODO 2 : Buatlah
1. server side validation
2. insert new user
3. tampilkan hasilnya error/berhasil */
if (isset($_POST["submit"])) {
    $valid = TRUE;
    $nama = test_input($_POST['nama']) ?? "";

    // Validasi terhadap field nama
    if ($nama == '') {
        $error_nama = "Nama harus diisi";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $error_nama = "Hanya huruf dan spasi yang diperbolehkan";
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
    $jenis_kelamin = '';
    if(isset($_POST['jenis_kelamin'])){
        $jenis_kelamin = test_input($_POST['jenis_kelamin']);
    }
    if($jenis_kelamin == ''){
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

    if ($valid) {
        $query = "INSERT INTO tb_user (nama, email, jenis_kelamin, alamat, kode_prov, kode_kab) VALUES (?, ?, ?, ?, ?, ?)";

        // Persiapkan statement SQL
        $stmt = $db->prepare($query);

        // Periksa apakah persiapan statement berhasil
        if (!$stmt) {
            die("Gagal mempersiapkan statement: " . $db->error);
        }

        // Bind parameter ke placeholder
        $stmt->bind_param("ssssdd", $nama, $email, $jenis_kelamin, $alamat, $provinsi, $kabupaten);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Data berhasil dimasukkan.";
            $stmt->close();
            $db->close();
            
        } else {
            echo "Gagal memasukkan data: " . $stmt->error;
        }
    }
}
?>

<div class="card">
    <div class="card-header">Form Input Pendaftaran</div>
    <div class="card-body">
        <!-- TODO 3 : definisikan method dan actions pada tags <form> -->
        <form name="daftar" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
                <div id="error_name" style="color: red;">
                    <?php if (isset($error_nama))  echo $error_nama ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <!-- TODO 4 : buatlah cek email menggunakan ajax -->
                <input type="email" name="email" id="email" class="form-control" oninput="getUser()">
                <div id="error_email" style="color: red;">
                    <?php if (isset($error_email))  echo $error_email ?>
                </div>
            </div>
            <label>Jenis Kelamin</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki">Laki-laki
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan">Perempuan
                </label>
            </div>
            <div id="error_gender" style="color: red; margin-bottom: 12px;">
                <?php if (isset($error_jenis_kelamin))  echo $error_jenis_kelamin ?>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                <div id="error_alamat" style="color: red;">
                    <?php if (isset($error_alamat))  echo $error_alamat ?>
                </div>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select onchange="getKabupaten(this.value)" name="provinsi" id="provinsi" class="form-control">
                    <option value="">Pilih Provinsi</option>
                    <?php require_once('get_provinsi.php'); ?>
                </select>
                <div id="error_provinsi" style="color: red;">
                    <?php if (isset($error_provinsi))  echo $error_provinsi ?>
                </div>
            </div>
            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select onchange="" name="kabupaten" id="kabupaten" class="form-control">
                    <option value="">Pilih kabupaten</option>
                    
                </select>
                <div id="error_kabupaten" style="color: red;">
                    <?php if (isset($error_kabupaten))  echo $error_kabupaten ?>
                </div>
            </div>
            <br>
            <button type="submit" name="submit" value="submit" class="btn btn-primary container-fluid">Daftar</button>
        </form>
    </div>
</div>

<?php include('footer.html') ?>