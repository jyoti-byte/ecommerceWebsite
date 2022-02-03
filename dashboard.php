<?php 
session_start();
include('inc/header1.php');

// if(isset($_POST['order'])){
//     header ('admin_order_details.php');
// }
?>
	<h1 class="text-center text-danger mb-5" style="margin-top:20px;">DASHBOARD</h1>
	<div class="col-md-6">
		<a href="index.php" target="_self" class="btn btn-dark mb-3 mr-1 ml-4"> Product CRUD</a><br>
        <a href="admin_order.php" target="_self" class="btn btn-dark mb-3 mr-1 ml-4">Orders Report </a>
    </div>
