<center><h1><font face="Century Ghotic"><b>- Selamat Bekerja Pak <?php echo $_SESSION['admin']['nama_admin']." -"?>  </b></font></h1></center>

<?php
	
	if (isset($_GET["halaman1"])) { header ("location:index.php");}
		
	elseif(isset($_GET["halaman2"])){ header ("location:halaman2.php");}
	
 ?>