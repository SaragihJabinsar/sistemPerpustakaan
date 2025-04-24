<?php
include'../koneksi.php';

$idAnggota=$_POST['idAnggota'];
$nama=$_POST['nama'];
$jenisKelamin=$_POST['jenisKelamin'];
$alamat=$_POST['alamat'];
$status=$_POST['status'];

If(isset($_POST['simpan'])){
	mysqli_query($db,
		"UPDATE tbanggota
		SET nama='$nama',jenisKelamin='$jenisKelamin',alamat='$alamat',status='$status'
		WHERE idAnggota='$idAnggota'"
	);
	header("location:../index.php?p=anggota");
}
?>