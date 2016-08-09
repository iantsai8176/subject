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
            if ($Wnum != 0) {
                if ($result_search["overage"] > $Wnum ) {
                    $total = $result_search["overage"] - $Wnum;
                    $sql = "INSERT INTO `Detail` (`Account`,`save`,`withdraw`,`overage`) VALUES ('ian_Tsai',:snum,:wnum,:total)";
                    $WithDraw = $db->prepare($sql);
                    $WithDraw->bindParam(":snum", $Snum, PDO::PARAM_INT,50);
                    $WithDraw->bindParam(":wnum", $Wnum, PDO::PARAM_INT,50);
                    $WithDraw->bindParam(":total", $total, PDO::PARAM_INT,50);
                    $result_WithDraw = $WithDraw->execute();
                    if (!$result_WithDraw) {
                        throw new Exception("提領失敗");
                    }

                } else {
                    throw new Exception("餘額不足");
                }

            }

            if ($Snum != 0) {
                    $total = $result_search["overage"] + $Snum;
                    $sql = "INSERT INTO `Detail` (`Account`,`save`,`withdraw`,`overage`) VALUES ('ian_Tsai',:snum,:wnum,:total)";
                    $SAVE = $db->prepare($sql);
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
            echo "<script>alert('".$e->getMessage()."')\nwindow.location.href='FrontInput.php'</script>";
        }
    }
}
