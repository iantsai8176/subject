<?php

require_once("opensql.php");

$ob = new opensql();
$db = $ob->getConnection();
$dbSearch = $db->prepare("SELECT * from Detail");
$dbSearch->execute();
?>
<html>
    <head>
        <meta charset="utf-8">
        <body>
            <div  style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 40% ; margin :auto">
                <span align="center"><h3>明細總表</h3></span>
                <table border = "1px" width="100%">
                    <TR><TH ROWSPAN=2>帳戶</TH><TH COLSPAN=2>明細</TH><TH ROWSPAN=2>餘額</TH></TR>
                    <TR><TH>轉入</TH><TH>轉出</TH></TR>
                    <?php while($row = $dbSearch->fetch()) { ?>
                    <tr align="center">
                        <td><?php echo $row["Account"] ?></td>
                        <td><?php echo $row["save"] ?></td>
                        <td><?php echo $row["withdraw"] ?></td>
                        <td><?php echo $row["overage"] ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </body>
    </head>
</html>