<?php
	require 'classes.php';

	require 'index_header.php';

	// need to move this to a "constants" file and include it
	$domain = 'localhost';	

	$logout_requested = isset($_POST['submit_logout']);
	
	if ($logout_requested)
	{
		setcookie('username', false, false, '/', $domain);
		setcookie('password', false, false, '/', $domain);
	}

	$login_cookie_set = isset($_COOKIE['username']);
	$logged_in = $login_cookie_set && !$logout_requested;
	if ($logged_in)
	{
		$username = $_COOKIE['username'];
		include 'already_logged_in.php';
	}	
    
	$user_created = isset($_POST['username']) 
					&& $_POST['username'] != '' 
					&& isset($_POST['password']) 
					&& $_POST['password'] != '';

	if ($user_created)
	{
		$conn = new SqlTransactor();
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conn->query('INSERT INTO users VALUES (NULL, ?, ?, NULL)', [$username, md5($password)]);
		
		include 'created_user.php';
		include 'user_creation_prompt.php';
	}
	else
	{
		include 'user_creation_prompt.php';
	}
?>
