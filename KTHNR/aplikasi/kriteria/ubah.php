<?php 
// ['id'] menampilkan id yang sesuai dengan = url.
// menampilkan detail nama kriteria dan himpunan yang akan di ubah himpunan
$id_kriteria = $_GET['id'];
// menampilkan detail nama kriteria yang akan di tambahi himpunan
$data_kriteria =$kriteria->detail($id_kriteria);


 ?>

 <h3>Ubah  Kriteria <?php echo $data_kriteria['nama_kriteria'] ?></h3>

<form method="post">
	<div class="form-group">
		<label>Nama Kriteria</label>
		<input type="text" name="nama_kriteria" class="form-control" required="" value="<?php echo 
		$data_kriteria['nama_kriteria'] ?>">

	</div>
	<div class="form-group">
		<label>Status Kriteria</label>
		<select class="form-control" name="status_kriteria" required="">
			<option value="">Pilih Status</option>
			<option value="input" <?php if ($data_kriteria['status_kriteria']=='input') 
			{
				echo "selected";
			} 
			?> 
				>Input</option>
			
			<option value="output" <?php if ($data_kriteria['status_kriteria']=='output') 
			{
				echo "selected";
			} 
			?> 
				>Output</option>
		
		</select>
	</div>
	
	<div class="form-group">
		<button class="btn btn-primary" name="simpan">Simpan</button>
	</div>
</form>

<?php 
if (isset($_POST['simpan'])) 
{
	$hasil = $kriteria->ubah($_POST['nama_kriteria'], $_POST['status_kriteria'],$id_kriteria);
	if ($hasil=='sukses')
	{
		echo "<div class='alert alert-info'>Ubah Data Kriteria Sukses</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kriteria'>";
		

		
	}else{
		echo "<div class='alert alert-danger'>Ubah Data Kriteria Gagal. Data sudah ada</div>";
	}
}


 ?>