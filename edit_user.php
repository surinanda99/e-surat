<?php 
include "koneksi.php"; 
include "log_activity.php"; 
session_start();

if (isset($_GET['id'])) { 
    $id_user = $_GET['id']; 
    $query = "SELECT * FROM user WHERE id_user='$id_user'"; 
    $sql = mysqli_query($conn, $query);

    if ($data = mysqli_fetch_array($sql)) { 
        $username = $data['username']; 
        $password = $data['password']; 
        $role     = $data['role']; 
        $status   = $data['status']; 
    } else {
        die("User tidak ditemukan.");
    }
} else { 
    die("Error. ID tidak ditemukan!");
}

if (isset($_POST['sub'])) { 
    $username = htmlspecialchars($_POST['username']);
    $new_password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']); 
    $status = htmlspecialchars($_POST['status']);

    $query = "UPDATE user SET username='$username', password='$new_password', role='$role', status='$status' WHERE id_user='$id_user'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        $_SESSION['success'] = "Data user berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal memperbarui data user.";
    }
    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user.css">

</head>
<body>

<div class="sidebar shadow-sm">
    <h5 class="text-center mb-4">📊 Admin Panel</h5>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="user.php">👥 Daftar User</a>
    <a href="list_surat.php">📄 Daftar Surat</a>
    <a href="log.php">📜 Log Aktivitas</a>
    <a href="logout.php">🔓 Logout</a>
</div>

<div class="content">
    <div class="form-container">
        <h3 class="text-center mb-4">✏️ Edit Data User</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $username; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" name="password" class="form-control" value="<?= $password; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role / Jabatan</label>
                <select name="role" class="form-select" required>
                    <option value="admin" <?= $role == "admin" ? "selected" : "" ?>>Admin</option>
                    <option value="pegawai" <?= $role == "pegawai" ? "selected" : "" ?>>Pegawai</option>
                    <option value="direktur" <?= $role == "direktur" ? "selected" : "" ?>>Direktur</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Status Akun</label>
                <select name="status" class="form-select" required>
                    <option value="aktif" <?= $status == "aktif" ? "selected" : "" ?>>Aktif</option>
                    <option value="nonaktif" <?= $status == "nonaktif" ? "selected" : "" ?>>Nonaktif</option>
                    <option value="suspend" <?= $status == "suspend" ? "selected" : "" ?>>Suspend</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="user.php" class="btn btn-secondary">← Batal</a>
                <button type="submit" name="sub" class="btn btn-success">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
