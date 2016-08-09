<?php
class Opensql{
    public static $CONNECT = NULL;
    function __construct(){
        $dbhost = "mysql:host=localhost;dbname=Bank;port=443";
        $dbuser = 'root';
    	$dbpass = '';
    	//資料庫連線
    	
    	self::$CONNECT = new PDO($dbhost,$dbuser,$dbpass);
    	self::$CONNECT->exec("set names utf8");
    }
    //取得
    function getConnection(){
        return self::$CONNECT;
    }
    //關閉
    function closConnection(){
        return self::$CONNECT = NULL;
    }
}
?>