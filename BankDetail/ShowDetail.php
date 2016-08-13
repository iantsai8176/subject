<?php
$ob = new Opensql();
$db = $ob->getConnection();
$user = $_POST["user"];
$dbSearch = $db->prepare("SELECT * FROM `detail` WHERE `account` = :user");
$dbSearch->bindParam(":user", $user);
$dbSearch->execute();