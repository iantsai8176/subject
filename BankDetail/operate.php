<?php
header("content-type: text/html; charset=utf-8");
require_once("opensql.php");
if (isset($_POST["SaveAmount"])) {
     $input = $_POST["SaveAmount"];
     $ob = new Operate();
     $call = $ob->operation(0,$input);
     
}

if (isset($_POST["WithdrawAmount"])) {
     $input = $_POST["WithdrawAmount"];
     $ob = new Operate();
     $call = $ob->operation($input,0);
     
}
class Operate  {
    function sql(){
        $PDO = new Opensql();
        $get = $PDO->getConnection();
        return $get;
    }
   
    function operation($Wnum, $Snum){
        $db = $this->sql();
        try{
            $db->beginTransaction();
            $search = $db->prepare("SELECT * from Detail ORDER BY  no DESC limit 1");
            $search->execute();
            $result_search = $search->fetch();
            
            if (!$result_search) {
                throw new Exception("查無此帳號");
            }
            
            sleep(3);
            if ($wnum != 0) {
                if ($result_search["overage"] > $Wnum ) {
                    $total = $result_search["overage"] - $Wnum;
                    $WithDraw = $db->prepare("INSERT INTO `Detail` (`Account`,`save`,`withdraw`,`overage`) VALUES ('ian_Tsai',:snum,:wnum,:total)");
                    $WithDraw->bindParam(":snum",$Snum,PDO::PARAM_INT,50);
                    $WithDraw->bindParam(":wnum",$Wnum,PDO::PARAM_INT,50);
                    $WithDraw->bindParam(":total",$total,PDO::PARAM_INT,50);
                    $result_WithDraw = $WithDraw->execute();
                    
                    if (!$result_insert) {
                        throw new Exception("提領失敗");
                    }
                }
            } elseif ($Snum != 0) {
                    $total = $result_search["overage"] + $Snum;
                    $SAVE = $db->prepare("INSERT INTO `Detail` (`Account`,`save`,`withdraw`,`overage`) VALUES ('ian_Tsai',:snum,:wnum,:total)");
                    $SAVE->bindParam(":snum",$Snum,PDO::PARAM_INT,50);
                    $SAVE->bindParam(":wnum",$Wnum,PDO::PARAM_INT,50);
                    $SAVE->bindParam(":total",$total,PDO::PARAM_INT,50);
                    $result_SAVE = $SAVE->execute();
                    
                    if (!$result_SAVE) {
                        throw new Exception("存款失敗");
                    }
            }
            
            $db->commit();
            echo "<script>alert('操作成功')\nwindow.location.href='FrontInput.php'</script></script>";
        
        }
        catch (Exception $e) {
            $db->rollback();
            echo $e->getMessage();
        }
    }
    
  
}
