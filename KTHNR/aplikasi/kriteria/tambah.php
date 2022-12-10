<h3>Tambah Kriteria</h3>
<form method="post">
	<div class="form-group">
		<label>Nama kriteria</label>
		<input type="text" name="nama_kriteria" class="form-control" required="" autocomplete="off">

	</div>

	<div class="form-group">
		<label>Status Kriteria</label>
		<select class="form-control" name="status_kriteria" required="">
			<option value="">Pilih Status</option>
			<option value="input">Input</option>
			<option value="output">Output</option>
		</select>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" name="simpan">Simpan</button>
	</div>
</form>

<?php 
if (isset($_POST['simpan'])) 
{
	$hasil = $kriteria->tambah($_POST['nama_kriteria'],  $_POST['status_kriteria']);
		echo "<div class='alert alert-info'>Tambah Data Kriteria Sukses</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kriteria'>";
}


 ?>