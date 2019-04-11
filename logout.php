<?php
	SESSION_START();
	unset($_SESSION["sign_in"]);
	unset($_SESSION["username"]);
	header("Location:login.php");
?>	