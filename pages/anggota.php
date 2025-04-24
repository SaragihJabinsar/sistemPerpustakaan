<?php
include 'koneksi.php'; // Pastikan ini ada di awal sebelum query
?>
<div class="container mt-4">
	<h3 class="text-primary"><i class="fas fa-users"></i> Tampil Data Anggota</h3>
	<hr>
	<a href="index.php?p=anggota-input" class="btn btn-success mb-3">
		<i class="fas fa-user-plus"></i> Tambah Anggota
	</a>

	<!-- Tambahkan div pembungkus untuk scrolling -->
	<div style="max-height: 400px; overflow-y: auto;">
		<table class="table table-striped table-bordered">
			<thead class="table-dark">
				<tr>
					<th>No</th>
					<th>ID Anggota</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Alamat</th>
					<th>Status</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
                $sql = "SELECT * FROM tbanggota ORDER BY idAnggota ASC";
                $q_tampil_anggota = mysqli_query($db, $sql);

                $nomor = 1;
                while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {
                ?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $r_tampil_anggota['idAnggota']; ?></td>
					<td><?php echo $r_tampil_anggota['nama']; ?></td>
					<td><?php echo $r_tampil_anggota['jenisKelamin']; ?></td>
					<td><?php echo $r_tampil_anggota['alamat']; ?></td>
					<td><?php echo $r_tampil_anggota['status']; ?></td>
					<td>
						<a href="index.php?p=anggota-edit&id=<?php echo $r_tampil_anggota['idAnggota']; ?>"
							class="btn btn-warning btn-sm">
							<i class="fas fa-edit"></i> Edit
						</a>
						<a href="proses/anggota-hapus.php?id=<?php echo $r_tampil_anggota['idAnggota']; ?>"
							class="btn btn-danger btn-sm">
							<i class="fas fa-trash"></i> Hapus
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div> <!-- Tutup div scrolling -->
</div>