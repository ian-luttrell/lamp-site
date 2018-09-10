<?php

require_once('../Core/Model.php');

class PrimeFactorizationModel extends Model
{
	private static function getUserId($username)
	{
		$sql = 'SELECT user_id FROM users' .
				' WHERE username=:username';
		$params = ['username' => $username];

		$db = static::getDbHandle();
		$stmt = $db->prepare($sql);
		$stmt->execute($params);

		return $stmt->fetch()['user_id'];
	}

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

		// Redirect output to /dev/null to prevent browser from waiting.
		// Note that sending to /dev/null is okay, because output stream
		//   gets redirected to the proper file after the script starts.
		shell_exec("python3 {$models_path}/make_factor_tree.py" .
					" {$username} {$integer} > /dev/null &");

		// check for errors before this
		$sql = 'INSERT INTO files' .
				' (file_id, user_id, file_name, complete)' .
				' VALUES ' .
				' (:file_id, :user_id, :file_name, :complete)';
		$params = ['file_id' => NULL,
					'user_id' => static::getUserId($username),
					'file_name' => $integer,
					'complete' => 0];

		$db = static::getDbHandle();	
		$stmt = $db->prepare($sql);
		$stmt->execute($params);
	}

	public static function getFactorArray($username, $integer)
	{
		$models_path = '/var/www/html/App/Models';
		$string_of_fac = shell_exec("python3 {$models_path}/get_string_of_factors.py" .
									" {$username} {$integer}");

		$arr_of_fac = explode(',', $string_of_fac);
		
		return $arr_of_fac;
	}
}

?>
