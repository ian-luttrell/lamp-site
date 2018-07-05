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
