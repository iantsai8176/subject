<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>
    <!--login CSS,js-->
    <script type="text/javascript" src="views/js/loginjs/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="views/js/loginjs/jquery.leanModal.min.js"></script>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="views/css/style.css" />

    <!-- Bootstrap Core CSS -->
    <link href="views/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="views/css/blog-home.css" rel="stylesheet">

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
                <a class="navbar-brand" href="Home">GO Travel</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a id="modal_trigger" href=<?php echo (!$_SESSION[ "login"]) ? "#modal": "Home/logout" ?>>
                            <?php echo (!isset($_SESSION["login"]))? "登入/註冊" : $_SESSION["login"]."&nbsp登出" ?>
                        </a>
                        
                    </li>
                    <li>
                        <a href=<?php echo (!$_SESSION[ "login"]) ? "": "Home/modify" ?>>
                             <?php echo (!isset($_SESSION["login"]))? "" : "會員中心" ?>
                         </a>
                    </li>
                    <li>
                        <a href=<?php echo (!$_SESSION[ "login"]) ? "#": "Home/shareArticle" ?>>
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
                    <form id="form1" name="form1" method="post" action="Home/login" onClick="return false">
                        <label>帳號</label>
                        <input type="text" id="username" name="username" />
                        <span class="username_error">*</span>
                        <br />

                        <label>密碼</label>
                        <input type="password" id="password" name="password" />
                        <span class="password_error">*</span>
                        <br />

                        

                        <div class="action_btns">
                            <div class="submit_on"><input type="submit" id="OK" name="OK" class="btn btn_red" value="登入" style="width:140px"><i class="fa fa-angle-double-left"></i></div>
                            <div class="one_half last"><a href="#" id="register_form" class="btn ">註冊</a></div>
                        </div>
                    </form>
                    <!--<a href="#" class="forgot_password">Forgot password?</a>-->
                </div>
                <!-- Register Form -->
                <div class="user_register">
                    <form id="form2" name="form2" method="post" action="Home/add_member" onClick="return false">
                        <label>帳號</label>
                        <input type="text" id="newname" name="newname" />
                        <span class="newname_error">*</span>
                        <br />

                        <label>信箱</label>
                        <input type="email" id="newemail" name="newemail" />
                        <span class="newemail_error">*</span>
                        <br />

                        <label>密碼</label>
                        <input type="password" id="newpsw" name="newpsw" />
                        <span class="newpsw_error">*</span>
                        <br />

                        <div class="action_btns">
                            <div class="submit_on"><input type="submit" id="confirm" name="confirm" class="btn btn_red" value="確認" style="width:140px"><i class="fa fa-angle-double-left"></i></div>
                            <div class="one_half last"><a href="#" class="btn back_btn">返回</a></div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div> 
    <!--//---------controll popup form-->
    <script src="views/methodjs/popup_form.js"></script>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header" align="center">
                    日本は
                    <img src="views/img/go.jpg" width="300">
                    來ます
                </h1>
                
                <!-- First Blog Post -->
                <?php 
                while ($row = $data["db_page"]->fetch()) : 
                preg_match('/<img[^>]+>/i', $row["content"], $match); //取得文章第一個圖片
                $text=str_replace(array("\r","\n","\t","\s"), '', $row["content"]);
                preg_match('/<p>[^<](.*?)<\/p>/i', $text, $match2); ///文章第一段文字
                $text2 = trim($match2[0]);
                $result_text = substr($text2,0);
                ?>
                <h2>
                    <span><?php echo $row["title"]?></span>
                    <!--//判斷當前使用者是否可修該刪除文章-->
                    <?php if($row["username"] == $_SESSION["login"]){?> 
                    <a href ="Home/ModifyShowArticle?page=<?php echo $row["no"]?>" align="right" ><img name = "m1"src="views/img/modify.png" width="3%" align="right"></a>
                    <a href ="Home/deleteArticle?page=<?php echo $row["no"]?>" align="right" ><img name = "d1" src="views/img/delete.jpg" width="3%" align="right"></a>
                   <?php }?>
                </h2>
                <p class="lead">
                    by <span><?php echo $row["username"]?></span>
                </p>
                <p><span class="glyphicon glyphicon-time"></span>
                    <?php echo "&nbsp ".$row["time"]?>
                </p>
                <hr>
                <div overflow="hidden">
                    
                    <?php print_r($match[0])."&nbspheight='300'"."width='600'" ?> </div> 
                <hr>
                <div><span><?php echo $result_text."...";?></span></div>
                <div><a class="btn btn-primary" href="Home/showArticle?PAGE=<?php echo $row["no"];?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a></div>
                
                <hr>
                <?php endwhile ?>
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <!--若頁數大於一 則顯示上一頁-->
                        <?php if($data["page"] > 1){ ?>
                        <a id="Older" href="<?php echo "Home";?>?page=<?php echo $data["page"]-1;?>">&larr; Older</a>
                        <?php } ?>
                    </li>
                    <li>
                        <!--------顯示頁碼----------->
                        <!---顯示當前頁之前後頁數--->
                        <?php 
                                for($i=1;$i<=$data["pages"];$i++){
                                    if($data["page"] == $i)
                                        echo "<span style='background:#FFA488'>$i&nbsp</span> ";
                                    else if ( $data["page"]-3 < $i && $i < $data["page"]+3 ) { 
                                        echo " <a href=Home?page=".$i.">$i</a> ";
                                    }
                                }
                        ?>
                    </li>
                    <li class="next">
                        <!--若頁數當前頁數小魚總頁數則顯示下一頁-->
                        <?php if($data["page"] < $data["pages"]){ ?>
                        <a id="Newer" href="<?php echo "Home";?>?page=<?php echo $data["page"]+1;?>"> Newer &rarr;</a>
                        <?php }?>
                    </li>
                </ul>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!--聊天室-->
                <div class="well">
                    
                    <script src="views/methodjs/chat.js"></script>
                    
                    <style type="text/css">
                        #ResponseDiv {
                            width: 300px;
                            height: 180px;
                            overflow: auto;
                            border: 2px solid gray;
                            margin-bottom: 15px;
                        }
                    </style>
                    <h4>留言板</h4>
                    <div id="ResponseDiv">
                        <?php
                    		$sql = "select * from (select * from message order by no desc limit 10) as data order by no asc";
                    		$result = $data["db"]->query($sql);
                    		while($row =$result->fetch()){
                    		    echo "<div>[".$row["time"].']'.$row['username'].":".$row['msg']."</div>";
                    		    echo "<script>$('#ResponseDiv').scrollTop($('#ResponseDiv').height());</script>";
                    		}
                    		
                    	?>
                    </div>
                    <div>
                        <input type="textarea" id="msg" placeholder="..." size="31px" />
                        <input type="button" id="btnok" value="送出" onclick="MakeRequest()" />
                    </div>
                </div>
                
                <!--每五分鐘向網頁抓取資料-->
                <script src="views/methodjs/exchange.js"></script>
                
                <div class="well">
                    <h4>最新匯率<h4>
                        <div>
                            <table border="1px" width="300px">
                                <tr style="font-family">
                                    <th rowspan=2><img src="http://www.findrate.tw/img/JPY.png">日幣</th><th>推薦銀行</th><th>現金賣出</th>
                                </tr>
                                <tr>
                                    <td id="bank"></td><td id="new"></td>
                                </tr>
                            </table>
                            <div style="margin-top:10px;margin-bottom:10px">台幣兌換日幣<span id="answer"></span></div>
                            <input type="text" name="num" id = "num" size="15px" maxlength="6" placeholder="請輸入台幣..."/>
                            <input type="submit" name="cal" id="cal" value="計算" />
                            <input type="reset" name="clear" id="clear" value="清除"/>
                        </div>
                </div>
                <!-- Side Widget Well -->
                <div class="well">
                    <h4> Widget Well</h4>
                    <p>凡走過必留下痕跡，喜愛旅遊的您，快點來此留下旅遊足跡，分享旅遊點滴，一同享受旅行的喜悅～</p>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2016</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="views/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="views/js/bootstrap.min.js"></script>
</body>

</html>
