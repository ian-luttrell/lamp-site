<?php

require 'header.php';

?>

<html>
<body>

<form action="/create-account/submit" method="post">
	<input type="text" name="username">
	<br>
	<input type="password" name="password">
	<br><br>
	<button type="submit">Create User</button>
</form>

Your username must contain letters or digits <b>only<b>.

</body>
</html>
