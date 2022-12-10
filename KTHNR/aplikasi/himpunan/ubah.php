<?php 
// ['id'] menampilkan id yang sesuai dengan = url.
$id_kriteria = $_GET['id_kriteria'];
$id_himpunan = $_GET['id_himpunan'];
// menampilkan detail nama kriteria dan himpunan yang akan di ubah himpunan
$data_kriteria =$kriteria->detail($id_kriteria);
$data_himpunan =$himpunan->detail($id_himpunan);
 ?>

 <h3>Ubah Himpunan Kriteria <?php echo $data_kriteria['nama_kriteria'] ?></h3>
<form method="post">
	<div class="form-group">
		<label>Nama Himpunan</label>
		<select class="form-control" name="nama_himpunan" required="">
			<option value="">Pilih himpunan</option>
			<option value="min" <?php if ($data_himpunan['nama_himpunan']=='min') 
			{
				echo "selected";
			} 
			?> 
				>Nilai Minimal</option>
			
			<option value="tengah" <?php if ($data_himpunan['nama_himpunan']=='tengah') 
			{
				echo "selected";
			} 
			?> 
				>Nilai Tengah</option>
			
			<option value="max" <?php if ($data_himpunan['nama_himpunan']=='max') 
			{
				echo "selected";
			
			} 
			?> 
				>Nilai Maksimal</option>
		</select>
	</div>
	
	<div class="form-group">
		<label>Keterangan Himpunan</label>
		<input type="text" name="keterangan_himpunan" class="form-control" required="" value="<?php echo 
		$data_himpunan['keterangan_himpunan'] ?>">

	</div>

	<div class="form-group">
		<label>Nilai Himpunan</label>
		<input type="number" name="nilai_himpunan" class="form-control" required="" value="<?php echo 
		$data_himpunan['nilai_himpunan'] ?>">

	</div>
	<div class="form-group">
		<button class="btn btn-primary" name="simpan">Simpan</button>
	</div>
</form>

<?php 
if (isset($_POST['simpan'])) 
{
	$hasil = $himpunan->ubah($id_kriteria, $_POST['nama_himpunan'], $_POST['keterangan_himpunan'], $_POST['nilai_himpunan'],$id_himpunan);
	if ($hasil=='sukses') 
	{
		echo "<div class='alert alert-info'>Ubah Data Himpunan Sukses</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=himpunan&id=$id_kriteria'>";
		

		
	}else{
		echo "<div class='alert alert-danger'>Ubah Data Himpunan Gagal. Data sudah ada</div>";
	}
}


 ?>