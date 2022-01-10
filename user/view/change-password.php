<?php
	include '../controller/UserController.php';
	include_once '../../lib/session.php';
    Session::checkUserLogin();
?>

<?php
    $userCon = new UserController();

    if(Session::get('user') == null){
        header('Location:index.php');
    }else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $alert = $userCon->Switch($_POST["change_password"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change password</title>
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
				<form action="" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Change password
					</span>
					
					<?php
						if(isset($alert)){
							echo $alert;
						}
					?>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="secretNumber">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-user"></i> Secret number</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100"> New password</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100"> Confirm password</span>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="change_password" value="change_password">
							Submit
						</button>
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