<?php
session_start();
require('inc/conn.php');

if (isset($_POST['register'])) {
    $username  = trim($_POST['name']);
    $email     = trim($_POST['email']);
    $mobileNumber = trim($_POST['mobile']);
    $password   = trim($_POST['password']);
    $password2   = trim($_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpassword = password_hash($password2, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT * from users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $res = $stmt->rowCount();

    if ($res > 0) {
        echo "<script>alert('Email already exists. Please choose a different email.');</script>";
    } else {
        if($password === $password2){
            $stmt = $conn->prepare("INSERT INTO `users`(`username`, `email`, `mobileNumber`, `password`, `cpassword`) VALUES (:username, :email, :mobile, :passsword, :password2)");
    
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':mobile', $mobileNumber, PDO::PARAM_STR);
            $stmt->bindParam(':passsword', $pass, PDO::PARAM_STR);
            $stmt->bindParam(':password2', $cpassword, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successfull.');</script>";
                echo "<script>window.location.href='login.php'</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again');</script>";
                echo "<script>window.location.href='registration.php'</script>";
            }
        }else {
            echo "Passwords do not match";
        }
        
    }
}
?>

<?php
include("inc/header.php");
?>
<div class="container">
    <div class="col-md-6 ml-5">
        <div class="register-form-wrap">
            <div class="col-xs-12">
                <div class="register-title mb-3">
                    <h2 class="title-line">Register</h2>
                </div>
            </div>
            <div class="col-xs-12">
                <form id="register-form" action="" method="post">
                    <div class="form-group">
                        <label for="username"> Full Name </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name " required>
                        <small class="fieldError" id="name_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="email"> Email Address </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email " required>
                        <small class="fieldError" id="email_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="mobile"> Mobile Number </label>
                        <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number " required>
                        <small class="fieldError" id="mobile_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="password"> Password </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        <small class="fieldError" id="password_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="password2"> Confirm Password </label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                        <small class="fieldError" id="cpassword_error"></small>
                    </div>

                    <div class="register-btn">
                        <button type="submit" name="register" id="register" class="btn btn-primary">Register</button>
                    </div>
                    <div class="mt-3 pb-3">Already a member? <a href="login.php">Login</a></div>
                </form>
                <div class="form-output register_msg">
					<p class="form-messege field_error"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ECI: START - FACEBOOK PIXEL -->
<script>
    fbq('track', 'CompleteRegistration');
</script>
   <!-- ECI: END - FACEBOOK PIXEL -->

<!-- <script src="js/validate.js"></script> -->
<!-- <script src="js/regisvalidation.js"></script> -->
<?php require('inc/footer.php') ?>