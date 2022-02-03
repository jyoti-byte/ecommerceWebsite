<?php 
session_start();
include('inc/header.php')
?>
<div class="container product-section">
	<div class="category">
		<h1 class="text-center text-danger mb-5 mt-5" style="font-family: 'Abril Fatface', cursive;">SHOP BY CATEGORIES</h1>
	</div>

	<div class="row">

	<?php
	require_once('inc/conn.php');

	$sql ="SELECT * FROM products";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
	// $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($product);
	// die;
	// if($product = $stmt->fetch(PDO::FETCH_ASSOC)){
	// 	$pId            = $product['product_id'];
	// 	$pName   		= $product["product_name"];
	// 	$pPrice   		= $product["price"];
	// 	$pImage       	= $product["product_image"];
	// 	$pAvailability 	= $product["availability"];
	// }

	if($stmt->rowCount() > 0){
		while($product = $stmt->fetch(PDO::FETCH_ASSOC)){
			?>	
		<div class="col-lg-3 col-md-3 col-sm-12">
			
			<form>
				<div class="card mb-5">
					<h6 class="card-title bg-info text-white p-2 text-uppercase"> <?php echo
					 $product["product_name"] ?> </h6>

					<div class="card-body">
						 <a href="product.php?product_id=<?=$product['product_id']?>"><img src="<?php echo
					 'image/'.$product["product_image"] ?>" alt="technology" class="img-fluid mb-3" style="height:150px; width:500px" ></a>

					 <span class="<?php if($product['availability']=='In stock'){echo 'in-stock';} else{echo 'out-stock';}?>"><?php echo $product["availability"]?></span>

					 <h6 style="padding-top:10px;"> &#8360; <?php echo $product["price"] ?> </h6>

				    </div>
				</div>
			</form>
			
			<script type="text/javascript">
				gtag('event', 'view_item_list', {
				"items": [
					{
					"id":"<?php echo $product['product_id']?>",
					"name": "<?php echo $product['product_name']  ?>",
					"price": "<?php echo  $product['price']?>"
					}
				]
				});

				gtag('event', 'select_content', {
					"content_type": "product",
					"items": [
						{
						"id": "<?php echo $product['product_id']?>",
						"name": "<?php echo $product['product_name'] ?>",
						"price": "<?php echo $product['price'] ?>"
						}
					]
				});

				gtag('event', 'page_view', {
					'send_to': 'AW-XXXXXXXXX',
					'ecomm_pagetype': 'home'
				});
			</script>
		</div>
		<?php		
		}
	}
	?>
    </div>
</div>

<script src="js/productBlog.js"></script>
<?php 
include('inc/footer.php');
?>