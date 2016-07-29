<?php
class chatMethod{
    function getchatmessage($db,$rq,$user){
if(isset($_GET["rq"])):
    switch ($_GET["rq"]):
        //訊息存入資料庫
        case 'msg':
            $msg = $_GET['newmsg'];
            $date = date("H:i:s");
            $sql = "insert into message(username,msg,time) value ('$user','$msg','$date')";
            $result = $db->query($sql);
            $array["msg"] = $msg;
            $array["username"] = $user;
            break;
        //更新訊息印出
        case 'update':
            $sql = "select * from message order by no desc limit 1";
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
                    $_SESSION["no"] =$row["no"];
                }
                else
                {
                    $array["username"] = $array_temp["username"];
                    $array["msg"] = $array_temp["msg"];
                    $array["status"] = 1;
                    
                }
            break;
    endswitch;
endif;
return json_encode($array);
    }
}
?>