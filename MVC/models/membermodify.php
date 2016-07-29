<?php
class membermodify{
    //---------會員修改---------------------
    function Domodify($mdpsw,$mdemail){
        $PDO = new PDOsql();
        $db = $PDO->getConnection();
        $mdusername = $_SESSION["login"];
        $do_db = $db->prepare("update member set password=:mdpsw,email=:mdemail where username=:mdusername");
        $do_db->bindParam("mdpsw", $mdpsw, PDO::PARAM_INT, 50);
        $do_db->bindParam("mdemail", $mdemail, PDO::PARAM_STR, 50);
        $do_db->bindParam("mdusername", $mdusername, PDO::PARAM_STR, 50);
        if($do_db->execute())
        {
             $_SESSION["EMAIL"] = $mdemail;
            $_SESSION["PSW"] = $mdpsw;
            return "<script>alert(\"修改成功\")\nwindow.location.href='../Home'</script>";
        }
        else
        {
            return "<script>alert(\"修改失敗\")\nwindow.location.href='../Home'</script>";
        }
    } //會員修改
}
?>