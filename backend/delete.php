<?php 
session_start();
if (!isset($_SESSION["login"])) {
   header("Location: ../login.php");
   exit;
}
require "../server/base.php";

$id = $_GET["id"];
if (destroy($id) > 0) {
   echo "<script>alert('Post berhasil dihapus')</script>";
   header("Location: dashboard.php");
} else {
   echo "<script>alert('Post gagal dihapus <br> " . mysqli_error($connection) . "')</script>";
   header("Location: dashboard.php");
}
