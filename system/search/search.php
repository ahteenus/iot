<?php
// this is the file that user quaries the database
Class Search{
	private $tag_no_col;
	private $user_id_col;
	private $tag_name_col;
	private $latest_location_col;
	private $location_col;
	private $unique_id_col;

	function gettag_no_col(){
		return $this->tag_no_col;
	}
	function gettag_name_col(){
		return $this->tag_name_col;
	}
	function getlatest_location_col(){
		return $this->latest_location_col;
	}
	function getunique_id_col(){
		return $this->unique_id_col;
	}
	function getuser_id_col(){
		return $this->user_id_col;
	}
	function getlocation_col(){
		return $this->location_col;
	}

	function settag_no_col($value){
		$this->tag_no_col=$value;
	}
	function settag_name_col($value){
		$this->tag_name_col=$value;
	}
	function setlatest_location_col($value){
		$this->latest_location_col=$value;
	}
	function setunique_id_col($value){
		$this->unique_id_col=$value;
	}
	function setuser_id_col($value){
		$this->user_id_col=$value;
	}
	function setlocation_col($value){
		$this->location_col=$value;
	}

	function searchtagpriority($con,$db_name,$tb_name,$tagno){
		//search in the notification datbase
		$column_name=$this->getlatest_location_col();
		$constraint=$this->gettag_no_col()."=".$tagno;
		$a['time']=time();
		$tag_no=$con->getsinglecells($db_name,$tb_name,$column_name,$constraint);
		$a['place']=$tag_no[$this->getlatest_location_col()];
		return $a;
	}
	function getpriorityplaces($db_name,$tb_name,$con,$userid){
		$column_name=$this->getuser_id_col();
		$row=$con->getsinglerow($db_name,$tb_name,$column_name,$userid);
		return $row;
	}
	function gettagno($db_name,$tb_name,$tagname,$con,$uid){
		//get the relavant tag_no for tag_name search in the session then tetm and then hetm
		$column_name=$this->getuser_id_col().",".$this->gettag_no_col();
		$constraint=$this->gettag_name_col()."='".$tagname."' AND ".$this->getuser_id_col()."='".$uid."'";
		$cells=$con->getsinglecells($db_name,$tb_name,$column_name,$constraint);
		return $cells;
	}
	function searchtag($con,$database1,$table1,$database2,$table2,$tagno){
		//search in the priority temparory tables and permanent tables.search in the relavant tables calculating user visit
		$column_name=$this->gettag_no_col();
		$constraint=$tagno;
		$row11=$con->getsinglerowdesc($database1,$table1,$column_name,$constraint,'time');
		if($row11=="empty_row"){
			return $row11; 
		}
		else{
			$column_name=$this->getlocation_col();
			$a=$this->getunique_id_col();
			$constraint=$this->getunique_id_col()."='".$row11['unique_id']."'";
			$row12=$con->getsinglecells($database2,$table2,$column_name,$constraint);
			$r=array($row11['time'],$row12['location']);
			return $r;
		}
	}
}
?>