<?php
session_start();
if($_SESSION['role']!='admin') die("Akses ditolak");
include "config.php";

if($_POST){
  $img=time()."_".$_FILES['gambar']['name'];
  move_uploaded_file($_FILES['gambar']['tmp_name'],"img/".$img);

  mysqli_query($conn,"INSERT INTO destinasi
  (nama,lokasi,kategori,deskripsi,gambar,
   harga_domestik,harga_mancanegara,parkir_motor,parkir_mobil)
  VALUES(
  '$_POST[nama]','$_POST[lokasi]','$_POST[kategori]',
  '$_POST[deskripsi]','$img',
  $_POST[hd],$_POST[hm],$_POST[pm],$_POST[pb]
  )");
  header("Location: index.php"); exit;
}
?>
<!doctype html>
<html>
<head>
<title>Tambah Wisata</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
<section>
<h2>Tambah Destinasi</h2>
<form method="post" enctype="multipart/form-data">
<input name="nama" placeholder="Nama" required>
<input name="lokasi" placeholder="Lokasi" required>
<input name="kategori" placeholder="Kategori" required>
<textarea name="deskripsi" placeholder="Deskripsi"></textarea>
<input type="file" name="gambar" required>
<input type="number" name="hd" placeholder="Harga Domestik" required>
<input type="number" name="hm" placeholder="Harga Mancanegara" required>
<input type="number" name="pm" placeholder="Parkir Motor" required>
<input type="number" name="pb" placeholder="Parkir Mobil" required>
<button class="btn btn-add">Simpan</button>
</form>
</section>
</div>
</body>
</html>
