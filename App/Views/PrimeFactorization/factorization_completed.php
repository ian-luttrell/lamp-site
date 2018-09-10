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

<?php
	foreach ($data['factors'] as $factor) {
		echo $factor . '<br>';
	}
?>

</body>

</html>
