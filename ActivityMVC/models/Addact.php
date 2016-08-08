<?php

class Addact {
    function Addactivity($activityName,$activityNum,$bringPeople,$activityStart,$activityEnd){
        try{
            $PDO = new Opensql();
            $db = $PDO->getConnection();
            $db_add = $db->prepare("INSERT into CreateActivity(ActivityName,LimitNumber,CurrentNumber,BringPeople,StartDate,EndDate) value(:Name,:Num,:Cnum,:People,:Start,:End)");
            $db_add->bindParam("Name",$activityName,PDO::PARAM_STR,50);
            $db_add->bindParam("Num",$activityNum,PDO::PARAM_STR,50);
            $db_add->bindParam("Cnum",$activityNum,PDO::PARAM_STR,50);
            $db_add->bindParam("People",$bringPeople,PDO::PARAM_STR,50);
            $db_add->bindParam("Start",$activityStart,PDO::PARAM_STR,50);
            $db_add->bindParam("End",$activityEnd,PDO::PARAM_STR,50);
            $db_add->execute();
            $row = $db->lastinsertid(); // 取得最後新增資料id
            
            
            return "<script>alert(\"活動新增成功\")\nwindow.location.href='showadd?id=$row'</script>";
            
        }catch(Exception $e){
            return "<script>alert(\"活動新增失敗\")\nwindow.location.href='../Home'</script>.$e->getMessage();";
        }
    }//新增活動
    
    function Addinfo(){
        try{
        $PDO = new Opensql();
        $db = $PDO->getConnection();
        $db_search = $db->prepare("SELECT * from CreateActivity order by no desc");
        $db_search->execute();
        $result = $db_search->fetchAll();
        if(!$result){throw new Exception("error");}
        return $result;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }//新增資訊
}

?>