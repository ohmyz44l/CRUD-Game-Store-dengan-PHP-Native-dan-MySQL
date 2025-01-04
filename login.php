<?php
session_start();
include('db.php');

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = ($_POST['password']);

    $result = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff7e6;
            background-image: url('img/bg2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px #e67326;
        }

        .login-header {
            margin-bottom: 1.5rem;
        }

        .login-header h2 {
            font-weight: bold;
        }

        .btn-primary {
            background-color: orange;
            border: none;
        }

        .btn-primary:hover {
            background-color: orangered;
        }

        .text-muted {
            color: orange;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="login-container">
            <div class="login-header text-center">
                <h2>Login</h2>
                <p class="text-muted">Silakan masuk untuk melanjutkan</p>
            </div>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="register.php">Belum punya akun? Daftar di sini</a>
            </div>
            <div class="text-center mt-3">
                <span>@ohmyz44l | Kintil Store</span>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>