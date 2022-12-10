
<center><h2> <b><font color="purple" face="Century Ghotic">Laporan Pesanan KTH Ngudi Rejeki</font></b></h2></center>
<hr>
<a href="./laporan/cetak.php" class="btn btn-info btn-sm"><i class="fas fa-print fa-fw"></i> Cetak</a>
<link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<div>
	<br>

	<table class="table table-bordered" id="example">
		<thead>
			<tr>
				<th>No</th>
				<th>Pemesan</th>
				<th>Tanggal</th>
				<th>Inputan</th>
				<th>Hasil Produksi</th>
				<th>Rekomendasi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($laporan->tampil() as $key => $value): ?>
				<tr>
					<td><?php echo $key+=1; ?></td>
					<td><?php echo $value['nama_pemesan']?> </td>
					<td><?php echo $value['tanggal_pemesan']?> </td>
					<td style="padding: 0px;">
						<ul>
							<?php foreach ($kriteria->tampil_status("input") as $key_k => $value_k): ?>
								<?php $inputan = $perhitungan->tampil_inputan($value['id_pemesan'], $value_k['id_kriteria']) ?>
								<li><?php echo $value_k['nama_kriteria']." = ".$inputan['nilai_inputan'] ?></li>
							<?php endforeach ?>
						</ul>
					</td>
					<td><?php echo $value['jumlah_hasil'] ?></td>
					<td><?php echo $value['rekomendasi'] ?></td>
					<td>
						<a href="index.php?halaman=hasil_perhitungan&id=<?php echo $value['id_pemesan'] ?>" class="btn btn-info">Detail</a>
					</td>	
				</tr>			
			<?php endforeach ?>
		</tbody>
		<!-- <button class="btn btn-info btn-sm hidden-print" onclick="print('$laporan')"><i class="fas fa-print"></i> Cetak</button -->
	</table>
</div>