<?php
include("config.php");
$sql ="select * from article";
$result1 = mysql_query($sql,$link) or die ("error");

$data_nums = mysql_num_rows($result1);//統計總比數
$per = 3;                               //每頁顯示項目數量
$pages = ceil($data_nums/$per);
    if (!isset($_GET["page"])){         //假如$_GET["page"]未設置 則在此設定起始頁數
        $page=1;                        
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
$start = ($page-1)*$per;                //每一頁開始的資料序號
$result = mysql_query($sql.' LIMIT '.$start.', '.$per,$link) or die("Error".$page);
?>