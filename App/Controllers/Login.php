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

		// pass supplied username to model for escaping
		$username = $cred['username'];
		$escapedUsername = LoginModel::escapeUsername($username);
		$password = $_POST['password'];
		$processedCred = ['username' => $escapedUsername,
							'password' => $password];		

		// pass processed credentials to model for authentication
		$validLogin = LoginModel::authenticate($processedCred); 
		if ($validLogin) {
			session_start();
			$_SESSION['user'] = $escapedUsername;

			$data = ['username' => $escapedUsername];
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
