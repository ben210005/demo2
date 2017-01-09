<?php
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");	
session_start();

if(isset($_SESSION['loginMember'])||$_SESSION['loginMember']='') {
	if(isset($_POST["username"]) && isset($_POST["psword"])){
		//取出資料表admin資料
		$query_Login = "SELECT * FROM `member` WHERE `username`='".$_POST["username"]."'";
		$query_LoginUpdate = "UPDATE `member` SET  `logintime`=NOW() WHERE `username`='".$_POST["username"]."'";	
		$LoginUpdate = mysql_query($query_LoginUpdate);
		$result = mysql_query($query_Login);	
		//取出帳號密碼的值
		$row_result=mysql_fetch_assoc($result);
		$username = $row_result["username"];
		$psword = $row_result["psword"];
		$level = $row_result["level"];
		//比對取出的帳號有無符合
		if(($_POST["username"] == $username) && $_POST["psword"] == $psword) {	//判斷帳號是否正確
			$_SESSION['loginMember'] = $username;
			$_SESSION['memberLevel'] = $level;
			//判斷登入等級
			if($_SESSION['memberLevel'] == "admin") {
				header("Location: admin.php");
			}else {
				header("Location: member.php");
			}
		}else {
			header("Location: index.php?errMsg=1");
		}
	}
}
?>
<html>
<head>
	<title>會員登入系統</title>
</head>
<body>
<table>
	<td width="200">
	<form name="form1" method="post" action="">
		<p>帳號:
		<input type="text" id='username' name='username'/></p>
		<p>密碼:
		<input type="password" id='psword'name='psword'/>
		<p >
		<input type="submit" name="button" id="button" value="登入"></p>
	</form>
	</td>
</table>
</body>
</html>
	
