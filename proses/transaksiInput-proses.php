<?php
include '../koneksi.php'; // Koneksi ke database

// Ambil data dari form
$idTransaksi = isset($_POST['idTransaksi']) && $_POST['idTransaksi'] !== '' ? $_POST['idTransaksi'] : null;
$idAnggota = $_POST['idAnggota'];
$idBuku = $_POST['idBuku'];
$tanggalPeminjaman = $_POST['tanggalPeminjaman'];
$tanggalKembali = $_POST['tanggalKembali'];
if(isset($_POST['simpan'])){

$sql =
"INSERT INTO tbtransaksi
VALUES('$idTransaksi','$idAnggota','$idBuku','$tanggalPeminjaman','$tanggalKembali')";
$query = mysqli_query($db, $sql);

header("location:../index.php?p=transaksiPeminjaman");
}
?>