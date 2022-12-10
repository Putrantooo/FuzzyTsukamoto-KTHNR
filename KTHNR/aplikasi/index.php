<?php include '../config/class.php'; ?>

<!-- jikabelum melakukan login tapi mencoba masuk paksa() -->
<?php if (!isset($_SESSION['admin'])) 
{
  echo "<script>alert('anda harus login');</script>";
  echo "<script>location='../index.php';</script>";
  exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelompok Tani Hutan Ngudi Rejeki</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fontawesome-free-5.15.2-web/css/all.css">
  <link rel="stylesheet" type="text/css" href="css/sendiri.css">
  <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
  <script src="js/jquery.js" ></script>
  
  
</head>
<body>

  <div id="wrapper">
    <nav class="navbar navbar-default">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
        data-target=".sidebar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Fuzzy Tsukamoto </a>

      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href="#"></a>
      <a class="navbar-brand" href=""><font  color="black" size="5"><b>Perhitungan Produksi Kunyit Bubuk</b></font></a>
      

    </div>
  </nav>
  <nav class="navbar-default navbar-side">
    <div class="sidebar-collapse">
      <ul class="nav" id="main-menu"> 
       <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
       <li><a href="index.php?halaman=kriteria"><i class="fas fa-toilet-paper"></i> kriteria</a></li>
       <li><a href="index.php?halaman=aturan"><i class="fas fa-pencil-ruler"></i> Aturan</a></li>
       <li><a href="index.php?halaman=perhitungan"><i class="fas fa-calculator"></i>  Perhitungan Produksi</a></li>
       <li><a href="index.php?halaman=laporan"><i class="fas fa-book"></i> Laporan hasil Prediksi</a></li>
       <li><a href="index.php?halaman=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
     </ul>
   </div>
 </nav>
 <div id="page-wrapper">
  <div id="page-inner">
    <?php 
          // jika tidak ada parameter halaman (index.php aja)
    if (!isset($_GET['halaman']))
    {
          // panggil file home.php
      include 'home.php';
    }
        // selain itu ada parameter halaman
    else
    {
          // jika halaman samadengan himpunan,maka panggil folder himpunan/nama filenya tampil himpunan
      if ($_GET['halaman']=="kriteria")
      {
        include 'kriteria/tampil.php';
      }
      elseif ($_GET['halaman']=="tambahkriteria")
      {
        include 'kriteria/tambah.php';
      }

      elseif ($_GET['halaman']=="ubahkriteria")
      {
        include 'kriteria/ubah.php';
      }

      elseif ($_GET['halaman']=="hapuskriteria")
      {
        include 'kriteria/hapus.php';
      }

      elseif ($_GET['halaman']=="himpunan")
      {
        include 'himpunan/tampil.php';
      }

      elseif ($_GET['halaman']=="tambahhimpunan")
      {
        include 'himpunan/tambah.php';
      }

      elseif ($_GET['halaman']=="ubahhimpunan")
      {
        include 'himpunan/ubah.php';
      }

      elseif ($_GET['halaman']=="hapushimpunan")
      {
        include 'himpunan/hapus.php';
      }


      elseif ($_GET['halaman']=="aturan")
      {
        include 'aturan/tampil.php';
      }

      elseif ($_GET['halaman']=="logout")
      {
        include 'logout.php';
      }

      elseif ($_GET['halaman']=="hapusaturan")
      {
        include 'aturan/hapus.php';
      }

      elseif ($_GET['halaman']=="perhitungan")
      {
        include 'perhitungan/tambah.php';
      }

      elseif ($_GET['halaman']=="hasil_perhitungan")
      {
        include 'perhitungan/hasil.php';
      }

      elseif ($_GET['halaman']=="laporan")
      {
        include 'laporan/tampil.php';
      }

      elseif ($_GET['halaman']=="hapushasil")
      {
        include 'perhitungan/hapus.php';
      }
    }


    ?>
  </div>

</div>

</div>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>


<!--membuat javascript untuk memunculkan collapse pada div sidebar-collapse ketika dibuka di mobile-->

<script>
  $(window).bind("load resize", function()
  {
    if($(this).width() < 768)
    {
      $('div.sidebar-collapse').addClass('collapse')
    }
    else
    {
      $('div.sidebar-collapse').removeClass('collapse')
    }
  });

</script>
</body>
</html>