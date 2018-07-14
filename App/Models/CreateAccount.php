<?php

require_once('../Core/Model.php');

class CreateAccountModel extends Model
{
	public static function register($credentials)
	{
		$username = $credentials['username'];
		$hashed_password = password_hash($credentials['password'], 
											PASSWORD_DEFAULT);
		
		$sql = 'INSERT INTO users (id, username, hashed_password, created_at)' .
				' VALUES (:id, :username, :hashed_password, :created_at);';
	
		$params = ['id' => NULL, 
					'username' => $username, 
					'hashed_password' => $hashed_password, 
					'created_at' => NULL];

		$db = static::getDbHandle();		
		$stmt = $db->prepare($sql);
		$stmt->execute($params);
	}
		 
}

?>
