<?php
class membermodify{
    //---------會員修改---------------------
    function Domodify($db,$mdpsw,$mdemail){
        $mdusername = $_SESSION["login"];
        $sql = "update member set password='$mdpsw',email='$mdemail' where username='$mdusername'";
        if($db->query($sql))
        {
            return "<script>alert(\"修改成功\")\nwindow.location.href='../Home'</script>";
            $_SESSION["EMAIL"] = $mdemail;
            $_SESSION["PSW"] = $mdpsw;
        }
        else
        {
            return "<script>alert(\"修改失敗\")\nwindow.location.href='../Home'</script>";
        }
    } //會員修改
}
?>