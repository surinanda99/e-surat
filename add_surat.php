<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Surat Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user.css">
</head>
<body>

<div class="sidebar">
    <h5 class="text-center text-black mb-4">🧾 Pegawai Panel</h5>
    <a href="add_surat.php"><b>📝 Buat Surat</b></a>
    <a href="archive.php"><b>📄 Arsip Surat</b></a>
    <a href="logout.php"><b>🔓 Logout</b></a>
</div>

<div class="content">
    <div class="form-card">
        <h4 class="mb-4 text-center">📄 Formulir Pengajuan Surat</h4>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="insertSurat.php" method="POST">
            <div class="mb-3">
                <label for="no_surat" class="form-label">📎 Nomor Surat</label>
                <input type="text" class="form-control" name="no_surat" required>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">👤 Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="id_jenis" class="form-label">📌 Jenis Surat</label>
                <select class="form-select" name="id_jenis" id="id_jenis" required onchange="updateJenisSurat()">
                    <option value="">-- Pilih Jenis Surat --</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM jenis_surat");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_jenis']}' data-nama='{$row['nama_jenis']}'>{$row['nama_jenis']}</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="jenis_surat" id="jenis_surat">

            <div class="mb-3">
                <label for="perihal" class="form-label">📝 Perihal</label>
                <textarea class="form-control" name="perihal" rows="2" placeholder="Contoh: Permohonan Izin Cuti" required></textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal_buat" class="form-label">📅 Tanggal Buat</label>
                <input type="date" class="form-control" name="tanggal_buat" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">📤 Kirim Surat</button>
            </div>
        </form>
    </div>
</div>

<script>
function updateJenisSurat() {
    const select = document.getElementById('id_jenis');
    const selectedOption = select.options[select.selectedIndex];
    const namaJenis = selectedOption.getAttribute('data-nama');
    document.getElementById('jenis_surat').value = namaJenis;
}
</script>
</body>
</html>
