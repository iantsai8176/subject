<?php
//header("content-type: text/html; charset=utf-8");
// 1. 初始設定
class exchangeMethod{
    function catchexchange($num,$ex){
        if($num != ""){
            $result = $num/$ex;
            echo round($result,6);//取到小樹第六位
        }
        else {
            $ch = curl_init();
            
            // 2. 設定 / 調整參數
            curl_setopt($ch, CURLOPT_URL, "http://www.findrate.tw/currency.php#.V48sGvm7hHw");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
            curl_setopt($ch, CURLOPT_HEADER, 0);
            
            // 3. 執行，取回 response 結果
            $pageContent = curl_exec($ch);
            
            // 4. 關閉與釋放資源
            curl_close($ch);
            
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($pageContent);
            
            $xpath = new DOMXPath($doc);
            $entries = $xpath->query("//*[@id='right']/table/tbody");
            
            foreach ($entries as $entry) 
            {
                for($i=1;$i<5;$i++)
                {
                    $title = $xpath->query("./tr[10]/td[$i]", $entry);
                    $data[$i]=$title->item(0)->nodeValue;
                }
            }
            return json_encode($data);
        }
    }
}
?>
