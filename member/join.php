<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(isset($_POST["action"])&&($_POST["action"]=="join")){
	//check the id is signed or not 
	$query_FindUser = "SELECT `username` FROM `member` WHERE `username`='".$_POST["username"]."'";
	$FindUser=mysql_query($query_FindUser);
	//如果有找到，表示已有人註冊
	if (mysql_num_rows($FindUser)>0){
		header("Location: join.php?errMsg=1&username=".$_POST["username"]);
	}else{
	//若沒有執行新增的動作
		$query_insert = "INSERT INTO `member` (`name` ,`username` ,`psword` ,`sex` ,`birthday` ,`email`,`address`,`jointime`) VALUES (";
		$query_insert .= "'".$_POST["name"]."',";
		$query_insert .= "'".$_POST["username"]."',";
		$query_insert .= "'".$_POST["psword"]."',";
		$query_insert .= "'".$_POST["sex"]."',";
		$query_insert .= "'".$_POST["birthday"]."',";
		$query_insert .= "'".$_POST["email"]."',";
		$query_insert .= "'".$_POST["address"]."',";	
		$query_insert .= "NOW())";
		mysql_query($query_insert);
		//$row_id 抓不到
		//查詢新增id並新增id資料夾	
		$query_id = "select `id` from `member` where `username` = '".$_POST["username"]."'";
		$row_num = mysql_query($query_id);
		$row_id = mysql_fetch_row($row_num);
		$id = $row_id[0];
		$path = "./images/".$id;
		if(!is_dir($path)){    //is_dir 判斷是否為目錄(資料夾) 
			mkdir($path); //make directory 
			//echo $id.' 已經建立完成!!'; 
		}else{ 
			echo $id.' 已經存在!!'; 
		} 
		//echo $query_insert;
		header("Location: join.php?loginStats=1");
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>網站會員系統</title>
<link href="css/style.css" rel="stylesheet"/>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
	$("#checkid").click(function() {
		var checkname = $("#username").val().trim();
		if (checkname.length >0){	//no word input
			$.post(
				"join_test.php",
				{username:checkname},
				function(result){
					$("#result").html(result);}
			)
		}else{
			alert("沒有輸入帳號");
		}
		
		
	})
});
</script>
<script language="JavaScript">
    $(document).ready(function(){ 
	$("#birthday").datepicker({dateFormat: "yy-mm-dd"});
      $("#datepicker2").datepicker({firstDay: 1});
      $("#datepicker3").datepicker({appendText: " 點一下顯示日曆"});
      });
  </script>
<script language="javascript">
function checkForm(){
	if(document.form1.username.value==""){		
		alert("請填寫帳號!");
		document.form1.username.focus();
		return false;
	}
	else{	//輸入帳號的字元判斷
		uid=document.form1.username.value;
		if(uid.length<5 || uid.length>12){
			alert( "您的帳號長度只能5至12個字元!" );
			document.form1.username.focus();
			return false;
		}
		if(!(uid.charAt(0)>='a' && uid.charAt(0)<='z')){
			alert("您的帳號第一字元只能為小寫字母!" );
			document.form1.username.focus();
			return false;
		}
		for(idx=0;idx<uid.length;idx++){
			if(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z'){
				alert("帳號不可以含有大寫字元!" );
				document.form1.username.focus();
				return false;
			}
			if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||( uid.charAt(idx)=='_'))){
				alert( "您的帳號只能是數字,英文字母及「_」等符號,其他的符號都不能使用!" );
				document.form1.username.focus();
				return false;
			}
			if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
				alert( "「_」符號不可相連 !\n" );
				document.form1.username.focus();
				return false;				
			}
		}
	}
	if(!check_passwd(document.form1.psword.value,document.form1.pswordcheck.value)){
		document.form1.psword.focus();
		return false;
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
	}*/
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


<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
	alert('會員新增成功。');
	window.location.href='index.php';		  
</script>
<?php }?>
<table width="780" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><form action="" method="POST" name="form1" id="form1" onSubmit="return checkForm();">
          <p class="title">加入會員</p>
		  <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
          <div class="errDiv">帳號 <?php echo $_GET["username"];?> 已經有人使用！</div>
          <?php }?>
          <div class="dataDiv">
            <hr size="1" />
            <p class="heading">帳號資料</p>
            <p><strong>使用帳號</strong>：
                <input name="username" type="text" class="normalinput" id="username">
                <font color="#FF0000">*</font></a><input type="button" id="checkid" value="click">
				<div id="result"></div>
				<br>
                <!-- 
				<span class="smalltext"  style="font-size:small;">請填入5~12個字元以內的小寫英文字母、數字、以及_ 符號。</span></p>
				-->
            <p><strong>使用密碼</strong>：
                <input name="psword" type="password" class="normalinput" id="psword">
                <font color="#FF0000">*</font><br>
				<!--
				<span class="smalltext" style="font-size:small;">請填入5~10個字元以內的英文字母、數字、以及各種符號組合，</span></p>
				-->   
            <p><strong>確認密碼</strong>：
                <input name="pswordcheck" type="password" class="normalinput" id="pswordcheck">
                <font color="#FF0000">*</font> <br>
            <hr size="1" />
            <p class="heading">個人資料</p>
            <p><strong>真實姓名</strong>：
                <input name="name" type="text" class="normalinput" id="name">
                <font color="#FF0000">*</font> </p>
            <p><strong>性　　別
              </strong>：
              <input name="sex" type="radio" value="M" checked>男
			  <input name="sex" type="radio" value="F"> 女 
			  <font color="#FF0000">*</font></p>
            <p><strong>生　　日</strong>：
                <input name="birthday" type="text" class="normalinput" id="birthday">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">為西元格式(YYYY-MM-DD)。</span></p>
            <p><strong>電子郵件</strong>：
                <input name="email" type="text" class="normalinput" id="email">
                <font color="#FF0000">*</font> </p>
            <p><strong>電　　話</strong>：
                <input name="phone" type="text" class="normalinput" id="phone">
            </p>
            <p><strong>住　　址</strong>：
                <input name="address" type="text" class="normalinput" id="address" size="40">
            </p>
            <p> <font color="#FF0000">*</font> 表示為必填的欄位</p>
          </div>
          <hr size="1" />
          <p align="center">
            <input name="action" type="hidden" id="action" value="join">
            <input type="submit" name="Submit2" value="送出申請">
            <input type="reset" name="Submit3" value="重設資料">
			<Input Type="Button" Value="回管理頁面" onClick="location='admin.php';">
          </p>
        </form></td>
        <td width="200">
        <div class="boxtl"></div><div class="boxtr"></div>
        <div class="boxbl"></div><div class="boxbr"></div></td>
      </tr>
    </table></td>
  
</table>
</body>
</html>
