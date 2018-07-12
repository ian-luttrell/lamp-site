<?php

require_once('../App/Models/Login.php');
require_once('../Core/View.php');

class Login
{
	public function index()
	{
		$view = '../App/Views/Login/index.php';
		View::render($view, []);
	}

	public function submit()
	{
		$cred = ['username' => $_POST['username'],
					'password' => $_POST['password']];

		$validLogin = LoginModel::authenticate($cred); 
		if ($validLogin) {
			session_start();
			$_SESSION['user'] = $cred['username'];

			$data = ['username' => $cred['username']];
			$view = '../App/Views/Login/successful_login.php';
			View::render($view, $data);	
		} else {
			$view = '../App/Views/Login/failed_login.php';
			View::render($view, []);
		}	
	}

	public function logOut()
	{
		session_start();
		$_SESSION = [];
		session_destroy();
				
		$view = '../App/Views/Login/index.php';
		View::render($view, []);
	}
}

?>
