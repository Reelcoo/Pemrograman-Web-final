<?php
session_start();
if($_SESSION['role']!='admin') die("Akses ditolak");
include "config.php";

$id=(int)$_GET['id'];
$d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT gambar FROM destinasi WHERE id=$id"));
if($d && file_exists("img/".$d['gambar'])) unlink("img/".$d['gambar']);

mysqli_query($conn,"DELETE FROM destinasi WHERE id=$id");
header("Location: index.php");
