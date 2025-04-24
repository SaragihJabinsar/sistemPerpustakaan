<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(mysqli_real_escape_string($db, $_POST['username']));
    $password = $_POST['password'];

    $result = $db->query("SELECT * FROM tbusers WHERE username='$username'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Login Gagal! Periksa username dan password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2980b9, #6dd5fa, #ffffff);
            background-size: cover;
        }

        .card {
            border-radius: 20px;
            border: none;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 10px;
            transition: 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
            border-color: #3498db;
        }

        .text-primary {
            color: #2980b9 !important;
        }

        a.text-primary:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 shadow-lg rounded-4" style="width: 400px; background: #ffffff;">
            <h2 class="text-center text-primary fw-bold">Login</h2>
            <hr>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control rounded-3" placeholder="Masukkan username"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control rounded-3"
                        placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
            </form>
            <p class="text-center mt-3">Belum punya akun? <a href="signup.php"
                    class="text-decoration-none text-primary">Daftar di sini</a></p>
        </div>
    </div>
</body>

</html>