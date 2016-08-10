<?php

require_once("operate.php");

if (isset($_POST["SaveAmount"])) {
     $input = $_POST["SaveAmount"];
     $user = $_POST["user"];
     $ob = new Operate();
     $callOperation = $ob->operation($input);

}

if (isset($_POST["WithdrawAmount"])) {
     $withDraw = $_POST["WithdrawAmount"];
     $input = -$withDraw;
     $user = $_POST["user"];
     $ob = new Operate();
     $callOperation = $ob->operation($input);

}

?>
<html>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <body>
            <div align="center" style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 20% ; margin :auto">
                <h3 align="center">Bank</h3>

               <form id="saveform" method="post" action = "index.php">
                    <label for="">請輸入帳號</label>
                    <input type="text" name="user"/><br>
                    <hr>
                    <input type="button" id="SAVE" value="存款"/>
                    <input type="button" id="WITHDRAW" value="提款"/>
                    <input type="text"  class="SaveAmount" name="SaveAmount" placeholder="預存款金額" style="display:none;margin-top:5px"/>
                    <input type="text" class="WithdrawAmount" name="WithdrawAmount" placeholder="預提款金額" style="display:none;margin-top:5px"/>
                    <input type="submit" class="SaveAmount" value="存款" style="display:none;margin-top:5px"/>
                    <input type="submit" class="WithdrawAmount" value="提款" style="display:none;margin-top:5px"/>
                    <br>
                </form>
                <hr>
                <span id = "msg" >
                <?php
                    if ($input != "") {
                        echo ($callOperation == true) ? "交易成功<br>" : "交易失敗" ;
                    }

                ?>
                </span>
                <input type="button" value="查看明細" onClick="location.href='FrontBank.php'" /><br>

            </div>
            <div style="border-width:3px 6px 7px;width: 40% ; margin :auto;margin-top:5px">
            </div>
            <script>
                $(document).ready(function(){
                    $("#SAVE").click(function(){
                        $(".SaveAmount").show();
                        $(".WithdrawAmount").hide();
                        $("#msg").text("");
                    })
                    $("#WITHDRAW").click(function(){
                        $(".WithdrawAmount").show();
                        $(".SaveAmount").hide();
                        $("#msg").text("");
                    })
                })
            </script>
        </body>
    </head>
</html>