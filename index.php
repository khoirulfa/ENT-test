<?php 
session_start();
require "server/base.php";
?>
<!doctype html>
<html lang="en">
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="assets/style.css">
   <title>Home</title>
</head>

<body">
   <div class="container mb-5 pb-5">
      <div class="row">
         <div class="col-sm-12">
            
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
               <div class="container">
                  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                     <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <img src="assets/logo.png" alt="" class="bi me-2" width="40" role="img">
                     </a>

                     <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 align-items-center justify-content-center mb-md-0">
                        <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">Features</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
                     </ul>

                     <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="POST">
                        <!-- <div class="input-group"> -->
                           <input type="text" class="form-control form-control-dark" id="keyword" placeholder="Search..." name="keyword" autocomplete="off" autofocus>
                           <button type="submit" name="search" class="btn btn-secondary d-none">Cari</button>
                        <!-- </div> -->
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
            </header>

            <div class="container mt-2 mb-5">
               <?php 
               $limit = 5;
               $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
               $firstPage = ($page > 1) ? ($page * $limit) - $limit : 0;

               $previous = $page - 1;
               $next = $page + 1;
               
               $counter = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM posts"));
               $pages = ceil($counter / $limit);

               $articles = query("SELECT post.slug, post.title, post.description, post.body, categories.category_title, users.name FROM posts AS post INNER JOIN categories ON post.category_id = categories.id INNER JOIN users ON post.user_id = users.id WHERE post.id LIMIT $firstPage, $limit");
               $i = $firstPage + 1; 
               
               if ( isset($_POST["search"]) ) {
                  $articles = search($_POST["keyword"]);
               }

               foreach ($articles as $article) : ?>
                  <div class="mb-2">
                  <span>&mdash; <?= $article['category_title']; ?></span>
                  <span class="fw-bold">&mdash; Penulis : <?= $article['name']; ?></span>
                  <h2 class="fw-bold"><?= $article['title']; ?></h2>
                     <div class="">
                        <h6 class="text-muted"><?= $article['description']; ?></h6>
                        <p class=""><?= htmlspecialchars_decode($article['body']); ?></p>
                        <a href="detail.php?slug=<?= $article['slug']; ?>" class="btn btn-primary">View more</a>
                        <hr>
                     </div>
                  </div>
               <?php endforeach; ?>
               <nav class="mt-3 mb-5">
                  <ul class="pagination justify-content-center">
                     <?php if($page > 1) : ?>
                        <li class="page-item">
                           <a class="page-link" href="?page=<?= $previous; ?>">Previous</a>
                        </li>
                     <?php endif; ?>

                     <?php 
                     for($x = 1; $x <= $pages ; $x++){
                        ?> 
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                        <?php
                     }
                     ?>

                     <?php if($page < $pages) : ?>
                        <li class="page-item">
                           <a class="page-link" href="?page=<?= $next; ?>">Next</a>
                        </li>
                     <?php endif; ?>
                  </ul>
               </nav>
            </div>
      
         </div>
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