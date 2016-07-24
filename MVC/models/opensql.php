<?php
class opensql{
    public $db;
    function sql(){
        $dbhost = "mysql:host=localhost;dbname=Myproject;port=443";
    	$dbuser = 'root';
    	$dbpass = '';
    	// 連接資料庫伺服器
    	$db = new PDO($dbhost,$dbuser,$dbpass);
    	$db->exec("set names utf8");
        return $db;
    } //啟動資料庫
}
?>