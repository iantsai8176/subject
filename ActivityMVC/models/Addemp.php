<?php
class Addemp {
    function Emp($id,$name, $actid){
        
        try{
        $PDO = new Opensql();
        $db = $PDO->getConnection();
        $db_insert = $db->prepare("INSERT INTO Employee(EmployeeName,Selfid,CanJoin) VALUES (:name,:id,:actid)");
        $db_insert->bindParam("name",$name,PDO::PARAM_STR,50);
        $db_insert->bindParam("id",$id,PDO::PARAM_INT,50);
        $db_insert->bindParam("actid",$actid,PDO::PARAM_INT,50);
        $db_insert->execute();
        $array["id"] =$id;
        $array["name"] = $name;
        return json_encode($array);
        }
        catch(Exception $e){
            return "<script>alert(\"新增失敗\")\nwindow.location.href='showadd'</script>.$e->getMessage();";
        }
    }
}
?>