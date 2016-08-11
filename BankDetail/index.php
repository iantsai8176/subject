<?php

require_once("operate.php");

if (($_POST["SaveAmount"]) != "") {
     $SaveAmount = $_POST["SaveAmount"];
     $input = abs($SaveAmount);
     $user = $_POST["user"];
     setcookie("user", $user);
     $dealAction = "SaveAmount";
     $ob = new Operate();
     $callOperation = $ob->operation($input, $user, $dealAction);

}

if (($_POST["WithDrawAmount"]) != "") {
     $withDraw = $_POST["WithDrawAmount"];
     $input = abs($withDraw);
     $user = $_POST["user"];
     setcookie("user", $user);
     $dealAction = "WithDrawAmount";
     $ob = new Operate();
     $callOperation = $ob->operation($input, $user, $dealAction);

}

?>
<html>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <body>
            <div align="center" style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 20% ; margin :auto">
                <h3 align="center">Bank</h3>
                <input type="button" id="deal" value="交易"/>
                <input type="button" id="detail" value="查餘額"/>
                <form id="dealform" method="post" action = "index.php" style="display:none;margin-top:5px">
                    <label for="">請輸入帳號</label>
                    <input type="text" name="user"/><br>
                    <hr>
                    <input type="button" id="SAVE" value="存款"/>
                    <input type="button" id="WITHDRAW" value="提款"/>
                    <input type="text"  class="SaveAmount" name="SaveAmount" placeholder="預存款金額" style="display:none;margin-top:5px"/>
                    <input type="text" class="WithDrawAmount" name="WithDrawAmount" placeholder="預提款金額" style="display:none;margin-top:5px"/>
                    <input type="submit" class="SaveAmount" id="btnok" value="存款確認" style="display:none;margin-top:5px"/>
                    <input type="submit" class="WithDrawAmount" id="btnok" value="提款確認" style="display:none;margin-top:5px"/>
                    <br>
                </form>
                <form id = "detailform" method="post" action="FrontBank.php" style="display:none;margin-top:5px">
                    <label for="">請輸入帳號</label>
                    <input type="text" name="user"/><br>
                    <input type="submit" name="" value="查看明細"/>
                </form>
                <hr>
                <span id = "msg" >
                <?php
                    if ($input != "") {
                        echo ($callOperation == true) ? "交易成功<br>" : "交易失敗<br>" ;
                    }

                ?>
                </span>
            </div>
            <div style="border-width:3px 6px 7px;width: 40% ; margin :auto;margin-top:5px">
            </div>
            <script>
                $(document).ready(function(){
                    $("#deal").click(function() {
                        $("#dealform").show();
                        $("#detailform").hide();
                    })
                    $("#detail").click(function() {
                        $("#detailform").show();
                        $("#dealform").hide();
                        $("#msg").text("");
                    })

                    $("#SAVE").click(function(){
                        $(".SaveAmount").show();
                        $(".WithDrawAmount").hide();
                        $("#msg").text("");
                    })
                    $("#WITHDRAW").click(function(){
                        $(".WithDrawAmount").show();
                        $(".SaveAmount").hide();
                        $("#msg").text("");
                    })
                })
            </script>
        </body>
    </head>
</html>