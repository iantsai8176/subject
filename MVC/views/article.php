<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>
    <!--login CSS,js-->
    <script type="text/javascript" src="../views/js/loginjs/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="../views/js/loginjs/jquery.leanModal.min.js"></script>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="../views/css/style.css" />

    <!-- Bootstrap Core CSS -->
    <link href="../views/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../views/css/blog-home.css" rel="stylesheet">
    <!-----CKEDITOR & CKFINDER----->
    <script src="../views/ckeditor/ckeditor.js"></script>
    <script src="../views/ckfinder/ckfinder.js"></script>
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body background="views/img/images-2.jpg">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../">GO Travel</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a id="modal_trigger" href=<?php echo (!$_SESSION["login"]) ? "#modal":"logout"?>>
                            <?php echo (!isset($_SESSION["login"]))? "登入/註冊" : $_SESSION["login"]."&nbsp登出" ?>
                        </a>
                    </li>
                    <li>
                        <a href=<?php echo (!$_SESSION["login"]) ? "#":"modify" ?>>
                            <?php echo (!isset($_SESSION["login"]))? "" :"會員中心" ?>
                        </a>
                    </li>
                    <li>
                        <a href=<?php echo (!$_SESSION["login"]) ? "#":"shareArticle" ?>>
                            <?php echo (!isset($_SESSION["login"]))? "" :"我要分享" ?>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!--pop login-->
    <div class="container">

        <div id="modal" class="popupContainer" style="display:none;">
            <header class="popupHeader">
                <span class="header_title">Login</span>
                <span class="modal_close"><i class="fa fa-times"></i></span>
            </header>

            <section class="popupBody">
                <!-- Username & Password Login form -->
                <div class="user_login">
                    <form id="form1" name="form1" method="post" action="login" onClick="return false">
                        <label>Email / Username</label>
                        <input type="text" id="username" name="username" />
                        <span class="username_error">*</span>
                        <br />

                        <label>Password</label>
                        <input type="password" id="password" name="password" />
                        <span class="password_error">*</span>
                        <br />

                        <div class="checkbox">
                            <input id="remember" type="checkbox" />
                            <label for="remember">Remember me on this computer</label>
                        </div>

                        <div class="action_btns">
                            <div class="submit_on"><input type="submit" id="OK" name="OK" class="btn btn_red" value="login" style="width:140px"><i class="fa fa-angle-double-left"></i></div>
                            <div class="one_half last"><a href="#" id="register_form" class="btn ">sign up</a></div>
                        </div>
                    </form>
                    <!--<a href="#" class="forgot_password">Forgot password?</a>-->
                </div>
                <!-- Register Form -->
                <div class="user_register">
                    <form id="form2" name="form2" method="post" action="add_member" onClick="return false">
                        <label>Full Name</label>
                        <input type="text" id="newname" name="newname" />
                        <span class="newname_error">*</span>
                        <br />

                        <label>Email Address</label>
                        <input type="email" id="newemail" name="newemail" />
                        <span class="newemail_error">*</span>
                        <br />

                        <label>Password</label>
                        <input type="password" id="newpsw" name="newpsw" />
                        <span class="newpsw_error">*</span>
                        <br />

                        <div class="action_btns">
                            <div class="submit_on"><input type="submit" id="confirm" name="confirm" class="btn btn_red" value="Regist" style="width:140px"><i class="fa fa-angle-double-left"></i></div>
                            <div class="one_half last"><a href="#" class="btn back_btn">Back</a></div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <script type="text/javascript">
        // ---------controll popup form
        $(function() {
                // Calling Register Form
                $("#register_form").click(function() {
                    $(".user_login").hide();
                    $(".user_register").show();
                    $(".header_title").text('Register');
                    return false;
                });

                //Going back to Social Forms
                $(".back_btn").click(function() {
                    $(".user_login").show();
                    $(".user_register").hide();
                    $(".header_title").text('Login');
                    return false;
                });

            })
            //--------Judge form1 data not null---
        $(document).ready(function() {
                $("#OK").click(function() {
                    if ($("#username").val() == "") {
                        $(".username_error").text("*必填").css("color","red");
                        eval("document.form1['username'].focus()");
                    }
                    else if ($("#password").val() == "") {
                        $(".password_error").text("*必填").css("color","red");
                        eval("document.form1['password'].focus()");
                    }
                    else {
                        document.form1.submit();
                    }
                })
            })
            //-------judge form2 data not null---
        emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;//正規表示法(判斷是否為有效email)
        $(document).ready(function() {
            $("#confirm").click(function() {
                if ($("#newname").val() == "") {
                    $(".newname_error").text("*必填").css("color","red");
                    eval("document.form2['newname'].focus()");
                }
                else if (($("#newemail").val().search(emailRule) == -1)) {
                    $(".newemail_error").text("*請填入有效Email").css("color","red");
                    eval("document.form2['newemail'].focus()");
                }
                else if (($("#newpsw").val() == "")) {
                    $(".newpsw_error").text("*必填").css("color","red");
                    eval("document.form2['newpsw'].focus()");
                }
                else {
                    document.form2.submit();
                }
            })
        })
    </script>
    
    <!-- Page Content -->
    <div class="container">
            <!-- Article area -->
            <div style="overflow:hidden;width:900px;margin:0px auto">
                <div align="center"><h1><?php echo $data["title"];?></h1></div>
                <div align="rignt" style="font-size:20px;font-family;color:#FFAA33"><?php echo "地區:".$data["area"]?><span style=float:right><?php echo $data["sort"];?></span></div>
                    <br>
                    <div align="center"> <?php echo $data["content"] ;?>  </div>
            </div>
     </div>
     <!--commitee article-->
     <hr style="border:1px dotted #036; height:1px;width:700px">
     <div style="position:relative;left:280px;font-size:25px">留言板
         <div id="newmsg">
             <?php 
                $pagee = $_SESSION["page"]; //取得當前文章之筆數
                $search_sql = "select * from comittee where page='$pagee'"; //查詢此文章之留言紀錄
                $comittee_result = $data["db"]->query($search_sql);
                while($row=$comittee_result->fetch()){
                    echo "<div>[".$row["time"]."]-".$row["username"].":".$row["message"]."</div>";
                }
             ?>
         </div>
     </div>
     <hr style="border:1px dotted #036; height:1px;width:700px">
     
     <form name="form_mesg" align="center" method="post" action="comittee_handel.php" onClick="return false">
         <span id=warn></span><br>
         <textarea name="message" id="message" style="font-size:9px;width:400px;height:120px"></textarea><br>
         <input type="submit" id="commitee_ok" value="確認"/>
         <input type="reset" id="commitee_clear"value="清除"/>
     </form>
     
     <!--judge commitee messag-->
     <script>
         $(document).ready(function(){
             $("#commitee_ok").click(function(){
                 if($("#message").val() != ""){
                     $.get("comittee?rq="+$("#message").val(),function(data){
                         if(data != 0){
                              var array = JSON.parse(data);
                             $("#newmsg").append("<div>"+"["+array["time"]+"]-"+array["username"]+":"+array["message"]+"</div>");
                             $("#message").val("");
                         }
                         else
                         {
                             alert("要先登入哦");
                         }
                     })
                 }
                 else
                 {
                     $("#warn").text("請輸入內容").css("color", "blue");
                 }
             })
         })
     </script>
     <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    <!-- jQuery -->
    <script src="../views/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../views/js/bootstrap.min.js"></script>

</body>

</html>
