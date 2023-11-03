<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- cdn bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Form POST</title>
</head>
<body>
<?php
  if(isset($_POST['submit'])) {
    $nama = test_input($_POST['nama']);
    if(empty($nama)){
        $error_nama = "Nama harus diisi";
    } elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
        $error_nama = "Nama hanya dapat berisi huruf dan spasi";
    } 

    $email = test_input($_POST['email']);
    if(empty($email)){
        $error_email = "Email harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Format email salah";
    }

    $alamat = test_input($_POST['alamat']);
    if(empty($alamat)){
        $error_alamat = "Alamat harus diisi";
    }
    $kota = test_input($_POST['kota']);
    if(empty($kota)){
        $error_kota = "Kota harus diisi";
    }   
    if(!isset($_POST['jenis_kelamin'])){
        $error_jenis_kelamin = "Jenis kelamin harus diisi";
    }
    
    if(!isset($_POST['minat'])){
        $error_minat = "Peminatan harus diisi";
    } 

  }  
  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<div class="card m-5">
<div class="card-header">
    Form Mahasiswa
  </div>
<form action="" autocomplete="on" method="POST" class="m-4">
<div class="form-group">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" class="form-control" maxlength="50" value="<?php if(isset($nama)) {echo $nama;}?>">
    <div class="error"><?php if(isset($error_nama)) echo $error_nama?></div>
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control"  name="email" id="email" value="<?php if(isset($email)) {echo $email;}?>">
    <div class="error"><?php if(isset($error_email)) echo $error_email?></div>
</div>
<div class="form-group">
    <label for="alamat">Alamat:</label>
    <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control" value="<?php if(isset($alamat)) {echo $alamat;}?>"></textarea>
    <div class="error"><?php if(isset($error_alamat)) echo $error_alamat?></div>
</div>

<div class="form-group">
    <label for="kota">Kota/Kabupaten</label>
    <select name="kota" id="kota" class="form-control">
        <option value="Semarang" <?php if(isset($kota) && $kota=="Semarang") {echo 'selected="true"';}?>>Semarang</option>
        <option value="Jakarta" <?php if(isset($kota) && $kota=="Jakarta") {echo 'selected="true"';}?>>Jakarta</option>
        <option value="Bandung" <?php if(isset($kota) && $kota=="Bandung") {echo 'selected="true"';}?>>Bandung</option>
        <option value="Surabaya" <?php if(isset($kota) && $kota=="Surabaya") {echo 'selected="true"';}?>>Surabaya</option>
    </select>
    <div class="error"><?php if(isset($error_kota)) echo $error_kota?></div>
</div>

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
    <div class="error"><?php if(isset($error_jenis_kelamin)) echo $error_jenis_kelamin?></div>
</div>

<br>
<label>Peminatan</label>
<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="minat[]" value="Coding">Coding
    </label>
</div>

<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="minat[]" value="UX Design">UX Design
    </label>
</div>

<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="minat[]" value="Data Science">Data Science
    </label>
    <div class="error"><?php if(isset($error_minat)) echo $error_minat?></div>
</div>
<br>
<!-- submit, reset dan button -->
<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
<button type="reset" class="btn btn-danger">Reset</button>
</form>
</div>

<?php
    if(isset($_POST["submit"])) {
        echo "<h3>Your Input</h3>";
        echo "Nama: " . $_POST["nama"]. "<br/>";
        echo "Email: " . $_POST["email"]. "<br/>";
        echo "Alamat: " . $_POST["alamat"]. "<br/>";
        echo "Kota: " . $_POST["kota"]. "<br/>";
        if(!isset($_POST["jenis_kelamin"])){
            echo "Jenis Kelamin: " . $_POST["jenis_kelamin"]. "<br/>";
        }
        
        $minat = $_POST["minat"];
        if(!isset($minat)){
            echo 'Peminatan yang dipilih: ';
            foreach($minat as $value){
                echo '<br/>'.$value.', ';
            }
        }
    }
?>

</body>
</html>