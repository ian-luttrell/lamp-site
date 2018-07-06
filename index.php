<?php
	require 'classes.php';

	require 'index_header.php';

	$login_cookie_exists = isset($_COOKIE['username']);

	$user_created = isset($_POST['username']) 
					&& $_POST['username'] != '' 
					&& isset($_POST['password']) 
					&& $_POST['password'] != '';

	if ($login_cookie_exists)
	{
		$username = $_COOKIE['username'];
		include 'already_logged_in.php';
	}
	
    if ($user_created)
	{
		$conn = new SqlTransactor();
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conn->query('INSERT INTO users VALUES (NULL, ?, ?, NULL)', [$username, md5($password)]);
		
		include 'created_user.php';
	}

	include 'user_creation_prompt.php';
?>
