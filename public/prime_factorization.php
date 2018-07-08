<?php
	require 'header.php';
	?> <script src='header_script.js'></script> <?php

	$logged_in = isset($_COOKIE['username']);
	if ($logged_in)
	{
		echo 'Welcome to prime factorization.';
	}
	else
	{
		echo 'Log in first.';
	}
?>
