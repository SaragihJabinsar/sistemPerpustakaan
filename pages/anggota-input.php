<?php
// 1. Koneksi ke database
$host = "localhost"; // Sesuaikan dengan konfigurasi
$user = "root"; // Username default XAMPP
$pass = ""; // Kosongkan jika pakai XAMPP default
$db   = "perpustakaan"; // Ganti dengan nama database yang dipakai

$conn = mysqli_connect($host, $user, $pass, $db);

// 2. Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 1. Ambil ID terbaru yang sudah ada
$query = "SELECT idAnggota FROM tbanggota ORDER BY idAnggota DESC LIMIT 1";
$result = mysqli_query($conn, $query);

$idBaru = "A001"; // Default ID jika belum ada data

if ($result) { // Pastikan query tidak error
    if (mysqli_num_rows($result) > 0) { 
        $row = mysqli_fetch_assoc($result);
        if (!empty($row['idAnggota']) && preg_match('/^A\d{3}$/', $row['idAnggota'])) {
            // 2. Ambil angka dari ID terakhir, misal 'A010' → ambil 10
            $lastIdNumber = (int) substr($row['idAnggota'], 1); 
            // 3. Tambahkan 1 ke angka terakhir
            $newIdNumber = $lastIdNumber + 1; 
            // 4. Format kembali ke 'Axxx' (misal: A011, A012, dst.)
            $idBaru = 'A' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
        }
    }
}

// Tutup koneksi setelah query selesai
mysqli_close($conn);
?>

<div class="container">
	<div class="card">
		<div class="card-header bg-primary text-white">
			<h3 class="mb-0">Input Data Anggota</h3>
		</div>
		<div class="card-body">
			<form action="proses/anggota-input-proses.php" method="post">
				<div class="mb-3">
					<label class="form-label">ID Anggota</label>
					<input type="text" name="idAnggota" class="form-control"
						value="<?php echo htmlspecialchars($idBaru); ?>" readonly>
				</div>
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama" class="form-control" required>
				</div>
				<div class="mb-3">
					<label class="form-label">Jenis Kelamin</label><br>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenisKelamin" value="Pria" required>
						<label class="form-check-label">Pria</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenisKelamin" value="Wanita" required>
						<label class="form-check-label">Wanita</label>
					</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Alamat</label>
					<textarea rows="2" name="alamat" class="form-control" required></textarea>
				</div>
				<div class="mb-3">
					<label class="form-label">Status</label><br>
					<div class="d-flex gap-3">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status" value="VIP" required>
							<label class="form-check-label">VIP</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status" value="Mahasiswa" required>
							<label class="form-check-label">Mahasiswa</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status" value="Umum" required>
							<label class="form-check-label">Umum</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status" value="Pelajar" required>
							<label class="form-check-label">Pelajar</label>
						</div>
					</div>
				</div>
				<div class="mb-3">
					<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>