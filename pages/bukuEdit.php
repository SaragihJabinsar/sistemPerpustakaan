<?php
include 'koneksi.php'; // Pastikan ini ada di awal sebelum query
$idBuku = $_GET['id'];
$q_tampil_buku = mysqli_query($db, "SELECT * FROM tbbuku WHERE idBuku='$idBuku'");
$r_tampil_buku = mysqli_fetch_array($q_tampil_buku);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="text-center">Edit Data Buku</h3>
            <form action="proses/bukuEdit-proses.php" method="post">
                <div class="mb-3">
                    <label class="form-label">ID Buku</label>
                    <input type="text" name="idBuku" value="<?php echo $r_tampil_buku['idBuku']; ?>" readonly
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judulBuku" value="<?php echo $r_tampil_buku['judulBuku']; ?>"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" value="Special"
                            <?php if ($r_tampil_buku['kategori'] == "Special") echo "checked"; ?>>
                        <label class="form-check-label">Special</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" value="Premium"
                            <?php if ($r_tampil_buku['kategori'] == "Premium") echo "checked"; ?>>
                        <label class="form-check-label">Premium</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengarang</label>
                    <input type="text" name="pengarang" value="<?php echo $r_tampil_buku['pengarang']; ?>"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" value="<?php echo $r_tampil_buku['penerbit']; ?>"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Tersedia"
                            <?php if ($r_tampil_buku['status'] == "Tersedia") echo "checked"; ?>>
                        <label class="form-check-label">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Habis"
                            <?php if ($r_tampil_buku['status'] == "Habis") echo "checked"; ?>>
                        <label class="form-check-label">Habis</label>
                    </div>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>