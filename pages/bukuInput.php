<?php
// 1. Koneksi ke database
$host = "localhost"; // Sesuaikan dengan konfigurasi
$user = "root"; // Username default XAMPP
$pass = ""; // Kosongkan jika pakai XAMPP default
$db = "perpustakaan"; // Ganti dengan nama database yang dipakai

$conn = mysqli_connect($host, $user, $pass, $db);

// 2. Cek koneksi
if (!$conn) {
die("Koneksi gagal: " . mysqli_connect_error());
}

// 1. Ambil ID terbaru yang sudah ada
$query = "SELECT idBuku FROM tbbuku ORDER BY idBuku DESC LIMIT 1";
$result = mysqli_query($conn, $query);

$idBaru = "B001"; // Default ID jika belum ada data

if ($result && mysqli_num_rows($result) > 0) { // Pastikan ada data sebelum fetch
$row = mysqli_fetch_assoc($result);
if (isset($row['idBuku']) && preg_match('/^B\d{3}$/', $row['idBuku'])) {
// 2. Ambil angka dari ID terakhir, misal 'B010' → ambil 10
$lastIdNumber = (int) substr($row['idBuku'], 1);
// 3. Tambahkan 1 ke angka terakhir
$newIdNumber = $lastIdNumber + 1;
// 4. Format kembali ke 'Bxxx' (misal: B011, B012, dst.)
$idBaru = 'B' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
}
}

// Tutup koneksi setelah query selesai
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="card shadow p-4">
            <h3 class="text-center">Input Data Buku</h3>
            <form action="proses/bukuInput-proses.php" method="post">
                <input type="hidden" name="idBuku" value="<?php echo isset($idBaru) ? $idBaru : 'B001'; ?>">

                <div class="mb-3">
                    <label class="form-label">ID Buku</label>
                    <input type="text" class="form-control" value="<?php echo isset($idBaru) ? $idBaru : 'B001'; ?>"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judulBuku" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" value="Special" required checked>
                        <label class="form-check-label">Special</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" value="Premium">
                        <label class="form-check-label">Premium</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengarang</label>
                    <input type="text" name="pengarang" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Tersedia" required>
                        <label class="form-check-label">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Habis">
                        <label class="form-check-label">Habis</label>
                    </div>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary w-25">Simpan</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>