<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
else{
	$nm = $_SESSION['username'];
}

//cek level user
if($_SESSION['hak_akses']!="mahasiswa"){
die("Anda bukan Mahasiswa");//jika bukan admin jangan lanjut
}
?>
<?php
	include "koneksi.php";
	
	$sql = "SELECT * FROM mhs WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nama = $data['nama'];
	$nim = $data['nim'];
	$prodi = $data['prodi'];
	?>
	<?php
	$sql1 = "SELECT * FROM akun WHERE username='$nm'";
	$kueri1 = mysql_query($sql1);
	$data1 = mysql_fetch_array($kueri1);
	$user = $data1['username'];
	$pass= $data1['password'];
	$hak= $data1['hak_akses'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Mahasiswa</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="mahasiswa.php">Mahasiswa</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
			
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nama?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!-- <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                        <li>
                            <a href="setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="mahasiswa.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#dm"><i class="fa fa-fw fa-th-list"></i> Daftar Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="dm" class="collapse">
                            <?php
								include "koneksi.php";
	
								$sql3 = "SELECT * FROM magang WHERE nim='$nim'";
								$kueri3 = mysql_query($sql3);
								$data3 = mysql_fetch_array($kueri3);
								$nim2 = $data3['nim'];
								$seleksi=$data3['s_seleksi'];
								$sel = $data3['verifikasi'];
									if($nim2!="" && $seleksi=="Diterima" && $sel=="Sudah"){
										?>
										<li>
											<a href="#"><i class="fa fa-fw fa-pencil"></i>Jalur Mandiri</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-fw fa-pencil"></i>Jalur Kerjasama</a>
										</li>
									<?php
									}elseif($nim2!="" && $seleksi=="Belum di Seleksi" && $sel=="Sudah"){
										?>
										<li>
											<a href="#"><i class="fa fa-fw fa-pencil"></i>Jalur Mandiri</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-fw fa-pencil"></i>Jalur Kerjasama</a>
										</li>
									<?php
									}elseif($nim2!="" && $seleksi=="Belum di Seleksi" && $sel=="Belum"){
										?>
										<li>
											<a href="#"><i class="fa fa-fw fa-pencil"></i>Jalur Mandiri</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-fw fa-pencil"></i>Jalur Kerjasama</a>
										</li>
									<?php
									}
									else{
										?>
										<li>
											<a href="../upload-download-files/daftar-mandiri.php"><i class="fa fa-fw fa-pencil"></i>Jalur Mandiri</a>
										</li>
										<li>
											<a href="kerjasama.php"><i class="fa fa-fw fa-pencil"></i>Jalur Kerjasama</a>
										</li>
							<?php
									}
							?>
                        </ul>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#info"><i class="fa fa-fw fa-th-list"></i> Info <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="info" class="collapse">
                            <li>
                                <a href="lowongan.php"><i class="fa fa-fw fa-info"></i>Lowongan Magang</a>
                            </li>
                            <li>
                                <a href="pendaftaran.php"><i class="fa fa-fw fa-info"></i>Pendaftaran</a>
                            </li>
                        </ul>
                    </li>
					<?php
						include "koneksi.php";
	
								$sql4 = "SELECT * FROM magang WHERE nim='$nim'";
								$kueri4 = mysql_query($sql4);
								$data4 = mysql_fetch_array($kueri4);
								$seleksi1=$data4['s_seleksi'];
								$sql5 = "SELECT * FROM umpanbalik WHERE nim='$nim'";
								$kueri5 = mysql_query($sql5);
								$data5 = mysql_fetch_array($kueri5);
								$nim5=$data5['nim'];
								
								if($seleksi1=="Diterima"){
									?>
									<li class="active">
										<a href="javascript:;" data-toggle="collapse" data-target="#m"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
										<ul id="m" class="collapse">
											<li>
												<a href="../upload-download-files/upload-log.php"><i class="fa fa-fw fa-file"></i>Logbook</a>
											</li>
											<li>
												<a href="../upload-download-files/upload-job.php"><i class="fa fa-fw fa-file"></i>Jobdesk</a>
											</li>
											<li>
												<a href="../upload-download-files/upload-absen.php"><i class="fa fa-fw fa-file"></i>Absensi</a>
											</li>
											<?php
												if($nim5==""){
													?>
											<li>
												<a href="umpanbalik.php"><i class="fa fa-fw fa-check"></i>Umpan Balik</a>
											</li>
													<?php
												} else{
											?>
											<li>
												<a href="#"><i class="fa fa-fw fa-check"></i>Umpan Balik</a>
											</li>
												<?php } ?>
										</ul>
									</li>
									<?php
								}
					?>
										<?php 
					if ($data4['jalur']!='kerjasama' && $data4['jalur']!=""){
					?>
					<li>
                        <a href="../upload-download-files/spm_mhs.php"><i class="fa fa-fw fa-tag"></i> Surat Pengantar</a>
                    </li>
					<?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Umpan Balik <small><?php echo $nama?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="mahasiswa.php"> Dashboard </a>
                            </li>
							<li class="active">
                                <i class="fa fa-check"></i> Umpan Balik
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-4">
                        <form role="form" action="" method="post">
							<h4>A.	Data Peserta Magang </h4>
							<div class="form-group">
                                <label for="disabledSelect">Nama</label>
                                <input name="nama" class="form-control" id="disabledInput" type="text" value="<?php echo $nama?>" readonly>
                            </div>
							<div class="form-group">
								<label>Nim</label>
								<input name="nim" type="text" class="form-control" value="<?php echo $nim?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Prodi</label>
								<input name="prodi" type="text" class="form-control" value="<?php echo $prodi?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Tempat Magang</label>
								<input name="tempat" type="text" class="form-control" value="<?php echo $data4['perusahaan']?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Tahun</label>
								<input name="tahun" type="text" class="form-control" placeholder="Tahun" required>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

					</div>
				</div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-12">
							<h4>B.	Parameter Penilaian </h4>
							<div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Parameter</th>
                                        <th>Sangat Setuju</th>
										<th>Setuju</th>
										<th>Kurang Setuju</th>
										<th>Tidak Setuju</th>
                                    </tr>
                                </thead>
                                <tbody>
									<tr>
										<td>1</td>
										<td>Posisi tempat magang sesuai dengan bidang ilmu</td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Sangat Setuju"></td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Setuju"></td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Kurang Setuju"></td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Tidak Setuju"></td>

									</tr>
									<tr>
										<td>2</td>
										<td>Ilmu yang didapat di kampus dapat mengimplentasikan di tempat magang</td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Sangat Setuju"></td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Setuju"></td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Kurang Setuju"></td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Tidak Setuju"></td>

									</tr>
									<tr>
										<td>3</td>
										<td>Mendapat ilmu baru yang tidak di dapat di kampus</td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Sangat Setuju"></td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Setuju"></td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Kurang Setuju"></td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Tidak Setuju"></td>

									</tr>
									<tr>
										<td>4</td>
										<td>Mendapatkan data dari tempat magang yang digunakan untuk laporan Magang atau TA</td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Sangat Setuju"></td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Setuju"></td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Kurang Setuju"></td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Tidak Setuju"></td>

									</tr>
                                </tbody>
                            </table>
                        </div>

					</div>
				</div>
                
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-6">
							<h4>C.	Kesan dan Pesan terhadap tempat magang </h4>
							<div class="form-group">
                                <label for="disabledSelect">1. Kesan Terhadap Tempat Magang</label>
                                <textarea name="kesan" class="form-control"></textarea>
                            </div>
							<div class="form-group">
								<label>2. Kendala Ketika Magang</label>
								<textarea name="kendala" class="form-control" ></textarea>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>3. Masukan Bagi Politeknik Negeri Batam</label>
								<textarea name="masukan" class="form-control" ></textarea>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							
							<button name="tblEdit" type="submit" class="btn btn-default">Simpan</button>
							<button name="batal" type="submit" class="btn btn-default">Batal</button>
						</form>
					</div>
				</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
<?php
		include "koneksi.php";
		if (isset($_POST['tblEdit'])){
			$tahun = $_POST['tahun'];
			$nim = $_POST['nim'];
			$no1 = $_POST['no1'];
			$no2 = $_POST['no2'];
			$no3 = $_POST['no3'];
			$no4 = $_POST['no4'];
			$kesan = $_POST['kesan'];
			$kendala = $_POST['kendala'];
			$masukan = $_POST['masukan'];
			for ($i=0; $i<1;$i++){
				$sql3 = "INSERT INTO umpanbalik values(NULL,'$nim','$tahun','$no1[$i]','$no2[$i]','$no3[$i]','$no4[$i]','$kesan','$kendala','$masukan')";
			$kueri3 = mysql_query($sql3);
			}
				if ($kueri3){
					echo "<script> alert('Umpan Balik berhasil');document.location='mahasiswa.php'</script>";
							}
				else {
					echo "<script> alert('Umpan Balik gagal');document.location='umpanbalik.php'</script>";
					echo mysql_error();
					}
				
		} 
		if (isset($_POST['batal'])){
		echo "<script> document.location='mahasiswa.php'</script>";
		
		}
						
		?>