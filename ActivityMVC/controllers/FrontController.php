<?php

class FrontController extends Controller {
    
   
    function showjoin(){
        $call_Showinfo = $this->model("Showinfo");
        $return_Showinfo = $call_Showinfo->showactivityData();
        $this->view("showjoin",$return_Showinfo);
    }
    
    function particpate(){
        $Eid = $_POST["Eid"];
        $Ename = $_POST["Ename"];
        $Bring = $_POST["num"];
        $actid = $_POST["actid"];
        $call_Join = $this->model("Showinfo");
        $return_Join = $call_Join->Join($Eid,$Ename,$Bring,$actid);
        $this->view("showecho",$return_Join);
    }
}
?>
