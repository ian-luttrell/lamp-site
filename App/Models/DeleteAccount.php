<?php

require_once('../Core/Model.php');

class DeleteAccountModel extends Model
{
	public static function delete($username)
	{
		$sql = 'DELETE FROM users WHERE username=:username';
		$params = ['username' => $username];

		$db = static::getDbHandle();
		try {		
			$stmt = $db->prepare($sql);
			$stmt->execute($params);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
