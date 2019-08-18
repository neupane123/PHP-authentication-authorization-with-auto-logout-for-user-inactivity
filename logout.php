<?php
	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
	{
		if(isset($_POST['logout']))
		{
			session_start();
			session_destroy();
			// header("location:login.php?msg=you have been logged out");
			echo "login.php?msg=your session has expired, plz re-login";
			exit();
		}
	}


	// echo $_POST['logout'];
	if(isset($_POST['logout']))
	{
		session_start();
		session_destroy();
		header("location:login.php?msg=you have been logged out");
		exit();
	}
	
?>