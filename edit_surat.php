<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("Error: ID Surat tidak ditemukan.");
}

$id_surat = $_GET['id'];

$query = "SELECT * FROM surat WHERE id_surat = '$id_surat'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Surat dengan ID tersebut tidak ditemukan.");
}

if (isset($_POST['submit'])) {
    $no_surat     = htmlspecialchars($_POST['no_surat']);
    $id_jenis     = htmlspecialchars($_POST['id_jenis']);
    $jenis_surat  = htmlspecialchars($_POST['jenis_surat']);
    $perihal      = htmlspecialchars($_POST['perihal']);
    $tanggal_buat = htmlspecialchars($_POST['tanggal_buat']);

    $update = "UPDATE surat SET 
        no_surat='$no_surat',
        id_jenis='$id_jenis',
        jenis_surat='$jenis_surat',
        perihal='$perihal',
        tanggal_buat='$tanggal_buat'
        WHERE id_surat='$id_surat'";

    if (mysqli_query($conn, $update)) {
        $_SESSION['success'] = "Data surat berhasil diperbarui.";
        header("Location: list_surat.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal memperbarui surat.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Surat</title>
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
        <div class="form-container">
            <h2>Edit Surat</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="no_surat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control" name="no_surat" value="<?= $data['no_surat']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="id_jenis" class="form-label">Jenis Surat</label>
                    <select class="form-select" name="id_jenis" required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        <option value="1" <?= $data['id_jenis'] == '1' ? 'selected' : '' ?>>Surat Keterangan Kerja</option>
                        <option value="2" <?= $data['id_jenis'] == '2' ? 'selected' : '' ?>>Surat Izin</option>
                        <option value="3" <?= $data['id_jenis'] == '3' ? 'selected' : '' ?>>Surat Pengunduran Diri</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_surat" class="form-label">Judul Jenis Surat</label>
                    <input type="text" class="form-control" name="jenis_surat" value="<?= $data['jenis_surat']; ?>">
                </div>
                <div class="mb-3">
                    <label for="perihal" class="form-label">Perihal</label>
                    <textarea class="form-control" name="perihal" rows="2" required><?= $data['perihal']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="tanggal_buat" class="form-label">Tanggal Buat</label>
                    <input type="date" class="form-control" name="tanggal_buat" value="<?= $data['tanggal_buat']; ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="list_surat.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>
