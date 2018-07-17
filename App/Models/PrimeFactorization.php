<?php

require_once('../Core/Model.php');

class PrimeFactorizationModel extends Model
{
	public static function checkForExistingJobs($username)
	{
		$sql = 'SELECT file_id FROM files JOIN users' .
				' ON files.user_id = users.user_id' . 
				' WHERE username=:username';
		$params = ['username' => $username];

		$db = static::getDbHandle();	
		$stmt = $db->prepare($sql);
		$stmt->execute($params);

		if ($stmt->rowCount() > 0) {
			return True;
		} else {
			return False;
		}
	}

	public static function submitJob($username, $integer)
	{
		$models_path = '/var/www/html/App/Models';
		shell_exec("python3 {$models_path}/make_factorization_file.py" .
					" {$username} {$integer}");

		// check for errors before this
		$sql = 'INSERT INTO files' .
				' (file_id, user_id, file_name, complete)' .
				' VALUES ' .
				' (:file_id, :user_id, :file_name, :complete)';
		$params = ['file_id' => NULL,
					'user_id' => 12,
					'file_name' => $integer,
					'complete' => 0];

		$db = static::getDbHandle();	
		$stmt = $db->prepare($sql);
		$stmt->execute($params);
	}
}

?>
