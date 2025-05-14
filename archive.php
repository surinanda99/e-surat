<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Arsip Surat Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/archive.css">
</head>
<body>

<div class="sidebar">
    <h5 class="text-center text-black mb-4">🧾 Pegawai Panel</h5>
    <a href="add_surat.php"><b>📝 Buat Surat</b></a>
    <a href="archive.php"><b>📄 Arsip Surat</b></a>
    <a href="logout.php"><b>🔓 Logout</b></a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📄 Daftar Arsip Surat Anda</h3>
        <input type="text" id="searchInput" class="form-control form-control-sm search-box" placeholder="🔍 Cari surat...">
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No Surat</th>
                            <th>Nama</th>
                            <th>Jenis Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Buat</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Tanggal Kirim</th>
                            <th>File / Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM surat WHERE id_user = $id_user ORDER BY tanggal_kirim DESC";
                        $result = mysqli_query($conn, $query);

                        while ($data = mysqli_fetch_assoc($result)) {
                            $badge = match($data['status_approval']) {
                                'approved' => '<span class="badge bg-success">Disetujui</span>',
                                'rejected' => '<span class="badge bg-danger">Ditolak</span>',
                                default     => '<span class="badge bg-warning text-dark">Menunggu</span>',
                            };

                            echo "<tr class='text-center'>
                                    <td>{$data['no_surat']}</td>
                                    <td>{$data['nama']}</td>
                                    <td>{$data['jenis_surat']}</td>
                                    <td>{$data['perihal']}</td>
                                    <td>{$data['tanggal_buat']}</td>
                                    <td>$badge</td>
                                    <td>{$data['catatan']}</td>
                                    <td>{$data['tanggal_kirim']}</td>
                                    <td>";

                            switch ($data['status_approval']) {
                                case 'approved':
                                    echo "<a href='preview_surat.php?id={$data['id_surat']}' target='_blank' class='btn btn-sm btn-outline-primary'>🖨️ Cetak</a>";
                                    break;
                                case 'rejected':
                                    echo "<span class='btn btn-sm btn-outline-danger disabled'>❌ Ditolak</span>";
                                    break;
                                default:
                                    echo "<span class='btn btn-sm btn-outline-warning disabled'>⏳ On Progress</span>";
                            }

                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const input = this.value.toLowerCase();
        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(input) ? "" : "none";
        });
    });
</script>

</body>
</html>
