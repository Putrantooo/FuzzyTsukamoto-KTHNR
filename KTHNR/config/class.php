
<?php 
session_start();
$mysqli= new mysqli('localhost','root','','tsukamoto');



class admin
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi= $mysqli;
	}
	function login_admin($un,$ps)
	{
		// enkripsi sandi dengan md5
		$pass=md5($ps);

		// 1.mengambil data admin yang cocok dengan email dan passwordnya
		$ambil= $this->koneksi->query("SELECT * FROM admin WHERE username_admin='$un' AND password_admin='$pass'");
		// 2.menghitung data yang cocok
		$yangcocok= $ambil->num_rows;
		// 3.bila yangcocok samadengan 1 (ada 1 akun yang benar),mk login sukses
		if ($yangcocok==1)
		{
		 	// 3a. memecah akun ke array
			$akun= $ambil->fetch_assoc();
		 	// 3b. menyimpan akun ke session ['admin']
			$_SESSION['admin']= $akun;
			return "sukses";
		}
			// 4. selain itu (0 akun yang cocok), maka gagal
		else
		{
			return "gagal";
		}

	}

	function ubah_profil($nama_admin, $username_admin, $password_admin)
	{
		$id_admin = $_SESSION['admin']['id_admin'];
		if (empty($password_admin)) {
			$pass = $_SESSION['admin']['password_admin'];
		} else {
			$pass = md5($password_admin);
		}
		// mengubah ke db
		$this->koneksi->query("UPDATE admin SET nama_admin='$nama_admin', username_admin='$username_admin', password_admin='$pass'
			WHERE id_admin='$id_admin'");
		// mengubah ke session
		$_SESSION['admin']['nama_admin'] = $nama_admin;
		$_SESSION['admin']['username_admin'] = $username_admin;
		$_SESSION['admin']['password_admin'] = $pass;
	}
}
$admin= new admin($mysqli);


class kriteria
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi=$mysqli;
	}

	function tampil()
	{
		$data = array(); 
		$ambil=$this->koneksi->query("SELECT * FROM kriteria");
		while ($array = $ambil->fetch_assoc())
		{
			$data[]=$array;
		}
		return $data;
	}

	function tampil_status($status_kriteria)
	{
		$data = array(); 
		$ambil=$this->koneksi->query("SELECT * FROM kriteria WHERE status_kriteria='$status_kriteria'");
		while ($array = $ambil->fetch_assoc())
		{
			$data[]=$array;
		}
		return $data;
	}



	function detail($id_kriteria)
	{
		$ambil= $this->koneksi->query("SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'");
		$array=$ambil->fetch_assoc();
		return $array;
	}


	function tambah($nama_kriteria,$status_kriteria)
	{
			$this->koneksi->query("INSERT INTO kriteria (nama_kriteria,status_kriteria)
				VALUES ('$nama_kriteria','$status_kriteria')");
			
	}

	function ubah($nama_kriteria,$status_kriteria,$id_kriteria)
	{
		$this->koneksi->query("UPDATE kriteria SET nama_kriteria='$nama_kriteria',
			status_kriteria='$status_kriteria' WHERE id_kriteria='$id_kriteria'");
		return 'sukses';
	}


	function hapus($id_kriteria)
	{
		$this->koneksi->query("DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
	}


} 
$kriteria= new kriteria($mysqli);


class himpunan
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi= $mysqli;
	}

	function tampil($id_kriteria)
	{
		$data = array(); 
		$ambil=$this->koneksi->query("SELECT * FROM himpunan WHERE id_kriteria='$id_kriteria'");
		while ($array=$ambil->fetch_assoc()) 
		{
			$data[]=$array;
		}
		return $data;
	}
	function tambah($id_kriteria,$nama_himpunan,$keterangan_himpunan,$nilai_himpunan)
	{
			// membuat validasi untuk nama himpunan
		$cek_nama=$this->koneksi->query("SELECT * FROM himpunan WHERE nama_himpunan='$nama_himpunan'
			AND id_kriteria='$id_kriteria'");
		$hitung= $cek_nama->num_rows;
		if ($hitung==0) 
		{
			$this->koneksi->query("INSERT INTO himpunan (id_kriteria,nama_himpunan,keterangan_himpunan,nilai_himpunan)
				VALUES ('$id_kriteria','$nama_himpunan','$keterangan_himpunan','$nilai_himpunan')");
			return "sukses";
		} else {
			return "gagal";
		}
	}
	function detail ($id_himpunan)
	{
		$ambil= $this->koneksi->query("SELECT * FROM himpunan WHERE id_himpunan='$id_himpunan'");
		$array=$ambil->fetch_assoc();
		return $array;
	}

	function ubah($id_kriteria, $nama_himpunan, $keterangan_himpunan,$nilai_himpunan, $id_himpunan)
	{
		$this->koneksi->query("UPDATE himpunan SET id_kriteria='$id_kriteria',
			nama_himpunan='$nama_himpunan',keterangan_himpunan='$keterangan_himpunan', nilai_himpunan='$nilai_himpunan' WHERE id_himpunan='$id_himpunan'");
		return 'sukses';
	}

	function hapus($id_himpunan)
	{
		$this->koneksi->query("DELETE FROM himpunan WHERE id_himpunan='$id_himpunan'");
	}

	function ambil ($id_kriteria,$nama_himpunan)
	{
		$ambil = $this->koneksi->query("SELECT * FROM himpunan WHERE id_kriteria= '$id_kriteria'
			AND nama_himpunan= '$nama_himpunan' ");
		$array =$ambil->fetch_assoc();
		return $array;
	}
}
$himpunan= new himpunan($mysqli);



class aturan 
{
	public $koneksi;

	function __construct($mysqli)
	{
		$this->koneksi=$mysqli;
	}

	function tampil ()
	{
		$ambil=$this->koneksi->query("SELECT * FROM aturan");
		while ($array =$ambil->fetch_assoc()) {
			$data[]=$array;
		}
		return $data;
	}

	function tampil_detail_aturan($id_aturan,$id_kriteria)
	{
			// memgambil semua data detailaturan dan menggabungkan dengan tabel himpunan dimana data yang sama berada di kolom id.himpunan berdasarkan id aturan dan id kriteria
		$ambil =$this->koneksi->query("SELECT * FROM detail_aturan JOIN himpunan ON himpunan.id_himpunan=detail_aturan.id_himpunan WHERE id_aturan='$id_aturan' AND id_kriteria='$id_kriteria'");
		$array =$ambil->fetch_assoc();
		return $array;
	}

	function tambah()
	{
			// mengambil kode aturan terakhir,(ORDER BY = mengurutkan) (DESC= dari yang terbesar) (limit 1 = mengambil satu data) (AS= mengaliaskan "nama_aturan" menjadi "nama".) 
		$ambil_nama= $this->koneksi->query("SELECT nama_aturan as nama FROM aturan ORDER BY id_aturan
			DESC LIMIT 1");
			// memecah nama yang ada "R"nya di  $array_nama index"nama"
		$array_nama = $ambil_nama->fetch_assoc();
		$explode = explode ("R",$array_nama['nama']);
			// menggabungkan "R" lalu ditambah 1
		$nama_selanjutnya = "R".($explode[1]+1);

			// menambah nama aturan dimana isinya ('$nama_selanjutnya'= yag sudah di tambah) 
		$this->koneksi->query("INSERT INTO aturan (nama_aturan) VALUES ('$nama_selanjutnya')");
	}

	function simpan($himpunan)
	{
			// memperulangkan himpunan
		foreach ($himpunan as $id_aturan => $value_a) 
		{
				// memperulangkan value
			foreach ($value_a as $id_kriteria => $id_himpunan) {
					// mengambil data lama
				$data_lama = $this->tampil_detail_aturan($id_aturan, $id_kriteria);

					//jika di data lama ada, tetapi di data baru tidak ada,maka dihapus
				if (!empty($data_lama) AND empty($id_himpunan)) 
				{
					$id_himpunan = $data_lama['id_himpunan'];
					$this->koneksi->query("DELETE FROM detail_aturan WHERE id_aturan='$id_aturan'
						AND id_himpunan='$id_himpunan'");
				} 

					 //jika di data lama tidak ada, tetapi di data baru ada,maka ditambah
				if (empty($data_lama) AND !empty($id_himpunan)) 
				{
					$this->koneksi->query("INSERT INTO detail_aturan (id_aturan,id_himpunan) 
						VALUES ('$id_aturan','$id_himpunan')");
				} 

					 //jika di data lama  dan data baru sama-sama ada, maka diubah.
				if (!empty($data_lama) AND !empty($id_himpunan)) 
				{
					$id_himpunan_lama = $data_lama['id_himpunan'];
					$this->koneksi->query("UPDATE detail_aturan SET id_himpunan='$id_himpunan' WHERE id_aturan='$id_aturan' AND id_himpunan='$id_himpunan_lama'");
				} 

			}
		}
	}
	function hapus ($id_aturan)
	{
		$this->koneksi->query("DELETE FROM aturan WHERE id_aturan='$id_aturan'");
	}

	function tampil_detail_aturan_input($id_aturan)
	{
		$ambil = $this->koneksi->query("SELECT * FROM detail_aturan
			JOIN himpunan ON himpunan.id_himpunan=detail_aturan.id_himpunan
			JOIN kriteria ON kriteria.id_kriteria=himpunan.id_kriteria
			WHERE id_aturan='$id_aturan'
			AND status_kriteria='input'");
		  while ($array = $ambil->fetch_assoc()){
		  	$data[]= $array;
		  }
		  return $data;
	}

	function tampil_detail_aturan_output($id_aturan)
	{
		$ambil = $this->koneksi->query("SELECT * FROM detail_aturan
			JOIN himpunan ON himpunan.id_himpunan=detail_aturan.id_himpunan
			JOIN kriteria ON kriteria.id_kriteria=himpunan.id_kriteria
			WHERE id_aturan='$id_aturan'
			AND status_kriteria='output'");
		  $array = $ambil->fetch_assoc();
		  return $array;
	}
}
$aturan = new aturan ($mysqli);

	class perhitungan
	{
		public $koneksi;

		function __construct($mysqli)
		{
			$this->koneksi= $mysqli;
		}

		function tampil_per_nama($id_pemesan, $nama_kriteria)
        {
            $ambil=$this->koneksi->query("SELECT nilai_inputan FROM inputan JOIN kriteria ON inputan.id_kriteria=
            kriteria.id_kriteria WHERE id_pemesan='$id_pemesan'AND nama_kriteria='$nama_kriteria'");
            $array =$ambil->fetch_assoc();
            return $array['nilai_inputan'];
        }

		function tambah($nama_pemesan, $inputan)
		{
			// diisi menambah di tabel pemesan dan inputan
			$tanggal_pemesan = date("Y-m-d");
			$this->koneksi->query("INSERT INTO pemesan (nama_pemesan,
				tanggal_pemesan) VALUES ('$nama_pemesan','$tanggal_pemesan')");

			// mendapatkan id_pemesan yang baru saja disimpan. (Gunakan fungsi mysqli_insert_id)
			$id_pemesan =mysqli_insert_id($this->koneksi);
			foreach ($inputan as $id_kriteria => $nilai_inputan) 
			{
				$this->koneksi->query("INSERT INTO inputan (id_pemesan,id_kriteria,nilai_inputan)
				VALUES ('$id_pemesan','$id_kriteria','$nilai_inputan') ");
			}

			return $id_pemesan;
		}

		function tampil_inputan($id_pemesan,$id_kriteria)
		{
			$ambil = $this->koneksi->query("SELECT * FROM inputan WHERE id_pemesan= '$id_pemesan' AND id_kriteria= '$id_kriteria' ");
			$array = $ambil->fetch_assoc();
			return $array;
		}

		function hasil ($id_pemesan)
		{
			// menyimpan data" yang dibutuhkan (mmemanggil objek yang sudah kita buat sebelumnya)
			$kriteria = new kriteria($this->koneksi);
			$himpunan = new himpunan($this->koneksi);
			$aturan = new aturan ($this->koneksi);
			// memanggil objek, memanggil fungsi-fungsi agar bisa digunakan (mengaktifkan).
			$data_kriteria = $kriteria->tampil_status("input");
			foreach ($data_kriteria as $key_k => $value_k) 
			{
				$idk = $value_k['id_kriteria'];
				$data_inputan =$this->tampil_inputan($id_pemesan, $idk);
				$nilai_inputan = $data_inputan['nilai_inputan'];
				$data_min = $himpunan->ambil($idk,"min");
				$data_tengah = $himpunan->ambil($idk,"tengah");
				$data_max = $himpunan->ambil($idk,"max");
				$min =$data_min ['nilai_himpunan'];
				$max =$data_max ['nilai_himpunan'];

				 // menggunakan fungsi fungsi yang sudah dipanggil untuk membuat fuzzifikasi

				  //jika nilai tengah tidak kosong (ada) maka menggunkan rumus ini. 
				if (!empty($data_tengah)) 
				{
					$tengah = $data_tengah['nilai_himpunan'];
					if ($nilai_inputan <= $min) 
					{
						$fuzzifikasi[$idk]['min']=1;
					}
					elseif ($nilai_inputan > $min AND $nilai_inputan < $tengah) 
					{
						$fuzzifikasi[$idk]['min']=round(($tengah-$nilai_inputan)/($tengah-$min),4);
					}
					elseif ($nilai_inputan >= $tengah) 
					{
						$fuzzifikasi[$idk]['min']=0;
					}


					if ($nilai_inputan <= $min OR $nilai_inputan >= $max) 
					{
						$fuzzifikasi[$idk]['tengah']=0;
					}
					elseif ($nilai_inputan > $min AND $nilai_inputan <= $tengah) 
					{
						$fuzzifikasi[$idk]['tengah']=  round(($nilai_inputan-$min)/($tengah-$min),4);
					}
					elseif ($nilai_inputan > $tengah AND $nilai_inputan < $max) 
					{
						$fuzzifikasi[$idk]['tengah']=  round(($max-$nilai_inputan)/($max-$tengah),4);
					}



					if ($nilai_inputan <= $tengah) 
					{
						$fuzzifikasi[$idk]['max']=0;
					}
					elseif ($nilai_inputan > $tengah AND $nilai_inputan < $max) 
					{
						$fuzzifikasi[$idk]['max']= round(($nilai_inputan-$tengah)/($max-$tengah),4);
					}
					elseif ($nilai_inputan >= $max) 
					{
						$fuzzifikasi[$idk]['max']=1;
					}
				}	

				// untuk mencari data yang tidak ada nilai tengah
				else {
					if ($nilai_inputan <= $min)
					{
						$fuzzifikasi[$idk]['min']=1;
					}
					elseif ($nilai_inputan > $min AND $nilai_inputan < $max) 
					{
						$fuzzifikasi[$idk]['min'] = round(($max-$nilai_inputan)/($max-$min),4);
					}
					elseif ($nilai_inputan >= $max)
					{
						$fuzzifikasi[$idk]['min']=0;
					}


					if ($nilai_inputan <= $min)
					{
						$fuzzifikasi[$idk]['max']=0;
					}
					elseif ($nilai_inputan > $min AND $nilai_inputan < $max) 
					{
						$fuzzifikasi[$idk]['max'] = round(($nilai_inputan-$min)/($max-$min),4);
					}
					elseif ($nilai_inputan >= $max)
					{
						$fuzzifikasi[$idk]['max']=1;
					}					

				}
			}

			echo "<pre>";
			print_r($fuzzifikasi);
			echo "</pre>";

			
			// IMPLIKASI
			// mengambil semua data aturan
			$data_aturan =$aturan->tampil();
			foreach ($data_aturan as $key_a => $value_a)
			{
				// $ambil_ai(ambilinput)=
				// (1) mengambil detail aturan yang id kriteria dan nama himpunan, dengan cara detail_aturan di join dengan himpunan lalu himpunan di join dengan kriteria. 
				// (2) dimana yang di ambil hanya id_aturan dan yang statusnya = input

				// (1)
			$ambil_ai =$this->koneksi->query("SELECT kriteria.id_kriteria, himpunan.nama_himpunan
					FROM detail_aturan 
					JOIN himpunan ON himpunan.id_himpunan=detail_aturan.id_himpunan
					JOIN kriteria ON kriteria.id_kriteria=himpunan.id_kriteria
					-- (2)
					WHERE id_aturan='$value_a[id_aturan]'
					AND status_kriteria='input' ");
			// persiapan untuk memperulangkan id_aturan dan id kriteria dan nama himpunan.
			while ($array_ai = $ambil_ai->fetch_assoc())
			{
				$aturan_input[$value_a['id_aturan']][$array_ai['id_kriteria']] =
				 $array_ai['nama_himpunan'];
			}



			// $ambil_ao(ambiloutput)=
				// (1) mengambil detail aturan yang id kriteria dan nama himpunan, dengan cara  detail_aturan di join dengan himpunan lalu himpunan di join dengan kriteria.

				// (2) dimana yang di diambil hanya id_aturan dan yang statusnya = output

				// (1)
			$ambil_ao = $this->koneksi->query("SELECT kriteria.id_kriteria, himpunan.nama_himpunan
				FROM detail_aturan
				JOIN himpunan ON himpunan.id_himpunan=detail_aturan.id_himpunan
				JOIN kriteria ON kriteria.id_kriteria=himpunan.id_kriteria
				-- (2)
				WHERE id_aturan='$value_a[id_aturan]'
				AND status_kriteria='output' ");

			// persiapan untuk memperulangkan id_aturan dan id kriteria dan nama himpunan.
			$array_ao = $ambil_ao->fetch_assoc();
				$aturan_output[$value_a['id_aturan']][$array_ao['id_kriteria']]=
				$array_ao['nama_himpunan'];
			}
			// mengelompokkan data untuk mencari nilai minimal
			foreach ($aturan_input as $ida => $value_ida) {
				foreach ($value_ida as $idk => $nama_himpunan) {
					$kelompok_min[$ida][$idk]= $fuzzifikasi[$idk][$nama_himpunan];
				}
			}

			// mencari alfa predikat menggunakan fungsi min
			foreach ($kelompok_min as $ida => $value_ida)
			{
				$alfa[$ida] = min($value_ida);
			}

			// Menghitung nilai implikasi susuai rumus
			// jika nama_himpunan min maka rumusnya = pk_max - (a_predikat*(pk_max - px_min))
			// jika nama_himpunan max maka rumusnya = (a_predikat * (pk_max - pk_min))+ pk_min

			// menyiapkan data dengan cara memanggil fungsi" 
			foreach ($aturan_output as $ida => $value_ida) {
				foreach ($value_ida as $idk => $nama_himpunan) 
				{
					$data_min = $himpunan->ambil($idk,"min");
					$data_tengah =$himpunan->ambil($idk,"tengah");
					$data_max = $himpunan->ambil($idk,"max");
					$min = $data_min['nilai_himpunan'];
					$max = $data_max ['nilai_himpunan'];
					

					// mencari nilai implikasi jika min
					if ($nama_himpunan=="min") 
					{
						$implikasi[$ida]= round($max - ($alfa[$ida] * ($max-$min)),4);
					} 

					// jika max
					elseif ($nama_himpunan=="max") 
					{
						$implikasi[$ida]= round(($alfa[$ida] * ($max - $min)) + $min,4);
					}
				}
			}

			echo "<pre>";
			print_r($implikasi);
			echo "</pre>";

			// Defuzzifikasi
			// rumus= (semua_nilai alfa predikat * semua nilai implikasi) / jumlah semua nilai alfa predikat

			// pembilang adalah (semua_nilai alfa predikat * semua nilai implikasi)
			$pembilang =0;
			foreach ($implikasi as $ida=> $value_ida) {
				$pembilang += round(($alfa[$ida]*$value_ida), 4);

			}
			 // echo "<pre>";
			 // print_r($pembilang);
			 // echo "</pre>";
			// penyebut adalah jumlah semua nilai alfa predikat
			$penyebut =array_sum($alfa);
			$defuzzifikasi= round($pembilang/$penyebut);

			
			// Menyimpan Defuzzifikasi ke tabel hasil
			// Mengecek apakah data sudah ada apa belum
			$cek_hasil = $this->koneksi->query("SELECT id_hasil FROM hasil WHERE id_pemesan='$id_pemesan'");
			// Jika belum ada maka ditambahkan
			if ($cek_hasil->num_rows == 0) 
			{
				$permintaan = $this->tampil_per_nama($id_pemesan,"permintaan");
				$persediaan = $this->tampil_per_nama($id_pemesan,"persediaan");
				$fix = $persediaan + $defuzzifikasi;
				if ($permintaan >= $fix) {
					$rekomendasi = "Produksi tidak memenuhi";
				} else {
					$rekomendasi = "Produksi memenuhi";
				}
				// menambah data rekomendasi ke db
				$this->koneksi->query("INSERT INTO hasil (id_pemesan, jumlah_hasil, rekomendasi) VALUES ('$id_pemesan','$defuzzifikasi','$rekomendasi') ");
			}

			// Menyiapkan hasil yang akan ditampilkan
			$tampil['fuzzifikasi']= $fuzzifikasi;
			$tampil['implikasi']= $implikasi;
			$tampil['defuzzifikasi']= $defuzzifikasi;
			return $tampil;
		}

		function tampil_rumus_fuzzifikasi($id_pemesan)
		{
			$kriteria =  new kriteria ($this->koneksi);
			$himpunan =  new himpunan ($this->koneksi);
			$data_kriteria = $kriteria->tampil_status("input");
			foreach ($data_kriteria as $key_k => $value_k) 
			{
				$idk = $value_k['id_kriteria'];
				$data_min = $himpunan->ambil($idk, "min");
				$data_tengah = $himpunan->ambil($idk, "tengah");
				$data_max = $himpunan->ambil($idk, "max");
				
				$min = $data_min['nilai_himpunan'];
				$max = $data_max['nilai_himpunan'];

				// menampilkan rumus yang mempunyai nilai tengah
				if (!empty($data_tengah)) 
				{
					$tengah = $data_tengah['nilai_himpunan'];

					// MIN
					$data[$idk]['min'][0]= "1, x &le; ".$min;
					$data[$idk]['min'][1]= "(Nilai tengah - x) / (Nilai tengah - Nilai min), ".$min." > X < ".$tengah;
					$data[$idk]['min'][2]= "0, x &#8805; ".$tengah;

					// TENGAH
					$data[$idk]['tengah'][0]= "0, x &le; ".$min." OR x &#8805; ".$max;
					$data[$idk]['tengah'][1]= "(x - Nilai min) / (Nilai tengah - Nilai min),  ".$min." > X &le; ".$tengah;
					$data[$idk]['tengah'][2]= "(Nilai max - x) / (Nilai max - Nilai tengah),  ".$tengah."  > X < ".$max;


					// MAX
					$data[$idk]['max'][0]= "0, x &le; ".$tengah;
					$data[$idk]['max'][1]= "(x - Nilai tengah) / (Nilai max - Nilai tengah),  ".$tengah."> X <".$max;
					$data[$idk]['max'][2]= "1, x &#8805;  ".$max;
				}

				// untuk yang tidak mempunyai nilai tengah
				else {
					// MIN
					$data[$idk]['min'][0]= "1, x &le; ".$min;
					$data[$idk]['min'][1]= "(Nilai max - x) / (Nilai max - Nilai min), ".$min. " > X < ".$max;
					$data[$idk]['min'][2]= "0, x &#8805; ".$max;

					// MAX
					$data[$idk]['max'][0]= "0, x &le;".$min;
					$data[$idk]['max'][1]= "(x - Nilai min) / (Nilai max - Nilai min), ".$min." > X <".$max;
					$data[$idk]['max'][2]= "1, x &#8805; ".$max;

				}
			}
			return $data;
		}
	}
	$perhitungan = new perhitungan ($mysqli);

	class laporan
	{
		public$koneksi;
		function __construct($mysqli)
		{
			$this->koneksi=$mysqli;
		}

		function tampil()
		{
			$ambil = $this->koneksi->query("SELECT * FROM hasil JOIN pemesan ON pemesan.id_pemesan=hasil.id_pemesan");
			while ($array = $ambil->fetch_assoc()) {
				$data[] = $array;
			}
			return $data;
		}

		function hapus($id_hasil)
		{
		$this->koneksi->query("DELETE FROM hasil WHERE id_hasil='$id_hasil'");
		}

	}
	$laporan = new laporan ($mysqli);
?>