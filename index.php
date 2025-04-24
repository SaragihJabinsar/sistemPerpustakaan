<?php
session_start();
include "koneksi.php";

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistem Informasi Perpustakaan</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		html,
		body {
			height: 100%;
			width: 100%;
			margin: 0;
			overflow: hidden;
		}

		.container-fluid {
			height: 100vh;
			display: flex;
			flex-direction: column;
		}

		.row {
			flex-grow: 1;
			overflow: hidden;
		}

		.navbar {
			background: linear-gradient(135deg, #2c3e50, #34495e);
			padding: 15px 20px;
		}

		.navbar-brand {
			font-weight: bold;
			color: white;
			display: flex;
			align-items: center;
		}

		.navbar-brand img {
			width: 40px;
			margin-right: 10px;
		}

		.sidebar {
			height: 100%;
			overflow: auto;
			background-color: #1c2833;
			height: 100vh;
			color: white;
			padding-top: 20px;
			box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
		}

		main {
			height: 100%;
			overflow: auto;
		}

		.sidebar a {
			color: white;
			text-decoration: none;
			display: block;
			padding: 12px;
			transition: 0.3s;
			border-radius: 5px;
		}

		.sidebar a:hover {
			background-color: #566573;
			transform: scale(1.05);
		}

		.footer {
			background-color: #2c3e50;
			color: white;
			text-align: center;
			position: fixed;
			max-width: 20%;
			width: 100%;
			font-size: 15px;
			bottom: 0;
			height: 30px;
			border-radius: 10px;
		}


		.btn-auth {
			border-radius: 25px;
			padding: 8px 20px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-dark">
		<div class="container d-flex justify-content-between">
			<a class="navbar-brand" href="#">
				<img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Library Logo">
				Sistem Informasi Perpustakaan
			</a>
			<div>
				<a href="logout.php" class="btn btn-danger btn-auth"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-3 col-lg-2 sidebar">
				<h5 class="text-center"><?php echo htmlspecialchars($username); ?></h5>
				<hr>
				<a href="index.php?p=beranda"><i class="fas fa-home"></i> Beranda</a>
				<h6 class="mt-3">Entry Data & Transaksi</h6>
				<a href="index.php?p=anggota"><i class="fas fa-users"></i> Data Anggota</a>
				<a href="index.php?p=buku"><i class="fas fa-book-open"></i> Data Buku</a>
				<a href="index.php?p=transaksiPeminjaman"><i class="fas fa-exchange-alt"></i> Transaksi Peminjaman</a>
				<h6 class="mt-3">Laporan</h6>
				<a href="cetak/laporanDataAnggota.php" target="_blank"><i class="fas fa-file-alt"></i> Lap. Data
					Anggota</a>
				<a href="cetak/laporanDataBuku.php" target="_blank"><i class="fas fa-file-alt"></i> Lap. Data Buku</a>
			</nav>

			<main class="col-md-9 col-lg-10 px-md-4 py-4">
				<?php
                $pages_dir = 'pages';
                if (!empty($_GET['p'])) {
                    $pages = scandir($pages_dir, 0);
                    unset($pages[0], $pages[1]);
                    $p = $_GET['p'];
                    if (in_array($p . '.php', $pages)) {
                        include($pages_dir . '/' . $p . '.php');
                    } else {
                        echo '<div class="alert alert-danger">Halaman Tidak Ditemukan</div>';
                    }
                } else {
                    include($pages_dir . '/beranda.php');
                }
                ?>
			</main>
		</div>
	</div>

	<footer class="footer">
		<p class="mt-1">&copy; 2025 SIP | Jabinsar Saragih</p>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>