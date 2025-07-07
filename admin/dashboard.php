<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");
include '../config/db.php';
$result = $conn->query("SELECT * FROM pasien");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h2>Data Pasien</h2>
<a href="tambah_pasien.php">+ Tambah Pasien</a><br><br>
<table>
<tr><th>Nama</th><th>Usia</th><th>Keluhan</th><th>Aksi</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['nama'] ?></td>
<td><?= $row['usia'] ?></td>
<td><?= $row['keluhan'] ?></td>
<td><a href="hapus_pasien.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>