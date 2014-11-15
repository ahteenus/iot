<?php
if (file_exists('C:\xampp\htdocs/mythings/system/controller/config.php')) {
		require_once('C:\xampp\htdocs/mythings/system/controller/config.php');
		//echo $_SERVER['SERVER_NAME'];
	}
	require_once(DIR_DB."/mysql_user_info.php");
	require_once(DIR_DB."/mysql_reader.php");
	require_once(DIR_DB."/mysql_connect.php");
	require_once(DIR_READER."/tag.php");
	require_once(DIR_READER."/antitheft.php");
	$c = mysql_connect(HOST,USER,PASSWORD);
	if (!$c) {
		//$this->user_con=false;
		return false;//die('Could not connect: '.mysql_error());
	}
	else{
		//$this->user_con= $c;
	}
	$a=mysql_select_db("reader_info",$c);
	$query="SELECT * FROM reader_public WHERE reader_no=1";
	if(!$a){
	$result=mysql_query($query);
	$row = mysql_fetch_assoc($result);
	echo $row;
	if(!$row){
		return "empty_row"; //search row error
	}
	else{
		return $row;
	}
	}
	else{
		return 0;//select db errror	
	}
?>