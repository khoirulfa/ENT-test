<?php 
require "../server/base.php";

$id = $_GET["id"];
if (destroy($id) > 0) {
   echo "<script>alert('Post berhasil dihapus')</script>";
   echo "document.location.href = 'dashboard.php'";
} else {
   echo "<script>alert('Post gagal dihapus <br> " . mysqli_error($connection) . "')</script>";
   echo "document.location.href = 'dashboard.php'";
}