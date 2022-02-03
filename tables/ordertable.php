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
  $sql = "CREATE TABLE Orders( order_id INT(20) PRIMARY KEY AUTO_INCREMENT,
                user_id INT(30),
                order_date DATE NOT NULL,
                status ENUM('pending','completed'),
                total_order_amount DOUBLE(8,2) NOT NULL,
                FOREIGN KEY(user_id) references users(user_id)
  )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table Order created successfully";
} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;
?>