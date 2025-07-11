<?php
$host = 'localhost'; // GANTI dari 'host.docker.internal'
$user = 'root';
$pass = ''; // kosongkan kalau pakai XAMPP
$db   = 'e_psikiater_db';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>