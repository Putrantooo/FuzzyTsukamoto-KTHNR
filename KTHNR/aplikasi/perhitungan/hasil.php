<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<h3>Hasil Perhitungan</h3>

<?php 
$data_kriteria = $kriteria->tampil_status("input");
$hasil = $perhitungan->hasil($_GET['id']);
$tampil = $perhitungan->tampil_rumus_fuzzifikasi($_GET['id']);

// echo "<pre>";
// print_r ($hasil);
// echo "</pre>";
?>

<p class="lead">1. Rumus</p>
<div class="table responsive">
	<table class="table table-bordered">
		<?php foreach ($data_kriteria as $key_k => $value_k): ?>
			<?php $data_himpunan = $himpunan->tampil($value_k['id_kriteria']) ?>
			<tr class="active">
				<td colspan="<?php echo count($data_himpunan)*2 ?>" class="text-center">
					<b><?php echo $value_k['nama_kriteria']; ?></b>
				</td>
			</tr>

			<tr>
				<td colspan="<?php echo count($data_himpunan)*2 ?>" class="text-center">
					<div id="grafik_<?php echo $value_k['id_kriteria'] ?>" style ="height: 200px; margin: 0 auto"></div>
				</td>
			</tr>
			
			<tr>
				<?php foreach ($data_himpunan as $key_h => $value_h): ?>
					<td style="vertical-align: middle;"> &micro; <?php echo $value_k['nama_kriteria']." ".
					$value_h['keterangan_himpunan'] ?>	
					</td>
					
					<td style="padding: 0px;">
						<table class="table" style="margin: 0px;">
							<?php foreach ($tampil[$value_k['id_kriteria']][$value_h['nama_himpunan']] as $key_t => $value_t): ?>
								<tr>
									<td><?php echo $value_t ?></td>
								</tr>
							<?php endforeach ?>
						</table>
							
					</td>
					
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</table>
</div>
<?php foreach ($data_kriteria as $key_k => $value_k): ?>
	<?php 
	$idk = $value_k['id_kriteria'];
	$data_himpunan = $himpunan->tampil($idk);
	$data_min = $himpunan->ambil($idk, "min");
	$data_tengah = $himpunan->ambil($idk, "tengah");
	$data_max = $himpunan->ambil($idk, "max");
	$min = $data_min['nilai_himpunan'];
	$max = $data_max['nilai_himpunan'];
	?>
	<script type="text/javascript">
		$(function () {
	    Highcharts.chart('grafik_<?php echo $value_k['id_kriteria'] ?>',{
		  	title: {
		  		text:''
		  	},
		  	xAxis: {
		  		title : {
		  			text:''
		  		}
		  	},
		  	yAxis: {
		  		title: {
		  			text:''
		  		}
		  	},
		  	tooltip: {
		  		headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
		  		pointFormat: '<span style="color:{point.color}"></span>x:{point.x}, y:{point.y}'
		  	},
		  	plotOptions: {
		  		series: {
		  			enableMouseTracking: false
		  		}
		  	},
		  	legend : {
		  		enabled: false
		  	},
		  	<?php if (!empty($data_tengah)): ?>
		  		<?php $tengah = $data_tengah['nilai_himpunan']; ?>
		  	series: [
		  	{
		  		type: 'line',
		  		name: '',
		  		color: 'black',
		  		data: [[0, 0], [<?php echo $min ?>, 0], [<?php echo $tengah ?>, 1], [<?php echo $max ?>, 0],                   [<?php echo $max +$min ?>, 0]]
		  	},
		  	{
		  		type: 'line',
		  		name: '',
		  		color: 'green',
		  		data: [[0, 1], [<?php echo $min ?>, 1], [<?php echo $tengah ?>, 0], [<?php echo $max ?>, 1],                   [<?php echo $max +$min ?>, 1]]
		  	},
		  	<?php foreach ($data_himpunan as $key_h => $value_h): ?>
		  		{
		  			type: 'line',
		  			name: '',
		  			dashStyle: 'dot',
		  			color: 'red',
		  			data: [
		  			{
		  				x : <?php echo $value_h['nilai_himpunan'] ?>,
		  				y : 0,
		  			}, {
		  				x : <?php echo $value_h['nilai_himpunan'] ?>,
		  				y : 1,
		  				dataLabels:{
		  					enabled: true,
		  					format: '<?php echo $value_h['keterangan_himpunan'] ?> : {point.x}'
		  				}
		  			}
		  		]
			},	
		 <?php endforeach ?>
		  	]
	<?php else:  ?>
		series: [
		{
			type: 'line',
			name: '',
			color: 'black',
			data: [[0, 0], [<?php echo $min ?>, 0], [<?php echo $max ?>, 1], [<?php echo ($max + $min) ?>, 1]]
		},
		{
			type: 'line',
			name: '',
			color: 'green',
			data: [[0, 1], [<?php echo $min ?>, 1], [<?php echo $max ?>, 0], [<?php echo ($max + $min) ?>, 0]]
		},
		<?php foreach ($data_himpunan as $key_h => $value_h): ?>
			{
				type: 'line',
				name: '',
				dashStyle: 'dot',
				color: 'red',
				data: [
				{
					x: <?php echo $value_h['nilai_himpunan'] ?>,
					y: 0,
				},{
					x: <?php echo $value_h['nilai_himpunan'] ?>,
					y: 1,
					dataLabels:{
						enabled: true,
						format: '<?php echo $value_h['keterangan_himpunan'] ?> : {point.x}'
					}			
				}
			]
		},	
		<?php endforeach ?>
		]
	  <?php endif ?>
		  }); 		
		});
	</script>
<?php endforeach ?>

<p class="lead">2. Fuzzifikasi</p>
<?php foreach ($data_kriteria as $key_k => $value_k): ?>
	<?php $inputan = $perhitungan->tampil_inputan($_GET['id'], $value_k['id_kriteria']) ?>
	<p><?php echo $value_k['nama_kriteria']." : x = ".$inputan['nilai_inputan'] ?></p>
	<?php foreach ($himpunan->tampil($value_k['id_kriteria']) as $key_h => $value_h): ?>
		<p><?php echo "&micro; ".$value_k['nama_kriteria']." ".$value_h['nama_himpunan']." = ".$hasil['fuzzifikasi'][$value_k['id_kriteria']][$value_h['nama_himpunan']] ?></p>
	<?php endforeach ?>
	<hr>
<?php endforeach ?>



<p class="lead">3. Implikasi</p>
<?php $data_aturan = $aturan->tampil(); ?>
<?php foreach ($data_aturan as $key_a => $value_a): ?>
	<p>
		<?php 
		$data_input = $aturan->tampil_detail_aturan_input($value_a['id_aturan']);
		$isi_aturan = "";
		foreach ($data_input as $key_i => $value_i) {
			$isi_aturan .= $value_i['nama_kriteria']." ".$value_i['keterangan_himpunan']." AND ";
		}
		echo "<b>Rule ".($key_a+=1)." : </b>IF ".substr($isi_aturan, 0,-4);
		$data_output = $aturan->tampil_detail_aturan_output($value_a['id_aturan']);
		echo "THEN ".$data_output['nama_kriteria']." ".$data_output['keterangan_himpunan'];
		?>
	</p>
	<p>
		<?php 
		$isi_alfa ="";
		foreach ($data_input as $key_i => $value_i) {
			$isi_alfa .= $hasil['fuzzifikasi'][$value_i['id_kriteria']][$value_i['nama_himpunan']]." , ";
		}
		echo "&alpha; predikat = min (".substr($isi_alfa, 0, -3).")";
		 ?>
	</p>
	<p>
		<?php 
		echo "implikasi = ".$hasil['implikasi'][$value_i['id_aturan']];
		?>
	</p>
	<hr>
<?php endforeach ?>

<p class="lead">4. Defuzzifikasi</p>
<p>
	<?php 
	echo "Defuzzifikasi = ".$hasil['defuzzifikasi'];
	?>
</p>

<p class="lead">5. Hasil</p>
<p>
	<?php 
	$permintaan = $perhitungan->tampil_per_nama($_GET['id'],"permintaan");
	$persediaan = $perhitungan->tampil_per_nama($_GET['id'], "persediaan");
	$bahan = $perhitungan->tampil_per_nama($_GET['id'], "Bahan baku");
	$fix = $hasil['defuzzifikasi'];
	$hayo = $fix + $persediaan;
	$situk = $permintaan + $permintaan;
	$loro = $permintaan/2;
	$telu = $situk + $loro;
	$papat = (20/100)*$permintaan;
	$limo = $papat + $telu;
	$final = $limo - $bahan;
	if ($permintaan > $hayo)
	{
	    echo "Produksi tidak memenuhi, harus menambah bahan baku";
	} else {
		echo "Produksi memenuhi,pesanan produksi kunyit bubuk segera dikerjakan";
	}
	?>
</p>


