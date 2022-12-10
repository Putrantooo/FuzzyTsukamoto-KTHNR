<h3><b> Data Basis Aturan</b> </h3>
<hr>

<?php 
$data_kriteria = $kriteria->tampil();
$data_aturan = $aturan->tampil();
 ?>

 <form method="post">
 	<div class="table-responsive">
 		<table class="table table-bordered" id="example">
 			<thead>
 				<tr>
 					<th>Aturan</th>
 					<?php foreach ($data_kriteria as $key => $value): ?>
 						<th><?php echo $value['nama_kriteria']; ?></th>
 					<?php endforeach ?>

 					<th>Aksi</th>
 				</tr>
 			</thead>

 			<tbody>
 				<!-- memanggil aturan -->
 				<?php foreach ($data_aturan as $key_a => $value_a): ?> 
 					<tr>
 						<!-- menampilkan nama aturan(R1,R2 dst...) -->
 						<td><?php echo $value_a['nama_aturan']?></td>
 						<!-- Menampilkan semua data kriteria -->
 						<?php foreach ($data_kriteria as $key_k => $value_k): ?>
 							<!-- menampilkan semua data himpunan sesuai dengan kriteria () -->
 							<?php $data_himpunan =$himpunan->tampil($value_k['id_kriteria']);
 							// menampilkan aturan yang sudah terisi
 							$data_detail = $aturan->tampil_detail_aturan($value_a['id_aturan'],
 								$value_k['id_kriteria']);
 							// jika tidak kosong/ terisi maka berisi sesuai dengan atuaran berdasarkan id himpunannya
 							if (!empty($data_detail)) {
 								$id_himpunan = $data_detail['id_himpunan'];
 							} 
 							// jika kosong maka belum dipilih.
 							else {
 								$id_himpunan ="";
 							}

 							?>
 						 	
 						 	<td>
 						 		<!-- name"himpunan"=data berindex id_aturan dan id_kriteria -->
 						 		<select class="form-control" name="himpunan[<?php echo $value_a
 						 		['id_aturan'] ?>][<?php echo $value_k['id_kriteria'] ?>]">
 						 			<option value="">Pilih Himpunan</option>
                  <!-- <option value=""></option> -->
 						 			<!-- Menampilkan pilihan himpunan di setiap kriteria (max,sedang,min) -->
 						 			<?php foreach ($data_himpunan as $key_h => $value_h): ?>
 						 				<!-- untuk menampilkan himpunan yang sudah terisi (selected) -->
 						 				<option value="<?php echo $value_h['id_himpunan'] ?>" 
 						 					<?php if ($id_himpunan==$value_h['id_himpunan']) {echo "selected";} ?>>
 						 				<?php echo $value_h['keterangan_himpunan'] ?>
 						 				</option>
 						 			<?php endforeach ?>
 						 		</select>
 						 	</td>
 						 <?php endforeach ?> 
 						 <td>
 						 	<a href="index.php?halaman=hapusaturan&id=<?php echo $value_a['id_aturan'] ?>" class="btn btn-danger" onclick ="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
 						 </td>

 					</tr>
 				<?php endforeach ?>
 			</tbody>
 			
 		</table>
 	</div>
  <br>
  <br>
 	<button class="btn btn-primary" name="tambah">Tambah Aturan</button>
 	<button class="btn btn-warning" name="simpan">Simpan Aturan</button>
  </form>

  <?php 
  // jika ada tambah maka menjalankan class tambah,lalu merefresh kehalaman aturan
  	if (isset($_POST['tambah'])) 
  	{
  		$aturan->tambah();
  		echo "<script>location='index.php?halaman=aturan'</script>";
  	}

  	// jika ada simpan maka menjalankan class simpan, lalu merefreshnya
  	if (isset($_POST['simpan'])) 
  	{
  		$aturan->simpan($_POST['himpunan']);
  		echo "<script>location='index.php?halaman=aturan'</script>";
  	}
   ?>