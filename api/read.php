<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../inc/conn.php');
include('../models/products.php');

$product = new Product($conn);

$result = $product->read();

$num = $result->rowCount();

if($num > 0){
    $product_arr = array();
    $product_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $product_item = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_image' => 'image/'.$product_image,
            'price' => $price,
            'availability' => $availability       
        );

        array_push($product_arr['data'], $product_item);
    }

    echo json_encode($product_arr);

}else {
    echo json_encode(
        array('message' => 'No products found')
    );
}

?>