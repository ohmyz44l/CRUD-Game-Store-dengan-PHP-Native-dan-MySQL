<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

$perPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

$queryCount = "SELECT COUNT(*) AS total FROM orders";
$totalResult = $conn->query($queryCount)->fetch_assoc();
$totalPages = ceil($totalResult['total'] / $perPage);

$query = "SELECT * FROM orders LIMIT $perPage OFFSET $offset";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penjualan</title>
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
            color: #333;
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center">Game Store</h4>
        <a href="index.php">Home</a>
        <a href="penjualan.php">List Penjualan</a>
        <a href="laporan.php">Laporan</a>
        <a href="gallery.php">Promo Top-Up</a>
        <a href="user.php">Manajemen Pengguna</a>
        <a href="kontak.php" class="nav-link">Contact Me</a>
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

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Server</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Game</th>
                    <th>Jumlah Top-Up</th>
                    <th>Harga</th>
                    <th>Bonus Top-Up</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['id_server']) ?></td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td><?= htmlspecialchars($row['game_name']) ?></td>
                        <td><?= htmlspecialchars($row['topup_amount']) ?></td>
                        <td>Rp <?= number_format($row['price'], 2) ?></td>
                        <td><?= htmlspecialchars($row['topup_bonus']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>