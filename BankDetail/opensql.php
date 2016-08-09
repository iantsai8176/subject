<?php
class Opensql{
    public static $connect = null;
    function __construct()
    {
        $dbHost = "mysql:host=localhost;dbname=Bank;port=443";
        $dbUser = 'root';
    	$dbPass = '';
    	//資料庫連線
    	
    	self::$connect = new PDO($dbHost,$dbUser,$dbPass);
    	self::$connect->exec("set names utf8");
    }
    //取得
    function getConnection()
    {
        
        return self::$connect;
        
    }
    //關閉
    function closConnection()
    {
        
        return self::$connect = null;
        
    }
}
