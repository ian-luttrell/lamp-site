<?php

require_once('../Core/View.php');

class PrimeFactorization
{
	public function index()
	{
		session_start();
		if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
			$view = '../App/Views/PrimeFactorization/prime_logged_in.php';
			View::render($view, []);
		} else {
			$view = '../App/Views/PrimeFactorization/prime_logged_out.php';
			View::render($view, []);
		}
	}
}

?>
