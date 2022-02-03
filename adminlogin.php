<?php
session_start();
require('inc/conn.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

try{
	$sql = "SELECT * FROM admin_users WHERE username=:username AND password=:passsword";
    $stmt=$conn->prepare($sql);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':passsword', $password, PDO::PARAM_STR);
	$stmt->execute();
	$res=$stmt->rowCount();

	if($res>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
		if ($row['username'] == $username && $row['password'] == $password) {

			$_SESSION['admin_login']    = "yes";  
			$_SESSION['admin_id'] = $row['admin_id'];
			$_SESSION['username'] = $row['username'];

			echo "<script>alert('Login successful.');</script>";
			echo "<script>window.location.href='dashboard.php'</script>";	
		}	
	}	
	else{
		echo "<script>alert('Invalid username or password.');</script>";
	}	
}
catch(PDOException $e) {
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
									<h2 class="title-line"> Admin Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" action="" method="post">
                                    <div class="form-group">
									<label for="username"> Username </label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password"> Password </label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                    </div>                                   
									<div class="login-btn">
										<button type="submit" name="login" class="btn btn-primary">Login</button>
									</div>
									<!-- <div class="mt-3 pb-3">New member? Would you like to <a href="registration.php">Register?</a></div> -->
								</form>
							</div>
						</div> 
                	</div>
				</div>
			</div>
        </section>
<?php 
include('inc/footer.php');
?>