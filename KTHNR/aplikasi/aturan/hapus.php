<?php 
$id =$_GET['id'];
$aturan->hapus($id);
echo "<script>location='index.php?halaman=aturan'</script>";
 ?>