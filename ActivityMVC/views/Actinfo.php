<html>
    <head>
         <meta charset="utf-8">
          </head>
        <body>
            <div style="margin: auto;width:30%;padding:5px">
        <center><input type="button" style="width:120px;height:40px;font-size:5px;" onclick=location.href="../Back" value="後台"></center> 
        </div>
            <div style=" width:100% ; ">
                <!--<div style=" width:30% ; border-width:3px ; border-color : black ; margin: auto ; ">-->
                
                <div style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 50% ; margin :auto">
                    <span align="center"><h3>活動總表</h3></span>
                        <table border="1">
                            <TR><TH>活動名稱</TH><TH>參加人數</TH><TH>攜伴</TH><TH>剩餘名額</TH><TH>起始時間</TH><TH>結束時間</TH><TH>報名網址</TH></TR>
                            <?php foreach ($data as $value) {   ?>
                         
                            <tr><td  align="center"><?php echo $value["ActivityName"] ?></td>
                                <td  align="center"><?php echo $value["LimitNumber"] ?></td>
                                <td  align="center"><?php echo $value["BringPeople"] ?></td>
                                <td  align="center"><?php echo $value["CurrentNumber"] ?></td>
                                <td  align="center"><?php echo $value["StartDate"] ?></td>
                                <td  align="center"><?php echo $value["EndDate"] ?></td>
                                <td  align="center"><a href="https://plc-kmygrock666.c9users.io/Object/ActivityMVC/Front/showjoin?id=<?php echo $value["no"] ?>">網址</a></td>
                            </tr>
                            
                            <?php } ?>
                        </table>
                        
        
                    
                </div>
            </div>
        </body>
   
</html>