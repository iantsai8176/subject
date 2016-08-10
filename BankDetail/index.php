<?php

require_once("operate.php");

if (($_POST["SaveAmount"]) != "") {
     $input = $_POST["SaveAmount"];
     $user = $_POST["user"];
     $dealAction = "SaveAmount";
     $ob = new Operate();
     $callOperation = $ob->operation($input, $user, $dealAction);

}

if (($_POST["WithDrawAmount"]) != "") {
     $withDraw = $_POST["WithDrawAmount"];
     $input = $withDraw;
     $user = $_POST["user"];
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
                <form method="post" action = "index.php">
                    <label for="">請輸入帳號</label>
                    <input type="text" name="user"/><br>
                    <hr>
                    <input type="button" id="SAVE" value="存款"/>
                    <input type="button" id="WITHDRAW" value="提款"/>
                    <input type="text"  class="SaveAmount" name="SaveAmount" placeholder="預存款金額" style="display:none;margin-top:5px"/>
                    <input type="text" class="WithDrawAmount" name="WithDrawAmount" placeholder="預提款金額" style="display:none;margin-top:5px"/>
                    <input type="submit" class="SaveAmount" id="btnok" value="存款" style="display:none;margin-top:5px"/>
                    <input type="submit" class="WithDrawAmount" id="btnok" value="提款" style="display:none;margin-top:5px"/>
                    <br>
                </form>
                <hr>
                <span id = "msg" >
                <?php
                    if ($input != "") {
                        echo ($callOperation == true) ? "交易成功<br>" : "交易失敗<br>" ;
                    }

                ?>
                </span>
                <input type="button" value="查看明細" id="detail" onClick="location.href='FrontBank.php?user='"/><br>
            </div>
            <div style="border-width:3px 6px 7px;width: 40% ; margin :auto;margin-top:5px">
            </div>
            <script>
                $(document).ready(function(){
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