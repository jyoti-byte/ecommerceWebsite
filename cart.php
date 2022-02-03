<?php
session_start();
require('inc/conn.php');
$message = '';

if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['item_id'] == $_GET["product_id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:cart.php?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  setcookie("shopping_cart", "", time() - 3600);
  header("location:cart.php?clearall=1");
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item Added into Cart
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Item removed from Cart
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}
?>

<?php 
include('inc/header.php')
?>
<div class="container"> 
<h3 class="text-center text-danger mt-5">Cart Details</h3>
    <div class="col-md-6">
    <a href="category.php" class="btn btn-success mb-3"> Continue Shopping </a>
    </div>
 
   <div class="table-responsive">
   <?php echo $message; ?>
    <div class="text-right">
        <a href="cart.php?action=clear" class="btn btn-sm btn-danger clear-cart"><b>Clear Cart</b></a>
    </div>
    <table class="table table-bordered text-center">
        <tr>
            <th width="20%">Product Name</th>
            <th width="10%">Quantity</th>
            <th width="20%">Price</th>
            <th width="20%">Total</th>
            <th width="10%">Action</th>
        </tr>
   <?php
   if(isset($_COOKIE["shopping_cart"]))
   {
    $total = 0;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
   ?>
    <tr>
        <td><?php echo $values["item_name"]; ?></td>
        <td><?php echo $values["item_quantity"]; ?></td>
        <td>&#8360; <?php echo $values["item_price"]; ?></td>
        <td>&#8360; <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
        <td><a href="cart.php?action=delete&product_id=<?php echo $values["item_id"]; ?>"><span class="text-danger remove-from-cart">Remove</span></a></td>

        <script type="text/javascript">
				jQuery('.remove-from-cart').on("click",function() {
						// alert('ok');
						gtag('event', 'remove_from_cart', {
							 "items": [
									{
										"id": "<?php echo $values['item_id']; ?>",
										"name": "<?php echo $values["item_name"]; ?>",
										"quantity": "<?php echo $values["item_quantity"]; ?>",
										"price": "<?php echo $values["item_price"]; ?>"
									}
								]
							});
						});

                        gtag('event', 'page_view', {
                            'send_to': 'AW-XXXXXXXXX',
                            'ecomm_prodid':'<?php echo $values['item_id']; ?>', 
                            'ecomm_pagetype': 'cart',
                            'ecomm_totalvalue': '<?php echo $values["item_price"]; ?>'
                        });
												
		</script>
    </tr>
    <?php 
        $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }
   ?>
    <tr>
     <td colspan="3" class="text-right">Total</td>
     <td class="text-center">&#8360; <?php echo number_format($total, 2); ?></td>
     <td></td>
    </tr>
   <?php 
    }
   else
   {
    echo '
    <tr>
     <td colspan="5" class="text-center">No Item in Cart</td>
    </tr>
    ';
   }
   ?>
   </table>
   </div>
        <a href="login.php" class="btn btn-primary mb-5 col-sm-12">Check out</a>
  </div>
  <script type="text/javascript">
		if($('.table .table-bordered').length == 0){
			$('.clear-cart').remove();
		}		
	</script>
<?php 
include('inc/footer.php');
?>