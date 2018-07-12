<html>
<head>
<!-- title set by javascript -->
<title></title>
<link rel="stylesheet" type="text/css" href="/nav_style.css"/>
<script src="/header_script.js" defer></script>
</head>
<body>
	<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if (isset($_SESSION['user'])) {
			$username = $_SESSION['user'];
			echo "Logged in as " . htmlspecialchars($username);

			require 'logout_form.php';
		} 
	?>

	<div class="topnav">
	<a href="/create-account">Create Account</a>
	<a href="/login">Login</a>
	<a href="/prime-factorization">Prime Factorization</a>
	</div>

	<br><br>
</body>
</html>
