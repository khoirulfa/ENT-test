<?php 
   session_start();
   if (!isset($_SESSION["login"])) {
      header("Location: ../login.php");
      exit;
   }
   require "../server/base.php";
   $id = $_GET["id"];
   $article = query("SELECT * FROM posts WHERE id = $id")[0];

   if(isset($_POST["submit"])) {
      if(update($_POST) > 0) {
         echo "<script>alert('Post telah diubah')</script>";
         echo "<script>document.location.href = 'dashboard.php'</script>?";
      } else {
         echo "<script>alert('Post gagal diubah <br>". mysqli_error($connection). "'); document.location.href = 'dashboard.php'</script>";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.tiny.cloud/1/ihsdnmc6l6080hvmhomlmxpoh7pkf9og2vsgu1zzwz1i2evi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
   <title>Create new post</title>
</head>
<body>
   <div class="container mt-4">
<!-- * content -->
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="id" value="<?= $article["id"]; ?>">
         <input type="hidden" name="created_at" value="<?= $article["created_at"]; ?>">
         <input type="hidden" name="thumbLama" value="<?= $article["thumbnail"]; ?>">
         <input type="hidden" name="user_id" value="<?= $article["user_id"] ?>">
         <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $article["title"]; ?>">
         </div>
         <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?= $article["description"]; ?>">
         </div>
         <div class="mb-3">
            <label class="form-label" for="body">Body</label>
            <textarea name="body" id="" cols="30" rows="10" id="mytextarea" class="form-control"><?= $article["body"]; ?></textarea>
         </div>
         <div class="mb-3">
            <label class="form-label" for="inputGroupSelect01">Category</label>
            <select class="form-select" id="inputGroupSelect01" name="category">
               <option selected>Choose...</option>
               <?php 
               $categories = mysqli_query($connection, "SELECT * FROM categories");
               foreach ($categories as $category) : ?>
                  <option value="<?= $category["id"]; ?>"><?= $category["category_title"]; ?></option>
               <?php endforeach; ?>
            </select>
         </div>
         <div class="mb-3">
            <img src="../img/<?= $article['thumbnail']; ?>" alt="" width="70px" class="img-thumbnail">
            <label class="form-label" for="body">Thumbnail</label>
            <input name="thumbnail" type="file" class="form-control">
         </div>
         <a href="./dashboard.php" class="btn border-secondary">Back</a>
         <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
   <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  </script>
</body>