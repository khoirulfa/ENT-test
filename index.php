<?php 
session_start();
require "server/base.php";

$articles = query("SELECT * FROM posts");

if ( isset($_POST["search"]) ) {
	$articles = search($_POST["keyword"]);
}
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
      <header class="p-3 border border-top-0 border-start-0 border-end-0 mb-4">
         <div class="container">
            <div class="d-flex align-items-center justify-content-between justify-content-lg-between">
               <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                  <img src="assets/logo.png" alt="" class="bi me-2" width="40" role="img">
               </a>

               <div class="d-flex">
                  <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="POST">
                     <div class="input-group">
                        <input type="text" class="form-control form-control-dark" id="keyword" placeholder="Search..." name="keyword" autocomplete="off" autofocus>
                        <button type="submit" name="search" class="btn btn-secondary d-inline">Cari</button>
                     </div>
                  </form>

                  <div class="text-end">
                     <?php if(isset($_SESSION["login"])) {
                        echo '<a href="backend/dashboard.php" type="button" class="btn btn-primary me-1">Dashboard</a>';
                     } else {
                        echo '<a href="register.php" type="button" class="btn btn-outline-primary me-1">Register</a>';
                        echo '<a href="login.php" type="button" class="btn btn-primary me-1">Login</a>';
                     }
                     ?>
                  </div>
               </div>
            </div>
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