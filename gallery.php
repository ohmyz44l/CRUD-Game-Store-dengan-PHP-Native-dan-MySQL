<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

$query = "SELECT * FROM games ORDER BY name ASC"; // Assumes you have a `games` table in your database.
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Top-Up Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff7e6;
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
        }

        .game-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .game-card img {
            max-height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .game-card .card-body {
            background-color: #fff3e0;
            color: #333;
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
        <h2 class="mb-4">Galeri Game</h2>

        <div class="row">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card game-card">
                        <img src="<?= htmlspecialchars($row['poster_url']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text">
                                <strong>Genre:</strong> <?= htmlspecialchars($row['genre']); ?><br>
                                <strong>Rating:</strong> <?= htmlspecialchars($row['rating']); ?>/5<br>
                                <strong>Top-Up Bonus:</strong> <?= htmlspecialchars($row['bonus']); ?>%
                            </p>
                            <a href="game_detail.php?id=<?= $row['id']; ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>