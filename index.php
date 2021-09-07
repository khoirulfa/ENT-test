<?php 
session_start();
require "server/base.php";

$articles = query("SELECT * FROM posts");

?>
<!doctype html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Home</title>
</head>

<body">
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
            <?php if(isset($_SESSION["login"])) {
               echo '<a href="backend/dashboard.php" type="button" class="btn btn-primary me-1">Dashboard</a>';
            } else {
               echo '<a href="register.php" type="button" class="btn btn-outline-primary me-1">Register</a>';
               echo '<a href="login.php" type="button" class="btn btn-primary me-1">Login</a>';
            }
            ?>
         </div>
      </header>

      <div class="container mt-2">
         <?php foreach ($articles as $article) : ?>
            <div class="mb-2">
            <h4 ><?= $article['title']; ?></h4>
               <div class="">
                  <h5 class=""><?= $article['description']; ?></h5>
                  <p class=""><?= htmlspecialchars_decode($article['body']); ?></p>
                  <a href="detail.php?slug=<?= $article['slug']; ?>" class="btn btn-primary">View more</a>
                  <hr>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
   <footer class="fixed-bottom mt-5 py-3 bg-light">
      <div class="container text-center">
         <span class="text-muted">Copyright &copy<?= date('Y'); ?> Made with ❤️ in Sidoarjo Indonesia</span>
      </div>
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>

</html>