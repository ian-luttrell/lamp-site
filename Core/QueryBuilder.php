<?php

// Config.php is a configuration file in the App directory containing
//   sensitive database login information, so it is NOT posted on GitHub
require_once('../App/Config.php');

class QueryBuilder
{
	protected $pdo;
		
	public function __construct($dbConn)
	{
		$this->pdo = $dbConn;
	}

	public function selectAll($table)
	{
		$statement = $this->pdo->prepare("SELECT * FROM {$table}");
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($table, $record) 
	{
			$col_names = implode(', ', array_keys($record));
			$parameters = ':' . implode(',:', array_keys($record));
			$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $col_names, $parameters);
		
			$parameters = explode(',', $parameters); 			
			$arr = array_combine($parameters, $record);
	
			try {
				$stmt = $this->pdo->prepare($sql);
				foreach ($arr as $param => $val) {
					// cleaner to use bindValue() instead of bindParam()
					//   when values may be NULL
					$stmt->bindValue($param, $val);
				}
				$stmt->execute();
			} catch (PDOException $e) {
				die('Database insert error.');
			}
	}
}

?>
