<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_server = isset($_POST['id_server']) ? trim($_POST['id_server']) : '';
    $customer_name = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
    $game_name = isset($_POST['game_name']) ? trim($_POST['game_name']) : '';
    $topup_amount = isset($_POST['topup_amount']) ? intval($_POST['topup_amount']) : 0;
    $price = isset($_POST['price']) ? intval($_POST['price']) : 0;
    $topup_bonus = isset($_POST['topup_bonus']) ? intval($_POST['topup_bonus']) : 0;

    if (empty($id_server) || empty($customer_name) || empty($game_name) || $topup_amount <= 0 || $price <= 0) {
        echo "Semua field wajib diisi dengan benar!";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO orders (id_server, customer_name, game_name, topup_amount, price, topup_bonus) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $id_server, $customer_name, $game_name, $topup_amount, $price, $topup_bonus);

    if ($stmt->execute()) {
        header("Location: penjualan.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
