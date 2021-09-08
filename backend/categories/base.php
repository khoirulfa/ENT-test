<?php 
$database = "ent_blog";
$connection =  mysqli_connect("127.0.0.1", "root", "", $database);

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
   $slug = slugGenerator($data["title"], 3);

   $titleCheck = mysqli_query ($connection, "SELECT title FROM categories WHERE category_title = '$title'");

    if ( mysqli_fetch_assoc($titleCheck) ) {
        echo "<script>
            alert ('Kategori sudah ada');
        </script>";
        
        return false;
    }

   mysqli_query($connection, "INSERT INTO categories VALUES 
        ('', '$title', '$slug')
    ");

   return mysqli_affected_rows($connection);
}

function update($data) {
   global $connection;
   $id = $data["id"];
   $title = htmlspecialchars($data["title"]);
   $slug = slugGenerator($data["title"], 3);

   mysqli_query($connection, "UPDATE `categories` SET
    `category_title` = '$title',
    `category_slug` = '$slug'
    WHERE id = $id");

   return mysqli_affected_rows($connection);
}

function destroy($id) {
    global $connection;
    mysqli_query($connection, "DELETE FROM categories WHERE id = $id");
    return mysqli_affected_rows($connection);
}

function slugGenerator($string, $limit = null)
  {     
      $words = explode(' ', $string);
      if (count($words) > $limit) {
        $rawSlug = implode(' ', array_slice($words, 0, $limit)) ;
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($rawSlug)));
        return $slug;
    } else {
        $rawSlug = implode(' ', array_slice($words, 0, $limit)) ;
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($rawSlug)));
          return $slug;
      }
  }