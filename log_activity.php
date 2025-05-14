<?php
function catat_log($conn, $id_user, $role, $aktivitas) {
    if (strtolower($role) !== 'admin') {
        $stmt = $conn->prepare("INSERT INTO log_activity (id_user, role, aktivitas) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_user, $role, $aktivitas);
        $stmt->execute();
        $stmt->close();
    }
}
?>
