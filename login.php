<?php
session_start();
require('inc/conn.php');

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	try {
		// $sql = "SELECT * FROM users WHERE username=:username AND password=:passsword limit 1";
		$sql = "SELECT * FROM users WHERE username=:username";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		// $stmt->bindParam(':passsword', $pass, PDO::PARAM_STR);
		$stmt->execute();
		$res = $stmt->rowCount();

		if ($res > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			// if ($row['username'] == $username && $row['password'] == $pass) 
			if(password_verify($password, $row['password'])){

				$_SESSION['user_login']    = "yes";
				$_SESSION['user_id']  = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['email']    = $row['email'];
				$_SESSION['mobileNumber'] = $row['mobileNumber'];

				echo "<script>alert('Login successful.');</script>";
				echo "<script>window.location.href='checkout.php'</script>";
			}
		} else {
			echo "<script>alert('Invalid username or password.');</script>";
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
?>

<?php
include('inc/header.php');
?>
<section class="bg-white">
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-6">
				<div class="login-form-wrap">
					<div class="col-xs-12 mb-3">
						<div class="login-title">
							<h2 class="title-line">Login</h2>
						</div>
					</div>
					<div class="col-xs-12">
						<form id="login-form" action="" method="post">
							<div class="form-group">
								<label for="username"> Username </label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
								<!-- <i class="fa fa-check-circle"></i>
								<i class="fa fa-exclamation-circle"></i> -->
								<small></small>
							</div>
							<div class="form-group">
								<label for="password"> Password </label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
								<!-- <i class="fa fa-check-circle"></i>
								<i class="fa fa-exclamation-circle"></i> -->
								<small></small>
							</div>
							<div class="login-btn">
								<button type="submit" name="login" class="btn btn-primary">Login</button>
							</div>
							<div class="mt-3 pb-3">New member? Would you like to <a href="registration.php">Register?</a></div>
						</form>
						<div class="form-output login_msg">
							<p class="form-messege field_error"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- <script src="js/loginvalidation.js"></script> -->
<?php
include('inc/footer.php');
?>