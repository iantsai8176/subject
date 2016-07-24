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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

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
                        <a id="modal_trigger" href=<?php echo (!$_SESSION["login"]) ? "#modal":"logout" ?>>
                            <?php echo (!isset($_SESSION["login"]))? "登入/註冊" : $_SESSION["login"]."&nbsp登出" ?>
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
    <!-- Page Content -->
    <div>
            <!-- Member Center -->
            <div style="width:300px;margin:auto;border-color:#CFCFCF;border-style:solid;border-width:3px 6px 9px 12px;padding:5px">
                <div align="center"><h3 style="display:block;font-weight:bold;border-bottom:1px;margin-bottom:20px">會員資料</h3></div>
                <form id="form3" name="form3" method="post" action="modify" style="margin-bottom:0;display:block;border1px" onClick="return false">

                <table align="center">
                    <tr>
                         <td>帳號：<input type="text" name="text" disabled value= "<?php echo $_SESSION["login"];?>"/><hr></td>
                    </tr>
                    
                    <tr>
                        <td>信箱：<input type="email"  id="Modify_email" name="Modify_email" value = "<?php echo $_SESSION["EMAIL"]?>"/>
                        <br><span class="Modify_email_error"></span>
                        <hr></td>
                    </tr>
                     <tr>
                        <td>密碼：<input type="password" id="Modify_psw" name="Modify_psw" value = "<?php echo $_SESSION["PSW"]?>"/>
                       <br><span class="Modify_psw_error"></span>
                        <hr></td>
                    </tr>
                    <tr>
                        <td align = "center"><input type="submit" id= "modify" name="modify" value="儲存修改"/></td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
<!----------Judge form3 data not null----->
            <script type="text/javascript">
            emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                $(document).ready(function() {
            $("#modify").click(function() {
                if ($("#Modify_email").val().search(emailRule) == -1) {
                    $(".Modify_email_error").text("請填入有效Email").css("color","red");
                    eval("document.form3['Modify_email'].focus()");
                }
                else if (($("#Modify_psw").val() == "")) {
                    $(".Modify_psw_error").text("不能為空值").css("color","red");;
                    eval("document.form3['Modify_psw'].focus()");
                }
                else {
                    document.form3.submit();
                }
            })
        })
            </script>
        
    <!-- jQuery -->
    <script src="../views/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../views/js/bootstrap.min.js"></script>

</body>

</html>