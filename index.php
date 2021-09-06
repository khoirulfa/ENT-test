<?php 
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

<body>
   <div class="container">
      <header
         class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
         <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap" viewBox="0 0 118 94">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
            </svg>
         </a>

         <div class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            My blog
         </div>

         
         <div class="col-md-3 text-end">
            <a href="backend/dashboard.php" type="button" class="btn btn-outline-primary me-2">Dashboard</a>
         </div>
      </header>

      <div class="container mt-2">
         <?php foreach ($articles as $article) : ?>
            <div class="card mb-2">
            <h5 class="card-header"><?= $article['title']; ?></h5>
               <div class="card-body">
                  <h5 class="card-title"><?= $article['description']; ?></h5>
                  <p class="card-text"><?= $article['body']; ?></p>
                  <a href="detail.php?id=<?= $article['id']; ?>" class="btn btn-primary">View more</a>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
   </script>
</body>

</html>