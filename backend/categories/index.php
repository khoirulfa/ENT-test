<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../../login.php");
	exit;
}
require "base.php"; 

$categories = query("SELECT * FROM categories");
?>
<!doctype html>
<html lang="en">

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>Categories</title>
</head>

<body>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-2">
				<ul class="list-group">
					<li class="list-group-item">
						<a href="../../index.php" class="text-decoration-none text-dark">Home</a>	
					</li>
					<li class="list-group-item">
						<a href="../dashboard.php" class="text-decoration-none text-dark">Posts</a>	
					</li>
					<li class="list-group-item">
						<a href="#" class="text-decoration-none text-dark">Categories</a>	
					</li>
					<li class="list-group-item bg-danger">
						<a href="../logout.php" class="text-decoration-none text-white">Logout</a>	
					</li>
				</ul>
			</div>
			<div class="col">
				<a href="create.php" class="btn btn-block btn-primary">Add new category</a>
				<table class="table">
					<thead>
						<tr>
							<td>#</td>
							<td>Title</td>
							<td>Slug</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 ?>
						<?php foreach ($categories as $category) : ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $category["category_title"]; ?></td>
								<td><?= $category["category_slug"]; ?></td>
								<td class="btn-group" role="group">
									<a href="edit.php?id=<?= $category["id"]; ?>" class="btn btn-sm btn-warning">edit</a>
									<a href="delete.php?id=<?= $category["id"]; ?>" class="btn btn-sm btn-danger"
									 onclick="return confirm('Yakin ingin dihapus?')">delete</a>
								</td>
							</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>
</body>

</html>