<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID surat tidak ditemukan.");
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM surat WHERE id_surat = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data || $data['status_approval'] !== 'approved') {
    die("Surat tidak ditemukan atau belum disetujui.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Cetak</title>
    <link rel="stylesheet" href="assets/css/surat.css">
</head>
<body onload="window.print()">
    <div class="kop">
        <h2>PT Nalta</h2>
        <hr>
        <h3>Surat <?= htmlspecialchars($data['jenis_surat']) ?></h3>
    </div>

    <div class="isi">
        <p><strong>Nomor Surat:</strong> <?= $data['no_surat'] ?></p>
        <p><strong>Nama:</strong> <?= $data['nama'] ?></p>
        <p><strong>Keterangan:</strong> <?= $data['perihal'] ?></p>
        <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($data['tanggal_buat'])) ?></p>
    </div>

    <div class="footer">
        <p>Telah mengajukan permohonan sehubungan dengan <?= strtolower($data['jenis_surat']) ?>. Surat ini diterbitkan sebagai bukti permohonan 
        dan akan digunakan sebagai salah satu dokumen penunjang dalam administrasi internal perusahaan.</p>

        <p>Demikian surat ini dibuat untuk dapat digunakan sebagaimana mestinya.</p>
        <br><br>
        <p><strong>Manajer HRD</strong></p>
    </div>
</body>
</html>
