<?php

require_once('../App/Models/DeleteAccount.php');

class DeleteAccount
{
	public function index()
	{
		session_start();
		$username = $_SESSION['user'];
		DeleteAccountModel::delete($username);

		$_SESSION = [];
		session_destroy();
		
		$data = ['username' => $username];
		$view = '../App/Views/DeleteAccount/index.php';
		View::render($view, $data);
	}
}

?>
