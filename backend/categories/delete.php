<?php 
session_start();
if (!isset($_SESSION["login"])) {
   header("Location: ../../login.php");
   exit;
}
require "base.php";

$id = $_GET["id"];
if (destroy($id) > 0) {
   echo "<script>alert('Kategori berhasil dihapus')</script>";
   header("Location: index.php");
} else {
   echo "<script>alert('Kategori gagal dihapus <br> " . mysqli_error($connection) . "')</script>";
   header("Location: index.php");
}
