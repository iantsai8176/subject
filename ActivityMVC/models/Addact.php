<?php

class Addact {
    function Addactivity($activityName,$activityNum,$bringPeople,$activityStart,$activityEnd){
        try{
            $PDO = new Opensql();
            $db = $PDO->getConnection();
            $db_add = $db->prepare("insert into CreateActivity(ActivityName,LimitNumber,BringPeople,StartDate,EndDate) value(:Name,:Num,:People,:Start,:End)");
            $db_add->bindParam("Name",$activityName,PDO::PARAM_STR,50);
            $db_add->bindParam("Num",$activityNum,PDO::PARAM_STR,50);
            $db_add->bindParam("People",$bringPeople,PDO::PARAM_STR,50);
            $db_add->bindParam("Start",$activityStart,PDO::PARAM_STR,50);
            $db_add->bindParam("End",$activityEnd,PDO::PARAM_STR,50);
            $db_add->execute();
            $row = $db->lastinsertid(); // 取得最後新增資料id
            
            
            return "<script>alert(\"活動新增成功\")\nwindow.location.href='showadd?id=$row'</script>";
            
        }catch(Exception $e){
            return "<script>alert(\"活動新增失敗\")\nwindow.location.href='../Home'</script>.$e->getMessage();";
        }
    }
}

?>