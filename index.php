<?php
	require 'classes.php';

	require 'index_header.php';

	$logged_in = isset($_COOKIE['username']);

	$logout_requested = isset($_POST['submit_logout']);
	if ($logout_requested)
	{
		$logged_in = False;
	}

	$user_created = isset($_POST['username']) 
					&& $_POST['username'] != '' 
					&& isset($_POST['password']) 
					&& $_POST['password'] != '';

	if ($logged_in)
	{
		$username = $_COOKIE['username'];
		include 'already_logged_in.php';
		include 'user_creation_prompt.php';
	}	
	elseif ($logout_requested)
	{
		setcookie('username', false, false, '/', $domain);
		setcookie('password', false, false, '/', $domain);
		include 'user_creation_prompt.php';
	}
    elseif ($user_created)
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
