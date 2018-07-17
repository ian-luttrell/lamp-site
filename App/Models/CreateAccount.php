<?php

require_once('../Core/Model.php');

class CreateAccountModel extends Model
{
	public static function register($credentials)
	{
		$username = $credentials['username'];
		$hashed_password = password_hash($credentials['password'], 
											PASSWORD_DEFAULT);
		
		# WARNING: username column must have type VARCHAR BINARY
		#   (so that this query is case sensitive).
		# The hashed_password column can just be VARCHAR(255), because
		#   the hashing is case-sensitive.
		$sql = 'INSERT INTO users' .
				' (user_id, username, hashed_password, created_at)' . 
				' VALUES (:user_id, :username,' .
							' :hashed_password, :created_at);';
	
		$params = ['user_id' => NULL, 
					'username' => $username, 
					'hashed_password' => $hashed_password, 
					'created_at' => NULL];

		$db = static::getDbHandle();		
		$stmt = $db->prepare($sql);
		$stmt->execute($params);
	}
		 
}

?>
