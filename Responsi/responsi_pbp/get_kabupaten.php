<?php
// Nama : Resma Adi Nugroho
// Nim  : 24060121120021
// lab  : D1

require_once 'lib/db_login.php';

/* TODO 6 : mengambil data kabupaten dari tabel 'tb_kabs' dengan parameter kode_prov*/
$kode_prov = $_GET['kode_prov'];
$query = "SELECT * FROM tb_kabs WHERE kode_prov = '$kode_prov'";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
} else {
    while ($row = $result->fetch_object()) {
        echo '<option value="' . $row->kode_kab . '">' . $row->nama_kab . '</option>';
    }
}
?>
