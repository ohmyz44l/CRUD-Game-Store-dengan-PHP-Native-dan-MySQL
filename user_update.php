<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Username dan password tidak boleh kosong.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $hashed_password);

    if ($stmt->execute()) {
        header("Location: user.php");
        exit();
    } else {
        echo "Gagal menambahkan pengguna.";
    }
} else {
    echo "Metode HTTP tidak valid.";
    exit();
}
?>
