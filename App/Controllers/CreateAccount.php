<?php

require_once('../App/Models/CreateAccount.php');

class CreateAccount
{
	public function index()
	{
		$view = '../App/Views/CreateAccount/index.php';
		View::render($view, []);
	}

	public function submit()
	{
		// pass registration credentials to model for processing
		$cred = ['username' => $_POST['username'],
					'password' => $_POST['password']];
		$processed_cred = CreateAccountModel::processCredentials($cred);
		
		// pass processed credentials to model for account creation		
		CreateAccountModel::register($processed_cred); 
		
		$username = $processed_cred['username'];
		$data = ['username' => $username];
		$view = '../App/Views/CreateAccount/submit.php';
		View::render($view, $data);
	}
}

?>
