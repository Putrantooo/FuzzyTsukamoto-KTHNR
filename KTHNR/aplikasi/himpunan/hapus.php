<?php 
$id_kriteria =$_GET['id_kriteria'];
$id_himpunan =$_GET['id_himpunan'];
$himpunan->hapus($id_himpunan);

echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=himpunan&id=$id_kriteria'>";

 ?>