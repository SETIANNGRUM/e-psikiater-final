<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include '../config/db.php';

// Proses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    $keluhan = $_POST['keluhan'];

    // Validasi sederhana
    if (!empty($nama) && !empty($usia) && !empty($keluhan)) {
        $stmt = $conn->prepare("INSERT INTO pasien (nama, usia, keluhan) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $nama, $usia, $keluhan);
        $stmt->execute();
        $stmt->close();

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Semua field harus diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pasien</title>
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
        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Data Pasien</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Pasien" required>
        <input type="number" name="usia" placeholder="Usia" required>
        <textarea name="keluhan" placeholder="Keluhan Pasien" required></textarea>
        <button type="submit">Simpan Data</button>
    </form>
</div>

</body>
</html>
