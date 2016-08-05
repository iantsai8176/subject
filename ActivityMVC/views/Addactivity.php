<html>
    <head>
         <meta charset="utf-8">
    </head>
        <body>
            <div style="margin: auto;width:30%;padding:5px">
        <center><input type="button" style="width:120px;height:40px;font-size:5px;" onclick=location.href="Front/showjoin?id=1" value="前台"></button>
          <input type="button" style="width:120px;height:40px;font-size:5px;" onclick=location.href="Back/Activityinfo" value="活動總表"></center> 
        </div>
            <div style=" width:100% ; ">
                <!--<div style=" width:30% ; border-width:3px ; border-color : black ; margin: auto ; ">-->
                
                <div style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 30% ; margin :auto">
                    <span align="center"><h3>新增活動</h3></span>
                    <form method="post" action="Back/addactivity">
                        
                        <label for="">活動名稱</label>
                        <input type="text" name="actName" size="38%"/>
                        <hr>
                        <label for="">參加人數</label>
                        <input type="text" name="num" size="38%"/>
                        <hr>
                        <label for="">是否攜伴</label>
                        <input type="radio" name="bring" value="Yes"/>是
                        <input type="radio" name="bring" value="No"/>否
                        <hr>
                        <label for="">報名起始</label>
                        <input type="datetime-local" name="startDate"/><br>
                        <label for="">報名結束</label>
                        <input type="datetime-local" name="endDate"/><br>
                        
                        <center style="margin-top:3%"><input type="submit" name="" value="確認"/></center>
        
                    </form>
                </div>
            </div>
           
        </body>
    
</html>