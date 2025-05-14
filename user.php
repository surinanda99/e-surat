<?php
session_start();
include 'koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM user ORDER BY id_user ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<div class="sidebar shadow-sm">
    <h5 class="text-center mb-4">📊 Admin Panel</h5>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="user.php">👥 Daftar User</a>
    <a href="list_surat.php">📄 Daftar Surat</a>
    <!-- <a href="template.php">📄 Template Surat</a> -->
    <a href="log.php">📜 Log Aktivitas</a>
    <a href="logout.php">🔓 Logout</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">👥 Daftar Pengguna Sistem</h3>
        <a href="add_user.php" class="btn btn-primary">➕ Tambah User</a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id_user']; ?></td>
                        <td><?= htmlspecialchars($row['username']); ?></td>
                        <td><span class="badge bg-info text-dark"><?= ucfirst($row['role']); ?></span></td>
                        <td>
                            <?php if ($row['status'] === 'aktif'): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php elseif ($row['status'] === 'nonaktif'): ?>
                                <span class="badge bg-secondary">Nonaktif</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark"><?= ucfirst($row['status']); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_user.php?id=<?= $row['id_user']; ?>" class="btn btn-warning btn-sm me-1" title="Edit">
                                ✏️
                            </a>
                            <a href="delete_user.php?id=<?= $row['id_user']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                🗑️
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
