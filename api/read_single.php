<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../inc/conn.php');
include('../models/products.php');

$product = new Product($conn);

$product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();

$product->single_read();

$product_arr = array(
    'product_id' => $product->product_id,
    'product_name' => $product->product_name,
    'price' => $product->price,
    'product_image' => $product->product_image,
    'availability' => $product->availability
);

print_r(json_encode($product_arr));

?>