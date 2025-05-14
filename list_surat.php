<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Arsip Surat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">

</head>
<body>

<div class="sidebar">
    <h5 class="text-center mb-4 fw-bold">📊 Admin Panel</h5>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="user.php">👥 Daftar User</a>
    <a href="list_surat.php" class="bg-light">📄 Daftar Surat</a>
    <a href="log.php">📜 Log Aktivitas</a>
    <a href="logout.php">🔓 Logout</a>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">🗂️ Daftar Arsip Surat</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle shadow-sm bg-white">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID User</th>
                        <th>No Surat</th>
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>Perihal</th>
                        <th>Tanggal Buat</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Tanggal Kirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM surat ORDER BY tanggal_kirim DESC";
                $result = mysqli_query($conn, $query);

                while ($data = mysqli_fetch_assoc($result)) {
                    $badgeClass = match($data['status_approval']) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default    => 'secondary',
                    };

                    echo "<tr class='text-center'>
                        <td>{$data['id_user']}</td>
                        <td>{$data['no_surat']}</td>
                        <td>{$data['nama']}</td>
                        <td>{$data['jenis_surat']}</td>
                        <td>{$data['perihal']}</td>
                        <td>{$data['tanggal_buat']}</td>
                        <td>";
                        if ($data['status_approval'] === 'approved') {
                            echo "<a href='preview_surat.php?id={$data['id_surat']}' target='_blank' class='btn btn-sm btn-outline-success'>📄 Lihat</a>";
                        } else {
                            echo "<button class='btn btn-sm btn-outline-secondary' disabled>⏳ Menunggu</button>";
                        }
                    echo "</td>
                        <td><span class='badge bg-$badgeClass badge-status'>" . ucfirst($data['status_approval']) . "</span></td>
                        <td>{$data['catatan']}</td>
                        <td>{$data['tanggal_kirim']}</td>
                        <td>
                            <a href='edit_surat.php?id={$data['id_surat']}' class='icon-btn text-warning' title='Edit'>✏️</a>
                            <a href='hapus_surat.php?id={$data['id_surat']}' class='icon-btn text-danger' title='Hapus' onclick=\"return confirm('Yakin ingin menghapus surat ini?')\">🗑️</a>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
