<?php
	include '../controller/UserController.php';
	include_once '../../lib/session.php';
	Session::checkUserSession();
?>

<?php
    $userCon = new UserController();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['userName'];
        $email = $_POST['email'];

        $check = $userCon->checkChangePass($username, $email);
        if($check != false){
            $profile = $check->fetch_assoc();
            $name = $profile['firstname'].' '.$profile['lastname'];

            $send = $userCon->sendSecretNumber($email, $name);
            if($send){
                Session::set('user', $username);
                header('Location:change-password.php');
                // var_dump(Session::get('user'));
            }
        }else{
            $alert = '<div class="alert alert-danger">Wrong information</div>';
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forgot password</title>
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
						<input class="input100" type="text" name="userName">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-user"></i> User name</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Email is required">
						<input class="input100" type="email" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fas fa-envelope"></i> Email</span>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
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