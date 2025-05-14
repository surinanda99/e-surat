<?php
session_start();
include 'koneksi.php';

if (isset($_POST['sub'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['jabatan']; 
    $status   = $_POST['status'];  

    $stmt = $conn->prepare("INSERT INTO user (username, password, status, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $status, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Gagal menambahkan user: " . $stmt->error;
    }

    $stmt->close();
    header("Location: add_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user.css">

</head>
<body>
    <div class="sidebar">
       <h4 class="text-center text-black mb-4">📊 Admin Panel</h4>
            <a href="dashboard.php"><b>🏠 Dashboard</b></a>
            <a href="user.php"><b>👥 Daftar User</b></a>
            <a href="list_surat.php"><b>📄 Daftar Surat</b></a>
            <!-- <a href="template.php"><b>📄 Template Surat</b></a> -->
            <a href="log.php"><b>📜 Log Aktivitas</b></a>
            <a href="logout.php"><b>🔓 Logout</b></a>
    </div>

    <div class="content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="form-container">
            <h2 class="mb-4">Tambah User Baru</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Role / Jabatan:</label>
                    <select class="form-select" name="jabatan" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="direktur">Direktur</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Akun:</label>
                    <select class="form-select" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        <option value="suspend">Suspend</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" name="sub" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</body>
</html>
