<?php
	require 'classes.php';

	$login_attempted = isset($_POST['username']) 
				        && !empty($_POST['username']) 
						&& isset($_POST['password']) 
						&& !empty($_POST['password']);

	$login_cookie_exists = isset($_COOKIE['username']);

	if ($login_attempted)
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hashed_password = md5($password);
		$valid_login = False;
		$db = new SqlTransactor();
		$result_set = $db->query('SELECT username,password FROM users', []);
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
			header('Location: http://' . $domain .'/index.php');
		}
		else
		{
			include 'failed_login.php';
		}
	}

	elseif ($login_cookie_exists)
	{
		$username = $_COOKIE['username'];
		include 'already_logged_in.php';
	}

	else
	{
		include 'login_prompt.php';
	}
?>
