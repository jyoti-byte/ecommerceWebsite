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
  $sql = "CREATE TABLE Products( product_id INT(255) PRIMARY KEY AUTO_INCREMENT,
                product_name VARCHAR(255) NOT NULL,
                price FLOAT(8,2) NOT NULL,
                product_image VARCHAR(255),
                insert_date DATE,
                modified_date DATE,
                availability ENUM('In stock','Out of Stock'),
                product_size VARCHAR(255),
                product_color VARCHAR(255)
  )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table Product created successfully";
} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;
?>