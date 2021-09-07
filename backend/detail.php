<?php
   session_start();
   if (!isset($_SESSION["login"])) {
      header("Location: ../login.php");
      exit;
   }
   require "../server/base.php";
   $id = $_GET['id'];

   $article = query("SELECT * FROM posts WHERE id = $id")[0];
?>
<!doctype html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title><?= $article['title']; ?></title>
</head>
<body>
   <div class="container mt-4">
      <!-- * content -->
      <article>
         <div class="card">
            <div class="card-body">
               <figure>
                  <blockquote class="blockquote">
                     <h4 class="fw-bold"><?= $article['title']; ?></h4>
                  </blockquote>
                  <figcaption class="blockquote-footer">
                     <?= $article['description']; ?>
                  </figcaption>
               </figure>
               <h6 class="text-muted"><?= $article['created_at']; ?></h6>
               <div class="divider"></div>
               <img src="../img/<?= $article["thumbnail"]; ?>" alt="" class="img-thumbnail" style="max-width: 500px;">
               <article><?= $article['body']; ?></article>
            </div>
         </div>
      </article>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>