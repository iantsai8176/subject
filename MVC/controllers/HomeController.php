<?php
session_start();
class HomeController extends Controller {
    
    //首頁
    function index() {
        //呼叫頁數計算方法
        $call_page = $this->model("caculation");
        $return_page = $call_page->page();
        $this->view("index",$return_page);
    } 
    
    //會員登入
   function login(){
    //   $url=$this->view("index");
            $tempName = $_POST["username"];
            $tempPass = $_POST["password"];
            //呼叫方法
            $call_login = $this->model("member");
            $return_login = $call_login->Dologin($tempName,$tempPass);
            $this->view("echo_json",$return_login);
            //結束連線
   }
   
   //會員登出
    function logout(){
       $call_logout = $this->model("member");
       $return_logout = $call_logout->Dologout();
       $this->view("echo_json",$return_logout);
       $db = null; 
   }
   
   //會員加入
    function add_member(){
        $Newname = $_POST["newname"];
        $Newpsw = $_POST["newpsw"];
        $Newemail = $_POST["newemail"];
        //呼叫方法
        $call_addmember = $this->model("member");
        $return_addmember = $call_addmember->Doaddmember($Newname,$Newpsw,$Newemail);
        $this->view("echo_json",$return_addmember);
        $db = null; 
        
   }
   
   //會員資料修改
   function modify(){//會員修改
        $this->view("modify");
        if($_POST["Modify_email"])
        {
            $EMAIL=$_POST["Modify_email"];
            $PSW=$_POST["Modify_psw"];
            //呼叫方法
            $call_modify = $this->model("membermodify");
            $return_modify = $call_modify->Domodify($PSW,$EMAIL);
            $this->view("echo_json",$return_modify);
        }
        $db = null; 
   }
   
    //文章發佈
   function shareArticle(){
        $this->view("shareArticle"); //導引至view
        //接收資料
        $username = $_SESSION["login"];
        $area = $_POST["area"];
        $title = $_POST["title"];
        $sort = $_POST["sort"];
        $address = $_POST["address"];
        $content = $_POST["note"];
        $_SESSION["title"] = $title;
        if(isset($_POST["note"]))
        {
            //呼叫方法
            $call_article = $this->model("articleMethod");
            $return_article = $call_article->Sharearticle($username,$area,$title,$sort,$address,$content);
            $this->view("echo_json",$return_article);
        }
   }
   
   //預修改之文章顯示
   function modifyShowArticle(){
       $page = $_GET["page"];
       //呼叫方法->從資料庫撈取欲修改文章
       $call_article = $this->model("articleMethod");
       $return_article = $call_article->ModifyShowArticle($page);
       $this->view("shareArticle",$return_article);
       //呼叫修改方法
   } 
   
   //文章修改
   function modifyArticle(){
        $username = $_SESSION["login"];
        $area = $_POST["area"];
        $title = $_POST["title"];
        $sort = $_POST["sort"];
        $address = $_POST["address"];
        $content = $_POST["note"];
        $_SESSION["title"] = $title;
        $page = $_SESSION["page"];
        if(isset($_POST["note"]))
        {
            //呼叫方法
            $call_article = $this->model("articleMethod");
            $return_article = $call_article->ModifyArticle($username,$area,$title,$sort,$address,$content,$page);
            $this->view("echo_json",$return_article);
        }
   } 
   
   //文章刪除
   function deleteArticle(){
       $page = $_GET["page"];
        //呼叫方法
        $call_article = $this->model("articleMethod");
        $return_article = $call_article->DeleteArticle($page);
        $this->view("echo_json",$return_article);
   } 
   
   //文章內容瀏覽
   function showArticle(){
        //呼叫方法
        $call_article = $this->model("articleMethod");
        $return_article = $call_article->Showarticle();
        $this->view("article",$return_article);
   } 
   
   //文章評論
   function comittee(){
        $rq=$_GET["rq"];
        //呼叫方法
        $call_comittee = $this->model("articleMethod");
        $return_comittee = $call_comittee->ComitteeHandel($rq);
        $this->view("echo_json",$return_comittee);
   } 
   
   //即時匯率
   function exchange(){
       $x = $_GET["num"];
       $y = $_GET["ex"];
       $call_exchange = $this->model("exchangeMethod");
       $return_exchange = $call_exchange->catchexchange($x,$y);
       $this->view("echo_json",$return_exchange);
   } 
   
   //即時聊天//
   function chat(){
        $get_rq = $_GET["rq"];
        $user = $_SESSION["login"];
        //呼叫方法
        $call_chatMethod = $this->model("chatMethod");
        $return_chatMethod = $call_chatMethod->getchatmessage($rq,$user);
        
        $this->view("echo_json",$return_chatMethod);
   }
    
}

?>
