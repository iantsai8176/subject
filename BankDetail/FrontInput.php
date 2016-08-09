<?php

require_once("operate.php");

if (isset($_POST["SaveAmount"])) {
     $input = $_POST["SaveAmount"];
     $ob = new Operate();
     $callOperation = $ob->operation(0, $input);
     echo $callOperation;

}

if (isset($_POST["WithdrawAmount"])) {
     $input = $_POST["WithdrawAmount"];
     $ob = new Operate();
     $callOperation = $ob->operation($input, 0);
     echo $callOperation;
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <body>
            <div  style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 20% ; margin :auto">
                <h3 align="center">Bank</h3>
                <input type="button" id="SAVE" value="存款"/>
                <input type="button" id="WITHDRAW" value="提款"/>
                <form id="saveform" method="post" action = "FrontInput.php" style="display:none;margin-top:5px">
                    <input type="text" name="SaveAmount" placeholder="預存款金額"/>
                    <input type="submit" name="" value="存款"/>
                    <br>
                </form>
                <form id="withdrawform" method="post" action = "FrontInput.php" style="display:none;margin-top:5px">
                    <input type="text" name="WithdrawAmount" placeholder="預提款金額"/>
                    <input type="submit" name="" value="提款"/>
                    <br>
                </form>
                <hr>
                <input type="button" aling="center" value="查看明細" onClick="location.href='FrontBank.php'" />
            </div>
            <div style="border-width:3px 6px 7px;width: 40% ; margin :auto;margin-top:5px">
            </div>
            <script>
                $(document).ready(function(){
                    $("#SAVE").click(function(){
                        $("#saveform").show();
                        $("#withdrawform").hide();
                    })
                    $("#WITHDRAW").click(function(){
                        $("#withdrawform").show();
                        $("#saveform").hide();
                    })
                })
            </script>
        </body>
    </head>
</html>