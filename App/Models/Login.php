<?php

require_once('../Core/Model.php');

class LoginModel extends Model
{
	public static function escapeUsername($username)
	{
		return(htmlspecialchars($username));
	}

	public static function authenticate($processedCred)
	{
		$username = $processedCred['username'];
		$password = $processedCred['password'];
		
		$conn = static::getConn();
		
		$sql = 'SELECT * FROM users WHERE username=:username';		
		$stmt = $conn->prepare($sql);
		$stmt->bindParam('username', $username);
		$user_exists = $stmt->execute();
		if ($user_exists) {
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			foreach ($results as $row) {
				$hashed_password = $row['hashed_password'];
				if (password_verify($password, $hashed_password)) {
					return True;
				}
			}
		}
		return False;
	}
		 
}

?>
