<?php 
include '../../config/class.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan hasil perhitungan pemesan</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
		<style>
		tbody td{
			text-align: center;
		}

	</style>
	<style type="text/css" media="print">
		@page { 
			size: portrait;
		}
		table { page-break-inside:auto }
		tr   { page-break-inside:avoid; page-break-after:auto }
		td   { page-break-inside:avoid; page-break-after:auto }
		thead { display:table-header-group }
		tfoot { display:table-footer-group }

	</style>
</head>
<body>
	<page size="A4" layout="portrait">
		<div class="container table-responsive">
			<h1 style="font-weight: bold; font-family: 'cambria'"><center><font color="purple" face="Century Ghotic">Laporan Pesanan Kelompok Tani Hutan Ngudi Rejeki</font></center> 
			<button class="btn btn-info btn-sm hidden-print" onclick="print()"><i class="fas fa-print"></i> Cetak</button>
				
			</h1>

			<table class="table table-bordered" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Pemesan</th>
						<th>Tanggal</th>
						<th>Inputan</th>
						<th>Hasil Produksi</th>
						<th>Rekomendasi</th>

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
						</tr>
					<?php endforeach ?>
				</tbody>

			</table>
		</div>
	</page>
</body>
</html>
