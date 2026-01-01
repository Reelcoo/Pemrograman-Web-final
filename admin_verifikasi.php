<?php
session_start();
if($_SESSION['role']!='admin') die("Akses ditolak");
include "config.php";

if(isset($_GET['set'])){
  [$id,$st]=explode("-",$_GET['set']);
  mysqli_query($conn,"
  INSERT INTO pembayaran(id_pemesanan,status)
  VALUES($id,'$st')
  ON DUPLICATE KEY UPDATE status='$st'");
  header("Location: admin_verifikasi.php"); exit;
}

$data=mysqli_query($conn,"SELECT * FROM pemesanan ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
<title>Verifikasi Admin</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
<section>
<h2>Verifikasi Pesanan</h2>
<table>
<tr><th>ID</th><th>Nama</th><th>Total</th><th>Aksi</th></tr>
<?php while($r=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $r['id'] ?></td>
<td><?= $r['nama'] ?></td>
<td>Rp <?= number_format($r['total_harga'],0,',','.') ?></td>
<td>
<a class="btn btn-add" href="?set=<?= $r['id'] ?>-Lunas">Setujui</a>
<a class="btn btn-delete" href="?set=<?= $r['id'] ?>-Ditolak">Tolak</a>
</td>
</tr>
<?php endwhile ?>
</table>
</section>
</div>
</body>
</html>
