<hteml>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="../views/js/jquery.js"></script>
        <script type="text/javascript" src="../views/js/jquery.min.js"></script>
    </head>
     
    <body>
       
<<<<<<< HEAD
        <div style=" width:100%">
=======
        <div style=" width:100% ; ">
>>>>>>> 42546735d86a6adaa98c0e161e85de3254e5cdf1
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
<<<<<<< HEAD
        <!--讓超出文字強制斷行-->
        <style>
            #wrap{
                word-wrap: break-word; 
                word-break: normal; 
                }
        </style>
        
        
            <div id="wrap">
                <?php 
                $id = $_GET["id"];
                
                $url = "https://plc-kmygrock666.c9users.io/ActivityMVC/Front/showjoin?id=$id";
                ?>
                <label>報名網址：</label><br>
                <a href="<?php echo $url?>"><?php echo $url?></a>
            </div>
=======
>>>>>>> 42546735d86a6adaa98c0e161e85de3254e5cdf1
        </div>
        </div>
        <script>
    $(document).ready(function(){
        $("#btnok").click(function(){
            
<<<<<<< HEAD
            if($("#Eid").val() == ""){
                $(".error1").text("未填").css("color","red");
                eval("document.add['Eid'].focus()");
            }
            else if($("#Ename").val() == ""){
                $(".error2").text("未填").css("color","red");
                eval("document.add['Ename'].focus()");
            }
            else{
                $.get("addemployee?"+"Eid="+$('#Eid').val()+"&Ename="+$('#Ename').val()+"&actid="+$('#actid').val(),
                    function(data){
                        // console.log(data);
=======
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
>>>>>>> 42546735d86a6adaa98c0e161e85de3254e5cdf1
                        var result = JSON.parse(data);
                        $("#list").append("<tr><td>"+result['id']+"</td><td>"+result['name']+"</td></tr>");
                        $("#Eid").val("");
                        $("#Ename").val("");
<<<<<<< HEAD
                        //  $("#joinurl").val(result["url"]);
=======
                        
>>>>>>> 42546735d86a6adaa98c0e161e85de3254e5cdf1
                    })
            }
             
        })
        
       
     
    })
</script>
       
    </body>
</hteml>
