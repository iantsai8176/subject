<?php
session_start();
header("content-type:text/html; charset=utf-8");
class member{
    //---------member verification----------
    public function Dologin($name,$pass){
    //執行SQL指令
    $PDO = new PDOsql();
    $db = $PDO->getConnection();
    $do_db = $db->prepare("select * from member where username=:name && password=:pass");
    $do_db->bindParam("name",$name,PDO::PARAM_STR,50);
    $do_db->bindParam("pass",$pass,PDO::PARAM_STR,50);
    $do_db->execute();

    //取得筆數
    $num_rows = $do_db->rowCount();
      if($num_rows > 0 )
        {
            while($row = $do_db->fetch())
            {
                $_SESSION["login"] = $row["username"];
                $_SESSION["EMAIL"] = $row["email"];
                $_SESSION["PSW"] = $row["password"];
            }
            return "<div style='position:absolute;left:42%;margin:20% auto'>登陸成功 頁面跳轉中...</div><script>setTimeout(\"window.location.href='../Home'\",1000)</script>";
        }
        else
        {
        return "<script>alert(\"帳號或密碼有誤\")\nwindow.location.href='../Home'</script>";
        }
        $db->closConnection();
    } //會員登入
    
    //---------add member data--------------
    function Doaddmember($name,$psw,$mail){
        //執行資料庫指令 搜尋是否帳號重複
        $PDO = new PDOsql();
        $db = $PDO->getConnection();
        $do_search_db = $db->prepare("select username from member where username=:name");
        $do_search_db->bindParam("name",$name,PDO::PARAM_STR,50);
        $do_search_db->execute();
        
        //取得筆數
        $num_rows = $do_search_db->rowCount();
        if($num_rows <= 0)
        {
            try
            {
                $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
                $add_db = $db->prepare("insert into member(username, password,email,time) value (:name,:psw,:mail,:time)");
                $add_db->bindParam("name",$name,PDO::PARAM_STR,50);
                $add_db->bindParam("psw",$psw,PDO::PARAM_INT,50);
                $add_db->bindParam("mail",$mail,PDO::PARAM_STR,50);
                $add_db->bindParam("time",$datetime,PDO::PARAM_STR,50);
                $add_db->execute();
            }
            catch(Exception $e)
            {
                return "<script>alert(\"註冊失敗\")\nwindow.location.href='../Home'</script>.$e->getMessage();";
            }
            $_SESSION["login"] = $name;
            $_SESSION["EMAIL"] = $mail;
            $_SESSION["PSW"] = $psw;
            return "<script>alert(\"註冊成功\")\nwindow.location.href='../Home'</script>";
        }
        else
        {
            return "<script>alert(\"帳號重複\")\nwindow.location.href='../Home'</script>";
        }
        $db->closConnection();
    } // 新增會員
    //---------會員登出---------------------
    function Dologout(){
    	session_destroy();
    	return "<div style='position:absolute;left:42%;margin:20% auto'>登出成功 頁面跳轉中...</div><script language=\"javascript\">setTimeout(\"window.location.href='../Home'\",1000)</script>";
    
        } // 會員登出
    
}
?>