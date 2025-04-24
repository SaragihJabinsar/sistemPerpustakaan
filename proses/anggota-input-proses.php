<?php
include '../koneksi.php';

// Pastikan variabel koneksi sesuai dengan yang ada di koneksi.php
if (!isset($db)) {
    die("Koneksi database tidak ditemukan.");
}

if(isset($_POST['simpan'])) {
    // Pastikan semua field diisi sebelum diproses
    if (!empty($_POST['idAnggota']) && !empty($_POST['nama']) && !empty($_POST['jenisKelamin']) && !empty($_POST['alamat']) && !empty($_POST['status'])) {
        
        $idAnggota = mysqli_real_escape_string($db, $_POST['idAnggota']);
        $nama = mysqli_real_escape_string($db, $_POST['nama']);
        $jenisKelamin = mysqli_real_escape_string($db, $_POST['jenisKelamin']);
        $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
        $status = mysqli_real_escape_string($db, $_POST['status']);

        // Cek apakah ID sudah ada di database
        $cekId = mysqli_query($db, "SELECT idAnggota FROM tbanggota WHERE idAnggota = '$idAnggota'");
        if (mysqli_num_rows($cekId) > 0) {
            die("Error: ID Anggota sudah ada di database.");
        }

        $sql = "INSERT INTO tbanggota (idAnggota, nama, jenisKelamin, alamat, status) 
                VALUES ('$idAnggota', '$nama', '$jenisKelamin', '$alamat', '$status')";

        $query = mysqli_query($db, $sql);

        if ($query) {
            header("location: ../index.php?p=anggota");
            exit(); // Menghentikan script setelah redirect
        } else {
            die("Gagal menyimpan data: " . mysqli_error($db));
        }
    } else {
        die("Error: Semua field harus diisi.");
    }
}
?>