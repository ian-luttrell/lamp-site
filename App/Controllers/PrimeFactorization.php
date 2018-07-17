<?php

require_once('../Core/View.php');
require_once('../App/Models/PrimeFactorization.php');

class PrimeFactorization
{
	public function index()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if (isset($_POST['submit_integer'])) {
			$input = trim($_POST['submit_integer']);
			if (filter_var($input, FILTER_VALIDATE_INT) !== false) {
				$integer_to_factor = $input;
				PrimeFactorizationModel::submitJob($_SESSION['user'],
													$integer_to_factor);
				
				$data = ['message' => 'You have submitted an integer' .
										' to factor. Please check back later' .
										' to see whether the factorization has' .
										' been completed.'];
				$view = '../App/Views/PrimeFactorization/submitted_integer.php';
			} else {
				$data = ['message' => 'You must provide an integer (containing' .
										' the characters 0-9 only).'];
				$view = '../App/Views/PrimeFactorization/' .
						'no_factors_requested.php';
			}

		} else if (isset($_SESSION['user'])) {
			$hasJobs = PrimeFactorizationModel::checkForExistingJobs(
								$_SESSION['user']);

			if ($hasJobs) {

				$status = 'INCOMPLETE';

				if ($status == 'INCOMPLETE') {
				$data = ['message' =>
							'Your number is still being factored.' .
							' Please refresh the page or check back later.'];
				$view = '../App/Views/PrimeFactorization/still_being_factored.php';
				} else {
				$data = ['message' =>
							'The factors of {$your_number} are   '];
				$view = '../App/Views/PrimeFactorization/factorization_completed.php';
				}

			} else {
				$data = ['message' =>
							'You have not requested any factorizations.' .
							' Submit one below:<br><br>'];
				$view = '../App/Views/PrimeFactorization/no_factors_requested.php';
			}		


		} else {
			$view = '../App/Views/PrimeFactorization/prime_logged_out.php';
			$data = [];
		}

		View::render($view, $data);
	}
}

?>
