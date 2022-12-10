<h3><b> Data Kriteria </b></h3>
<hr>
<?php 
$data_kriteria = $kriteria->tampil() 
?>
<link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

<div>
	<table class="table table-bordered" id="example">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Keterangan</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data_kriteria as $key => $value): ?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['nama_kriteria'] ?></td>
					<td>
						<a href="index.php?halaman=himpunan&id=<?php echo $value['id_kriteria']?>" 
						class="btn btn-primary">Himpunan</a>
						<a href="index.php?halaman=ubahkriteria&id=<?php echo $value['id_kriteria']?>"  
						class="btn btn-warning">Ubah</a>
						<a href="index.php?halaman=hapuskriteria&id=<?php echo $value['id_kriteria']?>"
						class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Data ini?')">Hapus</a>	
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<br>
  <br>
  <a href="index.php?halaman=tambahkriteria" 
						class="btn btn-primary">Tambah</a>
 	
 	

</div>