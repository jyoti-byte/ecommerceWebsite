<?php
require('inc/conn.php');
$message = '';

if(isset($_POST["add_to_cart"]))
{
 if(isset($_COOKIE["shopping_cart"]))
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }
  $item_id_list = array_column($cart_data, 'item_id');

  if(in_array($_POST["hidden_id"], $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["qty"];
   }
  }
 }
 else{
	$item_array = array(
		'item_id'      => $_POST["hidden_id"],
		'item_name'    => $_POST["hidden_name"],
		'item_price'   => $_POST["hidden_price"],
		'item_quantity'=> $_POST["qty"]
	   );
	  $cart_data[] = $item_array;
 }
  
 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:cart.php?success=1");

}
?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta property="og:title" content="DELL laptop">
	  <meta property="og:description" content="New Model, Dell Laptop">
	  <meta property="og:url" content="http://test.com/products">
	  <meta property="og:image" content="http://test.com/image/dell.jpg">
	  <meta property="product:availability" content="in stock">
	  <meta property="product:price:amount" content="50000">
	  <meta property="product:price:currency" content="USD">

	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Dancing+Script" rel="stylesheet">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	  <title>ecommerce website</title>

	<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-216917390-1"></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-XXXXXXXXXX"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-216917390-1');
		gtag('config', 'AW-XXXXXXXXXX');
		</script>


		<!-- Meta Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '917338932318670');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=917338932318670&ev=PageView&noscript=1"/>
		</noscript>
		<!-- End Meta Pixel Code -->


</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="#">NP</a>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="category.php">Categories</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li> -->
					<!-- <li class="nav-item">
						<a class="nav-link" href="#">Contact</a>
					</li> -->
					<li class="nav-item">
					<?php if(isset($_SESSION['user_login']) == "yes"){
						echo '<a class="nav-link" href="logout.php">Logout</a> <a class="nav-link" href="my_order.php">My Order</a>';
					}else{
						echo '<a class="nav-link" href="login.php">Login</a>';
					}?>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="registration.php">Register</a>
					</li>
				</ul>
				<form class="form-inline">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					<a class="nav-link text-light m1-5" href="cart.php"><i class="fa fa-shopping-cart fa-2x"></i><span class="badge badge-light"><?php echo (isset($_COOKIE['shopping_cart']) && count(json_decode($_COOKIE['shopping_cart']))>0) ?count(json_decode($_COOKIE['shopping_cart'])):'';
					?></span></a>
				</form>
			</div>
		</div>
	</nav>

	<div class="hero-image">
        <div class="hero-text">
            <h1 class="text-light">A New Online Shop Experience</h1>
            <h4>Genuine and Trustworthy</h4>
            <button class="btn btn-info btn-lg mt-4">Shop Now</button>
        </div>
    </div>

<div class="container">
	<h1 class="text-center text-danger mb-5" style="margin-top:20px;">PRODUCT</h1>
	<div class="col-md-6">
		<a href="category.php" class="btn btn-dark mb-3 mr-1 ml-4"><< Go to Category</a><a href="cart.php" class="btn btn-dark mb-3"><i class="fa fa-shopping-cart pr-2" aria-hidden="true"></i>Go to Cart >></a>
    </div>

	<?php

	require('inc/conn.php');

	$id = ''; 
	if( isset( $_GET['product_id'])) {
		$id = $_GET['product_id']; 
	}
	$sql = "SELECT * FROM products where product_id=:pid";
	
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':pid', $id, PDO::PARAM_INT);
	$stmt->execute();

	if($product = $stmt->fetch(PDO::FETCH_ASSOC)){
		$pName   		= $product["product_name"];
		$pPrice   		= $product["price"];
		$pImage       	= $product["product_image"];
		$pAvailability 	= $product["availability"];
	}else {
		header('location:category.php');
		die;
	}
	
	// if($stmt->rowCount() > 0){
	// 	while($product = $stmt->fetch(PDO::FETCH_ASSOC)){
	?>	
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row product-block">
					<div class="single-image col-6">
						<img src="image/<?php echo $pImage ?>" alt="technology" class="img-fluid mt-5 pr-5">
					</div>
					<div class="col-4">
						<div class="product-info mt-5">
							<h5 class="card-title bg-info text-white p-2 text-uppercase"> <?php echo
											$pName ?> </h5>
							<span class='<?php if($pAvailability == 'In stock'){echo 'in-stock';} else{echo 'out-stock';} ?>'><?php echo $pAvailability?></span>

							<h6 style="padding-top:10px;"> &#8360; <?php echo $pPrice ?></h6>
							<?php if($pAvailability == 'In stock'){ ?>
							<div class="form-group">
								<label>Quantity</label>
									<input type="text" name="qty" value="1" class="form-control mb-4" placeholder="Quantity">
							</div>
							<div class="btn-group d-flex">
								<button class="btn btn-success flex-fill text-white add-to-cart" name="add_to_cart"> Add to cart </button>
									<!-- <button class="btn btn-warning flex-fill text-white ml-1"><a href="checkout.php"> Buy now </button></a> -->
								<a href="checkout.php" class="btn btn-warning text-white">Buy Now</a>
						    </div>
							<?php } ?>
								<input type="hidden" name="hidden_name" value="<?php echo $pName; ?>">
								<input type="hidden" name="hidden_price" value="<?php echo $pPrice; ?>">
								<input type="hidden" name="hidden_id" value="<?php echo $id; ?>">
						</div>	
					</div>		
				</div>
			</form>
</div>

<script src="js/productBlog.js"></script>
<script type="text/javascript">
				gtag('event', 'view_item', {
				  "items": [
				    {
				      "id": "<?php echo $_GET['product_id']; ?>",
				      "name": "<?php echo $pName ?>",
				      "price": "<?php echo $pPrice ?>"
				    }
				  ]
				});

		jQuery('.add-to-cart').on("click",function() {
				alert('ok');
				gtag('event', 'add_to_cart', {
					"items": [
						{
						  "id": "<?php echo $_GET['product_id']; ?>",
						  "name": "<?php echo $pName ?>",
						  "price": "<?php echo $pPrice ?>"
						}
					]
				});
			});

				fbq('track', 'ViewContent', {
					content_type: 'product',
					content_ids: '<?php echo $_GET['product_id']; ?>',
					content_name: '<?php echo $pName ?>',
					value: '<?php echo $pPrice ?>',
					currency: 'USD',
				});

			// jQuery('.add-to-cart').on("click",function() {
				fbq('track', 'AddToCart',
					{
						value: '<?php echo $pPrice ?>',
						currency: 'USD',
						content_type: 'product', // required property
						content_ids: '<?php echo $_GET['product_id']; ?>' // required property, if not using 'contents' property
					});
				// });

				gtag('event', 'page_view', {
					'send_to': 'AW-XXXXXXXXX',
					'ecomm_prodid': '<?php echo $_GET['product_id']; ?>', 
					// 'ecomm_pagetype': '###PRODUCT-TYPE###',
					'ecomm_totalvalue': '<?php echo $pPrice ?>'
				});
</script>
<?php 
include('inc/footer.php');
?>