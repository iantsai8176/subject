 <?php
 session_start();
header("content-type:text/html; charset=utf-8");

class articleMethod{
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
    
    function Showarticle($db){
        if(isset($_SESSION["title"]))
            {
                $sql = "select * from article order by no desc limit 1";
                $result =$db->query($sql);
                unset($_SESSION["title"]);
                $_SESSION["page"] = $_GET["rq"]; //取得新加入文章之id
            }
            else
            {
                $sql ="select * from article";
                $page = $_GET["PAGE"] -1; //當前使用者點選文章之id
                $_SESSION["page"] = $page;
                $result = $db->query($sql.' LIMIT '.$page.', '.'1') or die("Error".$page);
            }
        while($catch=$result->fetch())
        {
            $array["area"] = $catch["area"];
            $array["sort"] = $catch["sort"];
            $array["content"] = $catch["content"];
            $array["title"] = $catch["title"];
        }
        $array["db"] = $db;
        return $array;
    } //顯示文章內容
    
    function ComitteeHandel($db,$rq){
    if($rq != ""){
        if(isset($_SESSION[ "login"]))
        {
        $username=$_SESSION["login"];
        $num = $_SESSION["page"];
        $msg=$_GET["rq"];
        $date = date("H:i:s");
        $sql = "insert into comittee(username,message,time,page) value ('$username','$msg','$date','$num')";
        $result = $db->query($sql);
        
            $array["username"] = $username;
            $array["message"] = $msg;
            $array["time"] =$date;
            
         echo json_encode($array);
        }
    else 
    {
        echo "0";
    }
}
    } //留言版評論
    
    function ModifyShowArticle($db,$page){
        $sql = "select * from article where no = '$page' ";
        $result = $db->query($sql);
        $_SESSION["page"] = $page;
        while($row = $result->fetch()){
            $array = $row;
        }
        
        return $array;
    } //撈取預修改文章
    
    function ModifyArticle($db,$username,$area,$title,$sort,$address,$content,$page){
        $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
        $sql = "update article set username='$username',area='$area',title='$title',sort='$sort',address='$address',content='$content',time='$datetime' where no='$page'";
        if($result = $db->query($sql))
        {
            $row = $db->lastinsertid(); // 取得最後新增資料id
            echo "<script>alert(\"修改成功\")\nwindow.location.href='showArticle?rq=$row'</script>";
         }
        else 
        {
        echo "<script>alert(\"修改失敗\")\nwindow.location.href='shareArticle'</script>";
        }
    } //修改文章
    
    function DeleteArticle($db,$page){
        $sql = "delete from article where no='$page'"; //預刪除文章編號
        if($result = $db->query($sql)){
            echo "<script>alert(\"刪除成功\")\nwindow.location.href='../'</script>";
        }
        else{
            echo "<script>alert(\"失敗\")\nwindow.location.href='../'</script>";
        }
    } //刪除文章
}


?>