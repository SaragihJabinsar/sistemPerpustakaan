<?php
include '../koneksi.php'; // Pastikan koneksi terhubung

// Pastikan semua data tersedia sebelum menggunakannya
$idBuku = isset($_POST['idBuku']) && $_POST['idBuku'] !== '' ? $_POST['idBuku'] : null;
$judulBuku = isset($_POST['judulBuku']) ? mysqli_real_escape_string($db, $_POST['judulBuku']) : '';
$kategori = isset($_POST['kategori']) ? mysqli_real_escape_string($db, $_POST['kategori']) : '';
$pengarang = isset($_POST['pengarang']) ? mysqli_real_escape_string($db, $_POST['pengarang']) : '';
$penerbit = isset($_POST['penerbit']) ? mysqli_real_escape_string($db, $_POST['penerbit']) : '';
$status = isset($_POST['status']) ? mysqli_real_escape_string($db, $_POST['status']) : '';

if (isset($_POST['simpan'])) {
    // Cek apakah semua input tidak kosong
    if ($idBuku && $judulBuku && $kategori && $pengarang && $penerbit && $status) {
        $sql = "INSERT INTO tbbuku (idBuku, judulBuku, kategori, pengarang, penerbit, status) 
                VALUES ('$idBuku', '$judulBuku', '$kategori', '$pengarang', '$penerbit', '$status')";
        $query = mysqli_query($db, $sql);

        if ($query) {
            header("location:../index.php?p=buku");
            exit; // Pastikan tidak ada eksekusi lebih lanjut
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($db);
        }
    } else {
        echo "Semua field harus diisi!";
    }
}
?>