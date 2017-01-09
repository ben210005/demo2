<?php
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
session_start();
$query_Member = "select * from `member` where `id` =".$_GET["id"];
$ans_Member = mysql_query($query_Member);
$row = mysql_fetch_assoc($ans_Member);
//var_dump($_GET["id"],$number);
//執行更新動作
if(isset($_POST["action"])&&($_POST["action"]=="update")){	
	$query_update = "UPDATE `member` SET ";
	//若有修改密碼，則更新密碼。
	if(($_POST["psword"]!="")&&($_POST["psword"]==$_POST["pswordcheck"])){
		$query_update .= "`psword`='".$_POST["psword"]."',";
	}	
	$query_update .= "`name`='".$_POST["name"]."',";	
	$query_update .= "`sex`='".$_POST["sex"]."',";
	$query_update .= "`birthday`='".$_POST["birthday"]."',";
	$query_update .= "`email`='".$_POST["email"]."',";
	$query_update .= "`address`='".$_POST["address"]."' ";
	$query_update .= "WHERE `id`=".$_POST["id"];	
	mysql_query($query_update);
	//重新導向
	header("Location: admin.php");
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員系統</title>
<link href="css/style.css" rel="stylesheet"/>
<head>
<style>
		span { 
			font-size:12px; 
		}
</style>
<script language="javascript">
function checkForm(){
	if(document.form1.psword.value!="" || document.form1.pswordcheck.value!=""){
		if(!check_passwd(document.form1.psword.value,document.form1.pswordcheck.value)){
			document.form1.psword.focus();
			return false;
		}
	}	
	if(document.form1.name.value==""){
		alert("請填寫姓名!");
		document.form1.name.focus();
		return false;
	}
	if(document.form1.birthday.value==""){
		alert("請填寫生日!");
		document.form1.birthday.focus();
		return false;
	}
	if(document.form1.email.value==""){
		alert("請填寫電子郵件!");
		document.form1.email.focus();
		return false;
	}
	/*
	if(!checkemail(document.form1.email)){
		document.form1.email.focus();
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
    <td class="tdbline"><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><form action="" method="POST" name="form1" id="form1" onSubmit="return checkForm();">
          <div class="dataDiv">
            <hr size="1" />
            <p class="heading">帳號資料</p>
            <p><strong>使用帳號</strong>
              ：<?php echo $row["username"];?></p>
            <p><strong>使用密碼</strong> ：
              <input name="psword" type="password" class="normalinput" id="psword">
              <br>
            </p>
            <p><strong>確認密碼</strong> ：
              <input name="pswordcheck" type="password" class="normalinput" id="pswordcheck">
              <br>
              <span class="smalltext">(若不修改密碼，請不要填寫。)</span></p>
            <hr size="1" />
            <p class="heading">個人資料</p>
            <p><strong>真實姓名</strong>：
                <input name="name" type="text" class="normalinput" id="name" value="<?php echo $row["name"];?>">
                <font color="#FF0000">*</font> </p>
            <p><strong>性　　別</strong>：
				<input name="sex" type="radio" value="M" <?php if($row["sex"]=="M") echo "checked";?>>男
				<input name="sex" type="radio" value="F" <?php if($row["sex"]=="F") echo "checked";?>>女
				<font color="#FF0000">*</font></p>
            <p><strong>生　　日</strong>：
                <input name="birthday" type="text" class="normalinput" id="birthday" value="<?php echo $row["birthday"];?>">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">為西元格式(YYYY-MM-DD)。 </span></p>
            <p><strong>電子郵件</strong>：
                <input name="email" type="text" class="normalinput" id="email" value="<?php echo $row["email"];?>">
                <font color="#FF0000">*</font> </p>
            <p><strong>電　　話</strong>：
                <input name="phone" type="text" class="normalinput" id="phone" value="<?php echo $row["phone"];?>">
            </p>
            <p><strong>住　　址</strong>：
                <input name="address" type="text" class="normalinput" id="address" value="<?php echo $row["address"];?>" size="40">
            </p>
            <p> <font color="#FF0000">*</font> 表示為必填的欄位</p>
          </div>
          <hr size="1" />
          <p align="center">
            <input name="id" type="hidden" id="id" value="<?php echo $row["id"];?>">
            <input name="action" type="hidden" id="action" value="update">
            <input type="submit" name="Submit2" value="修改資料">
            <input type="reset" name="Submit3" value="重設資料">
            <input type="button" name="Submit" value="回管理頁面" onClick="location='admin.php';">
          </p>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>