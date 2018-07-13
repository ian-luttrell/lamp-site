<?php

require_once('../App/Models/CreateAccount.php');

class CreateAccount
{
	public function index()
	{
		$view = '../App/Views/CreateAccount/index.php';
		View::render($view, []);
	}

	public function validateUsername($attemptedUsername)
	{
		return ctype_alnum($attemptedUsername);
	}

	public function submit()
	{
		$cred = ['username' => $_POST['username'],
					'password' => $_POST['password']];
		
		$usernameValid = static::validateUsername($cred['username']);
		if ($usernameValid) {
			CreateAccountModel::register($cred); 
			
			$data = ['username' => $cred['username']];
			$view = '../App/Views/CreateAccount/submit.php';
			View::render($view, $data);
		} else {
			$view = '../App/Views/CreateAccount/invalid_username.php';
			View::render($view, []);
		}
	}
}

?>
