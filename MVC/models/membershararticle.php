<?php
class membershararticle{
    function Sharearticle($db,$username,$area,$title,$sort,$address,$content){
        $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
        $sql = "insert into article(username,area,title,sort,address,content,time) value ('$username','$area','$title','$sort','$address','$content','$datetime')";
        if($result = $db->query($sql))
        {
            $row = $db->lastinsertid(); // 取得最後新增資料id
            echo "<script>alert(\"發布成功\")\nwindow.location.href='showArticle?rq=$row'</script>";
         }
        else 
        {
        echo "<script>alert(\"發布失敗\")\nwindow.location.href='shareArticle'</script>";
        }
    }//文章發佈
}
?>