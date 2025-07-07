<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");
include '../config/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM pasien WHERE id = $id");
header("Location: dashboard.php");
?>