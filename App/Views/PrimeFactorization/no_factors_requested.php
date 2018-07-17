<?php

require 'header.php';

?>

<html>
<head>
</head>

<body>

Welcome to the prime factorization utility, <?= htmlspecialchars($_SESSION['user']) ?>.
<br><br>
<?= $data['message'] ?>

<form action="/prime-factorization" method="POST">
	<input type="text" name="submit_integer">
	<br><br>
	<button type="submit">Submit Integer</button>
</form>

</body>

</html>
