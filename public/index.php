<!-- this file will implement the front controller -->

<?php
	require '../App/Controllers/CreateAccount.php';

	require '../Core/Router.php';
	$router = new Router();
	$router->addRoute('', ['controller' => 'CreateAccount', 'action' => 'index']);
	
	$url = $_SERVER['QUERY_STRING'];
	$router->dispatchRoute($url);
?>
