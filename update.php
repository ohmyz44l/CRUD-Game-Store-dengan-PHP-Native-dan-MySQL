<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id_server = $_POST['id_server'];
    $customer_name = $_POST['customer_name'];
    $game_name = $_POST['game_name'];
    $topup_amount = $_POST['topup_amount'];
    $price = $_POST['price'];
    $topup_bonus = $_POST['topup_bonus'];

    $stmt = $conn->prepare("UPDATE orders SET id_server = ?, customer_name = ?, game_name = ?, topup_amount = ?, price = ?, topup_bonus = ? WHERE id = ?");
    $stmt->bind_param("sssiiii", $id_server, $customer_name, $game_name, $topup_amount, $price, $topup_bonus, $id);

    if ($stmt->execute()) {
        header("Location: penjualan.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
