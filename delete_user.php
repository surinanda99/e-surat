<?php 
session_start();
include "koneksi.php"; 

if (!isset($_GET['id'])) {
    die("Error. Tidak ada ID user yang dipilih!");
}

$id_user = $_GET['id'];

// Pastikan ID tidak kosong
if (!empty($id_user)) {
    $query = "DELETE FROM user WHERE id_user = '$id_user'";
    $sql   = mysqli_query($conn, $query);

    if ($sql) {
        $_SESSION['success'] = "Data user berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus data user.";
    }
} else {
    $_SESSION['error'] = "ID tidak valid.";
}

header("Location: user.php");
exit();
?>
