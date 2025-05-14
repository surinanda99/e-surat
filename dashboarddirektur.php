<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_surat'], $_POST['action'])) {
    $id_surat = intval($_POST['id_surat']);
    $action = $_POST['action'] === 'approved' ? 'approved' : 'rejected';
    $catatan = $_POST['catatan'] ?? '';
    $stmt = $conn->prepare("UPDATE surat SET status_approval=?, catatan=? WHERE id_surat=?");
    $stmt->bind_param("ssi", $action, $catatan, $id_surat);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboarddirektur.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Direktur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user.css">
</head>
<body>
<div class="sidebar shadow-sm">
    <h5 class="text-center mb-4">📁 Direktur Panel</h5>
    <a href="dashboarddirektur.php">📄 Daftar Surat</a>
    <a href="logout.php">🔓 Logout</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">📋 Daftar Surat dari Pegawai</h4>
        <input type="text" id="searchInput" class="form-control form-control-sm w-auto" placeholder="🔍 Cari surat...">
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle" id="suratTable">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>No Surat</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Preview</th>
                        <th>Download</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $result = $conn->query("SELECT * FROM surat ORDER BY tanggal_kirim DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='text-center'>
                        <td>{$no}</td>
                        <td>{$row['no_surat']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['jenis_surat']}</td>
                        <td>{$row['perihal']}</td>
                        <td>{$row['tanggal_buat']}</td>";

                    // Status badge
                    $statusBadge = match($row['status_approval']) {
                        'approved' => '<span class="badge bg-success">Approved</span>',
                        'rejected' => '<span class="badge bg-danger">Rejected</span>',
                        default     => '<span class="badge bg-warning text-dark">Pending</span>',
                    };

                    echo "<td>$statusBadge</td>";
                    echo "<td>{$row['catatan']}</td>";

                    // Preview PDF
                    if ($row['status_approval'] === 'approved') {
                        echo "<td><a href='preview_surat.php?id={$row['id_surat']}' target='_blank' class='btn btn-sm btn-primary'>🔍</a></td>";
                        echo "<td>";
                        if (!empty($row['file_pdf'])) {
                            echo "<a href='uploads/{$row['file_pdf']}' class='btn btn-sm btn-success' download>⬇️</a>";
                        } else {
                            echo "<span class='text-muted'>-</span>";
                        }
                        echo "</td>";
                    } else {
                        echo "<td><span class='text-muted'>-</span></td><td><span class='text-muted'>-</span></td>";
                    }

                    // Aksi
                    echo "<td>";
                    if ($row['status_approval'] === 'pending') {
                        echo "<form method='post' class='d-flex flex-column gap-1'>
                                <input type='hidden' name='id_surat' value='{$row['id_surat']}'>
                                <input type='text' name='catatan' class='form-control form-control-sm' placeholder='Catatan' required>
                                <div class='d-flex gap-2'>
                                    <button name='action' value='approved' class='btn btn-success btn-sm'>✅</button>
                                    <button name='action' value='rejected' class='btn btn-danger btn-sm'>❌</button>
                                </div>
                              </form>";
                    } else {
                        echo "<button class='btn btn-secondary btn-sm' disabled>✔️ Selesai</button>";
                    }
                    echo "</td></tr>";
                    $no++;
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
    const rows = document.querySelectorAll("#suratTable tbody tr");
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
    });
});
</script>
</body>
</html>
