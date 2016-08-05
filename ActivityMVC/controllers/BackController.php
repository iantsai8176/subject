<?php

class BackController extends Controller {
    
    function index() {
       $this->view("Addactivity");
    }
    
    function addactivity() {
       $activityName = $_POST["actName"];
       $activityNum = $_POST["num"];
       $bringPeople = $_POST["bring"];
       $activityStart = $_POST["startDate"];
       $activityEnd = $_POST["endDate"];
       
       $call_Addact = $this->model("Addact");
       $return_Addact = $call_Addact->Addactivity($activityName,$activityNum,$bringPeople,$activityStart,$activityEnd);
       $this->view("showecho",$return_Addact);
    }
    
    function addemployee(){
        $Eid = $_GET["Eid"];
        $Ename = $_GET["Ename"];
        $actid = $_GET["actid"];
        
        if(isset($_GET["Ename"])){
            $call_Addemp = $this->model("Addemp");
            $return_Addemp = $call_Addemp->Emp($Eid,$Ename,$actid);
            $this->view("showecho",$return_Addemp);
        }
    }
    function showadd(){
        $this->view("Addemployee");
    }
    
    function Activityinfo(){
        $this->view("Activityinfo");
    }
    
}

?>