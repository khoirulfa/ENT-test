  <?php
   session_start();
   if (!isset($_SESSION["login"])) {
      header("Location: ../../login.php");
      exit;
   }
   require "base.php";
   $id = $_GET["id"];
   $category = query("SELECT * FROM categories WHERE id = $id")[0];

   if(isset($_POST["submit"])) {
      if(update($_POST) > 0) {
         echo "<script>alert('Kategori berhasil diubah')</script>";
         echo "<script>document.location.href = 'index.php'</script>?";
      } else {
         echo "<script>alert('Kategori gagal diubah".mysqli_error($connection). "'); document.location.href = 'index.php'</script>";
         echo mysqli_error($connection);
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Create new category</title>
</head>
<body>
   <div class="container mt-4">
<!-- * content -->
      <form action="" method="POST">
         <input type="hidden" name="id" value="<?= $category["id"]; ?>">
         <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $category["category_title"]; ?>">
         </div>
         <a href="index.php" class="btn border-secondary">Back</a>
         <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>