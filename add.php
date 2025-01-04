<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM orders WHERE id = $id");
    $data = $result->fetch_assoc();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff7e6;
            background-image: url('img/bg2.jpg');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: #333;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #ff8c42;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-bottom: 1px solid #e67326;
        }

        .sidebar a:hover {
            background-color: #e67326;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            /* max-width: calc(100% - 250px); */
            color: #333;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .container {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center">Top-Up Game</h4>
        <a href="index.php">Home</a>
        <a href="penjualan.php">List Penjualan</a>
        <a href="report.php">Laporan</a>
        <a href="gallery.php">Galeri Game</a>
        <a href="user.php">Manajemen Pengguna</a>
        <a href="logout.php" class="text-danger">Logout</a>
    </div>

    <div class="content">
        <h2>Daftar Penjualan Top-Up Game</h2>
        <form action="store.php" method="POST" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="id_server" class="form-label">ID (Server)</label>
                    <input type="text" name="id_server" class="form-control" placeholder="Masukkan ID Server" required>
                </div>
                <div class="col-md-4">
                    <label for="customer_name" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="customer_name" class="form-control" placeholder="Masukkan Nama Pelanggan" required>
                </div>
                <div class="col-md-4">
                    <label for="game_name" class="form-label">Nama Game</label>
                    <input type="text" name="game_name" class="form-control" placeholder="Masukkan Nama Game" required>
                </div>
                <div class="col-md-4">
                    <label for="topup_amount" class="form-label">Jumlah Top-Up</label>
                    <input type="number" name="topup_amount" class="form-control" placeholder="Masukkan Jumlah Top-Up" required>
                </div>
                <div class="col-md-4">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" placeholder="Masukkan Harga" required>
                </div>
                <div class="col-md-4">
                    <label for="topup_bonus" class="form-label">Bonus Top-Up</label>
                    <input type="number" name="topup_bonus" class="form-control" placeholder="Masukkan Bonus Top-Up" required>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-warning w-100">Tambah</button>
                </div>
            </div>
        </form>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>