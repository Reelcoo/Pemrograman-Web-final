<?php
session_start();
if($_SESSION['role']!='admin') die("Akses ditolak");
include "config.php";

$id=(int)$_GET['id'];
$d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM destinasi WHERE id=$id"));

if($_POST){
  $img=$d['gambar'];
  if(!empty($_FILES['gambar']['name'])){
    $img=time()."_".$_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'],"img/".$img);
  }

  mysqli_query($conn,"UPDATE destinasi SET
  nama='$_POST[nama]', lokasi='$_POST[lokasi]', kategori='$_POST[kategori]',
  deskripsi='$_POST[deskripsi]', gambar='$img',
  harga_domestik=$_POST[hd], harga_mancanegara=$_POST[hm],
  parkir_motor=$_POST[pm], parkir_mobil=$_POST[pb]
  WHERE id=$id");

  header("Location: index.php"); exit;
}
?>
<!doctype html>
<html>
<head>
<title>Edit Wisata</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
<section>
<h2>Edit Destinasi</h2>
<form method="post" enctype="multipart/form-data">
<input name="nama" value="<?= $d['nama'] ?>" required>
<input name="lokasi" value="<?= $d['lokasi'] ?>" required>
<input name="kategori" value="<?= $d['kategori'] ?>" required>
<textarea name="deskripsi"><?= $d['deskripsi'] ?></textarea>
<input type="file" name="gambar">
<input type="number" name="hd" value="<?= $d['harga_domestik'] ?>" required>
<input type="number" name="hm" value="<?= $d['harga_mancanegara'] ?>" required>
<input type="number" name="pm" value="<?= $d['parkir_motor'] ?>" required>
<input type="number" name="pb" value="<?= $d['parkir_mobil'] ?>" required>
<button class="btn btn-edit">Update</button>
</form>
</section>
</div>
</body>
</html>
