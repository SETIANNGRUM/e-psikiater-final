<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");
include '../config/db.php';

// Query ambil data pasien
$result = $conn->query("SELECT id, nama, usia, keluhan FROM pasien ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - E-Psikiater</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .add-btn {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            float: right;
            margin-bottom: 20px;
        }
        .table-container {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        th {
            background: #667eea;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: white;
        }
        .edit-btn {
            background-color: #4ecdc4;
        }
        .delete-btn {
            background-color: #ff6b6b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <a href="tambah_pasien.php" class="add-btn"><i class="fas fa-plus"></i> Tambah Pasien</a>
        
        <div class="table-container">
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Keluhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= $row['usia'] ?> tahun</td>
                                <td><?= htmlspecialchars($row['keluhan']) ?></td>
                                <td class="actions">
                                    <a href="edit_pasien.php?id=<?= $row['id'] ?>" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="hapus_pasien.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Yakin ingin hapus pasien ini?');"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Tidak ada data pasien.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
