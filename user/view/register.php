<?php
    include '../controller/UserController.php';
?>

<?php
    $userCon = new UserController();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$alert = $userCon->Switch($_POST['register']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
        include '../view/layouts/login/cssfile.php';
    ?>
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="register.php">
					<span class="login100-form-title p-b-43">
						Register
					</span>
					
					<?php
						if(isset($alert)){
							echo $alert;
						}
					?>
					<div class="wrap-input100 validate-input" data-validate = "Not empty">
						<input class="input100" type="text" name="userName">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-user"></i> User name</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Not empty">
						<input class="input100" type="text" name="firstName">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-signature"></i> First name</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Not empty">
						<input class="input100" type="text" name="lastName">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-signature"></i> Last name</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-envelope"></i> Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-lock"></i> Password</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate="Confirm password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-lock"></i> Confirm password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">

						<div>
							<a href="login.php" class="txt1">
								If you already have account, login now!
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="register" value="register">
							Submit
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('./assets/login/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<?php
        include '../view/layouts/login/jsfile.php';
    ?>

</body>
</html>