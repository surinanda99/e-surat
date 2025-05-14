<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/css/dashboard.css">
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
    <h2 class="mb-4">Halo, Admin! 👋</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="user.php" class="text-decoration-none">
                <div class="card card-hover text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title">👥 Kelola User</h4>
                        <p class="card-text">Tambah, ubah, atau hapus data pengguna sistem.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="log.php" class="text-decoration-none">
                <div class="card card-hover text-white bg-warning">
                    <div class="card-body">
                        <h4 class="card-title">📜 Log Aktivitas</h4>
                        <p class="card-text">Pantau semua aktivitas login dan perubahan data.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card p-3 shadow-sm">
                    <h5 class="mb-3">📄 Statistik Surat (Bar Chart)</h5>
                    <canvas id="suratChart" height="200"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 shadow-sm">
                    <h5 class="mb-3">📅 Log Aktivitas 7 Hari Terakhir</h5>
                    <canvas id="logChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Grafik -->
    <div class="mt-5 text-left">
        <h4 class="mb-3text-start">📊 Statistik User Berdasarkan Role</h4>
        <div style="max-width: 280px;">
            <canvas id="roleChart"></canvas>
        </div>
    </div>
    <?php
    $roles = ['admin', 'pegawai', 'direktur'];
    $counts = [];

    foreach ($roles as $role) {
        $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM user WHERE role = '$role'");
        $row = mysqli_fetch_assoc($result);
        $counts[] = $row['total'];
    }?>

    <?php
        $status_label = ['approved', 'pending', 'rejected'];
        $status_count = [];

        foreach ($status_label as $status) {
            $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM surat WHERE status_approval = '$status'");
            $data = mysqli_fetch_assoc($res);
            $status_count[] = $data['total'];
        }

        $log_label = [];
        $log_data = [];

        $logs = mysqli_query($conn, "
            SELECT DATE(waktu) as tanggal, COUNT(*) as total 
            FROM log_activity 
            WHERE waktu >= DATE_SUB(CURDATE(), INTERVAL 6 DAY) 
            GROUP BY DATE(waktu)
            ORDER BY tanggal ASC
        ");

        while ($row = mysqli_fetch_assoc($logs)) {
            $log_label[] = $row['tanggal'];
            $log_data[] = $row['total'];
        }
        ?>

</div>
<script>
const roleCtx = document.getElementById('roleChart').getContext('2d');
new Chart(roleCtx, {
    type: 'pie',
    data: {
        labels: ['Admin', 'Pegawai', 'Direktur'],
        datasets: [{
            label: 'Jumlah User',
            data: <?= json_encode($counts); ?>,
            backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e'],
            borderWidth: 1
        }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
});

const suratCtx = document.getElementById('suratChart').getContext('2d');
new Chart(suratCtx, {
    type: 'bar',
    data: {
        labels: ['Approved', 'Pending', 'Rejected'],
        datasets: [{
            label: 'Jumlah Surat',
            data: <?= json_encode($status_count); ?>,
            backgroundColor: ['#1cc88a', '#36b9cc', '#e74a3b']
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
    }
});

const logCtx = document.getElementById('logChart').getContext('2d');
new Chart(logCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode($log_label); ?>,
        datasets: [{
            label: 'Log Per Hari',
            data: <?= json_encode($log_data); ?>,
            fill: false,
            borderColor: '#4e73df',
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});
</script>

</body>
</html>
