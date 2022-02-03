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

if(!isset($_COOKIE['shopping_cart']) || count(json_decode($_COOKIE['shopping_cart'])) == 0){
?>
 <script>window.location.href='category.php';</script>
 <?php
}

$total = 0;
$cookie_data = stripslashes($_COOKIE['shopping_cart']);
$cart_data = json_decode($cookie_data, true);
foreach($cart_data as $keys => $values)
{
    $total = $total + ($values["item_quantity"] * $values["item_price"]);
}

if(isset($_POST['proceed-btn'])){
	header("Location: order_confirmation.php");
}

?>

<?php 
include('inc/header.php');
?>
<div class="ml-5 pt-5 font-weight-bold">Hello, <?php echo $_SESSION ['username']; ?></div>
<div class="container">
    <h3 class="text-center text-danger mb-4 font-weight-bold mr-5"> Checkout</h3>
    <div class="row">
        <div class="col-sm-8 bg-light">
            <form action="order_confirmation.php" method="POST">
                <div class="form-group row pt-3">
                    <label for="fullName" class="col-sm-2 col-form-label"> Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $_SESSION['username'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phoneNumber" class="col-sm-2 col-form-label"> Phone Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $_SESSION['mobileNumber'];?> ">
                    </div>
            
                    <label for="email" class="col-sm-2 col-form-label pl-5"> Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                <label for="region" class="col-sm-2 col-form-label"> Region</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="region" name="region"required>
                                    <option value="" selected disabled> Please choose your region </option>
                                    <option value="1">Bagmati Province</option>
                                    <option value="2">Gandaki Province</option>
                                    <option value="3">Karnali Province</option>
                                    <option value="4">Lumbini Province</option>
                                    <option value="5">Province 1</option>
                                    <option value="6">Province 2</option>
                                    <option value="7">Sudurpashchim Province</option>
                            </select>
                        </div>       
                </div>

                <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label"> City</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="city" name="city" required>
                                    <option value="" selected disabled> Please choose your city </option>
                                    <option value="1">Banepa</option>
                                    <option value="2">Bhaktapur</option>
                                    <option value="3">Bharatpur</option>
                                    <option value="4">Hetauda</option>
                                    <option value="5">Kathmandu Inside Ring Road</option>
                                    <option value="6">Kathmandu Outside Ring Road</option>
                                    <option value="7">Lalitpur</option>
                                    <option value="8">Butwal</option>
                                    <option value="10">Janakpur</option>
                            </select>
                        </div>       
                </div>

                <div class="form-group row">
                <label for="area" class="col-sm-2 col-form-label"> Area</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="area" name="area" required>
                                    <option value="" selected disabled> Please choose your area </option>
                                    <option value="1">Babarmahal</option>
                                    <option value="2">Godawari</option>
                                    <option value="3">Imadol</option>
                                    <option value="4">Maitighar</option>
                                    <option value="5">Nakhu</option>
                                    <option value="6">Teku</option>
                                    <option value="7">Thapathali</option>
                                    <option value="8">Thimi</option>
                                    <option value="9">Tripureshwor</option>
                            </select>
                        </div>       
                </div>

                <div class="form-group row">
                    <label for="shippingAddress" class="col-sm-2 col-form-label"> Shipping Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ship_address" name="ship_address" placeholder=" For example House#123, Street# 123, ABc " required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="billingAddress" class="col-sm-2 col-form-label"> Billing Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bill_address" name="bill_address" placeholder=" Same as billing address " required>
                    </div>
                </div>
                <div class="paymentinfo">
                    <div class="single-method">
                        <label for="payment"> Payment Method </label><br>
                        <span class="ml-5"><input type="radio" name="payment_type" value="COD" required> Cash On Delivery </span>
                        <span class="ml-5"><input type="radio" name="payment_type" value="Credit Card" required> Credit Card </span>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary proceed-btn col-sm-6 mr-2 ml-3 mb-5" name="proceed"><i class="fa fa-check-circle"></i> Proceed to Pay </button>
                    <a href="cart.php" class="btn btn-danger col-sm-5 mb-5"><i class="fa fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
            <div class="col-sm-4 pl-5">
                <div class="order-details bg-light">
                    <h5 class="order-details-title text-center text-primary mb-4">Your Order</h5>
                        <div class="order-details-item">
                            <?php
							if(isset($_COOKIE["shopping_cart"]))
                            {
                             $total = 0;
                             $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                             $cart_data = json_decode($cookie_data, true);
                             foreach($cart_data as $keys => $values)
                             {
                             $total = $total + ($values["item_quantity"] * $values["item_price"]);
							?>
							<div class="single-item">
                                 <div class="single-item-content">
                                    <span class="pl-2"><?php echo $values['item_id']?></span>
                                    <span class="col-sm-1 pl-3"><?php echo $values["item_name"]?></span>
                                    <span class="col-sm-1 pl-4"> &#8360; <?php echo $values["item_quantity"] * $values["item_price"]?></span>
                                </div>
                            </div>

                            <script type="text/javascript">
                                    gtag('event', 'begin_checkout', {
                                        "items": [
                                                {
                                                    "id": "<?php echo $values['item_id'] ?>",
                                                    "name": "<?php echo $values["item_name"]?>",
                                                    "quantity": "<?php echo $values["item_quantity"] ?>",
                                                    "price": "<?php echo $values["item_price"] ?>"
                                                }
                                            ],
                                            "coupon": ""
                                        });

                                        fbq('track', 'InitiateCheckout');
                                    </script>
                                    
								<?php } }?>
                        </div>
                            <div class="ordre-details-total bg-dark">
                                <span class="pl-2 text-info font-weight-bold">Grand total</span>
                                <span class="col-sm-2 pl-5 text-white"> &#8360; <?php echo $total?></span>
                            </div>
                    </div>
                </div>
        </div>    
    </div>
</div>

<?php 
include('inc/footer.php');
?>