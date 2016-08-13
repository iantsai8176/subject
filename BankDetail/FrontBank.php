<?php

require_once("OpenSql.php");

require_once("ShowDetail.php");
?>
<style>
    .color
    {   border-width:3px 6px 7px;
        border-style:solid;
        border-color:#CFCFCF;
        padding:5px;
        width: 60%;
        height: 90%;
        margin:auto;
        overflow:auto;
    }
</style>
<html>
    <head>
        <meta charset="utf-8">
        <body>
            <div align="center" class="color">
                <span align="center"><h3>明細總表</h3></span>
                <table border = "1px" width="100%">
                    <TR><TH ROWSPAN=2>帳戶</TH><TH COLSPAN=3>明細</TH><TH ROWSPAN=2>餘額</TH></TR>
                    <TR><TH>time</TH><TH>存入</TH><TH>轉出</TH></TR>
                    <?php while($row = $dbSearch->fetch()) { ?>
                    <tr align="center">
                        <td><?php echo $row["Account"] ?></td>
                        <td><?php echo $row["time"] ?></td>
                        <td><?php echo $row["save"] ?></td>
                        <td><?php echo $row["withdraw"] ?></td>
                        <td><?php echo $row["overAge"] ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <input type="button" value="回存提款頁" onClick="location.href='Index.php'" /><br>
            </div>
        </body>
    </head>
</html>