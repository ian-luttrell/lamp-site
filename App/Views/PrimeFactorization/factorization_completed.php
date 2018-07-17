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

</body>

</html>
