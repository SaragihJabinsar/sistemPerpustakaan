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

// Ambil data transaksi berdasarkan ID yang dikirim
$idTransaksi = $_GET['id'];
$q_tampil_transaksi = mysqli_query($conn, "SELECT * FROM tbtransaksi WHERE idTransaksi='$idTransaksi'");
$r_tampil_transaksi = mysqli_fetch_array($q_tampil_transaksi);

// Pastikan ID tersedia
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Transaksi tidak ditemukan!");
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Edit Data Transaksi</h3>
        <div class="card p-4 shadow-sm">
            <form action="proses/transaksiEdit-proses.php" method="post">
                <div class="mb-3">
                    <label class="form-label">ID Transaksi</label>
                    <input type="text" name="idTransaksi" value="<?php echo $r_tampil_transaksi['idTransaksi']; ?>"
                        class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Anggota</label>
                    <select name="idAnggota" class="form-select">
                        <option value="">-- Pilih Anggota --</option>
                        <?php foreach ($anggotaList as $row) {
                            $selected = ($row['idAnggota'] == $r_tampil_transaksi['idAnggota']) ? "selected" : "";
                            echo "<option value='" . $row['idAnggota'] . "' $selected>" . $row['nama'] . "</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Buku</label>
                    <select name="idBuku" class="form-select">
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach ($bukuList as $row) {
                            $selected = ($row['idBuku'] == $r_tampil_transaksi['idBuku']) ? "selected" : "";
                            echo "<option value='" . $row['idBuku'] . "' $selected>" . $row['judulBuku'] . "</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="date" name="tanggalPeminjaman"
                        value="<?php echo $r_tampil_transaksi['tanggalPeminjaman']; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggalKembali"
                        value="<?php echo $r_tampil_transaksi['tanggalKembali']; ?>" class="form-control">
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