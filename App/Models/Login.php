<?php

require_once('../Core/Model.php');

class LoginModel extends Model
{
	public static function authenticate($credentials)
	{
		$username = $credentials['username'];
		$password = $credentials['password'];
				
		$sql = 'SELECT * FROM users WHERE username=:username';		
		$params = ['username' => $username];
		
		$db = static::getDbHandle();
		$stmt = $db->prepare($sql);
		$stmt->execute($params);
		
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);		
		foreach ($results as $row) {
			$hashed_password = $row['hashed_password'];
			if (password_verify($password, $hashed_password)) {
				return True;
			}
		}
		return False;
	}
}

?>
