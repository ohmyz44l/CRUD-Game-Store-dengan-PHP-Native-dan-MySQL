<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: penjualan.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>