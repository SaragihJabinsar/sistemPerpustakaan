<?php
include'../koneksi.php';
$idTransaksi=$_GET['id'];

mysqli_query($db,
	"DELETE FROM tbtransaksi
	WHERE idTransaksi='$idTransaksi'"
);
header("location:../index.php?p=transaksiPeminjaman");
?>