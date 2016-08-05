<hteml>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="../views/js/jquery.js"></script>
        <script type="text/javascript" src="../views/js/jquery.min.js"></script>
    </head>
     
    <body>
       
        <div style=" width:100% ; ">
             <div style="border-width:3px 6px 7px;border-style:solid;border-color:#CFCFCF;padding:5px; width: 30% ; margin :auto">
        
        <form name = "add" align="center" method="post" action="addemployee">
            
            <table border="1" align="center" id = "list">
                <h3>可參加人員</h3
                 <TR><TH>員工編號</TH><TH>員工姓名</TH></TR>
                
            </table>
            <hr>
            <div style = "width:100%;margin: auto">
                
            <label for="">員工編號</label>
            <input type="text" name="Eid" id="Eid"/>
            <span class="error1"></span>
            <br>
            <label for="">員工姓名</label>
            <input type="text" name="Ename" id="Ename"/>
            <span class="error2"></span>
            <br>
            <input type="hidden" id="actid" value=" <?= $_GET['id']?>" >
            <input type="submit" name="" id="btnok" value="提交" onClick="return false"/>
            
            </div>
        </form>
        </div>
        </div>
        <script>
    $(document).ready(function(){
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
                //document.add.submit();
                $.get("addemployee?"+"Eid="+$('#Eid').val()+"&Ename="+$('#Ename').val()+"&actid="+$('#actid').val(),
                    function(data){
                        console.log(data);
                        var result = JSON.parse(data);
                        $("#list").append("<tr><td>"+result['id']+"</td><td>"+result['name']+"</td></tr>");
                        $("#Eid").val("");
                        $("#Ename").val("");
                        
                    })
            }
             
        })
        
       
     
    })
</script>
       
    </body>
</hteml>
