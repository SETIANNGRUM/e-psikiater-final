<?php
$host = 'host.docker.internal';
$user = 'root';
$pass = '';
$db = 'e_psikiater_db';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Koneksi Gagal: ' . mysqli_connect_error());
}

?>