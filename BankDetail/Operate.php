<?php

require_once("OpenSql.php");

date_default_timezone_set("Asia/Taipei");

class Operate
{
    public function connect()
    {
        $pdo = new OpenSql();
        $getConnect = $pdo->getConnection();

        return $getConnect;
    }

     public function closeConnect()
    {
        $pdo = new OpenSql();
        $closeConnect = $pdo->closConnection();

        return $closeConnect;
    }

    public function operation($amount, $user, $dealAction)
    {
        $db = $this->connect();
        $dateTime = date("Y-m-d H:i:s");
        $resultAmount = 0;
        try {
            $db->beginTransaction();
            $lockRow = $db->prepare("SELECT * FROM `balance` WHERE `account` = :user FOR UPDATE");
            $lockRow->bindParam(":user", $user);
            $lockRow->execute();
            $lockRowResult = $lockRow->fetch();

            if (!$lockRowResult) {
                throw new Exception('查無此帳號');
            }

            //判斷是否為存款或提款
            if ($dealAction == 'WithDrawAmount') {
                if ($lockRowResult['overAge'] >= $amount ) {
                    $updateWithDraw =$db->prepare("UPDATE `balance` SET `overAge`= `overAge` - :withDraw WHERE `account` = :user");
                    $updateWithDraw->bindParam(":withDraw", $amount);
                    $updateWithDraw->bindParam(":user", $user);
                    $updateWithDraw->execute();
                    //新增提款紀錄
                    $total = $lockRowResult['overAge'] - $amount;
                    $sql = "INSERT INTO `detail` (`account`, `time`, `save`, `withdraw`, `overAge`) VALUES (:user, '$dateTime', 0, :withDraw, :total)";
                    $withDrawDetail = $db->prepare($sql);
                    $withDrawDetail->bindParam(":user", $user);
                    $withDrawDetail->bindParam(":withDraw", $amount);
                    $withDrawDetail->bindParam(":total", $total);
                    $withDrawDetailResult = $withDrawDetail->execute();

                    if (!$withDrawDetailResult || $amount == 0) {
                        throw new Exception('提領失敗');
                    }
                }

                if ($lockRowResult['overAge'] < $amount) {
                    throw new Exception('餘額不足');
                }

                $resultAmount = $total;
            }

            if ($dealAction == 'SaveAmount') {
                $updateSave =$db->prepare("UPDATE `balance` SET `overAge`= `overAge` + :save WHERE `account` = :user");
                $updateSave->bindParam(":save", $amount);
                $updateSave->bindParam(":user", $user);
                $result=$updateSave->execute();
                //新增存款紀錄
                $total = $lockRowResult['overAge'] + $amount;
                $sql = "INSERT INTO `detail` (`account`, `time`, `save`, `withdraw`, `overAge`) VALUES (:user, '$dateTime', :save, 0, :total)";
                $saveDetail = $db->prepare($sql);
                $saveDetail->bindParam(":user", $user);
                $saveDetail->bindParam(":save", $amount);
                $saveDetail->bindParam(":total", $total);
                $saveDetailResult = $saveDetail->execute();

                if (!$saveDetailResult || $amount == 0) {
                    throw new Exception('存款失敗');
                }

                $resultAmount = $total;
            }
            $db->commit();
            $closedb = $this->closeConnect();

            return $resultAmount;
        }catch (Exception $e) {
            $db->rollback();
            echo "<script>alert('".$e->getMessage()."')</script>";

            return $resultAmount;
        }
    }
}
