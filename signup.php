<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, trim($_POST['username']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $result = $db->query("SELECT * FROM tbusers WHERE username='$username'");
    if ($result->num_rows > 0) {
        echo "<script>alert('Username sudah digunakan! Silakan coba yang lain.');</script>";
    } else {
        if ($db->query("INSERT INTO tbusers (username, password) VALUES ('$username', '$password')")) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal! Silakan coba lagi.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2ecc71, #27ae60, #ffffff);
            background-size: cover;
        }

        .card {
            border-radius: 20px;
            border: none;
        }

        .btn-success {
            background-color: #2ecc71;
            border: none;
            transition: 0.3s;
        }

        .btn-success:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 10px;
            transition: 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
            border-color: #2ecc71;
        }

        .text-success {
            color: #27ae60 !important;
        }

        a.text-success:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 shadow-lg rounded-4" style="width: 400px; background: #ffffff;">
            <h2 class="text-center text-success fw-bold">Sign Up</h2>
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
                <button type="submit" class="btn btn-success w-100 fw-bold">Daftar</button>
            </form>
            <p class="text-center mt-3">Sudah punya akun? <a href="login.php"
                    class="text-decoration-none text-success">Login di sini</a></p>
        </div>
    </div>
</body>

</html>