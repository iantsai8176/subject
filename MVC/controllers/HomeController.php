<?php
session_start();
class HomeController extends Controller {
    
    //首頁
    function index() {
        //資料庫連線
        $db = $this->get_connectsql();
        //呼叫頁數計算方法
        $call_page = $this->model("caculation");
        $return_page = $call_page->page($db);
        $this->view("index",$return_page);
    } 
    
    //取得資料庫連線
    function get_connectsql(){
        $connect = $this->model("opensql");
        $db_get = $connect->sql();
        return $db_get;
    } 
    
    //會員登入
   function login(){
    //   $url=$this->view("index");
            $tempName = $_POST["username"];
            $tempPass = $_POST["password"];
            //資料庫連線
            $db = $this->get_connectsql();
            //呼叫方法
            $call_login = $this->model("member");
            $return_login = $call_login->Dologin($db,$tempName,$tempPass);
            $this->view("echo_json",$return_login);
   }
   
   //會員登出
    function logout(){
       $call_logout = $this->model("member");
       $return_logout = $call_logout->Dologout();
       $this->view("echo_json",$return_logout);
   }
   
   //會員加入
    function add_member(){
        $Newname = $_POST["newname"];
        $Newpsw = $_POST["newpsw"];
        $Newemail = $_POST["newemail"];
        //資料庫連線
        $db = $this->get_connectsql();
        //呼叫方法
        $call_addmember = $this->model("member");
        $return_addmember = $call_addmember->Doaddmember($db,$Newname,$Newpsw,$Newemail);
        $this->view("echo_json",$return_addmember);
        
   }
   
   //會員資料修改
   function modify(){//會員修改
        $this->view("modify");
        if($_POST["Modify_email"]){
        $EMAIL=$_POST["Modify_email"];
        $PSW=$_POST["Modify_psw"];
        //資料庫連線
        $db = $this->get_connectsql();
        //呼叫方法
        $call_modify = $this->model("membermodify");
        $return_modify = $call_modify->Domodify($db,$PSW,$EMAIL);
        $this->view("echo_json",$return_modify);
        }
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
        if(isset($_POST["note"])){
        //資料庫連線
        $db = $this->get_connectsql();
        //呼叫方法
        $call_article = $this->model("membershararticle");
        $return_article = $call_article->Sharearticle($db,$username,$area,$title,$sort,$address,$content);
        }
   }
   
   //預修改之文章顯示
   function modifyShowArticle(){
       $page = $_GET["page"];
       $db = $this->get_connectsql();
       //呼叫方法->從資料庫撈取欲修改文章
       $call_article = $this->model("articleMethod");
       $return_article = $call_article->ModifyShowArticle($db,$page);
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
        if(isset($_POST["note"])){
        //資料庫連線
        $db = $this->get_connectsql();
        //呼叫方法
        $call_article = $this->model("articleMethod");
        $return_article = $call_article->ModifyArticle($db,$username,$area,$title,$sort,$address,$content,$page);
        }
   } 
   
   //文章刪除
   function deleteArticle(){
       $page = $_GET["page"];
       //資料庫連線
        $db = $this->get_connectsql();
        //呼叫方法
        $call_article = $this->model("articleMethod");
        $return_article = $call_article->DeleteArticle($db,$page);
   } 
   
   //文章內容瀏覽
   function showArticle(){
        //資料庫連線
        $db = $this->get_connectsql();
        //呼叫方法
        $call_article = $this->model("articleMethod");
        $return_article = $call_article->Showarticle($db);
        $this->view("article",$return_article);
   } 
   
   //文章評論
   function comittee(){
        $rq=$_GET["rq"];
        //資料庫連線
        $db = $this->get_connectsql();
        //呼叫方法
        $call_comittee = $this->model("articleMethod");
        $return_comittee = $call_comittee->ComitteeHandel($db,$rq);
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
       $db = $this->get_connectsql();
        //呼叫方法
        $call_chatMethod = $this->model("chatMethod");
        $return_chatMethod = $call_chatMethod->getchatmessage($db,$rq,$user);
        echo $return_chatMethod;
        
        $this->view("echo_json",$return_comittee);
   }
    
}

?>
