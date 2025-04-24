<?php
include 'koneksi.php'; // Pastikan ini ada di awal sebelum query
?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Tampil Data Buku</h3>
        </div>
        <div class="card-body">
            <a href="index.php?p=bukuInput" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>

            <!-- Tambahkan div pembungkus untuk scrolling -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Buku</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tbBuku ORDER BY idBuku ASC";
                        $q_tampil_buku = mysqli_query($db, $sql);
                        $nomor = 1;
                        while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
                        ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $r_tampil_buku['idBuku']; ?></td>
                            <td><?php echo $r_tampil_buku['judulBuku']; ?></td>
                            <td><?php echo $r_tampil_buku['kategori']; ?></td>
                            <td><?php echo $r_tampil_buku['pengarang']; ?></td>
                            <td><?php echo $r_tampil_buku['penerbit']; ?></td>
                            <td><?php echo $r_tampil_buku['status']; ?></td>
                            <td>
                                <a href="index.php?p=bukuEdit&id=<?php echo $r_tampil_buku['idBuku']; ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="proses/bukuHapus.php?id=<?php echo $r_tampil_buku['idBuku']; ?>"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> <!-- Tutup div scrolling -->

        </div>
    </div>
</div>