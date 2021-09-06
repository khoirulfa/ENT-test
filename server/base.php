<?php 
/* database connection */

$database = "ent_blog";
$connection =  mysqli_connect("127.0.0.1", "root", "", $database);

/* check connection status */
/*
if ($connection) {
   echo "Koneksi berhasil";
} else {
   echo "terjadi kesalahan : ". mysqli_connect_error();
} */

function query($query) {
   global $connection;
   $result = mysqli_query($connection, $query);
   $rows = [];
   while( $row = mysqli_fetch_assoc($result)) {
      $rows[] = $row; 
   }

   return $rows;
}

function create($data) {
   global $connection;
   $title = htmlspecialchars($data["title"]);
   $slug = htmlspecialchars($data["slug"]);
   $description = htmlspecialchars($data["description"]);
   $body = htmlspecialchars($data["body"]);

   mysqli_query($connection, "INSERT INTO posts VALUES ('', '$title', '$slug', '$description', '$body')");

   return mysqli_affected_rows($connection);
}

function update($data) {
   global $connection;
   $id = $data["id"];
   $title = htmlspecialchars($data["title"]);
   $slug = htmlspecialchars($data["slug"]);
   $description = htmlspecialchars($data["description"]);
   $body = htmlspecialchars($data["body"]);

   mysqli_query($connection, "UPDATE posts SET
    title = '$title',
    slug = '$slug',
    description = '$description',
    body = '$body'
    WHERE id = $id ");

   return mysqli_affected_rows($connection);
}

function destroy($id) {
    global $connection;
    mysqli_query($connection, "DELETE FROM posts WHERE id = $id");
    return mysqli_affected_rows($connection);
}
