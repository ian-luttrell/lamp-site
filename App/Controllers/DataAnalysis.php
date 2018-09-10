<?php

require_once('../App/Models/DataAnalysis.php');

class DataAnalysis
{
	public function index()
	{
		$view = '../App/Views/DataAnalysis/index.php';
		View::render($view, []);
	}
}

?>
