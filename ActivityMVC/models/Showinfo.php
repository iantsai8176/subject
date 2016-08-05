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
        try{
            $db->beginTransaction();
            $sql = "SELECT * FROM CreateActivity WHERE no = :id FOR UPDATE";
            $search = $db->prepare($sql);
            $search->bindParam("id",$actid,PDO::PARAM_STR,50);
            $search->execute();
            $result_search = $search->fetch();
            
            if(!$result_search){throw new Exception("查無此活動");}
        
            $db_check = $db->prepare("SELECT * from Employee WHERE 'Selfid' = :id AND 'CanJoin' = :actid AND 'EmployeeName' = :name");
            $db_check->bindParam("id",$Eid,PDO::PARAM_STR,50);
            $db_check->bindParam("actid",$actid,PDO::PARAM_STR,50);
            $db_check->bindParam("name",$Ename,PDO::PARAM_STR,50);
            $db_check->execute();
            $result_check = $db_check->fetch();
            //$num = $db_check->rowCount();
            if($result_check != ""){
            $total = $Bring++;
            $updatesql = "UPDATE Employee SET Join = 1 ,BringPeople = :num, CurrentNum = :total where Selfid = :id";
            $db_updateEmp = $db->prepare($updatesql);
            $db_updateEmp->bindParam("num",$Bring,PDO::PARAM_STR,50);
            $db_updateEmp->bindParam("total",$total,PDO::PARAM_STR,50);
            $db_updateEmp->bindParam("id",$Eid,PDO::PARAM_STR,50);
            $db_updateEmp->execute();
            }
            else{
                throw new Exception("不符合資格參加活動");
            }
            
            // if($result_check["Selfid"] == "1"){
            //         throw new Exception("禁止重複報名");
            // }
            
            sleep(5);
            if($result_search["CurrentNumber"] >= $Bring++  ){
                $sql = "UPDATE CreateActivity SET CurrentNumber = CurrentNumber - :Bring WHERE no = :id ";
                $updat_act = $db->prepare($sql);
                $updat_act->bindParam("id",$Eid,PDO::PARAM_STR,50);
                $updat_act->bindParam("Bring",$total,PDO::PARAM_STR,50);
                $result = $updat_act->execute();
                
                if(!$result) { throw new Exception('無法更新尚可報名人數'); }
            }else{
                throw new Exception('超過尚可報名人數'); 
            }
            $db->commit();
        }catch(Exception $err){
            $db->rollback();
            return $err->getMessage();
        }
        
        return "報名成功";
    }
}
?>