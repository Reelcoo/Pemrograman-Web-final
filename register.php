<?php
include "config.php";

if($_POST){
  mysqli_query($conn,"INSERT INTO users(username,password,role)
  VALUES('$_POST[username]','$_POST[password]','user')");
  header("Location: login.php");
}
?>
<!doctype html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
<section style="max-width:400px;margin:auto">
<h2>Register</h2>
<form method="post">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button>Daftar</button>
</form>
</section>
</div>
</body>
</html>
