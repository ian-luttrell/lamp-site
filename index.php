<html>
<body>

<?php
	require 'classes.php';

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
	}

	else
	{
		include 'user_creation_prompt.php';
	}
?>

</body>
</html>
