<?php
	header("Content-Type: text/html; charset=utf-8");
	require_once("connMysql.php");	
	// 建立CURL連線
	$ch = curl_init();
	// 設定擷取的URL網址
	curl_setopt($ch, CURLOPT_URL, "http://api.1680180.com/CQShiCai/getBaseCQShiCai.do?lotCode=10002&issue=");
	curl_setopt($ch, CURLOPT_HEADER, false);
	//將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	// 執行
	$temp=curl_exec($ch);
	// 關閉CURL連線
	curl_close($ch);
	//轉換JSON格式
	$arr = json_decode($temp,true);
	$str_id = $arr['result']['data'][0]['preDrawIssue'];	//期數
	$str_num = $arr['result']['data'][0]['preDrawCode'];	//號碼字串
	$arr_num = explode(',',$str_num);	//號碼陣列
	$i=1;
	foreach($arr_num as $value){
		${'ball_'.$i} = $value;	//動態變數
		$i++;
	}
	//echo $ball_1.$ball_2.$ball_3.$ball_4.$ball_5;
	
	//兩種檢查字串必需為英數的方法 /^([A-Z0-9])+$/i
	//驗證身分證號碼 /^[A-Z]{1}[0-9]{9}$/
	//只允許數字 /^([0-9]+)$/
	
	if(preg_match("/^20[0-9]{9}$/",$str_id)){	//驗證號碼
		//撈出最近第一筆資料
		$sql = "SELECT `num_id` FROM `ball` ORDER BY `num_id` desc limit 1;";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		echo $str_id;
		if($str_id != $row['num_id']){ 
			echo 'insert';
			$str_insert = "INSERT INTO `ball` (`num_id`, `ball_1`, `ball_2`, `ball_3`, `ball_4`, `ball_5`) VALUES (".$str_id.",".$ball_1.",".$ball_2.",".$ball_3.",".$ball_4.",".$ball_5.");";
			mysql_query($str_insert);
		}else{
			echo 'already exist';
		}
	} else{
		echo 'false';
	}
	
?>