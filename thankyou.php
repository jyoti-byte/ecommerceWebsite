<?php
session_start();
require ('inc/conn.php');
?>
<?php
include('inc/header.php');
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
            <h2 class="text-center text-danger font-weight-bold mt-3 mb-3">Thank you! <?php echo $_SESSION['username']; ?></h2>
			<h3 class="text-center text-danger font-weight-bold mb-5">Your order has been placed.</h3>
		</div>
	</div>     
</div>
<?php
include('inc/footer.php');
?>