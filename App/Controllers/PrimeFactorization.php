<?php

require_once('../Core/View.php');

class PrimeFactorization
{
	public function index()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if (isset($_SESSION['user'])) {
			$view = '../App/Views/PrimeFactorization/prime_logged_in.php';
			View::render($view, []);
		} else {
			$view = '../App/Views/PrimeFactorization/prime_logged_out.php';
			View::render($view, []);
		}
	}
}

?>
