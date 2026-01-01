<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include "config.php";

$id=(int)$_GET['id'];
$d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM destinasi WHERE id=$id"));

if($_POST){
  $harga = ($_POST['tipe']=="Domestik") ? $d['harga_domestik'] : $d['harga_mancanegara'];
  $total = $harga * $_POST['jumlah'];

  mysqli_query($conn,"INSERT INTO pemesanan
  (id_wisata,nama,no_hp,jumlah,tipe,total_harga,metode_pembayaran)
  VALUES
  ($id,'$_POST[nama]','$_POST[no_hp]',$_POST[jumlah],'$_POST[tipe]',$total,'$_POST[metode]')");

  header("Location: verifikasi.php"); exit;
}
?>
<!doctype html>
<html>
<head>
<title>Pemesanan</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
<section>
<h2>Pemesanan - <?= $d['nama'] ?></h2>
<form method="post">
<input name="nama" placeholder="Nama" required>
<input name="no_hp" placeholder="No HP" required>
<input type="number" name="jumlah" placeholder="Jumlah" required>
<select name="tipe">
<option>Domestik</option>
<option>Mancanegara</option>
</select>
<select name="metode">
<option>BCA</option><option>DANA</option><option>OVO</option>
</select>
<button>Pesan</button>
</form>
</section>
</div>
</body>
</html>
