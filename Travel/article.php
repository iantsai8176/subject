
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
    <script type="text/javascript" src="js/loginjs/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/loginjs/jquery.leanModal.min.js"></script>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
    <!-----CKEDITOR & CKFINDER----->
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckfinder/ckfinder.js"></script>

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
                <a class="navbar-brand" href="index.php">GO Travel</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a id="modal_trigger" href=<?php echo (!$_COOKIE["login"]) ? "#modal":"logout.php?" ?>>
                            <?php echo (!isset($_COOKIE["login"]))? "登入/註冊" : $_COOKIE["login"]."&nbsp登出" ?>
                        </a>
                    </li>
                    <li>
                        <a href=<?php echo (!$_COOKIE["login"]) ? "#":"#" ?>>
                            <?php echo (!isset($_COOKIE["login"]))? "" :"我要分享" ?>
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
				<form id="form1" name="form1" method="post" action="login.php" onClick="return false" >
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

				<a href="#" class="forgot_password">Forgot password?</a>
			</div>

			<!-- Register Form -->
			<div class="user_register">
				<form id="form2" name="form2" method="post" action="login.php" onClick="return false">
					<label>Full Name</label>
					<input type="text" id="newname" name="newname" />
					<span class="newname_error">*</span>
					<br />

					<label>Email Address</label>
					<input type="email" id="newemail" name="newemail" />
					<span class="newemail_error">*</span>
					<br />

					<label>Password</label>
					<input type="password"  id="newpsw" name="newpsw"/>
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
//---------controll popup form
        $("#modal_trigger").leanModal({
            top: 200,
            overlay: 0.6,
            closeButton: ".modal_close"
        });
    
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
                    $(".username_error").text("*必填").css("font-family");
                    eval("document.form1['username'].focus()");
                }
                else if ($("#password").val() == "") {
                    $(".password_error").text("*必填").css("font-family");
                    eval("document.form1['password'].focus()");
                }
                else {
                    document.form1.submit();
                }
            })
        })
//  -------judge form2 data not null---
        emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
        $(document).ready(function() {
            $("#confirm").click(function() {
                if ($("#newname").val() == "") {
                    $(".newname_error").text("*必填");
                    eval("document.form2['newname'].focus()");
                }
                else if (($("#newemail").val().search(emailRule) == -1)) {
                    $(".newemail_error").text("*請填入有效Email");
                    eval("document.form2['newemail'].focus()");
                }
                else if (($("#newpsw").val() == "")) {
                    $(".newpsw_error").text("*必填");
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

        <div class="row">

            <!-- Article area -->
            <?php
                    include("config.php");
                   if(isset($_SESSION["title"]))
                   {
                    $sql = "select * from article order by no desc limit 1";
                    $result = mysql_query($sql, $link);
                   }
                   else
                   {
                       $sql ="select * from article";
                       $page = $_GET["page"];
                       $result = mysql_query($sql.' LIMIT '.$page.', '.'1',$link) or die("Error".$page);
                   }
                    while($catch=mysql_fetch_assoc($result))
                     {
                        $area = $catch["area"];
                        $sort = $catch["sort"];
                        $content = $catch["content"];
                        $title = $catch["title"];
                     }  
                   
            ?>
            <div class="col-md-8" style=overflow:hidden>
                
                <div align="rignt"><?php echo "地區:".$area."<br>".$sort?></div>
                    <div>
                        <?php echo $content ;?>
                    </div>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

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

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
