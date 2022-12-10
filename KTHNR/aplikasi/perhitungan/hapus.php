<?php 
$id_hasil =$_GET['id'];
$laporan->hapus($id_hasil);

echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=laporan'>";

 ?>