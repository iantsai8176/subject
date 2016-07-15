<?php
session_start();
header("content-type:text/html; charset=utf-8");
//---member verification-----
$url='index.php';
 if(isset($_POST["username"]))
 {
    $tempName = $_POST["username"];
    $tempPass = $_POST["password"];
    $verify = "select * from member where username='$tempName'";
    $result = sql_connect($verify);
    $row = mysql_fetch_assoc($result);
    if($row != null)
    {
        setcookie("login",$_POST["username"]);
        $_SESSION["EMAIL"] = $row["email"];
        $_SESSION["PSW"] = $row["password"];
       echo "<script language=\"javascript\">setTimeout(\"window.location.href='".$url."'\",1000)</script>";
    }
    else
    {
        echo "<script>alert(\"登錄失敗\")\nwindow.location.href='$url'</script>";
    }
 }

//---------add member data---------
if(isset($_POST["newname"]))
{
    $Newname = $_POST["newname"];
    $Newpsw = $_POST["newpsw"];
    $Newemail = $_POST["newemail"];
    $addsql = "insert into member(username, password,email) value ('$Newname','$Newpsw','$Newemail')";
    $result = sql_connect($addsql);
    sql_connect($addsql);
    echo "<script>setTimeout(\"window.location.href='$url'\",1500)</script>";
     setcookie("login",$_POST["username"]);
    $_SESSION["EMAIL"] = $Newemail;
    $_SESSION["PSW"] = $Newpsw;
    
}
function sql_connect($data){
    include("config.php");
    // $link = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
    // $result = mysql_query("set names utf8",$link);
    // mysql_select_db($dbname,$link);
    $result = mysql_query($data, $link);
    return $result;
}
?>