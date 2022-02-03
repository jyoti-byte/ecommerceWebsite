<?php 
session_start();
require('inc/conn.php');
if(!isset($_SESSION['user_login'])){
	?>
	<script>
	window.location.href='login.php';
	</script>
	<?php
}

$shipAddress   = $_POST['ship_address'];
$billAddress   = $_POST['bill_address'];
$payment_type  = $_POST['payment_type'];

$total = 0;
// $order_id = 0;
$cookie_data = stripslashes($_COOKIE['shopping_cart']);
$cart_data = json_decode($cookie_data, true);
foreach($cart_data as $keys => $values)
{
    $total = $total + ($values["item_quantity"] * $values["item_price"]);
    $id = $values['item_id'];
	$name = $values['item_name'];
	$qty = $values['item_quantity'];
	$price = $values['item_price'];
}
// $check_user = $_SESSION['user_id'];

// $check_order_details = "SELECT user_id FROM orders WHERE user_id = :check_user";
// $stmt = $conn->prepare($check_order_details);
// $stmt->bindParam(':check_user', $check_user);
// $stmt->execute();
// $check = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['confirm'])){
    $orderDate = date('Y-m-d h:i:s');
    $status = 1;
    $user_id = $_SESSION['user_id'];
    // if($payment_type == 'COD'){
    //     $status = "success";
    // }
    $totalOrderAmount = $total;

$conn->beginTransaction();
$stmt = $conn->prepare("INSERT INTO `orders`(`user_id`, `order_date`, `payment_method`, `status`, `total_order_amount`) VALUES (:user_id, :order_date, :payment_method, :order_status, :total_order_amount)");

$stmt->bindParam(":order_date", $orderDate);
$stmt->bindParam(":payment_method", $payment_type);
$stmt->bindParam(":order_status", $status);
$stmt->bindParam(":total_order_amount", $totalOrderAmount);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();

    $order_id=$conn->lastInsertId(); 
    // var_dump($order_id);
    // die;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    // $cart_data = [];
    $bulk_product = array();
    foreach($cart_data as $keys => $values)
    {
        // $item_array = [
        //     '$product_id'   => $values['item_id'],
        //     '$quantity'     => $values['item_quantity'],
        //     '$product_price'=> $values['item_price']
        // ];
        // $cart_data[] = $item_array;
        $product_id    = $values['item_id'];
        $quantity      = $values['item_quantity'];
        $product_price = $values['item_price'];

        $bulk_product[] = "(:order_id, :product_id, :quantity, :product_price)";

    }
    $stmt2 = $conn->prepare("INSERT INTO `order_product`(`order_id`, `product_id`, `quantity`, `product_price`) VALUES" .implode(',', $bulk_product));
    $stmt2->bindParam(':order_id', $order_id);
    $stmt2->bindParam(':product_id', $product_id);
    $stmt2->bindParam(':quantity', $quantity);
    $stmt2->bindParam(':product_price', $product_price);
    $stmt2->execute();

    $stmt3 = $conn->prepare("INSERT INTO `order_address`(`order_id`, `shipping_address`, `billing_address`) VALUES (:order_id, :shipAddress, :billAddress)");
    $stmt3->bindParam(':order_id', $order_id);
    $stmt3->bindParam(':shipAddress', $shipAddress);
    $stmt3->bindParam(':billAddress', $billAddress);
    
    
    if($stmt3->execute()){
    $conn->commit();
    echo "<script>alert('Record inserted successfully');</script>";
    echo "<script>window.location.href='thankyou.php'</script>";
    }
    else {
    $conn->rollback();
    echo "<script>alert('Something went wrong. Please try again');</script>";
    echo "<script>window.location.href='checkout.php'</script>";
    }

    setcookie("shopping_cart", "", time() - 3600);
}

?>

<?php 
include('inc/header.php');
?>
<div class="ml-5 pt-5 font-weight-bold">Hello, <?php echo $_SESSION ['username']; ?></div>
<div class="container">
    <form action="" method="POST">
        <h5 class="order-details-title text-center text-primary mb-4">Your Order</h5>
        <div class="row col-sm-10 bg-light">
            <div class="col-sm-6 pl-5">
                <div class="shippingAddress mt-5">
                    <h5> Shipping Address:</h5>
                    <input type="text"  class="form-control" name="ship_address" value="<?php echo $shipAddress ?>">
                </div>
                <div class="billingAddress mt-3">
                    <h5> Billing Address: </h5>
                    <input type="text" class="form-control" name="bill_address" value="<?php echo $billAddress ?>">
                </div>
                <div class="paymentMethod mt-3">
                    <h5> Payment Method: </h5>
                    <input type="text" class="form-control" name="payment_type" value="<?php echo $payment_type ?>">
                </div>
                <div class="form-group row mt-3">
                    <button type="submit" class="btn btn-primary confirm-btn mt-2 mr-2 ml-3 mb-5" name="confirm"> Confirm Order </button>
                </div>
            </div>
            <div class="col-sm-4 ml-5 mt-5">
                <div class="order-details">
                    <div class="order-details-item">
                            <?php
                            // if(isset($_COOKIE["shopping_cart"]))
                            // {
                            // $total = 0;
                            // $order_id = 0;
                            // $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                            // $cart_data = json_decode($cookie_data, true);
                            // foreach($cart_data as $keys => $values)
                            // {
                            // $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            // $stmt=$conn->prepare("SELECT order_id FROM `orders`");
                            // $stmt->bindParam(":order_id", $order_id);
                            // $order_id=$conn->lastInsertId();
                            // $stmt->execute();
                            // var_dump($order_id);
                            // die;
                            ?>
                            <div class="single-item">
                                <div class="single-item-content">
                                    <span class="pl-2"><?php echo $id?></span>
                                    <span class="col-sm-1 pl-3"><?php echo $name?></span>
                                    <span class="col-sm-1 pl-4"> &#8360; <?php echo $qty * $price?></span>
                                </div>
                            </div>                            
                            <div class="ordre-details-total bg-dark">
                                <span class="pl-2 text-info font-weight-bold">Grand total</span>
                                <span class="col-sm-2 pl-5 text-white"> &#8360; <?php echo $total?></span>
                            </div>
                    </div>
                </div>
            </div>    
        </div>
    </form>
</div>
<?php 
include('inc/footer.php');
?>
<?php 
$order_id = $conn->lastInsertId(); ?>
<script type="text/javascript">
        jQuery('.confirm-btn').click(function(){
            gtag('event', 'purchase', {
                "transaction_id": "<?php echo $order_id ?>",
                "value": "<?php echo $total ?>",
                "currency": "USD",
                "items": [
                    {
                        "id": "<?php echo $id?>",
                        "name": "<?php echo $name?>",
                        "quantity": "<?php echo $qty ?>",
                        "price": "<?php echo $price ?>"
                    }
                ]
            });
        });

            gtag('event', 'conversion', {
                'send_to': 'AW-XXXXXXXXXX/1u7SCPPXXXXR7Kn-Aw',
                'value': "<?php echo $total ?>",	//order subtotal
                'currency': 'USD',	
                'transaction_id': "<?php echo $order_id ?>"	// order ID
            });

            fbq('track', 'Purchase', {
                content_type: 'product',
				content_ids: '<?php echo $id?>',
                currency: "USD", 
                value: <?php echo $total ?>
            });

            gtag('event', 'page_view', {
                'send_to': 'AW-XXXXXXXXX',
                'ecomm_prodid': '<?php echo $id ?>',
                'ecomm_pagetype': 'purchase',
                'ecomm_totalvalue': '<?php echo $total ?>'
            });
</script>