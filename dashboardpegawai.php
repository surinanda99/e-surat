<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center text-black mb-4">🏠 Pegawai Panel</h4>
        <a href="add_surat.php"><b>📝 Buat Surat</b></a>
        <a href="archive.php"><b>📄 Arsip Surat</b></a>
        <a href="logout.php"><b>🔓 Logout</b></a>
    </div>

</body>
</html>
