<?php
	header("Content-Type: text/html; charset=utf-8");
	require_once("connMysql.php");
	if(isset($_POST["username"])) {
		$query_FindUser = "SELECT `username` FROM `member` WHERE `username`='".$_POST["username"]."'";
		$finduser = mysql_query($query_FindUser);
		if(mysql_num_rows($finduser) >= 1) {	//重複帳號
			echo $_POST["username"]."此帳號有人使用";
		}else {
			echo $_POST["username"]."此帳號無人使用";
		}
	}
?>