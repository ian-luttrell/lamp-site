<?php

require_once('../Core/Model.php');

class CreateAccountModel extends Model
{
	public static function processCredentials($cred)
	{
		$username = htmlspecialchars($cred['username']);
		$hashed_password = password_hash($cred['password'], PASSWORD_DEFAULT);
		$processed_cred = ['username' => $username,
							'hashed_pass' => $hashed_password];
		
		return $processed_cred;
	}

	public static function register($processed_cred)
	{
		$username = $processed_cred['username'];
		$hashed_password = $processed_cred['hashed_pass'];
		$record = ['id' => NULL, 
					'username' => $username, 
					'hashed_password' => $hashed_password, 
					'created_at' => NULL];
		
		$conn = static::getConn();
		$db = new QueryBuilder($conn);
		$db->insert('users', $record);
	}
		 
}

?>
