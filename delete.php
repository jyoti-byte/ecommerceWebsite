<?php 
session_start();
require("inc/conn.php");

if (isset($_GET['product_id'])) {
    // Delete record
    try {
        // SQL Statement
        $sql = 'DELETE FROM products WHERE product_id = :pid LIMIT 1';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":pid", $_GET['product_id'], PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount()) {
            echo "<script>alert('Record deleted successfully');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
        header("Location: index.php?status=fail_delete");
        exit();
    } catch (PDOException $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to index.php
    header("Location: index.php?status=fail_delete");
    exit();
}