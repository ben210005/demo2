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
		if($_POST["psword"] == $psword) {	//判斷帳號是否正確
			$_SESSION['loginMember'] = $username;
			$_SESSION['memberLevel'] = $level;
			//若帳號等級為 member 則導向會員中心
			if($_SESSION["memberLevel"]=="member"){
				header("Location: member.php");
			//否則則導向管理中心
			}else{
				header("Location: admin.php");	
			}
		}else {
			header("Location: index.php?errmsg=1");	
		}
	}
}
?>
<html>
<head>
	<link href="css/style.css" rel="stylesheet"/>
	<title>會員登入系統</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<div id="main" >
	<h2>會員登入系統</h2>
	<hr>
	<form id="form" method="post">
		<div id="namediv"><label>username</label>
		<input type="text" name="username" id="username" placeholder="username"/><br></div>
		<div id="psdiv"><label>password</label>
		<input type="text" name="psword" id="psword" placeholder="psword"/></div>
		<input type="submit" id="btn" name="btn" value="登入" >
	</form>
	
	
</div>
</body>
</html>
	
