<?php

class FrontController extends Controller {
    
   
    function showjoin(){
        $call_Showinfo = $this->model("Showinfo");
        $return_Showinfo = $call_Showinfo->showactivityData();
        if(is_array($return_Showinfo)){ //判別是否報名已截止
            $this->view("showjoin",$return_Showinfo);
        }else{
            $this->view("showecho",$return_Showinfo);
        }
    }//顯示報名資訊
    
    function particpate(){
        $Eid = $_POST["Eid"];
        $Ename = $_POST["Ename"];
        $Bring = $_POST["num"];
        $actid = $_POST["actid"];
        $call_Join = $this->model("Showinfo");
        $return_Join = $call_Join->Join($Eid,$Ename,$Bring,$actid);
        $this->view("showecho",$return_Join);
    }//報名
    
    function getcurrentnum(){
        $call_timely = $this->model("Showinfo");
        $return_timely = $call_timely->timely();
        $this->view("showecho",$return_timely);
    }//取得目前人數
}
?>
