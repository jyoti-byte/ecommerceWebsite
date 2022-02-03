<?php
include('inc/conn.php');

try {
  $sql = "CREATE DATABASE ecommerce_website";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Database created successfully<br>";
} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;
?>