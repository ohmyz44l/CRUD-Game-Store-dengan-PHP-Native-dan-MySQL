<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

$query = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
            max-width: calc(100% - 260px);
            color: #333;
            background-color: rgba(255, 255, 255, 0.8);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
                max-width: calc(100% - 210px);
            }
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
        <h2>Laporan Penjualan Top-Up Game</h2>
        <div class="py-4">
            <a href="report.php" class="btn btn-warning" target="_blank">Report PDF</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="reportTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>ID Server</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Game</th>
                        <th>Jumlah Top-Up</th>
                        <th>Harga</th>
                        <th>Bonus TopUp</th>
                        <th>Tanggal</th>
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
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('btnGeneratePDF').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.setFontSize(18);
            doc.text('Laporan Penjualan Top-Up Game', 10, 10);

            const table = document.getElementById('reportTable');
            let rowData = [];
            const rows = table.querySelectorAll('tr');

            rows.forEach((row, index) => {
                const cols = row.querySelectorAll('td, th');
                let rowContent = [];
                cols.forEach((col) => rowContent.push(col.innerText));
                rowData.push(rowContent);
            });

            rowData.forEach((row, index) => {
                const yOffset = 20 + (index * 10);
                row.forEach((col, colIndex) => {
                    doc.text(col, 10 + (colIndex * 40), yOffset);
                });
            });

            doc.save('Laporan_Penjualan.pdf');
        });
    </script>
</body>

</html>