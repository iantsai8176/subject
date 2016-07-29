<?php
class caculation{
    function page($db){
        $sql ="select * from article order by no desc";
        $result = $db->query($sql);
        
        $num_rows = $result->rowCount();//統計總比數
        $per = 3;                               //每頁顯示項目數量
        $pages = ceil($num_rows/$per);
            if (!isset($_GET["page"])){         //假如$_GET["page"]未設置 則在此設定起始頁數
                $page=1;                        
            } else {
                $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
            }
        $start = ($page-1)*$per;                //每一頁開始的資料序號
        $getpage_result = $db->query($sql.' LIMIT '.$start.', '.$per) or die("Error".$page);//從第Ｎ筆取Ｍ筆資料
        $array["page"] = $page;
        $array["db_page"] = $getpage_result;
        $array["pages"] = $pages;
        $array["db"] = $db;
        return $array;
    } //文章分頁
    
    
}
?>