<?php 
   require "server/base.php";
   $slug = $_GET['slug'];

   $article = query("SELECT * FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id WHERE slug = '$slug'")[0];
?>
<!doctype html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title><?= $article['title']; ?></title>
</head>
<body>
   <div class="container mb-5">
      <header
         class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
         <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="assets/logo.png" class="bi me-2" width="40" role="img">
         </a>
   
         <div class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            My blog
         </div>
   
         
         <div class="col-md-3 text-end">
         </div>
      </header>

      <!-- * content -->
      <article>
         <div class="card">
            <div class="card-body">
               <figure>
                  <span>&mdash; <?= $article['category_title']; ?></span>
                  <blockquote class="blockquote">
                     <h4 class="fw-bold"><?= $article['title']; ?></h4>
                  </blockquote>
                  <figcaption class="blockquote-footer">
                     <?= $article['description']; ?>
                  </figcaption>
               </figure>
               <h6 class="text-muted"><?= $article['created_at']; ?></h6>
               <div class="divider"></div>
               <img src="img/<?= $article["thumbnail"]; ?>" alt="" class="img-thumbnail" style="max-width: 500px;">
               <article><?= $article['body']; ?></article>
            </div>
         </div>
      </article>
   </div>

   <footer class="fixed-bottom mt-auto py-3 bg-light">
      <div class="container text-center">
         <span class="text-muted">Copyright &copy<?= date('Y'); ?> Made with ❤️ in Sidoarjo Indonesia</span>
      </div>
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>