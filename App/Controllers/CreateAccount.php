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
		$cred = ['username' => $_POST['username'],
					'password' => $_POST['password']];
			
		CreateAccountModel::register($cred); 
		
		$data = ['username' => $cred['username']];
		$view = '../App/Views/CreateAccount/submit.php';
		View::render($view, $data);
	}
}

?>
