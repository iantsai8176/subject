<?php

require_once(dirname(dirname(dirname(__FILE__))) . "/Operate.php");

class OperateTest extends \PHPUnit_Framework_TestCase {
    protected function setUp(){
        $pdo = new OpenSql();
        $db = $pdo->getConnection();
        $testSql =$db->prepare("UPDATE `balance` SET `overAge` = 1000 WHERE `account` = '0000-000-0001'");
        $testSql->execute();
    }

    //存款
     public function testRepeatSave()
     {
        $paramCount = 1000;
        $user = "0000-000-0001";
        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, 'SaveAmount');
        $this->assertEquals(2000, $result);
    }

    //提款
    public function testRepeatWithDraw()
    {
        $paramCount = 1000;
        $user = "0000-000-0001";
        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, 'WithDrawAmount');
        $this->assertEquals(0, $result);
    }

    //查無此帳號
    public function testRepeatCheckError()
    {
        $paramCount = 1000;
        $user = "0000-000-00011";
        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, 'WithDrawAmount');
        $this->assertEquals(0, $result);
    }

    //存款失敗
    public function testRepeatSaveError()
    {
        $paramCount = "*&*-/1000//";
        $user = "0000-000-0001";
        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, 'SaveAmount');
        $this->assertEquals(0, $result);
    }

    //提款失敗
    public function testRepeatWithDraError()
    {
        $paramCount = "*&*-/1000//";
        $user = "0000-000-0001";
        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, 'WithDrawAmount');
        $this->assertEquals(0, $result);
    }

    //餘額不足
    public function testRepeatWithDrawOverAgeError()
    {
        $paramCount = "100000";
        $user = "0000-000-0001";
        $tool = new Operate();
        $result = $tool->operation($paramCount, $user, 'WithDrawAmount');
        $this->assertEquals(0, $result);
    }

    protected function tearDown()
    {
        $pdo = new OpenSql();
        $db = $pdo->getConnection();
        $testSql =$db->prepare("UPDATE `balance` SET `overAge` = 0 WHERE `account` = '0000-000-0001'");
        $testSql->execute();
    }
}
