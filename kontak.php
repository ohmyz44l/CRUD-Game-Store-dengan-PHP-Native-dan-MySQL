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
    <title>Game Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #fff3e0;
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
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #ff8c42;
            border-color: #e67326;
        }

        .btn-primary:hover {
            background-color: #e67326;
            border-color: #cc5a00;
        }

        h2,
        h3 {
            color: #ff8c42;
        }

        .media-container {
            text-align: center;
            margin: 20px 0;
        }

        .media-container img {
            width: 90%;
            max-width: 800px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .game-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .game-gallery img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-gallery img:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2.8rem;
            background: var(--main-color);
            border-radius: 4rem;
            font-size: 1.6rem;
            color: orangered;
            border: 2px solid;
            letter-spacing: 0.1rem;
            font-weight: 600;
            transition: 0.3s ease-in-out;
            cursor: pointer;
        }

        .social-links {
            text-align: center;
            margin-top: 30px;
        }

        .social-links a {
            margin: 0 10px;
            color: #ff8c42;
            font-size: 24px;
        }

        .social-links a:hover {
            color: #e67326;
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
        <section id="contact" class="contact">
            <div class="container">
                <h2>Contact Me</h2>
                <form action="#" method="POST" class="contact-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message"
                            required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>