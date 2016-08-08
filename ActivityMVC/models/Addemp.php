<?php
class Addemp {
    function Emp($id,$name, $actid){
<<<<<<< HEAD
        $url = "https://plc-kmygrock666.c9users.io/ActivityMVC/Front/showjoin?id=$actid";
        try{
        $PDO = new Opensql();
        $db = $PDO->getConnection();
        $db_insert = $db->prepare("INSERT INTO Employee(Ename,Selfid,CanJoin) VALUES (:name,:id,:actid)");
=======
        
        try{
        $PDO = new Opensql();
        $db = $PDO->getConnection();
        $db_insert = $db->prepare("INSERT INTO Employee(EmployeeName,Selfid,CanJoin) VALUES (:name,:id,:actid)");
>>>>>>> 42546735d86a6adaa98c0e161e85de3254e5cdf1
        $db_insert->bindParam("name",$name,PDO::PARAM_STR,50);
        $db_insert->bindParam("id",$id,PDO::PARAM_INT,50);
        $db_insert->bindParam("actid",$actid,PDO::PARAM_INT,50);
        $db_insert->execute();
        $array["id"] =$id;
        $array["name"] = $name;
<<<<<<< HEAD
        $array["url"] = $url;
            if(!$db_insert){
                throw new Exception("error");
            }else{
                return json_encode($array);
            }
=======
        return json_encode($array);
>>>>>>> 42546735d86a6adaa98c0e161e85de3254e5cdf1
        }
        catch(Exception $e){
            return "<script>alert(\"新增失敗\")\nwindow.location.href='showadd'</script>.$e->getMessage();";
        }
<<<<<<< HEAD
    }//新增可報名人員
=======
    }
>>>>>>> 42546735d86a6adaa98c0e161e85de3254e5cdf1
}
?>