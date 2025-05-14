<?php 
session_start();
include "koneksi.php"; 
include "log_activity.php"; 
?> 

<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login | e-Surat</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head> 
<body>

<div class="login-card">
    <h3 class="login-title">Login Sistem e-Surat</h3>

    <?php 
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger text-center">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">👤 Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">🔑 Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <div class="d-grid">
            <button type="submit" name="login" class="btn btn-primary">Masuk</button>
        </div>
    </form>
</div>

<?php 
if (isset($_POST['login'])) { 
    $username = $_POST['username']; 
    $password = $_POST['password']; 

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'"); 
    $count = mysqli_num_rows($query);

    if ($count > 0) { 
        $data = mysqli_fetch_assoc($query); 

        if (password_verify($password, $data['password'])) { 
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username']; 
            $_SESSION['role'] = $data['role'];

            catat_log($conn, $data['id_user'], $data['role'], 'Login ke sistem');

            switch (strtolower($data['role'])) {
                case "admin":
                    header("Location: dashboard.php"); break;
                case "pegawai":
                    header("Location: add_surat.php"); break;
                case "direktur":
                    header("Location: dashboarddirektur.php"); break;
                default:
                    $_SESSION['error'] = "Role tidak dikenali.";
                    header("Location: login.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Password salah.";
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username']; 
            $_SESSION['role'] = $data['role'];

            catat_log($conn, $data['id_user'], $data['role'], 'Gagal Login ke sistem');
            header("Location: login.php");
        }
    } else {
        $_SESSION['error'] = "Akun tidak ditemukan.";
        header("Location: login.php");
    }
} 
?> 

</body> 
</html>
