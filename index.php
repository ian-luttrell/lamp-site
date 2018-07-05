<html>
<body>

<?php
	class SqlTransactor
	{
		private $pdo;
		
		public function __construct() {
			$host = 'localhost';
			$db   = 'test';
			$user = 'web';
			$pass = 'sesame';
			$charset = 'utf8mb4';

			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
			$opt = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			$this->pdo = new PDO($dsn, $user, $pass, $opt);
		}

		public function query($sql, $val_array) {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute($val_array);
		
			return $stmt;
		}
	}
?>

<form action="/index.php" method="post">
	<input type="text" name="username">
	<br>
	<input type="password" name="password">
	<br>
	<button type="submit">Create User</button>
</form>

<?php 
	$conn = new SqlTransactor();
	if (isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '')
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conn->query('INSERT INTO users VALUES (NULL, ?, ?, NULL)', [$username, md5($password)]);
		echo 'created user ' . $username;
	}
?>

</body>
</html>
