<?php

require_once("myProject/Operate.php");

class OperateTest extends \PHPUnit_Framework_TestCase {
    //提款
    public function testRepeatWithDraw() {
        $paramCount = 1000;
        $paramWhat = "WithDrawAmount";
        $expectedResult = true;
        $user = "tiger";

        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, $paramWhat);

        $this->assertEquals($expectedResult, $result);
    }

    //查無此帳號
    public function testRepeatCheckTryCatch() {
        $paramCount = 1000;
        $paramWhat = "WithDrawAmount";
        $expectedResult = false;
        $user = "tir";

        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, $paramWhat);

        $this->assertEquals($expectedResult, $result);
    }
    //存款
     public function testRepeatSave() {
        $paramCount = 1000;
        $paramWhat = "SaveAmount";
        $expectedResult = true;
        $user = "tiger";

        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, $paramWhat);

        $this->assertEquals($expectedResult, $result);
    }
    //存款失敗
    public function testRepeatSaveTryCatch() {
        $paramCount = "*&*-/1000//";
        $paramWhat = "SaveAmount";
        $expectedResult = false;
        $user = "tiger";

        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, $paramWhat);

        $this->assertEquals($expectedResult, $result);
    }
    //提款失敗
    public function testRepeatWithDrawTryCatch() {
        $paramCount = "*&*-/1000//";
        $paramWhat = "WithDrawAmount";
        $expectedResult = false;
        $user = "tiger";

        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, $paramWhat);

        $this->assertEquals($expectedResult, $result);
    }

    //餘額不足
    public function testRepeatWithDrawOverAgeTryCatch() {
        $paramCount = "100000";
        $paramWhat = "WithDrawAmount";
        $expectedResult = false;
        $user = "ian_Tsai";

        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, $paramWhat);

        $this->assertEquals($expectedResult, $result);
    }
}


?>