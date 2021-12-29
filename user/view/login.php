<?php
	include '../controller/LoginController.php';
	include_once '../../lib/session.php';
	
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $loginCon = new LoginController();
        $username = $_POST['userName'];
        $password = md5($_POST['password']);
		
    	$login_check = $loginCon->loginUser($username, $password);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
				<form action="login.php" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					<?php
						if(isset($login_check)){
							echo $login_check;
						}
					?>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="userName">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-user"></i> User name</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Confirm password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-lock"></i> Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<a href="forgot-password.php" class="txt1">
								Forgot password?
							</a>
						</div>

						<div>
							<a href="register.php" class="txt1">
								Register
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
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