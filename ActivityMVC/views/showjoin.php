<html>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="../views/js/jquery.js"></script>
    </head>
    <body>
        
        <div style="margin: auto;width:30%;padding:5px">
        <center><input type="button" style="width:120px;height:40px;font-size:5px;" onclick=location.href="showjoin" value="前台"></button>
        <input type="button" style="width:120px;height:40px;font-size:5px;" onclick=location.href="../Back" value="後台"></center> 
        </div>

        
        <div style=" width:100% ">
             <div style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 30% ; margin :auto;margin-bottom:10px">
                    
                     <label for="">活動名稱：<?php echo $data["ActivityName"]?></label><br>
                     <label for="">報名人數：<?php echo $data["LimitNumber"]?></label><br>
                     <label for="">起始日期：<?php echo $data["StartDate"]?></label><br>
                     <label for="">截止日期：<?php echo $data["EndDate"]?></label><br>
                     <label for="">目前報名人數：</label><br>
                     
            </div>
             <div style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 30% ; margin :auto">
                 
                
        
        <form name = "add"  method="post" action="particpate" >
            <h3 align="center">報名資料填寫</h3>
            <div style=" margin :auto;width:60%">
                
            <label for="">編號</label>
            <input type="text" name="Eid" id="Eid"/>
            <span class="error1"></span>
            <br>
            <label for="">姓名</label>
            <input type="text" name="Ename" id="Ename"/>
            <span class="error2"></span>
            <br>
            
            <label class="bringok" style="display:none">攜伴</label>
            <input type="radio" name="bring" value="Yes"  class="bringok" style="display:none"/><span class="bringok" style="display:none">是</span>
            <input type="radio" name="bring" value="No"  class="bringok" style="display:none"/><span class="bringok" style="display:none">否</span>
            <input type="text" name="num" size="1px" class="radio" style="display:none"/>
            <label for="num" class="radio" style="display:none">人</label>
            
            <input type="hidden" name = "actid" id="actid" value=" <?= $_GET['id']?>" >
            <br>
            <input type="submit" name="" id="btnok" value="提交" onClick="return false"/>
            
            </div>
        </form>
        </div>
        </div>
       
        <script>
            $(document).ready(function(){
                $('input[type=radio]').click(function(){
                   if($(this).attr("value") =="Yes"){
                        $(".radio").show();
                    }else if($(this).attr("value") =="No"){
                        $(".radio").hide();
                    }
                })
                var getbring = "<?php echo $data['BringPeople']?>";
                if(getbring == "Yes"){
                    $(".bringok").show();
                }
                
               $("#btnok").click(function(){
                   if($("#Eid").val() == ""){
                    $(".error1").text("未填").css("color","red");
                    eval("document.add['Eid'].focus()");
                }
                else if($("#Ename").val() == ""){
                    $(".error2").text("未填").css("color","red");
                    eval("document.add['Ename'].focus()");
                }
            else{
                document.add.submit();
               }
            })
            })
        </script>
        
    </body>
</html>