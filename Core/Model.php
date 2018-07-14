<?php

// Config.php is a configuration file in the App directory containing
//   sensitive database login information, so it is NOT posted on GitHub
require_once('../App/Config.php');


abstract class Model
{
	static private $db = null;


	private static function setDbHandle()
	{
		try {
			$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' .
					Config::DB_NAME . ';charset=utf8';
			self::$db = new PDO($dsn, Config::DB_USER,
											Config::DB_PASSWORD);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	
	public static function getDbHandle()
	{
		if (self::$db == null) {
			self::setDbHandle();
		}

		return self::$db;
	}
}

?>
