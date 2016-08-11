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

    function operation($amount, $user, $dealAction)
    {
        $db = $this->connect();
        $dateTime = date("Y-m-d H:i:s");
        try {
            $db->beginTransaction();
            $lockRow = $db->prepare("SELECT * FROM `balance` WHERE `account` = :user FOR UPDATE");
            $lockRow->bindParam(":user", $user);
            $lockRow->execute();
            $lockRowResult = $lockRow->fetch();

            if (!$lockRowResult) {
                throw new Exception("查無此帳號");
            }

            //判斷是否為存款或提款
            if ($dealAction == "WithDrawAmount") {
                if ($lockRowResult["overAge"] >= $amount ) {
                    $updateWithDraw =$db->prepare("UPDATE `balance` SET `overAge`= overAge - :withDraw WHERE `account` = :user");
                    $updateWithDraw->bindParam(":withDraw", $amount);
                    $updateWithDraw->bindParam(":user", $user);
                    $updateWithDraw->execute();

                    //新增提款紀錄
                    $total = $lockRowResult["overAge"] - $amount;
                    $sql = "INSERT INTO `detail` (`account`, `time`, `save`, `withdraw`, `overAge`) VALUES (:user, '$dateTime', 0, :withDraw, :total)";
                    $withDrawDetail = $db->prepare($sql);
                    $withDrawDetail->bindParam(":user", $user);
                    $withDrawDetail->bindParam(":withDraw", $amount);
                    $withDrawDetail->bindParam(":total", $total);
                    $withDrawDetailResult = $withDrawDetail->execute();

                    if (!$withDrawDetailResult) {
                        throw new Exception("提領失敗");
                    }

                } else {
                    throw new Exception("餘額不足");
                }
            } elseif ($dealAction == "SaveAmount") {
                $updateSave =$db->prepare("UPDATE `balance` SET `overAge`= overAge + :save WHERE account = :user");
                $updateSave->bindParam(":save", $amount);
                $updateSave->bindParam(":user", $user);
                $result=$updateSave->execute();

                //新增存款紀錄
                $total = $lockRowResult["overAge"] + $amount;
                $sql = "INSERT INTO `detail` (`account`, `time`, `save`, `withdraw`, `overAge`) VALUES (:user, '$dateTime', :save, 0, :total)";
                $saveDetail = $db->prepare($sql);
                $saveDetail->bindParam(":user", $user);
                $saveDetail->bindParam(":save", $amount);
                $saveDetail->bindParam(":total", $total);
                $saveDetailResult = $saveDetail->execute();

                if (! $saveDetailResult) {
                    throw new Exception("存款失敗");
                }

            }
            $db->commit();

            return true;
        }catch (Exception $e) {
            $db->rollback();
            echo "<script>alert('".$e->getMessage()."')</script>";

            return false;
        }
    }
}
