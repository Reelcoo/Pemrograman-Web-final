<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include "config.php";

// Proses pencarian pesanan
if($_POST){
  $q = $_POST['cari'];
  $data = mysqli_query($conn,"
    SELECT p.*, pb.status 
    FROM pemesanan p
    LEFT JOIN pembayaran pb ON pb.id_pemesanan = p.id
    WHERE p.id = '$q'
       OR p.nama LIKE '%$q%'
       OR p.no_hp LIKE '%$q%'
  ");
}
?>
<!doctype html>
<html>
<head>
<title>Cek Status Pembayaran</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrap">
<section>

<h2>Cek Status Pembayaran</h2>

<!-- PESAN SETELAH PEMESANAN BERHASIL -->
<?php if(isset($_GET['pesan']) && $_GET['pesan']=='sukses'): ?>
  <div style="
    margin-bottom:15px;
    padding:15px;
    background:#0f766e;
    border-radius:8px;
    color:white;
  ">
    <b>✅ Pesanan berhasil dibuat</b><br><br>

    Silakan lakukan pembayaran ke:<br>
    <b>No Pembayaran:</b> <?= $NO_PEMBAYARAN ?><br>
    <b>Metode:</b> BCA / DANA / OVO / dll<br><br>

    Setelah membayar, cek status pesanan Anda di bawah ini.
  </div>
<?php endif; ?>

<!-- FORM CARI PESANAN -->
<form method="post">
  <input name="cari" placeholder="Masukkan ID / Nama / No HP" required>
  <button>Cari Pesanan</button>
</form>

<!-- HASIL PENCARIAN -->
<?php if(!empty($data)): ?>

  <?php if(mysqli_num_rows($data)==0): ?>
    <p style="margin-top:15px;color:#facc15">
      ❗ Pesanan tidak ditemukan
    </p>
  <?php else: ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Total Bayar</th>
      <th>Status</th>
    </tr>

    <?php while($r=mysqli_fetch_assoc($data)):
      $status = $r['status'] ?? 'Menunggu';
    ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <td><?= $r['nama'] ?></td>
      <td>Rp <?= number_format($r['total_harga'],0,',','.') ?></td>
      <td class="status <?= strtolower($status) ?>">
        <?= $status ?>
      </td>
    </tr>
    <?php endwhile; ?>

  </table>

  <?php endif; ?>
<?php endif; ?>

</section>
</div>

</body>
</html>
