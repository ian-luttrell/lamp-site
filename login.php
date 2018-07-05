<html>
<body>

<?php
	require 'classes.php';

	if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']))
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
			echo '
			<form action="login.php" method="post">
			<input type="text" name="username">
			<button type="submit" name="submit_login">Log In</button>
			<br>
			<input type="password" name="password">
			</form>
			';
		
			echo '<br>Failed login.';
		}
	}

	else if (isset($_COOKIE['username']))
	{
		echo "Already logged in.";
	}

	else
	{
		echo '
			<form action="login.php" method="post">
			<input type="text" name="username">
			<button type="submit" name="submit_login">Log In</button>
			<br>
			<input type="password" name="password">
			</form>
			';
	}
?>


</body>
</html>
	
