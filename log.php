<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Log Aktivitas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/log.css">
</head>
<body>

<div class="sidebar">
    <h5 class="text-center fw-bold mb-4">📊 Admin Panel</h5>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="user.php">👥 Daftar User</a>
    <a href="list_surat.php">📄 Daftar Surat</a>
    <a href="log.php" class="bg-light">📜 Log Aktivitas</a>
    <a href="logout.php">🔓 Logout</a>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">📜 Log Aktivitas Sistem</h4>
            <input type="text" id="searchInput" class="form-control form-control-sm" style="max-width: 250px;" placeholder="🔍 Cari log...">
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle shadow-sm bg-white" id="logTable">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Waktu</th>
                        <th>ID User</th>
                        <th>Role</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT l.*, u.id_user FROM log_activity l 
                            JOIN user u ON l.id_user = u.id_user 
                            ORDER BY l.waktu DESC";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='text-center'>
                                <td>{$row['waktu']}</td>
                                <td>{$row['id_user']}</td>
                                <td><span class='badge bg-secondary'>" . ucfirst($row['role']) . "</span></td>
                                <td class='text-start'>{$row['aktivitas']}</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll("#logTable tbody tr");

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            row.style.display = rowText.includes(keyword) ? "" : "none";
        });
    });
</script>

</body>
</html>
