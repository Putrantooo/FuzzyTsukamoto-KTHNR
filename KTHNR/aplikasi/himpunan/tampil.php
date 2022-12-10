<?php 
// ['id'] menampilkan id yang sesuai dengan = url.
$id_kriteria = $_GET['id'];
// menampilkan detail nama kriteria yang akan di tambahi himpunan
$data_kriteria =$kriteria->detail($id_kriteria);
// menampilkan himpunan berdasarkan id kriteria yang akan di rubah
$data_himpunan =$himpunan->tampil($id_kriteria);
 ?>

 <h3>Data Himpunan Kriteria <?php echo $data_kriteria['nama_kriteria'] ?></h3>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Keterangan</th>
				<th>Nilai</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data_himpunan as $key => $value): ?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['nama_himpunan'] ?></td>
					<td><?php echo $value['keterangan_himpunan'] ?></td>
					<td><?php echo $value['nilai_himpunan'] ?></td>
					<td>
						<a href="index.php?halaman=ubahhimpunan&id_kriteria=<?php echo 
						$id_kriteria ?>&id_himpunan=<?php echo $value['id_himpunan'] ?>" 
						class="btn btn-warning">Ubah</a>
						<a href="index.php?halaman=hapushimpunan&id_kriteria=<?php echo 
						$id_kriteria ?>&id_himpunan=<?php echo $value['id_himpunan'] ?>" 
						class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Data ini?')">Hapus</a>					
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<a href="index.php?halaman=tambahhimpunan&id=<?php echo $id_kriteria?>" 
						class="btn btn-primary">Tambah</a>