<?php
session_start();
require('inc/conn.php');

if(isset($_GET['order_id']) && $_GET['order_id'] != '') {
    $order_id=$_GET['order_id'];
}

if(isset($_POST['update_order_status'])){
	$update_order_status=$_POST['update_order_status'];
    $stmt1=$conn->prepare("UPDATE orders set status='$update_order_status' where order_id=:order_id");
    $stmt1->bindParam('order_id', $order_id);

	// if($update_order_status=='5'){
	// 	$stmt1=$conn->prepare("UPDATE orders set order_status='$update_order_status',payment_status='Success' where orders.order_id=:order_id");
	// }else{
	// 	$stmt1=$conn->prepare("UPDATE orders set status='$update_order_status' where orders.order_id=:order_id");
	// }
    $stmt1->execute();
	
}
?>
<?php 
include('inc/header1.php');
?>
<div class="container mt-4">
        <div class="col-md-6">
        <a href="admin_order.php" class="btn btn-success mb-3"> Back </a><a href="view_reports.php" class="btn btn-success mb-3 ml-2"> View Reports </a>
        </div>
        <form action="" method="POST" >
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-database"></i> Orders Details</strong>
                </div>
                <table class="table table-bordered table-responsive text-center">
                    <thead>
                        <tr>
                            <th class="col-2">Product ID</th>     
                            <th class="col-2">Product Name</th>
                            <th class="col-2">Product Image</th>
                            <th class="col-2">Quantity</th>
                            <th class="col-2">Product Price</th>
                            <th class="col-2">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
					$res=$conn->prepare("SELECT distinct(orders.order_id),products.product_name,products.product_image,order_product.quantity, order_product.product_price, 
                    order_product.product_id from orders, products, order_product where orders.order_id=:order_id and products.product_id=order_product.product_id");
                    $res->bindParam('order_id', $order_id);
                    $res->execute();
					$total_price=0;
                    // $row=$res->fetch(PDO::FETCH_ASSOC);
                    // var_dump($row);
                    // die;

					while($row=$res->fetch(PDO::FETCH_ASSOC)){
						$total_price=$total_price+($row['quantity']*$row['product_price']);
					?>
					<tr>
                        <td class="product-id"><?php echo $row['product_id']?></td> 
						<td class="product-name"><?php echo $row['product_name']?></td>
                        <td class="product-name"><img src="<?php echo 'image/'.$row['product_image'] ?>" class="img-fluid mb-3" style="height:150px; width:500px"></td>
						<td class="product-name"><?php echo $row['quantity']?></td>
						<td class="product-name">&#8360; <?php echo $row['product_price']?></td>
						<td class="product-name">&#8360; <?php echo $row['quantity']*$row['product_price']?></td>
										
					</tr>
					<?php } ?>
					<tr>
						<td colspan="4"></td>
							<td class="product-name font-weight-bold">Total Price</td>
							<td class="product-name font-weight-bold">&#8360; <?php echo $total_price?></td>
										
						</tr>
					</tbody>
							
				</table>
                <div>
                    <strong class="pl-3">Order Status: </strong>
                    <?php 
                    $stmt=$conn->prepare("SELECT order_status.name FROM order_status, orders where orders.order_id=:order_id and orders.status=order_status.id");
                    $stmt->bindParam('order_id', $order_id);
                    $stmt->execute();
                    $res=$stmt->fetch(PDO::FETCH_ASSOC);
                    echo $res['name'];
                    ?>
                        <div>
                            <form method="post">
                                <select class="form-control mt-3" name="update_order_status" required>
                                        <option value="">Select Status</option>
                                        <?php
                                        $res=$conn->prepare("SELECT * FROM order_status");
                                        $res->execute();
                                        while($row=$res->fetch(PDO::FETCH_ASSOC)){
                                            if($row['id']==$status){
                                                echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            }
                                            }
                                        ?>
                                </select>
                                <input type="submit" class="form-control text-primary font-weight-bold"/>
                            </form>
						</div>
                </div>
                
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('inc/footer.php');
?>