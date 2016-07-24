<?php
session_start();
header("content-type:text/html; charset=utf-8");
class member{
    //---------member verification----------
    public function Dologin($db,$name,$pass){
    //執行SQL指令
    $verify = "select * from member where username='$name' && password='$pass'";
    $result =$db->query($verify);
    //取得筆數
    $num_rows = $result->rowCount();
      if($num_rows > 0 )
        {
            while($row = $result->fetch())
            {
                $_SESSION["login"] = $row["username"];
                $_SESSION["EMAIL"] = $row["email"];
                $_SESSION["PSW"] = $row["password"];
            }
            echo "<div style='position:absolute;left:42%;margin:20% auto'>登陸成功 頁面跳轉中...</div>";
            echo "<script language=\"javascript\">setTimeout(\"window.location.href='../Home'\",1000)</script>";
        }
        else
        {
        echo "<script>alert(\"帳號或密碼有誤\")\nwindow.location.href='../Home'</script>";
        }
    } //會員登入
    
    //---------add member data--------------
    function Doaddmember($db,$name,$psw,$mail){
    //執行資料庫指令
    $search = "select username from member where username='$name'";
    $result =$db->query($search);
    //取得筆數
    $num_rows = $result->rowCount();
    if($num_rows <= 0)
    {
    $addsql = "insert into member(username, password,email) value ('$name','$psw','$mail')";
    $add = $db->query($addsql);
    $_SESSION["login"] = $name;
    $_SESSION["EMAIL"] = $mail;
    $_SESSION["PSW"] = $psw;
     echo "<script>alert(\"註冊成功\")\nwindow.location.href='../Home'</script>";
    }
    else{
        echo "<script>alert(\"帳號重複\")\nwindow.location.href='../Home'</script>";
    }
} // 新增會員
    //---------會員登出---------------------
    function Dologout(){
    	session_destroy();
    	echo "<div style='position:absolute;left:42%;margin:20% auto'>登出成功 頁面跳轉中...</div>";
    	echo "<script language=\"javascript\">setTimeout(\"window.location.href='../Home'\",1000)</script>";
    
        } // 會員登出
    //---------會員修改---------------------
    function Domodify($db,$mdpsw,$mdemail){
        $mdusername = $_SESSION["login"];
        $sql = "update member set password='$mdpsw',email='$mdemail' where username='$mdusername'";
        if($db->query($sql))
        {
            echo "<script>alert(\"修改成功\")\nwindow.location.href='../Home'</script>";
            $_SESSION["EMAIL"] = $mdemail;
            $_SESSION["PSW"] = $mdpsw;
        }
        else
        {
            echo "<script>alert(\"修改失敗\")\nwindow.location.href='../Home'</script>";
        }
    } //會員修改
}
?>