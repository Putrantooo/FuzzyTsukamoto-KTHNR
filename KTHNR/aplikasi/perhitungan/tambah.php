<h3><b>Masukkan Inputan</b></h3>
<hr>
<!-- memanggil class tampil_status ( hanya yang input) -->
<?php $data_kriteria = $kriteria->tampil_status("input") ?>

<form method="post" class="form-horizontal">
	
<div class="form-group">
	<label class="col-sm-2">Nama Pemesan</label>
	<div class="col-sm-4">
	   <input type="text" name="nama_pemesan" class="form-control" autocomplete="off">
	</div>
</div>

<?php foreach ($data_kriteria as $key => $value): ?>
	<div class="form-group">
		<label class="col-sm-2"><?php echo $value ['nama_kriteria'] ?></label>
		<div class="col-sm-4">
			<input type="number" name="inputan[<?php echo $value ['id_kriteria'] ?>]" 
			class ="form-control" autocomplete="off">
		</div>
	</div>
<?php endforeach ?>
<div class="form-group">
	<div class="col-sm-2">
		<button class="btn btn-primary" name="proses">Proses</button>
	</div>
</div>

</form>

<?php 
if (isset($_POST['proses'])) 
{
	$id_pemesan=$perhitungan->tambah($_POST['nama_pemesan'], $_POST['inputan']);
	echo "<script>location='index.php?halaman=hasil_perhitungan&id=$id_pemesan'</script>"; 	
 } 
?>