<?php 
require "server/base.php";

   if(isset($_POST["register"])) {
      if(register($_POST) > 0) {
         echo "<script>alert('Anda berhasil mendaftar')</script>";
         echo "<script>document.location.href = 'backend/dashboard.php'</script>";
      } else {
         echo "<script>alert('Anda gagal mendaftar : ". mysqli_error($connection). "') </script>";
         echo "<script>document.location.href = 'index.php'</script>";
      }
   }
?>
<!doctype html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Register</title>
</head>

<body class="text-center">
   <div class="container d-flex vh-100 justify-content-center align-items-center">
      <form action="" method="POST" class="col-md-4">
         <img src="assets/logo.png" class="mb-2" height="100" role="img">
         <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
         </div>
         <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
         </div>
         <div class="mb-3">
            <label for="password" class="form-label">Confirm password</label>
            <input type="password" class="form-control" id="password" name="confPass">
         </div>
         <div class="d-grid gap-2">
            <button type="submit" name="register" class="btn btn-block btn-primary">Register</button>
         </div>
      </form>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>