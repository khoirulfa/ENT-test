<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
}
require "../server/base.php"; 

?>
<!doctype html>
<html lang="en">

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Dashboard</title>
</head>

<body>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-2">
				<ul class="list-group">
					<li class="list-group-item">
						<a href="../index.php" class="text-decoration-none text-dark">Home</a>	
					</li>
					<li class="list-group-item">
						<a href="#" class="text-decoration-none text-dark">Posts</a>	
					</li>
					<li class="list-group-item">
						<a href="categories/index.php" class="text-decoration-none text-dark">Categories</a>	
					</li>
					<li class="list-group-item bg-danger">
						<a href="../logout.php" class="text-decoration-none text-white">Logout</a>	
					</li>
				</ul>
			</div>
			<div class="col">
				<div class="row d-flex justify-content-between mb-3">
					<div class="col-6">
						<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="POST">
							<div class="input-group">
								<input type="text" class="form-control form-control-dark" id="keyword" placeholder="Search..." name="keyword" autocomplete="off" autofocus>
								<button type="submit" name="search" class="btn btn-secondary d-inline">Cari</button>
							</div>
						</form>
					</div>
					<div class="col-2">
						<a href="create.php" class="btn btn-block btn-primary">Add new post</a>
					</div>
				</div>
				<table class="table">
					<thead>
						<tr>
							<td>#</td>
							<td>Title</td>
							<td>Category</td>
							<td>Description</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$limit = 5;
						$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
						$firstPage = ($page > 1) ? ($page * $limit) - $limit : 0;

						$previous = $page - 1;
						$next = $page + 1;
						
						$counter = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM posts"));
						$pages = ceil($counter / $limit);

						$articles = query("SELECT post.id, post.title, post.description, categories.category_title FROM posts AS post INNER JOIN categories ON post.category_id = categories.id INNER JOIN users ON post.user_id = users.id WHERE post.id LIMIT $firstPage, $limit");
						$i = $firstPage + 1; 

						if ( isset($_POST["search"]) ) {
							$articles = search($_POST["keyword"]);
						}
						?>
						<?php foreach ($articles as $article) : ?>
							<tr>
								<td><?= $i; ?></td>
								<td style="max-width: 400px;"><?= $article['title']; ?></td>
								<td><?= $article['category_title']; ?></td>
								<td style="max-width: 400px;"><?= $article['description']; ?></td>
								<td class="btn-group" role="group">
									<a href="detail.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-secondary">detail</a>
									<a href="edit.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-warning">edit</a>
									<a href="delete.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-danger"
									onclick="return confirm('Yakin ingin dihapus?')">delete</a>
								</td>
							</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
				<nav class="mt-3">
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


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../assets/script.js"></script>
</body>

</html>