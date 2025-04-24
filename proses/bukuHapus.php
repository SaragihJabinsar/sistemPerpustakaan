<?php
include'../koneksi.php';
$idBuku=$_GET['id'];

mysqli_query($db,
	"DELETE FROM tbbuku
	WHERE idBuku='$idBuku'"
);
header("location:../index.php?p=buku");
?>