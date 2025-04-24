<?php
include 'koneksi.php'; // Pastikan koneksi sudah ada

// Pastikan ID tersedia dan valid
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Anggota tidak ditemukan!");
}
$id_anggota = mysqli_real_escape_string($db, $_GET['id']);

$q_tampil_anggota = mysqli_query($db, "SELECT * FROM tbanggota WHERE idAnggota='$id_anggota'");
$r_tampil_anggota = mysqli_fetch_assoc($q_tampil_anggota);

if (!$r_tampil_anggota) {
    die("Data anggota tidak ditemukan!");
}
?>

<div class="container mt-4">
	<h3 class="text-center">Edit Data Anggota</h3>
	<form action="proses/anggota-edit-proses.php" method="post">
		<div class="mb-3">
			<label class="form-label">ID Anggota</label>
			<input type="text" name="idAnggota" value="<?php echo htmlspecialchars($r_tampil_anggota['idAnggota']); ?>"
				class="form-control" readonly>
		</div>
		<div class="mb-3">
			<label class="form-label">Nama</label>
			<input type="text" name="nama" value="<?php echo htmlspecialchars($r_tampil_anggota['nama']); ?>"
				class="form-control">
		</div>
		<div class="mb-3">
			<label class="form-label">Jenis Kelamin</label>
			<select name="jenisKelamin" class="form-select">
				<option value="Pria" <?php if ($r_tampil_anggota['jenisKelamin'] == "Pria") echo "selected"; ?>>Pria
				</option>
				<option value="Wanita" <?php if ($r_tampil_anggota['jenisKelamin'] == "Wanita") echo "selected"; ?>>
					Wanita</option>
			</select>
		</div>
		<div class="mb-3">
			<label class="form-label">Alamat</label>
			<textarea name="alamat" class="form-control"
				rows="2"><?php echo htmlspecialchars($r_tampil_anggota['alamat']); ?></textarea>
		</div>
		<div class="mb-3">
			<label class="form-label">Status</label>
			<select name="status" class="form-select">
				<option value="VIP" <?php if ($r_tampil_anggota['status'] == "VIP") echo "selected"; ?>>VIP</option>
				<option value="Mahasiswa" <?php if ($r_tampil_anggota['status'] == "Mahasiswa") echo "selected"; ?>>
					Mahasiswa</option>
				<option value="Umum" <?php if ($r_tampil_anggota['status'] == "Umum") echo "selected"; ?>>Umum</option>
				<option value="Pelajar" <?php if ($r_tampil_anggota['status'] == "Pelajar") echo "selected"; ?>>Pelajar
				</option>
			</select>
		</div>
		<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
	</form>
</div>