<?php 
$id_kriteria =$_GET['id'];
$kriteria->hapus($id_kriteria);

echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kriteria'>";

 ?>