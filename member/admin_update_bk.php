<?php
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
session_start();
$query_Member = "select * from `member` where `id` =".$_GET["id"];
$ans_Member = mysql_query($query_Member);
$row = mysql_fetch_assoc($ans_Member);
//var_dump($_GET["id"],$number);
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員系統</title>
<link href="style.css" rel="stylesheet" type="text/css">
<head>
<style>
		span { 
			font-size:12px; 
		}
</style>
<script language="javascript">
function checkForm(){
	if(document.formJoin.m_passwd.value!="" || document.formJoin.m_passwdrecheck.value!=""){
		if(!check_passwd(document.formJoin.m_passwd.value,document.formJoin.m_passwdrecheck.value)){
			document.formJoin.m_passwd.focus();
			return false;
		}
	}	
	if(document.formJoin.m_name.value==""){
		alert("請填寫姓名!");
		document.formJoin.m_name.focus();
		return false;
	}
	if(document.formJoin.m_birthday.value==""){
		alert("請填寫生日!");
		document.formJoin.m_birthday.focus();
		return false;
	}
	if(document.formJoin.m_eemail.value==""){
		alert("請填寫電子郵件!");
		document.formJoin.m_eemail.focus();
		return false;
	}
	/*
	if(!checkemail(document.formJoin.m_eemail)){
		document.formJoin.m_eemail.focus();
		return false;
	}
	*/
	return confirm('確定送出嗎？');
}
function check_passwd(pw1,pw2){
	if(pw1==''){
		alert("密碼不可以空白!");
		return false;
	}
	for(var idx=0;idx<pw1.length;idx++){
		if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
			alert("密碼不可以含有空白或雙引號 !\n");
			return false;
		}
		if(pw1.length<5 || pw1.length>10){
			alert( "密碼長度只能5到10個字母 !\n" );
			return false;
		}
		if(pw1!= pw2){
			alert("密碼二次輸入不一樣,請重新輸入 !\n");
			return false;
		}
	}
	return true;
}
/*
function checkemail(myEemail) {
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(filter.test(myEemail.value)){
		return true;
	}
	alert("電子郵件格式不正確");
	return false;
}
*/
</script>
</head>

<body>
<table width="780" border="0" align="center" cellpadding="4" cellspacing="0">
	<tr>
		<form method="post" action="" name="form1" id="form1" onsubmit="return CheckForm();" >
			<p>Hello <?php echo $row['username']?></p>
			<tr>
				<p>個人基本資料修改</p>
				<p>使用帳號:
				<?php echo $row["username"];?>
				</p>
				<p><strong>使用密碼:</strong>
				<input  type="password" name="psword" id="psword" class="normalinput" >
				</p>
				<p><strong>確認密碼:</strong>
				<input  type="password" name="pswordcheck" id="pswordcheck" class="normalinput" >
				</P>	
				<span clsss="smalltext">若不修改密碼，請不用填寫，若要修改，請輸入密碼兩次，</span><br>
				<span class="smalltext"> 若修改密碼，系統會自動登出，請用新密碼登入。</span>
			</tr>
			<tr>
				<P>姓名:<input type="name" id="name" name="name" value="<?php echo $row["name"]?>" >
				</p>
				<p>性別:<input name="sex" type="radio" value="M" <?php if($row["sex"] == "M") echo "checked";?>>男
						<input name="sex" type="radio" value="F" <?php if($row["sex"] == "F") echo "checked";?>>女
				</p>
				<p>生日:<input type="text" id="birthday" name="birthday" value="<?php echo $row['birthday']?>" >
				</p>
				<p>信箱:<input type="text" id="email" name="email" value="<?php echo $row['email']?>" >
				</p>
				<p>電話:<input type="text" id="phone" name="phone" value="<?php echo $row['phone']?>" >
				</p>
				<p>住址:<input type="text" id="address" name="address" value="<?php echo $row['address']?>" >
				</p>
			</tr>
			<p align="left">
            <input type="hidden" id="id" name="id" value="<?php echo $row["id"];?>">
			<input type="hidden" id="action" name="action" value="update">
            <input type="submit" id="Submit2"name="Submit2" value="送出資料">
            <input type="reset" id="Submit3" name="Submit3" value="重設資料">
            <input type="button" name="go_index" value="回上一頁" onclick="javascript:history.back()">
            </p>
		</form>
	</tr>
</table>

</body>
</html>