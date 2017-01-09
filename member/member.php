<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
session_start();
//檢查是否經過登入
/*
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}
*/
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: index.php");
}
//登入會員資料
$query_Member = "SELECT * FROM `member` WHERE `username`='".$_SESSION["loginMember"]."'";
$Member = mysql_query($query_Member);	
$row=mysql_fetch_assoc($Member);
//重新導向頁面
$redirectUrl="index.php";
//執行更新動作
if(isset($_POST["action"])&&($_POST["action"]=="update")){	
	$query_update = "UPDATE `member` SET ";
	//若有修改密碼，則更新密碼。
	if(($_POST["psword"]!="")&&($_POST["psword"]==$_POST["pswordcheck"])){
		$query_update .= "`psword`='".$_POST["psword"]."',";
	}
	// 其餘資料
	$query_update .= "`name`='".$_POST["name"]."',";	
	$query_update .= "`sex`='".$_POST["sex"]."',";
	$query_update .= "`birthday`='".$_POST["birthday"]."',";
	$query_update .= "`email`='".$_POST["email"]."',";
	$query_update .= "`address`='".$_POST["address"]."' ";
	$query_update .= "WHERE `id`=".$_POST["id"];	
	mysql_query($query_update);
	//若有修改密碼，則登出回到首頁。
	if(($_POST["psword"]!="")&&($_POST["psword"]==$_POST["pswordcheck"])){
		unset($_SESSION["loginMember"]);
		unset($_SESSION["memberLevel"]);
	}		
	//重新導向
	header("Location: member.php?loginStats=1");
}
?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>網站會員系統</title>
<link href="style.css" rel="stylesheet" type="text/css">
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
	if(!checkmail(document.form1.email)){
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

</script>
</head>

<body>
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
	alert('會員修改成功，請重新登入。');
	window.location.href='index.php';		  
</script>
<?php }?>
<table width="780" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><form action="" method="POST" name="form1" id="form1" onSubmit="return checkForm();">
          <p class="title">修改資料</p>
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
              <span class="smalltext">若不修改密碼，請不要填寫。若要修改，請輸入密碼</span><span class="smalltext">二次。<br>
              若修改密碼，系統會自動登出，請用新密碼登入。</span></p>
            <hr size="1" />
            <p class="heading">個人資料</p>
            <p><strong>真實姓名</strong>：
                <input name="name" type="text" class="normalinput" id="name" value="<?php echo $row["name"];?>">
                <font color="#FF0000">*</font> </p>
            <p><strong>性　　別
              </strong>：
			  <input name="sex" type="radio" value="M" <?php if($row["sex"]=="M") echo "checked";?>>男
              <input name="sex" type="radio" value="F" <?php if($row["sex"]=="F") echo "checked";?>>女
			  <font color="#FF0000">*</font></p>
            <p><strong>生　　日</strong>：
                <input name="birthday" type="text" class="normalinput" id="birthday" value="<?php echo $row["birthday"];?>">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext" sytle="small">為西元格式(YYYY-MM-DD)。 </span></p>
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
            <input type="button" name="Submit" value="回上一頁" onClick="window.history.back();">
          </p>
        </form></td>
        <td width="200">
        <div class="boxtl"></div><div class="boxtr"></div>
		<div class="regbox">  
            <p><strong><?php echo $row["name"];?></strong> 您好。</p>
          <!--  <p>您總共登入了 <?php echo $row["login"];?> 次。<br> -->
            本次登入的時間為：<br>
            <?php echo $row["logintime"];?></p>
            <a href="?logout=true">登出系統</a></p>
		</div>
        <div class="boxbl"></div><div class="boxbr"></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
