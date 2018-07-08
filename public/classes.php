<?php
	// for security reasons, deny browser access to this file with .htaccess
	//   and put it in a non-public folder (outside of the document root)
	class QueryBuilder
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

			try {
				$this->pdo = new PDO($dsn, $user, $pass, $opt);
			} catch (PDOException $e) {
				die('Could not connect to database.');
			}

		}

		public function select_all($table) {
			$sql = "SELECT * FROM {$table}";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
		
			return $stmt;
		}

		public function insert($table, $parameters) {
			$col_names = implode(', ', array_keys($parameters));
			$values = ':' . implode(', :', array_keys($parameters));
			$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $col_names, $values);
			
			try {
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute($parameters);
			} catch (PDOException $e) {
				die('Database insert error.');
			}
		}
	}
?>
