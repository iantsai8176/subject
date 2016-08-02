<?php
//將cookies清空
if (isset($_COOKIE["login"]))
{
	setcookie("login", "Guest", time() - 3600);
	header("Location: index.php");
	session_destroy();
}
?>