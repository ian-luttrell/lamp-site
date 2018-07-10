<?php
	require_once('../App/Controllers/CreateAccount.php');
	require_once('../App/Controllers/Login.php');
	require_once('../App/Controllers/PrimeFactorization.php');

	require '../Core/Router.php';
	$router = new Router();
	$router->addRoute('create-account', ['controller' => 'CreateAccount', 'action' => 'index']);
	$router->addRoute('create-account/submit', ['controller' => 'CreateAccount', 'action' => 'submit']);
	$router->addRoute('', ['controller' => 'CreateAccount', 'action' => 'index']);
	$router->addRoute('show-all-users', ['controller' => 'Test', 'action' => 'showAllUsers']);
	$router->addRoute('login', ['controller' => 'Login', 'action' => 'index']);
	$router->addRoute('login/submit', ['controller' => 'Login', 'action' => 'submit']);
	$router->addRoute('log-out', ['controller' => 'Login', 'action' => 'logOut']);
	$router->addRoute('prime-factorization', ['controller' => 'PrimeFactorization', 'action' => 'index']);
	
	$url = $_SERVER['QUERY_STRING'];
	$router->dispatchRoute($url);
?>
