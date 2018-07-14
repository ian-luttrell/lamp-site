<?php

require_once('../App/Models/CreateAccount.php');

class CreateAccount
{
	public function index()
	{
		$view = '../App/Views/CreateAccount/index.php';
		View::render($view, []);
	}

	// If credentials are invalid, returns a string describing the error.
	// Otherwise, returns the username provided by the user.
	public function validateCredentials($cred)
	{
		$attemptedUsername = $cred['username'];
		$attemptedPassword = $cred['password'];

		if (!ctype_alnum($attemptedUsername)) {
			// this also prevents an empty or whitespace-only username
			return "Your username must contain letters or digits <b>only<b>.";
		} else if (empty($attemptedPassword)) {
			return "Your password must contain at least one character.";
		} else {
			return $cred['username'];
		}
	}

	public function submit()
	{
		$cred = ['username' => $_POST['username'],
					'password' => $_POST['password']];
		
		$rv = static::validateCredentials($cred);
		if ($rv == $cred['username']) {
			// credentials were valid
			CreateAccountModel::register($cred); 
			
			$data = ['username' => $cred['username']];
			$view = '../App/Views/CreateAccount/submit.php';
			View::render($view, $data);
		} else {
			// view will display the appropriate error message that was
            //   returned from validateCredentials()
			$data = ['invalid_credentials_description' => $rv];
			$view = '../App/Views/CreateAccount/invalid_username.php';
			View::render($view, $data);
		}
	}
}

?>
