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

    mysqli_query ($connection, "INSERT INTO users VALUES ('', '$email', '$password')");
    return mysqli_affected_rows ($connection);
}

function create($data) {
   global $connection;
   $title = htmlspecialchars($data["title"]);
   $slug = htmlspecialchars(strtolower($data["title"]));
   $description = htmlspecialchars($data["description"]);
   $body = $data["body"];
   $datetime = date("Y-m-d h:i:s");

   $titleCheck = mysqli_query ($connection, "SELECT title FROM posts WHERE title = '$title'");

    if ( mysqli_fetch_assoc($titleCheck) ) {
        echo "<script>
            alert ('Judul sudah ada');
        </script>";
        
        return false;
    }

   mysqli_query($connection, "INSERT INTO posts VALUES ('', '$title', '$slug', '$description', '$body', '$datetime', '')");

   return mysqli_affected_rows($connection);
}

function update($data) {
   global $connection;
   $id = $data["id"];
   $title = htmlspecialchars($data["title"]);
   $slug = htmlspecialchars(strtolower($data["title"]));
   $description = htmlspecialchars($data["description"]);
   $body = $data["body"];
   $datetime = $data["created_at"];
   $updatetime = date("Y-m-d h:i:s");

   mysqli_query($connection, "UPDATE posts SET
    title = '$title',
    slug = '$slug',
    description = '$description',
    body = '$body',
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
