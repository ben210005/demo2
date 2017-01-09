<?php
	header("Content-Type: text/html; charset=utf-8");
	require_once("connMysql.php");
	session_start();
	//check the session
	if(!isset($_SESSION['loginMember']) || $_SESSION['loginMember'] == '') {
		header("Location: index.php");
	}
	//check the level
	if($_SESSION["memberLevel"]=="member"){
		header("Location: index.php");
	}
	//logout action
	if(isset($_GET["logout"]) && $_GET["logout"] == 'true') {
		unset($_SESSION["loginMember"]);
		unset($_SESSION["memberLevel"]);
		header("Location: index.php");
	}
	//delete the member
	if(isset($_GET["action"])&&($_GET["action"]=="delete")){	
		$query_Member = "DELETE FROM `member` WHERE `id`=".$_GET["id"];
		mysql_query($query_Member); 
		//重新導向回到主畫面
		header("Location: admin.php");
	}
	
	//admin personal data
	$query_Admin = "SELECT * FROM `member` WHERE `username`='".$_SESSION['loginMember']."'";
	$ans_Admin = mysql_query($query_Admin);	
	$row = mysql_fetch_assoc($ans_Admin);
	// the member
	$pageRow_records = 5;	//page 
	$num_pages = 1;	//default
	if (isset($_GET['page'])) {
		$num_pages = $_GET['page'];
	}
	//record the count_page
	$startRow_records = ($num_pages -1) * $pageRow_records;
	//all members
	$query_AllMember = "SELECT * FROM `member` WHERE `level`<>'admin'";
	$All_Member = mysql_query($query_AllMember);
	//the page member
	$query_limit_Member = $query_AllMember.' LIMIT '.$startRow_records.",".$pageRow_records;
	$Limit_Member = mysql_query($query_limit_Member);
	//calculate the members
	$total_counts = mysql_num_rows($All_Member);
	$total_pages = ceil($total_counts/$pageRow_records);
	//search the member
	if(isset($_GET["find"])){
		$query_search = "SELECT * FROM `member` WHERE `username` = '".$_GET['find']."'";
		$find = mysql_query($query_search);
		$num = mysql_num_rows($find);	//ans_count
		if ($num == 0) {	
			header("Location: admin.php?errmsg=1");
		}else {	//new $row
			$Limit_Member = $find;
		}
	}
?>

<html>
<head>
	<title>admin manage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/style.css" rel="stylesheet"/>
	<script type="text/javascript">
	function delete_member(){
		if (confirm('\n您確定要刪除這個會員嗎?\n刪除後無法恢復!\n')) {
			return true;
		}
		return false;
	}
	</script>
	<?php if(isset($_GET["errmsg"]) && ($_GET["errmsg"]=="1")){?>
		<script>
				alert('未查詢到此會員。');	 
				window.location.href='admin.php';				
		</script>
	<?php } ?>
</head>
<body>

<table width="780" border="0" align="center" cellpadding="4" cellspacing="0">
	<td class="tdrline"><p class="title" align='center'>會員資料列表 </p>
		<div align="right">
			<h3 >hello，<?php echo $_SESSION['loginMember'] ?></h3>
			<form method="get" action="">
			<input type="text" id="find" name="find"  style="text-align: left">
			<input type="submit" value="查詢">
			</form></div>
		<p align="right"><a href="join.php">新增會員</a>| <a href="?logout=true">登出系統</a></p>
	<table width="100%" border=1 cellpadding="2" cellspacing="1">
		<tr>
			<th width="20%" bgcolor="#CCCCCC"><p></p></th>
			<th width="20%" bgcolor="#CCCCCC"><p>id</p></th>
			<th width="20%" bgcolor="#CCCCCC"><p>姓名</p></th>
			<th width="20%" bgcolor="#CCCCCC"><p>帳號</p></th>
			<th width="20%" bgcolor="#CCCCCC"><p>加入時間</p></th>
			
		</tr>
		<!-- get the data from database-->
		<?php	while($row=mysql_fetch_assoc($Limit_Member)){ ?>
            <tr>
              <td width="20%" align="center" bgcolor="#FFFFFF"><p><a href="admin_update.php?id=<?php echo $row["id"];?>">修改</a><br>
                <a href="?action=delete&id=<?php echo $row["id"];?>" onClick="return delete_member();">刪除</a></p></td>
              <td width="20%" align="center" bgcolor="#FFFFFF"><p><?php echo $row["id"];?></p></td>
              <td width="20%" align="center" bgcolor="#FFFFFF"><p><?php echo $row["name"];?></p></td>
              <td width="20%" align="center" bgcolor="#FFFFFF"><p><?php echo $row["username"];?></p></td>  
			  <td width="20%" align="center" bgcolor="#FFFFFF"><p><?php echo $row["jointime"];?></p></td>
 
            </tr>
		<?php }?>
	</table>
	 <table width="98%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr>
              <td valign="middle"><p>資料筆數：<?php echo $total_counts;?></p></td>
              <td align="right"><p>
				<?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
						<a href="?page=1">第一頁</a> | <a href="?page=<?php echo $num_pages-1;?>">上一頁</a> |
				<?php }?>
				<!--顯示頁數[1][2][3][4][5]-->
				<?php
					for ($x = 1; $x < 4; $x++) {	
							if ($x == $num_pages) {
								echo " [<b>".$x."</b>] ";
							}else {
								echo " <a href=admin.php?page=".$x.">".$x."</a> ";
							} 
					} 
				?>
                <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
						<a href="?page=<?php echo $num_pages+1;?>">下一頁</a> | <a href="?page=<?php echo $total_pages;?>">最末頁</a>
                <?php }?>
              </p></td>
            </tr>
          </table>  
</table>
</body>
</html>