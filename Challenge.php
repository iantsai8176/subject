<!--找出 10x10 陣列中的相鄰最大區塊-->

<!--相鄰定義：1 的上下左右中有 1 的為相鄰區塊-->

<!--預設陣列定義-->

    <!--$origin = array(-->
    <!--    array(1, 1, 0, 0, 0, 0, 0, 0, 0, 0),-->
    <!--    array(1, 1, 0, 1, 1, 0, 0, 0, 0, 0),-->
    <!--    array(0, 0, 0, 1, 1, 0, 0, 0, 0, 0),-->
    <!--    array(0, 0, 0, 0, 0, 1, 1, 1, 0, 0),-->
    <!--    array(1, 1, 1, 1, 1, 0, 0, 0, 0, 0),-->
    <!--    array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),-->
    <!--    array(1, 1, 1, 0, 1, 0, 1, 1, 1, 1),-->
    <!--    array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),-->
    <!--    array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),-->
    <!--    array(1, 1, 0, 1, 1, 0, 0, 0, 0, 1)-->
    <!--);-->

<!--練習重點：-->

<!-- * 邏輯判斷-->

<!--### 輸出結果-->

<!--	0 0 0 0 0 0 0 0 0 0-->
<!--	0 0 0 0 0 0 0 0 0 0-->
<!--	0 0 0 0 0 0 0 0 0 0-->
<!--	0 0 0 0 0 0 0 0 0 0-->
<!--	0 0 0 0 0 0 0 0 0 0-->
<!--	0 0 0 0 0 0 0 0 0 0-->
<!--	0 0 0 0 0 0 1 1 1 1-->
<!--	0 0 0 0 0 0 1 1 1 1-->
<!--	0 0 0 0 0 0 1 1 1 1-->
<!--	0 0 0 0 0 0 0 0 0 1-->
<?php
class Test{
    public static $position;
    public static $temp;
    
    function produce(){
        $origin = array(
        array(1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
        array(1, 1, 0, 1, 1, 0, 0, 0, 0, 0),
        array(0, 0, 0, 1, 1, 0, 0, 0, 0, 0),
        array(0, 0, 0, 0, 0, 1, 1, 1, 0, 0),
        array(1, 1, 1, 1, 1, 0, 0, 0, 0, 0),
        array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
        array(1, 1, 1, 0, 1, 0, 1, 1, 1, 1),
        array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),
        array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),
        array(1, 1, 0, 1, 1, 0, 0, 0, 0, 1)
        );
        //另存鎮列
        foreach($origin as $value){
            $i+=1;
            $j = 0;
            foreach ($value as $array) {
                   $j+=1;
                self::$position[$i][$j] = $array;
            }
        }
        //印出原始鎮列
        foreach (self::$position as $value) {
            foreach ($value as $constant) {
                echo $constant;
            }
        echo "<br>";
        }
    }
    //依序檢查相鄰之一
    function produceArr(){
        for($i=1;$i<=10;$i++){
            for($j=1;$j<=10;$j++){
                if(self::$position[$i][$j] == 1){
                    $k +=1;
                    ${"R".$k}[] = $i;
                    ${"R".$k}[] = $j;
                    self::$position[$i][$j] = 0; //若找到相鄰之一將該位置數值設為0
                    $temp = [];
                    ${"R".$k} = $this->recursive(self::$position,$i,$j,${"R".$k},$temp); //檢查上下左右鄉林之一
                    $result[] = ${"R".$k} ;
                }
            }
        }
        return $result;
    }
    function recursive($position,$i,$j,$array,$temp){
                //找相鄰右邊
            if($position[$i][$j+1] == 1){
                $y = $j+1;
                $array[] = $i;
                $array[] = $y;
                self::$position[$i][$y] = 0;
                $temp[] = $i;   //將找到相鄰之位址儲存為陣列
                $temp[] = $y;
            }
                //找相鄰左邊
            if($position[$i][$j-1] == 1){
                $y = $j-1;
                $array[] = $i;
                $array[] = $y;
                self::$position[$i][$y] = 0;
                $temp[] = $i;
                $temp[] = $y;
            }
                //找相鄰上邊
            if($position[$i+1][$j] == 1){
                $x = $i+1;
                $array[] = $x;
                $array[] = $j;
                self::$position[$x][$j] = 0;
                $temp[] = $x;
                $temp[] = $j;
            }
                //找相鄰下邊
            if($position[$i-1][$j] == 1){
                $x = $i-1;
                $array[] = $x;
                $array[] = $j;
                self::$position[$x][$j] = 0;
                $temp[] = $x;
                $temp[] = $j;
            }
            //判斷是否有無找到相鄰的值，如有繼續尋找相鄰，沒有回傳結果
            if($temp[0] != "" && $temp[1] != ""){
                    $x = $temp[0];
                    $y = $temp[1];
                    unset($temp[0]);
                    unset($temp[1]);
                    $temp = array_values($temp);
                    return $this->recursive(self::$position,$x,$y,$array,$temp);
            }else {
                return $array;
            }
    }
    
    function result(){
        $got = $this->produceArr();
        $resultposition =  self::$position;
        //檢查區塊最大值
        foreach ($got as $value) {
            if(count($value) > count($temp)){
                $temp = $value;
            }
        }
        echo "<br>";
        //將最大值存入陣列
        for($i=0;$i<count($temp);$i+=2){
             $resultposition[$temp[$i]][$temp[$i+1]] = 1;
        }
        //顯示結果
        foreach ($resultposition as $value) {
            foreach ($value as $constant) {
                echo $constant;
            }
            echo "<br>";
        }
        echo "<br>";
        foreach ($got as $value) {
            foreach ($value as $result) {
            echo "[".$result."]";
            }
            echo "<br>";
        }
    }
}

$obj = new Test();
echo $obj->produce()."<br>";
    
echo $obj->result()."<br>";
    
    
   
    
    
    
  
   
?>