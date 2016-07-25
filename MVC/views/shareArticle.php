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
                        <a id="modal_trigger" href=<?php echo (!$_SESSION["login"]) ? "#":"logout" ?>>
                            <?php echo (!isset($_SESSION["login"]))? "" : $_SESSION["login"]."&nbsp登出" ?>
                        </a>
                    </li>
                    <li>
                        <a href=<?php echo (!$_SESSION["login"]) ? "#":"modify" ?>>
                            <?php echo (!isset($_SESSION["login"]))? "" :"會員中心" ?>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Page Content -->
    <div class="container">
            <!-- Member Center -->

            <div align="center" style="width:800px;margin:0px auto">
                <!--判別當前是預修改文章的按鈕 或是 發布文章之按鈕-->
                <form id="form4" name="form4" method="post" action=<?php echo (isset($_GET["page"]))?'modifyArticle':"shareArticle"?> onClick="return false">
                    <h1 style=border-bottom:1pxsolid;margin-bottom:20px;align:center>Travel share<?php echo $_GET["page"]; ?></h1>
                    <span text-align-last:center>地區:</span>
                    <select name="area">
                        <option value="東京">東京</option>
                        <option value="大阪">大阪</option>
                        <option value="北海道">北海道</option>
                    </select>
                    
                    <span>分類:</span>
                    <select name="sort">
                    <option value="美食記">美食記</option>
                    <option value="旅遊記">旅遊記</option>
                    </select><br>
                    <!--判別使用者是否預修改文章 如是顯示 如不是空白-->
                    <div style=margin-top:20px>標題：<input type="text" id="title" name ="title" size="50" value ="<?php echo (isset($_GET["page"]))?$data['title']:'';?>" /></div>
                    <div style=margin-top:20px>位址：<input type="text" id="address" name ="address" size="50" value ="<?php echo (isset($_GET["page"]))?$data['address']:'' ?>"/></div>
                    <hr>圖片寬度勿超過640<br>
                    <textarea name="note" id="note" row="20%" ><?php echo (isset($_GET["page"]))?$data['content']:'' ?></textarea>
                    
                    <div align="center" style=margin-top:20px><input type = "submit" name = "article_ok" id="article_ok" value = "送出"></div>
                    
                    <script>
                    CKFinder.setupCKEditor();
                    CKEDITOR.replace( 'note', {});
                    </script>
                </form>
            </div>
       <!------judge textarea not null---------->
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#article_ok").click(function(){
                            if($("#title").val() == ""){
                                alert("標題未填寫");
                            }
                            else if( CKEDITOR.instances.note.getData() == ""){
                                alert("未填入內容");
                            }
                            else{
                                document.form4.submit();
                            }
                        })
                    })
                </script>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../views/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../views/js/bootstrap.min.js"></script>

</body>

</html>
