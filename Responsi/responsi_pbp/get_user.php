<?php
// Nama : Resma Adi Nugroho
// Nim  : 24060121120021
// lab  : D1

require_once 'lib/db_login.php';

/* TODO 7 : mengambil data user dari tabel 'tb_user' dengan paramater email */
$email = $_GET['email'];
$query = "SELECT * FROM tb_user WHERE email = '$email'";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
} else {
    $row = $result->fetch_object();
    if ($row != NULL) {
        echo "Email sudah terdaftar";
    } 
}
?>