<?php
   session_start();
   if (!isset($_SESSION["login"])) {
      header("Location: ../login.php");
      exit;
   }
   require "../server/base.php";

   if(isset($_POST["submit"])) {
      if(create($_POST) > 0) {
         echo "<script>alert('Post baru telah dibuat')</script>";
         echo "<script>document.location.href = 'dashboard.php'</script>?";
      } else {
         // echo "<script>alert('Post baru gagal dibuat <br>". mysqli_error($connection). "'); document.location.href = 'dashboard.php'</script>";
         echo mysqli_error($connection);
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Create new post</title>
</head>
<body>
   <div class="container mt-4">
<!-- * content -->
      <form action="" method="POST" enctype="multipart/form-data">
         <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
         </div>
         <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description">
         </div>
         <div class="mb-3">
            <label class="form-label" for="body">Body</label>
            <textarea name="body" id="" cols="30" rows="10" id="mytextarea" class="form-control"></textarea>
         </div>
         <a href="./dashboard.php" class="btn border-secondary">Back</a>
         <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>