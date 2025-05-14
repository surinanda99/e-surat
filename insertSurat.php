<?php
session_start();
include 'koneksi.php';
include 'log_activity.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id_user'])) {
        $_SESSION['error'] = "Anda belum login.";
        header("Location: login.php");
        exit();
    }

    $id_user = $_SESSION['id_user'];
    $id_jenis = $_POST['id_jenis']; 
    $no_surat = $_POST['no_surat'];
    $nama = $_POST['nama'];
    $jenis_surat = $_POST['jenis_surat']; 
    $perihal = $_POST['perihal'];
    $tanggal_buat = $_POST['tanggal_buat'];
    $status_approval = 'pending';
    $catatan = '';
    $tanggal_kirim = date('Y-m-d H:i:s');

    $cek = mysqli_query($conn, "SELECT 1 FROM jenis_surat WHERE id_jenis = '$id_jenis'");
    if (mysqli_num_rows($cek) === 0) {
        $_SESSION['error'] = "Jenis surat tidak valid.";
        header("Location: add_surat.php");
        exit();
    }

    $query = "INSERT INTO surat (
                id_user, id_jenis, no_surat, nama, jenis_surat, perihal, tanggal_buat,
                status_approval, catatan, tanggal_kirim
              ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiisssssss", $id_user, $id_jenis, $no_surat, $nama, $jenis_surat,
                  $perihal, $tanggal_buat, $status_approval, $catatan, $tanggal_kirim);


    if ($stmt->execute()) {
        // log aktivitas hanya jika pegawai atau direktur
        catat_log($conn, $id_user, $_SESSION['role'], "Menambahkan surat: $no_surat");

        $_SESSION['success'] = "Surat berhasil disimpan!";
    } else {
        $_SESSION['error'] = "Gagal menyimpan surat: " . $stmt->error;
    }

    $stmt->close();
    header("Location: add_surat.php");
    exit();
}
?>
