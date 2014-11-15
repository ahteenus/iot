<?php
require_once(DIR_SEARCH."/search.php");
Class Attendancesearch extends Search {

	private $lecturehall;
	private $readernumber;

	function getlecturehall(){
		return $this->lecturehall;
	}

	function setlecturehall($value){
		$this->lecturehall=$value;
	}

	function getreadernumber(){
		return $this->readernumber;
	}

	function setreadernumber($value){
		$this->readernumber=$value;
	}

	function getgroupnumber(){
		return $this->readergroupnumber;
	}

	function setgroupnumber($value){
		$this->readergroupnumber=$value;
	}

	function getlocation(){
		return $this->location;
	}

	function setlocation($value){
		$this->location=$value;
	}

	function mapping_lecture_hall($db,$tb,$column_name,$user_id,$con){

		$row = $con->getsinglerow($db,$tb,$column_name,"'".$this->getlecturehall()."' AND ".$this->getuser_id_col()."='".$user_id."'");
		if($row=="empty_row") {
			return "no_reader";
		}
		else{
			$this->setreadernumber($row['reader_no']);
			return 1;
		}
	}

	function get_reader_info($db_name,$tb_name,$con,$uid,$column_name){
		$row = $con->getsinglerow($db_name,$tb_name,$column_name,$this->getreadernumber()." AND reader_owner=".$uid);
		if(!$row) {
			return 0;
		}
		else{
			$this->setlocation($row['reader_location']);
			$this->setgroupnumber($row['reader_group']);
			return 1;
		}
	}

	function search_data($con,$db_t,$tb_t,$db_l,$tb_l,$location,$user_id,$from,$to){
		//search parameters lecture hall,time frame result present students
		$attendance=array();
		$value=" LIKE '%".$user_id."%'"." AND time BETWEEN '".$from."' AND '".$to."'";
		$timedata=$con->getfullrows($db_t,$tb_t,$this->gettag_no_col(),$value);
		//print_r($timedata);
		//echo "location";
		$value2="='".$location."'";
		$locationdata=$con->getfullrows($db_l,$tb_l,$this->getlocation_col(),$value2);
		//print_r($locationdata);
		if($timedata=="empty_row"){
			return "empty_row12";
		}
		else{
			if($locationdata=="empty_row"){
				return "empty_row11";
			}
			else{
			$name=$this->gettag_no_col();	
			foreach($timedata as $i){
			foreach($locationdata as $j){
			if($j[$this->getunique_id_col()]==$i[$this->getunique_id_col()]){
				//print_r($i);
				//print_r($j);
				
			//	echo $name;
				if($j[$this->getlocation_col()]==$location){
					//map tag time and location
					$memory=0;
					$r=0;
					foreach($attendance as $k){
						if($k[$name]==$i[$name]){
							$memory=$r;
							break;
						}
						$r++;
					}
						if($memory==0){
							$att=array(
				   				$name =>$i[$name],
				   				'count' =>1
							);
							array_push($attendance, $att);
						}
						else{
							$attendance[$memory]['count']=$attendance[$memory]['count']+1;
						}
				}
			}	
			}
		}
		}
		}
		return $attendance;
	}

	function send_daily_lecture_attendance($db_name,$tb_name,$con,$user_id,$date,$from,$to){
		//get date of the day selected date and log into lecture_info  table according to the lectures sheduled for the date
		// search the tttr & ttlr and send a email
	}
	function gettagname($db_name,$tb_name,$att,$con,$uid){
		//get the relavant tag_no for tag_name search in the session then tetm and then hetm
		//echo "tag no to tag name mapping ";
		$attendance=array();
		foreach($att as $j){
		$column_name=$this->gettag_name_col();
		$constraint=$this->gettag_no_col()."='".$j[$this->gettag_no_col()]."' AND ".$this->getuser_id_col()."='".$uid."'";
		$cells=$con->getsinglecells($db_name,$tb_name,$column_name,$constraint);
		$row_data1 = array(
	     	     	$this->gettag_name_col() => $cells[$this->gettag_name_col()],
	   				'count' => $j['count']
	   				);
		array_push($attendance, $row_data1);
		}
		return $attendance;
	}

}
?>