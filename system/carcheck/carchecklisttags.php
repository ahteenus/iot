<?php
require_once(DIR_READER."/tag.php");
Class Carchecklisttags extends Tag{

  //EPC ,reader no,time
  //map epc and check if it is a refferance tag
  //if ref-wait 15s and execute the notify 
  //if not update db with carcheck table
function getreaderowner(){
	return $this->readerowner;
}

function setreaderowner($value){
	$this->readerowner=$value;
}
/*function userid_data($con,$db_name,$table){
	//map epc to tag no from etm-pl1 db has hetm and tetm_groupname
	$tb_name=$table;
	$column_name="user_id";
	$row = $con->getrows($db_name,$tb_name,$column_name,$this->getreaderowner()." AND carcheck=1");
	if($row=="empty_row"){
		echo "empty_row";
	}
	else{
		return $row;
	}
}*/

function check_reader_location($con,$db_name,$tb_name,$column_name){
	//get reader location and group name
	
	$row = $con->getsinglerow($db_name,$tb_name,$column_name,$this->getreadernumber());
	if(!$row) {
		return 0;
	}
	else{
		$this->setlocation($row['reader_location']);
		$this->setgroupnumber($row['reader_group']);
		$this->setreaderowner($row['reader_owner']);
		return 1;
	}
}

function check_refuser($con,$db_name,$tb_name,$column_name){
	//get reader location and group name
	
	$row = $con->getsinglerow($db_name,$tb_name,$column_name,$this->getreaderowner()."001");
	if(!$row) {
		return 0;
	}
	else{
		
		return $row["notify"];
	}
}

function store_carchecktagdata($db_name,$table,$con){
	$contraint="tag_no=".$this->gettag_no();
	echo $contraint;
	//$values="latest_location='".$this->getlocation()."',";
	$values="status='1'";
	$a=$con->storemulticell($db_name,$con,$table,$values,$contraint);
	return $a;
}

function store_carcheckref($db_name,$table,$con){
	$contraint="tag_no=".$this->gettag_no();
	echo $contraint;
	//$values="latest_location='".$this->getlocation()."',";
	$values="notify='".time()."'";
	$a=$con->storemulticell($db_name,$con,$table,$values,$contraint);
	return $a;
}

function store_carcheckstart($db_name,$table,$con){
	$contraint="user_id=".$this->getuser_id();
	echo $contraint;
	//$values="latest_location='".$this->getlocation()."',";
	$values="notify='0'";
	$a=$con->storemulticell($db_name,$con,$table,$values,$contraint);
	return $a;
}
}
?>