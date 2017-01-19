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
					<li class="active">
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
									<li>
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
                            Pendaftaran <small><?php echo $nama?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href = "mahasiswa.php"> Dashboard </a>
                            </li>
							<li class="active">
                                <i class="fa fa-info"></i> Pendaftaran
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <!-- <h2>Bordered with Striped Rows</h2> -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perusahaan</th>
                                        <th>Jalur</th>
										<th>Status</th>
										<th>Catatan</th>
										<th>Tanggal Masuk</th>
										<th>Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										include "koneksi.php";	
										$sql2 = "SELECT * FROM mhs WHERE username='$nm'";
										$kueri2 = mysql_query($sql2);
										$data2 = mysql_fetch_array($kueri2);
										$nim2 = $data2['nim'];
										$sql = "SELECT * FROM magang where nim = $nim2";
										$kueri = mysql_query($sql);
										$no=1;
										while($data = mysql_fetch_array($kueri)){
											$nim = $data['nim'];
											$sql1 = "SELECT * FROM mhs WHERE nim='$nim'";
											$kueri1 = mysql_query($sql1);
											$data1 = mysql_fetch_array($kueri1);
										//$nama = $data1['nama'];
										
											if ($data['s_seleksi']=='Diterima'){
									?>
											<tr class = "success">
												<td><?php echo $no ?></td>
												<td><?php echo $data['perusahaan']?></td>
												<td><?php echo $data['jalur']?></td>
												<td><?php echo $data['s_seleksi']?></td>
												<td></td>
												<td><?php echo $data['tgl_masuk']?></td>
												<td><?php echo $data['tgl_keluar']?></td>
											</tr>
											<?php
											} elseif ($data['s_seleksi']=='Belum di Seleksi' && $data['verifikasi']=='Belum'){	
											?>
											<tr class = "warning">
												<td><?php echo $no ?></td>
												<td><?php echo $data['perusahaan']?></td>
												<td><?php echo $data['jalur']?></td>
												<td><?php echo $data['s_seleksi']?></td>
											</tr>
											<?php
											}elseif ($data['s_seleksi']=='Belum di Seleksi' && $data['verifikasi']=='Sudah'){	
											?>
											<tr class = "warning">
												<td><?php echo $no ?></td>
												<td><?php echo $data['perusahaan']?></td>
												<td><?php echo $data['jalur']?></td>
												<td><?php echo $data['s_seleksi']?></td>
											</tr>
											<?php
											}elseif ($data['s_seleksi']=='Belum di Seleksi' && $data['verifikasi']=='Gagal') {
											?>
											<tr class = "danger">
												<td><?php echo $no ?></td>
												<td><?php echo $data['perusahaan']?></td>
												<td><?php echo $data['jalur']?></td>
												<td><?php echo $data['verifikasi']?></td>
												<td><?php echo $data['keterangan']?></td>
											</tr>
											
											<?php
											}else{	
											?>
											<tr class = "warning">
												<td><?php echo $no ?></td>
												<td><?php echo $data['perusahaan']?></td>
												<td><?php echo $data['jalur']?></td>
												<td><?php echo $data['s_seleksi']?></td>
											</tr>
											<?php
											}
											$no++;}
									?>
                                </tbody>
                            </table>
                        </div>
					</div>
                </div>
                <!-- /.row -->

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
