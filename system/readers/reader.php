<?php
Class Reader {
	private $readernumber; //integer
	private $location; //string geographical location
	private $groupnumber; //area no

function getreadernumber(){
	return $this->readernumber;
}
function getlocation(){
	return $this->location;
}
function getgroupnumber(){
	return $this->groupnumber;
}

function setreadernumber($value){
	$this->readernumber=$value;
}
function setlocation($value){
	$this->location=$value;
}
function setgroupnumber($value){
	$this->groupnumber=$value;
}

function check_reader_location($con,$db_name,$tb_name,$column_name){
	//get reader location and group name
	
	$row = $con->getsinglerow($db_name,$tb_name,$column_name,$this->getreadernumber());
	if(!$row) {
		return 0;
	}
	else{
		$this->setlocation($row['reader_location']);
		$this->setgroupnumber($row['reader_group']);
		return 1;
	}
}
function check_gps_reader_group($con,$db_name,$tb_name,$column_name){

	//get group name
	$a=$this->getlocation();
	$point=explode(',',$a);
	$point[1]=floatval($point[1]);
	$point[2]=floatval($point[2]);
	$constraint="$point[1] > point1 AND $point[1] <= point2 AND $point[2] > point3 AND $point[2] <= point4";
	$row = $con->getsinglecells($db_name,$tb_name,$column_name,$constraint);
	//print_r($row);
	if(!$row) {
		return 0;
	}
	else{
		
		$this->setgroupnumber($row['reader_group']);
		return 1;
	}
}
}
?>