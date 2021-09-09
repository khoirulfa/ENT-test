<?php 
session_start();
if (isset($_SESSION["login"])) {
   header("Location: index.php");
   exit;
}

require "server/base.php";
if(isset($_POST["login"])) {

   $email = $_POST["email"];
   $password = $_POST["password"];

   $result = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");

   // cek username
   if ( mysqli_num_rows($result) === 1 ) {

      // cek password
      $row = mysqli_fetch_assoc($result);
      if ( password_verify($password, $row["password"]) ) {
         // set session
         $_SESSION['login'] = true;
         $_SESSION['user_id'] = $row['id'];
         header("Location: backend/dashboard.php");
         exit;
      }
   }
   $error = true;
}
?>
<!doctype html>
<html lang="en">

<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Login</title>
</head>

<body class="text-center">
   <div class="container d-flex vh-100 justify-content-center align-items-center">
      <form action="" method="POST" class="col-md-4">
         <img src="assets/logo.png" class="mb-2" height="100" role="img">
         <?php if (isset($error)) echo '<span class="d-block text-danger">Email atau password salah</span>' ?>
         <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
         </div>
         <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
         </div>
         <div class="d-grid gap-2">
            <button type="submit" name="login" class="btn btn-block btn-primary">Login</button>
         </div>
      </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>