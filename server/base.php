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

function register($data) {
    global $connection;

    $name = strtolower ($data["name"]);
    $email = strtolower (stripslashes ($data["email"]));
    $password = mysqli_real_escape_string ($connection, $data["password"]);
    $passwordConf = mysqli_real_escape_string ($connection, $data["confPass"]);

    $result = mysqli_query ($connection, "SELECT email FROM users WHERE email = '$email' ");

    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>
            alert ('email sudah ada!. Silahkan ganti username anda');
        </script>";
        
        return false;
    }

    if ($password !== $passwordConf) {
        echo "<script>
            alert ('password tidak sesuai!');
        </script>";

        return false;
    }

    $password = password_hash ($password, PASSWORD_DEFAULT);

    mysqli_query ($connection, "INSERT INTO users VALUES ('', '$name', '$email', '$password')");
    return mysqli_affected_rows ($connection);
}

function create($data) {
   global $connection;
   $title = htmlspecialchars($data["title"]);
   $slug = slugGenerator($data["title"], 5);
   $description = htmlspecialchars($data["description"]);
   $body = $data["body"];
   $category = $data["category"];
   $author = $_SESSION["user_id"];
   $datetime = date("Y-m-d h:i:s");

   $img = uploadGambar();
    if ( !$img ){
        return false;
    }

   $titleCheck = mysqli_query ($connection, "SELECT title FROM posts WHERE title = '$title'");

    if ( mysqli_fetch_assoc($titleCheck) ) {
        echo "<script>
            alert ('Judul sudah ada');
        </script>";
        
        return false;
    }

   mysqli_query($connection, "INSERT INTO posts VALUES 
        ('', '$title', '$slug', '$description', '$body', '$category', '$author', '$img', '$datetime', '')
    ");

   return mysqli_affected_rows($connection);
}

function update($data) {
   global $connection;
   $id = $data["id"];
   $title = htmlspecialchars($data["title"]);
   $slug = slugGenerator($data["title"], 5);
   $description = htmlspecialchars($data["description"]);
   $body = $data["body"];
   $category = $data["category"];
   $author = $data["user_id"];
   $datetime = $data["created_at"];
   $updatetime = date("Y-m-d h:i:s");
   $picLama = htmlspecialchars($data["thumbLama"]);

    if ( $_FILES['thumbnail']['error'] === 4 ) {
        $pic = $picLama;
    }else {
        $pic = uploadGambar();
    }

   mysqli_query($connection, "UPDATE posts SET
    title = '$title',
    slug = '$slug',
    description = '$description',
    body = '$body',
    category_id = '$category',
    user_id = '$author',
    thumbnail = '$pic',
    created_at = '$datetime',
    updated_at = '$updatetime'
    WHERE id = $id ");

   return mysqli_affected_rows($connection);
}

function destroy($id) {
    global $connection;
    mysqli_query($connection, "DELETE FROM posts WHERE id = $id");
    return mysqli_affected_rows($connection);
}

function uploadGambar () {
    $name = $_FILES['thumbnail']['name'];
    $fileSize = $_FILES['thumbnail']['size'];
    $error     = $_FILES['thumbnail']['error'];
    $tmpName   = $_FILES['thumbnail']['tmp_name'];

    if ( $error === 4 ) {
        echo 
            "<script>
                alert ('Pilih gambar terlebih dahulu!');      
            </script>
            ";
        return false;
    }

    $extensionList = ['jpg', 'jpeg', 'png'];
    $extension = explode('.', $name);
    $extension = strtolower(end($extension));

    if(!in_array ($extension, $extensionList) ) {
        echo 
            "<script>
                alert ('Yang anda upload bukan gambar!');      
            </script>
            ";
        return false;
    }

    if($fileSize > 2000000 ) {
        echo 
            "<script>
                alert ('Ukuran gambar anda terlalu besar!');      
            </script>
            ";
        return false;
    }

    $fileName = uniqid();
    $fileName .= ".";
    $fileName .= $extension;

    move_uploaded_file($tmpName , '../img/'. $fileName);

    return $fileName;
} 

function search($keyword) {
    $query = "SELECT posts.id, posts.slug, posts.title, posts.description, posts.body, users.name, categories.category_title FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id WHERE
            title LIKE '%$keyword%' OR
            description LIKE '%$keyword%' OR
            body LIKE '%$keyword%'
            ";
        return query($query);
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