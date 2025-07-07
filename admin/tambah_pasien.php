<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");
include '../config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    $keluhan = $_POST['keluhan'];
    $conn->query("INSERT INTO pasien (nama, usia, keluhan) VALUES ('$nama', '$usia', '$keluhan')");
    header("Location: dashboard.php");
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pasien</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h2>Form Tambah Pasien</h2>
<form method="POST">
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="number" name="usia" placeholder="Usia" required><br>
    <textarea name="keluhan" placeholder="Keluhan" required></textarea><br>
    <button type="submit">Simpan</button>
</form>
</body>
</html>