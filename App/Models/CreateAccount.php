<?php

require_once('../Core/Model.php');

class CreateAccountModel extends Model
{
	public static function register($credentials)
	{
		$username = $credentials['username'];
		$hashed_password = password_hash($credentials['password'], 
											PASSWORD_DEFAULT);
		
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
