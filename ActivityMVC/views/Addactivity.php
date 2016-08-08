<html>
    <head>
         <meta charset="utf-8">
          <script type="text/javascript" src="views/js/jquery.js"></script>
    </head>
        <body>
            <div style="margin: auto;width:30%;padding:5px">
        <center><input type="button" style="width:120px;height:40px;font-size:5px;" onclick=location.href="Back/Actinfo" value="活動總表"></center> 
        </div>
            <div style=" width:100% ; ">
                
                <div style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 35% ; margin :auto">
                    <span align="center"><h3>新增活動</h3></span>
                    <form name="actadd" method="post" action="Back/addactivity">
                        
                        <label for="">活動名稱</label>
                        <input type="text" name="actName" id="actName" size="38%"/>
                        <span class="error1"></span>
                        <hr>
                        <label for="">參加人數</label>
                        <input type="text" name="num" id="num" size="38%"/>
                        <span class="error2"></span>
                        <hr>
                        <label for="">是否攜伴</label>
                        <input type="radio" name="bring" value="Yes"/>是
                        <input type="radio" name="bring" value="No" checked="true"/>否
                        <hr>
                        <label for="">報名起始</label>
                        <input type="datetime-local" id= "start" name="startDate"/><br>
                        <label for="">報名結束</label>
                        <input type="datetime-local" id = "end" name="endDate"/><br>
                        <span class="error3"></span>
                        
                        <center style="margin-top:3%"><input type="submit" name="" id = "btnok" value="確認" onClick="return false"/></center>
        
                    </form>
                </div>
            </div>

           
        </body>
    
</html>