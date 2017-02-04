<?php 
	header("Content-Type: text/html; charset=utf-8");
	require_once("connMysql.php");	

	$json_str ='{
	"data": [{
		"preDrawDate": "2017-01-26 00:00:00",
		"drawCount": 58,
		"drawIssue": 20170126059,
		"preDrawCode": "0,4,6,2,8",
		"preDrawIssue": 20170126058,
		"preDrawTime": "2017-01-26 15:40:55"
	}]
	}';
	$arr = json_decode($json_str,true);	//assoc為true，預設false
	//echo "<pre>";
	//print_r($arr);
	//echo($arr['data'][0]['preDrawCode']);
	$split_arr = explode(",",$arr['data'][0]['preDrawCode']);	//字串轉陣列
	
    $i=1;
	foreach($split_arr as $value){
		${ "str_".$i } = $value;	//動態變數
		$i++;
	}
	echo $str_1.$str_2.$str_3.$str_4.$str_5;
	//insert `table`(`ball_1`,`ball_2`,`ball_3`,`ball_4`,`ball_5`) values($str_1,$str_2,$str_3,$str_4,$str_5);
?>