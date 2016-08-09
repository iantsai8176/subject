<?php
header("content-type: text/html; charset=utf-8");
require_once("opensql.php");
if(isset($_POST["amount"])){
     $input = $_POST["amount"];
     $ob = new Operate();
     $call = $ob->operation($input);
     
}
class Operate  {
    function sql(){
        $PDO = new Opensql();
        $get = $PDO->getConnection();
        return $get;
    }
   
    function operation($wnum,$snum = int){
        $db = $this->sql();
        try{
            $db->beginTransaction();
            $search = $db->prepare("SELECT * from Detail ORDER BY  no DESC limit 1");
            $search->execute();
            $result_search = $search->fetch();
            //$db_insert = $db->prepare("INSERT into Detail(Account,save,withdraw,overage) value ($Ac,$save,$withdraw,$overage");
            if(!$result_search){throw new Exception("查無此帳號");}
            
            //sleep(3);
            if($result_search["overage"] > $wnum ){
                $total = $result_search["overage"] - $wnum;
                $insert = $db->prepare("INSERT INTO `Detail` (`Account`,`save`,`withdraw`,`overage`) VALUES ('ian_Tsai',:snum,:wnum,:total)");
                $insert->bindParam(":snum",$snum,PDO::PARAM_INT,50);
                $insert->bindParam(":wnum",$wnum,PDO::PARAM_INT,50);
                $insert->bindParam(":total",$total,PDO::PARAM_INT,50);
                
                $result_insert = $insert->execute();
                // var_dump($result_insert);
                // var_dump($total);
                // exit();
                
                if(!$result_insert){throw new Exception("提領失敗");}
            }
            $db->commit();
            echo "success";
        
        }
        catch(Exception $e){
            $db->rollback();
            echo $e->getMessage();
        }
    }
    
  
}

?>