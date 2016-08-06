<?php
class Showinfo{
    
    function showactivityData(){
        $id = $_GET["id"];
        try{
            $PDO = new Opensql();
            $db = $PDO->getConnection();
            $db_catch = $db->prepare("SELECT * from CreateActivity WHERE no = $id");
            $db_catch->execute();
            $row = $db_catch->fetch();
            $array = $row;
            if(!$row){throw new Exception("查無此活動");}
            return $array;
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
    
    function Join($Eid,$Ename,$Bring,$actid){
        $PDO = new Opensql();
        $db = $PDO->getConnection();
        if($Bring == ""){
            $Bring = 0;
        }
        try{
            $db->beginTransaction();
            $sql = "SELECT * FROM CreateActivity WHERE no = :id FOR UPDATE";
            $search = $db->prepare($sql);
            $search->bindParam(":id",$actid,PDO::PARAM_STR,50);
            $search->execute();
            $result_search = $search->fetch();
            
            if(!$result_search){throw new Exception("查無此活動");}
            
            //檢查是否符合資格
            $db_check = $db->prepare("SELECT * from `Employee` where `Selfid` = :id AND `CanJoin` = $actid AND `Ename` = :name");
            $db_check->bindParam(":id",$Eid,PDO::PARAM_INT,50);
            $db_check->bindParam(":name",$Ename,PDO::PARAM_STR,50);
            $db_check->execute();
            $result_check = $db_check->fetch();
            
            if($result_check["Particpate"] == "1"){throw new Exception("禁止重複報名");}
             
            //符合資格 更新資料庫
            if(!empty($result_check)){
                $total = $Bring +1;
                $updatesql = "UPDATE Employee SET `Particpate` = 1 ,`BringPeople` = :num, `CurrentNum` = :total where `Selfid` = :id AND `CanJoin` = $actid;";
                $db_updateEmp = $db->prepare($updatesql);
                $db_updateEmp->bindParam(":num",$Bring,PDO::PARAM_STR,50);
                $db_updateEmp->bindParam(":total",$total,PDO::PARAM_STR,50);
                $db_updateEmp->bindParam(":id",$Eid,PDO::PARAM_STR,50);
                $db_updateEmp->execute();
            }
            else{
                throw new Exception("不符合資格參加活動");
            }
            
             sleep(3);
             //判定欲參加人數<目前可參加人數
            if($result_search["CurrentNumber"] >= $Bring+1  ){
                $sql = "UPDATE CreateActivity SET `CurrentNumber` = CurrentNumber -:Bring  WHERE `no` = $actid ";
                $updat_act = $db->prepare($sql);
                $updat_act->bindParam(":Bring",$total,PDO::PARAM_INT,50);
                $result = $updat_act->execute();
                
                if(!$result) { throw new Exception('無法更新尚可報名人數'); }
                
            }else{
                throw new Exception('超過尚可報名人數'); 
            }
            $db->commit();
            return "<script>alert(\"報名成功\")\nwindow.location.href='showjoin?id=$actid'</script>";
        }catch(Exception $err){
            $db->rollback();
            return  "<script>alert('".$err->getMessage()."')\nwindow.location.href='showjoin?id=$actid'</script>";
        }
        
        
    }
}
?>