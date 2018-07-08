<?php

class CreateAccount
{
	public function index()
	{
		// for now, just redirect to create_account.php
		//   (not a proper MVC setup, but avoid breaking site for now)
		$domain = 'localhost';
		header('Location: https://' . $domain .'/create_account.php');
	}
}
