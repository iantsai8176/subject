<?php
class PDOsql{
    public static $connect = NULL;
    function __construct(){
        $dbhost = "mysql:host=localhost;dbname=Myproject;port=443";
    	$dbuser = 'root';
    	$dbpass = '';
    	// 連接資料庫伺服器
    	self::$connect = new PDO($dbhost,$dbuser,$dbpass);
    	self::$connect->exec("set names utf8");
    } //啟動資料庫
    function getConnection(){
        return self::$connect;
    }
    function closConnection(){
        return self::$connect = NULL;
    }
}
?>