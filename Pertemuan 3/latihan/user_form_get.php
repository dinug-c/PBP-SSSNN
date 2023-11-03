<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- cdn bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Form Get</title>
</head>
<body>
<form action="" method="GET">
    
<div class="form-group">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" class="form-control" maxlength="50">
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control"  name="email" id="email">
</div>
<div class="form-group">
    <label for="alamat">Alamat:</label>
    <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control"></textarea>
</div>

<div class="form-group">
    <label for="kota">Kota/Kabupaten</label>
    <select name="kota" id="kota" class="form-control">
        <option value="Semarang">Semarang</option>
        <option value="Jakarta">Jakarta</option>
        <option value="Bandung">Bandung</option>
        <option value="Surabaya">Surabaya</option>
    </select>
</div>

<label>Jenis Kelamin</label>
<div class="form-check">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria">Pria
    </label>
</div>
<div class="form-check">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita">Wanita
    </label>
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
</div>
<br>
<!-- submit, reset dan button -->
<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
<button type="reset" class="btn btn-danger">Reset</button>
</form>

<?php
    if(isset($_GET["submit"])) {
        echo "<h3>Your Input</h3>";
        echo "Nama: " . $_GET["nama"]. "<br/>";
        echo "Email: " . $_GET["email"]. "<br/>";
        echo "Alamat: " . $_GET["alamat"]. "<br/>";
        echo "Kota: " . $_GET["kota"]. "<br/>";
        echo "Jenis Kelamin: " . $_GET["jenis_kelamin"]. "<br/>";
        // echo "Minat: ".$_GET["minat"]."<br/>";

        $minat = $_GET["minat"];
        if(!empty($minat)){
            echo 'Peminatan yang dipilih: ';
            foreach($minat as $value){
                echo '<br/>'.$value.', ';
            }
        }
    }
?>

</body>
</html>