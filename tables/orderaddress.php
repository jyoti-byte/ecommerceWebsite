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
  $sql = "CREATE TABLE Order_Address (
                        order_address_id INT(30) PRIMARY KEY AUTO_INCREMENT,
                        order_id INT,
                        shipping_address VARCHAR(100) NOT NULL,
                        billing_address VARCHAR(100) NOT NULL,
                        FOREIGN KEY(order_id) REFERENCES Orders(order_id)
    )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table Order Address created successfully";
} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;
?>