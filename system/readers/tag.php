<?php
require_once(DIR_READER."/reader.php");
Class Tag extends Reader {
	private $epc;
	private $tag_no;
	private $tag_name;
	private $user_id;
	private $priority;
	private $counter;
	private $carcheck;
	private $kitchen;
	private $tag_time;

function getepc(){
	return $this->epc;
}
function gettag_no(){
	return $this->tag_no;
}
function gettag_name(){
	return $this->tag_name;
}
function getuser_id(){
	return $this->user_id;
}
function getpriority(){
	return $this->priority;
}
function gettag_time(){
	return $this->tag_time;
}
function getcounter(){
	return $this->counter;
}

function getkitchencheck(){
	return $this->kitchen;
}

function getcarcheck(){
	return $this->carcheck;
}

function setcarcheck($value){
	$this->carcheck=$value;
}

function setkitchencheck($value){
	$this->kitchen=$value;
}

function setepc($value){
	$this->epc=$value;
}
function settag_no($value){
	$this->tag_no=$value;
}
function settag_name($value){
	$this->tag_name=$value;
}
function setuser_id($value){
	$this->user_id=$value;
}
function setpriority($value){
	$this->priority=$value;
}
function settag_time($value){
	$this->tag_time=$value;
}
function setcounter($value){
	$this->counter=$value;
}

function map_epc_tagno($con,$db_name){
	//map epc to tag no from etm-pl1 db has hetm and tetm_groupname
	$tb_name="tetmr_".$this->getgroupnumber();
	$column_name="epc";
	$row = $con->getsinglerow($db_name,$tb_name,$column_name,$this->getepc());
	if($row=="empty_row"){
		$tb_name="hetmr";
		$row= $con->getsinglerow($db_name,$tb_name,$column_name,$this->getepc());
		if(!$row){
			return 0;
		}
		else {
			if(isset($row['tag_no'])) {
				$this->settag_no($row['tag_no']);
			}
			if(isset($row['tag_name'])) {
				$this->settag_name($row['tag_name']);
			}
			if(isset($row['user_id'])) {
				$this->setuser_id($row['user_id']);
			}
			if(isset($row['priority'])) {
				$this->setpriority($row['priority']);
			}
			$this->setcounter(0);
			if(isset($row['carcheck'])) {
				$this->setcarcheck($row['carcheck']);
				//echo "carcheckofsas=".$row['carcheck'];
			}
			if(isset($row['kitchen'])) {
				$this->setkitchencheck($row['kitchen']);
			}
			
			$a=$this->store_epcintetmr($db_name,$con);
			//echo $a;
			return 1;
		}
	}
	else if ($row==0){
		//echo "row==0";
			return 0;
	}
	else{
		
		if(isset($row['tag_no'])) {
			$this->settag_no($row['tag_no']);
		}
		if(isset($row['tag_name'])) {
			$this->settag_name($row['tag_name']);
		}
		if(isset($row['tag_name'])) {
			$this->setuser_id($row['user_id']);
		}
		if(isset($row['priority'])) {
			$this->setpriority($row['priority']);
		}
		if(isset($row['counter'])) {
			$this->setcounter($row['counter']);
		}
		if(isset($row['carcheck'])) {
				$this->setcarcheck($row['carcheck']);
		}
		if(isset($row['kitchen'])) {
				$this->setkitchencheck($row['kitchen']);
		}
		$c=$this->getcounter()+1;
		$a=$con->storesinglecell($db_name,$con,$tb_name,"tag_no=".$this->gettag_no(),"counter=".$c);
		//echo "tetmr_ & storesinglecell".$a."//";
		return 1;
	}
}

function store_time($db_name,$con,$id) {
	//store time results in db
	$table="tttr_".$this->getgroupnumber();
	$values="'".$id."',".$this->gettag_no().",";
	$values=$values.$this->gettag_time();
	$a=$con->storesinglerow($db_name,$table,"unique_id,tag_no,time",$values);
	//echo "store time $a//";
	return $a;
}
function store_prioritytagdata($db_name,$table,$con){
	$contraint="tag_no=".$this->gettag_no();
	$values="latest_location='".$this->getlocation()."',";
	$values=$values."antitheft = 1,counter=counter+1";
	$a=$con->storemulticell($db_name,$con,$table,$values,$contraint);
	return $a;
}
function store_location($db_name,$con,$id) {
	//store location results in db
	$table="ttlr_".$this->getgroupnumber();
	$values="'".$id."',".$this->gettag_no().",";
	$values=$values."'".$this->getlocation()."'";
	$a=$con->storesinglerow($db_name,$table,"unique_id,tag_no,location",$values);
	//echo "store location $a//";
	return $a;
}

public function store_epcintetmr($db_name,$con) {
	//	store results in d
	$tb_name="tetmr_".$this->getgroupnumber();
	$value=$this->getepc().",";
	$value=$value.$this->gettag_no().",";
	$value=$value."'".$this->gettag_name()."',";
	$value=$value.$this->getuser_id().",";
	$value=$value.$this->getpriority().",";
	$value=$value.$this->getcounter().",";
	$value=$value.$this->getcarcheck().",";
	$value=$value.$this->getkitchencheck();
	$a=$con->storesinglerow($db_name,$tb_name,"epc,tag_no,tag_name,user_id,priority,counter,carcheck,kitchen",$value);
	//echo "store_epcintetmr".$a."//";
	return $a;
}
}
?>