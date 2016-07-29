 <?php
 session_start();
//header("content-type:text/html; charset=utf-8");

class articleMethod{
    function Showarticle(){
        $PDO = new PDOsql();
        $db = $PDO->getConnection();
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
    
    function ComitteeHandel($rq){
        if($rq != "")
        {
            if(isset($_SESSION[ "login"]))
            {
                $PDO= new PDOsql();
                $db = $PDO->getConnection();
                $username=$_SESSION["login"];
                $num = $_SESSION["page"];
                $msg=$_GET["rq"];
                $date = date("H:i:s");
                $do_db = $db->prepare("insert into comittee(username,message,time,page) value (:username,:msg,:date,:num)");
                $do_db->bindParam("username", $username, PDO::PARAM_STR, 50);
                $do_db->bindParam("msg", $msg, PDO::PARAM_STR, 50);
                $do_db->bindParam("date", $date, PDO::PARAM_STR, 50);
                $do_db->bindParam("num", $num, PDO::PARAM_INT, 50);
                $do_db->execute();
            
                $array["username"] = $username;
                $array["message"] = $msg;
                $array["time"] =$date;
                
                return json_encode($array);
            }
            else 
            {
                return "0";
            }
        }
    } //留言版評論
    
    function ModifyShowArticle($page){
        $PDO = new PDOsql();
        $db = $PDO->getConnection();
        $do_db = $db->prepare("select * from article where no = :page");
        $do_db->bindParam("page", $page, PDO::PARAM_INT, 50);
        $do_db->execute();
        $_SESSION["page"] = $page;
        while($row = $do_db->fetch()){
            $array = $row;
        }
        return $array;
    } //撈取預修改文章
    
    function ModifyArticle($username,$area,$title,$sort,$address,$content,$page){
        $PDO = new PDOsql();
        $db = $PDO->getConnection();
        $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
        $do_db = $db->prepare("update article set username=:username,area=:area,title=:title,sort=:sort,address=:address,content=:content,time=:datetime where no=:page");
        $do_db->bindParam("username", $username, PDO::PARAM_STR, 50);
        $do_db->bindParam("area", $area, PDO::PARAM_STR, 50);
        $do_db->bindParam("title", $title, PDO::PARAM_STR, 50);
        $do_db->bindParam("sort", $sort, PDO::PARAM_STR, 50);
        $do_db->bindParam("address", $address, PDO::PARAM_STR, 50);
        $do_db->bindParam("content", $content, PDO::PARAM_STR, 50);
        $do_db->bindParam("datetime", $datetime, PDO::PARAM_STR, 50);
        $do_db->bindParam("page", $page, PDO::PARAM_INT, 50);
        if($do_db->execute())
        {
            $row = $db->lastinsertid(); // 取得最後新增資料id
            return "<script>alert(\"修改成功\")\nwindow.location.href='showArticle?rq=$row'</script>";
         }
        else 
        {
            return "<script>alert(\"修改失敗\")\nwindow.location.href='shareArticle'</script>";
        }
    } //修改文章
    
    function DeleteArticle($page){
        $PDO = new PDOsql();
        $db = $PDO->getConnection();
        $del_db = $db->prepare("delete from article where no=:page"); //預刪除文章編號
        $del_db->bindParam("page", $page, PDO::PARAM_INT, 50);
        if($del_db->execute()){
            return "<script>alert(\"刪除成功\")\nwindow.location.href='../'</script>";
        }
        else{
            return "<script>alert(\"失敗\")\nwindow.location.href='../'</script>";
        }
    } //刪除文章
    
    function Sharearticle($username,$area,$title,$sort,$address,$content){
        $PDO = new PDOsql();
        $db = $PDO->getConnection();
        $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
        $do_db = $db->prepare("insert into article(username,area,title,sort,address,content,time) value (:username,:area,:title,:sort,:address,:content,:datetime)");
        $do_db->bindParam("username", $username, PDO::PARAM_STR, 50);
        $do_db->bindParam("area", $area, PDO::PARAM_STR, 50);
        $do_db->bindParam("title", $title, PDO::PARAM_STR, 50);
        $do_db->bindParam("sort", $sort, PDO::PARAM_STR, 50);
        $do_db->bindParam("address", $address, PDO::PARAM_STR, 50);
        $do_db->bindParam("content", $content, PDO::PARAM_STR, 50);
        $do_db->bindParam("datetime", $datetime, PDO::PARAM_STR, 50);
        if($do_db->execute())
        {
            $row = $db->lastinsertid(); // 取得最後新增資料id
            return "<script>alert(\"發布成功\")\nwindow.location.href='showArticle?rq=$row'</script>";
         }
        else 
        {
            return "<script>alert(\"發布失敗\")\nwindow.location.href='shareArticle'</script>";
        }
    }//文章發佈

}


?>