<?php
session_start();
include "config.php";

if($_POST){
  $u=$_POST['username'];
  $p=$_POST['password'];

  $q=mysqli_query($conn,"SELECT * FROM users WHERE username='$u' AND password='$p'");
  if(mysqli_num_rows($q)){
    $r=mysqli_fetch_assoc($q);
    $_SESSION['login']=true;
    $_SESSION['role']=$r['role'];
    header("Location: index.php"); exit;
  } else $err="Login gagal";
}
?>
<!doctype html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
<section style="max-width:400px;margin:auto">
<h2>Login</h2>
<?php if(!empty($err)) echo "<p>$err</p>"; ?>
<form method="post">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button>Login</button>
</form>
<p>Belum punya akun? <a href="register.php">Daftar</a></p>
</section>
</div>
</body>
</html>
