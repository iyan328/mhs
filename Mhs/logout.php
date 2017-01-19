<?php
  session_start();
  session_destroy();?>
  <center>Anda telah sukses keluar sistem <b>[LOGOUT]<b>
  <center><a href="../index.html"><b>[LOGIN]<b> kembali</a>
<?php
// Apabila setelah logout langsung menuju halaman utama website, aktifkan baris di bawah ini:

  //header('location:http://localhost/ta/index.php');
?>
