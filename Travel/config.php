<?php
    $dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'Myproject';
	$link = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
    $result = mysql_query("set names utf8",$link);
    mysql_select_db($dbname,$link);
?>