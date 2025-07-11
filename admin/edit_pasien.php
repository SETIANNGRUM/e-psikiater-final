<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include '../config/db.php';

// Pastikan ID dikirim via GET dan merupakan angka
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data pasien dari database
$stmt = $conn->prepare("SELECT * FROM pasien WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$pasien = $result->fetch_assoc();
$stmt->close();

// Jika data pasien tidak ditemukan
if (!$pasien) {
    echo "Data pasien tidak ditemukan.";
    exit;
}

// Jika form disubmit (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    $keluhan = $_POST['keluhan'];

    $update = $conn->prepare("UPDATE pasien SET nama = ?, usia = ?, keluhan = ? WHERE id = ?");
    $update->bind_param("sisi", $nama, $usia, $keluhan, $id);
    $update->execute();
    $update->close();

    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 20px;
        }
        .form-container {
            max-width: 500px;
            background: #fff;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background: #667eea;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #5a67d8;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Data Pasien</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Pasien" value="<?= htmlspecialchars($pasien['nama']) ?>" required>
        <input type="number" name="usia" placeholder="Usia" value="<?= $pasien['usia'] ?>" required>
        <textarea name="keluhan" placeholder="Keluhan Pasien" required><?= htmlspecialchars($pasien['keluhan']) ?></textarea>
        <button type="submit">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
