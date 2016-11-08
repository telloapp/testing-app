<?php
require '../core/init.php';
$general->logged_in_protect();


         
if (empty($_POST) === false) {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Sorry, but we need your username and password.';
	//} else if ($users->user_exists($email) === false) {
		//$errors[] = 'Sorry that email doesn\'t exist, please sign up first';
	//} else if ($users->email_confirmed($username) === false) {
	//	$errors[] = 'Sorry, but you need to activate your account. 
	//				 Please check your email.';
	} else {
		if (strlen($password) > 18) {
			$errors[] = 'The password should be less than 18 characters, without spacing.';
		}
		$login = $designer->login($username, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that username or password is invalid';
		}else {
			$_SESSION['id'] =  $login;
			header('Location: home.php');
			exit();
		}
	}
} 
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Log In</div>
            <form action="" method="post">
                <div class="body bg-white">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="submit" class="btn bg-blue btn-block">Log In</button>  <br>
		<?php 
		if(empty($errors) === false){
			echo '<p>' . implode('</p><p>', $errors) . '</p>';	
		}
		?>                    
                    
                    
                    <a href="register.php" class="text-center">New to Tello?</a>
                </div>
            </form>

        </div>
      

    </body>
</html>