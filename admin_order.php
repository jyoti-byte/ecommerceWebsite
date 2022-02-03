<?php
session_start();
require('inc/conn.php');
?>
<?php
include('inc/header1.php'); 
?>
<div class="container mt-5">
    <div class="col-md-6">
        <a href="dashboard.php" class="btn btn-success mb-3"> Back </a>
    </div>
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body bg-danger text-white">
				   <h4 class="box-title text-center"> View Orders </h4>
				</div>
				   <div class="order-table">
					  <table class="table table-bordered table-responsive text-center col-xl-12">
							<thead>
								<tr>
									<th class="product-thumbnail col-2">Order ID</th>
									<th class="product-name col-2"><span class="nobr">Order Date</span></th>
									<th class="product-price col-2"><span class="nobr"> Address </span></th>
									<th class="product-stock-stauts col-2"><span class="nobr"> Payment Method</span></th>
									<th class="product-stock-stauts col-2"><span class="nobr"> Order Status </span></th>
									<!-- <th class="product-stock-stauts col-2"><span class="nobr"> Payment Status </span></th> -->
								</tr>
							</thead>
							<tbody>
								<?php
								$stmt=$conn->prepare("SELECT orders.*,order_status.name, order_address.shipping_address from orders,order_status,order_address where order_status.id=orders.status and orders.order_id=order_address.order_id");
                                $stmt->execute();
								while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
								?>
								<tr>
									<td class="product-add-to-cart"><a href="admin_orders_details.php?order_id=<?php echo $row['order_id']?>"> <?php echo $row['order_id']?></a></td>
									<td class="product-name"><?php echo $row['order_date']?></td>
                                    <td class="product-name"><?php echo $row['shipping_address']?></td>
									<td class="product-name"><?php echo $row['payment_method']?></td>
									<td class="product-name"><?php echo $row['status']?></td>
									<!-- <td class="product-name"><?php echo $row['payment_status']?></td> -->
									
								</tr>
								<?php } ?>
							</tbody>
							
						</table>
				   </div>
			 </div>
		  </div>
	   </div>
</div>
<?php
require('inc/footer.php');
?>