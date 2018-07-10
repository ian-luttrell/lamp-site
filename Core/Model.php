<?php

require_once('../App/Config.php');
require_once('../Core/QueryBuilder.php');

abstract class Model
{
	public static function getConn()
	{
		static $conn = null;

		if ($conn == null) {
			try {
				$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' .
						Config::DB_NAME . ';charset=utf8';
				$conn = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
		
		return $conn;
	}
}

?>
