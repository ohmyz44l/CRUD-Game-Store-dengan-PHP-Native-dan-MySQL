<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        header("Location: user.php");
        exit();
    } else {
        echo "Gagal menghapus pengguna.";
    }
} else {
    header("Location: user.php");
    exit();
}
?>
