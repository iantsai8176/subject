<?php

require_once("openSql.php");

date_default_timezone_set("Asia/Taipei");

class Operate
{
    function connect()
    {
        $pdo = new Opensql();
        $getConnect = $pdo->getConnection();

        return $getConnect;
    }

    function operation($withDraw, $save)
    {
        $db = $this->connect();
        $dateTime = date("Y-m-d H:i:s");
        try {
            $db->beginTransaction();
            $lockRow = $db->prepare("SELECT * FROM `Balance` WHERE no = 1 FOR UPDATE");
            $lockRow->execute();
            $lockRowResult = $lockRow->fetch();

            if (!$lockRowResult) {
                throw new Exception("查無此帳號");
            }

            //判斷是存款或提款
            if($withDraw != 0){
                if ($lockRowResult["overage"] >= $withDraw ) {
                    $updateWithDraw =$db->prepare("UPDATE ` Balance` SET `overAge`= overAge - :withDraw WHERE no = 1");
                    $updateWithDraw->bindParam(":withDraw", $withDraw);
                    $updateWithDraw->execute();

                    $total = $lockRowResult["overage"] + $save;
                    $sql = "INSERT INTO `detail` (`account`,`time`,`save`,`withdraw`,`overAge`) VALUES ('ian_Tsai','$datetime',:snum,:wnum,:total)";
                    $saveDetail = $db->prepare($sql);
                    $saveDetail->bindParam(":snum",$save);
                    $saveDetail->bindParam(":wnum",$withDraw);
                    $saveDetail->bindParam(":total",$total);

                } else {
                    throw new Exception("餘額不足");
                }
            } elseif ($save != 0) {
                $updateSave =$db->prepare("UPDATE `Balance` SET `overAge`= overAge + :save WHERE no = 1");
                $updateSave->bindParam(":save", $save);
                $updateSave->execute();
            }

            $db->commit();
            //將資料存入資料庫
            if ($save != 0) {



                $resultSaveDetail = $saveDetail->execute();
                if (! $resultSaveDetail) {
                    throw new Exception("存款失敗");
                }
            }

            if ($withDraw != 0) {
                $total = $lockRowResult["overage"] - $withDraw;
                $sql = "INSERT INTO `detail` (`Account`,`time`,`save`,`withdraw`,`overAge`) VALUES ('ian_Tsai','$datetime',:snum,:wnum,:total)";
                $withDrawDetail = $db->prepare($sql);
                $withDrawDetail->bindParam(":snum", $save);
                $withDrawDetail->bindParam(":wnum", $withDraw);
                $withDrawDetail->bindParam(":total", $total);
                $withDrawDetailResult = $withDrawDetail->execute();
                if (! $withDrawDetailResult) {
                    throw new Exception("提領失敗");
                }

            }

           return true;
        }catch (Exception $e) {
            $db->rollback();

            return $e->getMessage();
        }
    }
}
