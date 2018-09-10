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
			$username = $_SESSION['user'];
			//$input = explode(' ', $_POST['submit_integer'])[0];
			$input = $_POST['submit_integer'];

			if (preg_match('/^[1-9]+[0-9]*$/', $input)) {
				$integer_to_factor = $input;
				PrimeFactorizationModel::submitJob($username,
													$integer_to_factor);
				
				$data = ['message' => 'You have submitted the integer ' .
							$integer_to_factor . ' to be factored. Please' .
							' check back later' . ' to see whether the' .
							' factorization has been completed.'];
				$view = '../App/Views/PrimeFactorization/submitted_integer.php';
			} else {
				$data = ['message' => 'You must provide an integer (containing' .
										' the characters 0-9 only).'];
				$view = '../App/Views/PrimeFactorization/' .
						'no_factors_requested.php';
			}

		} else if (isset($_SESSION['user'])) {
			$username = $_SESSION['user'];
			$hasJobs = PrimeFactorizationModel::checkForExistingJobs(
								$_SESSION['user']);

			if ($hasJobs) {
				$status = 'INCOMPLETE';

				if ($status == 'INCOMPLETE') {
					$data = ['message' =>
								'Your number is still being factored.' .
								' Please refresh the page or check back later.'];
					$view = '../App/Views/PrimeFactorization/' .
							'still_being_factored.php';
				} else {
					$integer = '1';
					$arr_of_factors = PrimeFactorizationModel::getFactorArray(
										$username, $integer);
					$data = ['message' =>
								"The factors of {$integer} are: <br>",
								'factors' => $arr_of_factors];
					$view = '../App/Views/PrimeFactorization/' .
							'factorization_completed.php';
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
