<?php
include 'koneksi.php'; // Pastikan ini ada di awal sebelum query
?>
<div id="label-page" class="container mt-4">
    <h3 class="text-center text-primary fw-bold">Tampil Transaksi</h3>
</div>
<div id="content" class="container">
    <p id="tombol-tambah-container">
        <a href="index.php?p=transaksiInput" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Transaksi
        </a>
    </p>

    <!-- Tambahkan div pembungkus agar bisa di-scroll -->
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table id="tabel-tampil" class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th id="label-tampil-no">No</th>
                    <th>ID Transaksi</th>
                    <th>ID Anggota</th>
                    <th>ID Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Kembali</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tbtransaksi ORDER BY idTransaksi ASC";
                $q_tampil_transaksi = mysqli_query($db, $sql);
                
                $nomor = 1;
                while ($r_tampil_transaksi = mysqli_fetch_array($q_tampil_transaksi)) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $nomor++; ?></td>
                    <td><?php echo $r_tampil_transaksi['idTransaksi']; ?></td>
                    <td><?php echo $r_tampil_transaksi['idAnggota']; ?></td>
                    <td><?php echo $r_tampil_transaksi['idBuku']; ?></td>
                    <td><?php echo $r_tampil_transaksi['tanggalPeminjaman']; ?></td>
                    <td><?php echo $r_tampil_transaksi['tanggalKembali']; ?></td>
                    <td class="text-center">
                        <a href="index.php?p=transaksiEdit&id=<?php echo $r_tampil_transaksi['idTransaksi'];?>"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="proses/transaksiHapus.php?id=<?php echo $r_tampil_transaksi['idTransaksi']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>