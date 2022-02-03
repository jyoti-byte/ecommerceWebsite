<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_website";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to create table
  $sql = "CREATE TABLE Users( user_id INT(20) PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(255) ,
                email VARCHAR(255),
                mobileNumber VARCHAR(255),
                password VARCHAR(255)

  )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table Users created successfully";
} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;
?>