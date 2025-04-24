<?php
include '../koneksi.php'; // Koneksi ke database

// Ambil data dari form
$idTransaksi = $_POST['idTransaksi'];
$idAnggota = $_POST['idAnggota'];
$idBuku = $_POST['idBuku'];
$tanggalPeminjaman = $_POST['tanggalPeminjaman'];
$tanggalKembali = $_POST['tanggalKembali'];

If(isset($_POST['simpan'])){
mysqli_query($db,
"UPDATE tbtransaksi
SET idAnggota='$idAnggota',idBuku='$idBuku',tanggalPeminjaman='$tanggalPeminjaman',tanggalKembali='$tanggalKembali'
WHERE idTransaksi='$idTransaksi'"
);
header("location:../index.php?p=transaksiPeminjaman");
}
?>
