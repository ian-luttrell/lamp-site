
<?php
	require 'classes.php';

	require 'header.php';
	?> <script src='header_script.js'></script> <?php

	// need to move this to a "constants" file and include it
	$domain = 'localhost';

	$login_attempted = isset($_POST['username']) 
				        && !empty($_POST['username']) 
						&& isset($_POST['password']) 
						&& !empty($_POST['password']);

	$login_cookie_exists = isset($_COOKIE['username']);

	$logout_requested = isset($_POST['submit_logout']);

	if ($login_attempted)
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hashed_password = md5($password);
		$valid_login = False;
		$db = new QueryBuilder();
		$result_set = $db->select_all('users');
		foreach ($result_set as $row)
		{
			if ($row['username'] == $username && $row['password'] == $hashed_password)
			{
				$valid_login = True;
				break;
			}
		}

		if ($valid_login)
		{
			$domain = 'localhost';
			setcookie('username', $username, false, '/', $domain);
			setcookie('password', $hashed_password, false, '/', $domain);
			header('Location: https://' . $domain .'/');
		}
		else
		{
			require 'failed_login.php';
		}
	}
	elseif ($logout_requested)
	{
		setcookie('username', false, false, '/', $domain);
		setcookie('password', false, false, '/', $domain);
		require 'login_prompt.php';
	}
	elseif ($login_cookie_exists)
	{
		$username = $_COOKIE['username'];
		require 'already_logged_in.php';
	}
	else
	{
		require 'login_prompt.php';
	}
?>
