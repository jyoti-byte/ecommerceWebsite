<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
		src="https://www.facebook.com/tr?id=5078415258876683&ev=PageView&noscript=1"
		/></noscript>
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
					<a class="nav-link text-light m1-5" href="cart.php"><i class="fa fa-shopping-cart fa-2x"></i><span class="badge badge-light"><?php echo (isset($_COOKIE['shopping_cart']) && count(json_decode($_COOKIE['shopping_cart']))>0) ? count(json_decode($_COOKIE['shopping_cart'])):'';
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
