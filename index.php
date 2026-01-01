<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include "config.php";

$data=mysqli_query($conn,"SELECT * FROM destinasi");
?>
<!doctype html>
<html>
<head>
<title>Jelajah Wisata</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">

<header>
<h1>Jelajah Wisata</h1>
<nav>
<a href="index.php">Beranda</a>
<a href="verifikasi.php">Cek Status</a>
<?php if($_SESSION['role']=='admin'): ?>
  <a href="admin_verifikasi.php">Verifikasi</a>
  <a href="admin_tambah_wisata.php">+ Wisata</a>
<?php endif; ?>
<a href="logout.php">Logout</a>
</nav>
</header>

<section class="grid">
<?php while($d=mysqli_fetch_assoc($data)): ?>
<div class="card" style="background-image:url('img/<?= $d['gambar'] ?>')">
  <div class="content">
    <b><?= $d['nama'] ?></b><br>
    <span><?= $d['lokasi'] ?> • <?= $d['kategori'] ?></span>

    <div class="admin-actions">
    <?php if($_SESSION['role']=='admin'): ?>
      <a class="btn btn-edit" href="admin_edit_wisata.php?id=<?= $d['id'] ?>">Edit</a>
      <a class="btn btn-delete"
         href="admin_hapus_wisata.php?id=<?= $d['id'] ?>"
         onclick="return confirm('Hapus wisata?')">Hapus</a>
    <?php else: ?>
      <a class="btn btn-add" href="pemesanan.php?id=<?= $d['id'] ?>">Pesan</a>
    <?php endif; ?>
    </div>

  </div>
</div>
<?php endwhile ?>
</section>

</div>
</body>
</html>
