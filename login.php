<?php

$creds = require_once "credentials.php";
$err = [];

if(isset($_POST['btn_login'])) {

	if(!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
		$email = $_POST['email'];
	}else {
		$err['email'] = "plz provide valid email";
	}

	if( !empty($_POST['password']) ) {
		$password = $_POST['password'];
	}else {
		$err['password'] = "plz provide valid password";
	}

	if(count($err)==0)
	{
		if(array_key_exists($email, $creds))
		{
			if(password_verify($password, $creds[$email]['password'])) {

				//checking user status
				if($creds[$email]['status'] == 1 )
				{
					//login success section
					session_start();
					// echo uniqid();
					$_SESSION['login'] = true;
					$_SESSION['name'] = $creds[$email]['name'];

					header('location:dashboard.php');
					eixt();

				}else{

					$err['invalid_login'] = "you account is currently suspended !";
				}
				

			}else{
				$err['invalid_login'] = "wrong password !";
			}
		}else {
			$err['invalid_login'] = "sorry ! account does not exists";
		}
	}

}

?>

<form action="" method="post">
	<?php 
	if(isset($err['invalid_login'])) {

		echo "<caption>{$err['invalid_login']}</caption><br>";
	}elseif(isset($_GET['msg']) && !empty($_GET['msg'])) {
		echo "<caption>{$_GET['msg']}</caption><br>";
	}

	?>
	<input type="email" name="email" placeholder="email"><br>
	<input type="password" name="password" placeholder="password"><br>
	<button type="submit" name="btn_login">Login</button>
</form>