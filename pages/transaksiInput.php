<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "perpustakaan");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data ID Anggota
$sqlAnggota = "SELECT idAnggota, nama FROM tbanggota";
$resultAnggota = $conn->query($sqlAnggota);
if (!$resultAnggota) {  
    die("Error saat mengambil data anggota: " . $conn->error);
}

// Ambil data ID Buku
$sqlBuku = "SELECT idBuku, judulBuku FROM tbBuku";
$resultBuku = $conn->query($sqlBuku);
if (!$resultBuku) {
    die("Error saat mengambil data buku: " . $conn->error);
}

// Simpan hasil query ke array agar tidak habis saat digunakan dalam looping
$anggotaList = $resultAnggota->fetch_all(MYSQLI_ASSOC);
$bukuList = $resultBuku->fetch_all(MYSQLI_ASSOC);

// Ambil ID terbaru yang sudah ada
$query = "SELECT idTransaksi FROM tbtransaksi ORDER BY idTransaksi DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $lastId = intval(substr($row['idTransaksi'], 1)); // Mengambil angka setelah "T"
    $idBaru = "T" . str_pad($lastId + 1, 3, "0", STR_PAD_LEFT);
} else {
    $idBaru = "T001"; // Jika belum ada data, mulai dari T001
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="text-center">Input Transaksi</h3>
            <form action="proses/transaksiInput-proses.php" method="post">
                <input type="hidden" name="idTransaksi" value="<?php echo $idBaru; ?>">
                <div class="mb-3">
                    <label class="form-label">ID Transaksi</label>
                    <input type="text" class="form-control" value="<?php echo $idBaru; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Anggota</label>
                    <select name="idAnggota" class="form-select">
                        <option value="">-- Pilih Anggota --</option>
                        <?php foreach ($anggotaList as $row) { ?>
                        <option value="<?php echo $row['idAnggota']; ?>"> <?php echo $row['nama']; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Buku</label>
                    <select name="idBuku" class="form-select">
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach ($bukuList as $row) { ?>
                        <option value="<?php echo $row['idBuku']; ?>"> <?php echo $row['judulBuku']; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="date" name="tanggalPeminjaman" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggalKembali" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Tutup koneksi setelah semua proses selesai
$conn->close();
?>