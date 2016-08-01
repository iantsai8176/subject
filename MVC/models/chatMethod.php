<?php
class chatMethod{
    function getchatmessage($rq){
if(isset($_GET["rq"])):
    $PDO = new PDOsql();
    $db = $PDO->getConnection();
    $user = $_SESSION["login"];
    switch ($_GET["rq"]):
        //訊息存入資料庫
        case 'msg':
            $msg = $_GET['newmsg'];
            $date = date ("H:i:s" , mktime(date('H')+8, date('i'), date('s'))) ; 
            $sql = "INSERT into message(username,msg,time) value ('$user','$msg','$date')";
            $result = $db->query($sql);
            $array["msg"] = $msg;
            $array["username"] = $user;
            $array["time"] = $date;
            break;
        //更新訊息印出
        case 'update':
            $sql = "SELECT * from message order by no desc limit 1";
            $result = $db->query($sql);
            $row = $result->fetch();
                if($_SESSION["no"] == ""){
                    $_SESSION["no"] = $row["no"];
                    $array_temp = $row;
                } 
                if($_SESSION["no"] < $row["no"])
                {
                    $array["username"] = $row["username"];
                    $array["msg"] = $row["msg"];
                    $array["status"] = 0;
                    $array["time"] = $row["time"];
                    $_SESSION["no"] =$row["no"];
                }
                else
                {
                    $array["username"] = $array_temp["username"];
                    $array["msg"] = $array_temp["msg"];
                    $array["time"] = $row["time"];
                    $array["status"] = 1;
                    
                }
            break;
    endswitch;
endif;
return json_encode($array);
    }
}
?>