<?php 
// ['id'] menampilkan id yang sesuai dengan = url.
$id_kriteria = $_GET['id'];
// menampilkan detail nama kriteria yang akan di tambahi himpunan
$data_kriteria =$kriteria->detail($id_kriteria);
 ?>

<h3>Tambah Himpunan Kriteria <?php echo $data_kriteria['nama_kriteria'] ?></h3>
<form method="post">
	<div class="form-group">
		<label>Nama Himpunan</label>
		<select class="form-control" name="nama_himpunan" required="">
			<option value="">Pilih himpunan</option>
			<option value="min">Nilai Minimal</option>
			<option value="tengah">Nilai Tengah</option>
			<option value="max">Nilai Maksimal</option>
		</select>
	</div>
	<div class="form-group">
		<label>Ketarangan Himpunan</label>
		<input type="text" name="keterangan_himpunan" class="form-control" required="" autocomplete="off">
	</div>
	<div class="form-group">
		<label>Nilai Himpunan</label>
		<input type="number" name="nilai_himpunan" class="form-control" required="" autocomplete="off">
	</div>
	<div class="form-group">
		<button class="btn btn-primary" name="simpan">Simpan</button>
	</div>
</form>

<?php 
if (isset($_POST['simpan'])) 
{
	$hasil = $himpunan->tambah($id_kriteria, $_POST['nama_himpunan'],  $_POST['keterangan_himpunan'], $_POST['nilai_himpunan']);
	if ($hasil=='sukses') 
	{
		echo "<div class='alert alert-info'>Tambah Data Himpunan Sukses</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=himpunan&id=$id_kriteria'>";
		

		
	}else{
		echo "<div class='alert alert-danger'>Tambah Data Himpunan Gagal. Data sudah ada</div>";
	}
}


 ?>