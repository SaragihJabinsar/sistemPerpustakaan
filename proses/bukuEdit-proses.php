<?php
include'../koneksi.php';

$idBuku=$_POST['idBuku'];
$judulBuku=$_POST['judulBuku'];
$kategori=$_POST['kategori'];
$pengarang=$_POST['pengarang'];
$penerbit=$_POST['penerbit'];
$status=$_POST['status'];

If(isset($_POST['simpan'])){
	mysqli_query($db,
		"UPDATE tbbuku
		SET judulBuku='$judulBuku',kategori='$kategori',pengarang='$pengarang',penerbit='$penerbit', status='$status'
		WHERE idBuku='$idBuku'"
	);
	header("location:../index.php?p=buku");
}
?>