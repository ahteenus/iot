<?php
class Mysql {

private  $user_con; //user connection to the database

public function getcon(){ //return user connection resource
	return $this->user_con;
}


function __construct ($host,$user,$password) { //connect to the database physically separate one database
    $c = mysql_connect($host,$user,$password);

	if (!$c) {
		$this->user_con=false;
		return false;//die('Could not connect: '.mysql_error());
	}
	else{
		$this->user_con= $c;
	}
}

public function deletetable($db_name,$tb_name){

	$query="DELETE FROM `user_places` WHERE 1";
	$a=mysql_select_db($db_name,$this->user_con);
	$result=mysql_query($query);

}
public function getsinglerow($db_name,$tb_name,$column_name,$value){
	$query="SELECT * FROM $tb_name WHERE $column_name=".$value;

	$a=mysql_select_db($db_name,$this->user_con);

	if($a){
		$result=mysql_query($query);
		$row = mysql_fetch_assoc($result);
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
}

public function getrows($db_name,$tb_name,$column_name,$value){
	$query="SELECT * FROM $tb_name WHERE $column_name=".$value;
	$arr=array();
	$i=0;
	$a=mysql_select_db($db_name,$this->user_con);

	if($a){
		$result=mysql_query($query);
		while($row= mysql_fetch_assoc($result)){
			if(!$row){
				//echo "empty_row"; //search row error
			}
			else{
				array_push($arr, $row[$column_name]);
			}
			$i++;
		}
		return $arr;
	}
	else{
		return 0;//select db errror	
	}
}

public function getfullrows($db_name,$tb_name,$column_name,$value){
	$query="SELECT * FROM $tb_name WHERE $column_name".$value;
	$arr=array();
	$a=mysql_select_db($db_name,$this->user_con);

	if($a){

		$result=mysql_query($query); 
		while($row = mysql_fetch_assoc($result)){
			if(!$row){
				//echo "empty_row"; //search row error
			}
			else{
			    array_push($arr, $row);
			}
		}
		return $arr;
	}
	else{

		return 0;//select db errror	
	}
}

public function getsinglerowdesc($db_name,$tb_name,$column_name,$value,$desc_col){
	$query="SELECT * FROM $tb_name WHERE $column_name=$value ORDER BY time DESC";
	$a=mysql_select_db($db_name,$this->user_con);

	if($a){
		$result=mysql_query($query);
		$r=mysql_fetch_assoc($result);
  			if(!$r){
				return $row="empty_row"; //search row error
			}
			else{
				return $r;
			}		
	}
	else{
		return 0;//select db errror	
	}
}

public function getsinglecells($db_name,$tb_name,$column_name,$constraint){
	$query="SELECT $column_name FROM $tb_name WHERE ".$constraint;
	$a=mysql_select_db($db_name,$this->user_con);
	if($a){
		$result=mysql_query($query);
		$row = mysql_fetch_assoc($result);
		if(!$row){
			return "empty_cell"; //search row error
		}
		else{
			return $row;
		}
	}
	else{
		return 0;//select db errror	
	}
}

public function getrowscounter($db_name,$tb_name,$constraint){
	$query="SELECT user_id,counter FROM $tb_name WHERE ".$constraint;
	$data=array();
	$a=mysql_select_db($db_name,$this->user_con);
	if($a){
		$result=mysql_query($query);
		while($row = mysql_fetch_assoc($result)){
			set_time_limit(0);
			if(!$row){
				return "empty_cell"; //search row error
			}
			else{
			//	$row1['counter']=$row['counter'];
				$row['priorityplace']=substr($tb_name,6,strlen($tb_name));
				array_push($data, $row);

			}
		}
		//print_r($data);
		return $data;
	}
	else{
		return 0;//select db errror	
	}
}

public function gettables($dbname){
	$sql = "SHOW TABLES FROM $dbname";
 	$result = mysql_query($sql);
 	$arrayCount = 0;
 	$arr=array();
 	//$row = mysql_fetch_row($result);
	while ($row = mysql_fetch_row($result)) {
 		//$tableNames[$arrayCount] = $row[0];
 		set_time_limit(0);
 		array_push($arr, $row[0]);
 		//print_r($row);
 		$arrayCount++; //only do this to make sure it starts at index 0
 	}
 	//print_r($arr);
 	return $arr;

}

public function storesinglerow($db_name,$tb_name,$columns,$values){
	mysql_select_db($db_name, $this->user_con);
	$query="INSERT INTO $tb_name ($columns) VALUES ($values)";
	$retval=mysql_query($query);
	//echo mysql_error($this->user_con);
	return $retval;
}

public function storemultirow($db_name,$con,$tb_name,$tag_obj){

}

public function storemulticell($db_name,$con,$tb_name,$values,$contraint){
	mysql_select_db($db_name, $this->user_con);
	$query="UPDATE $tb_name SET $values WHERE $contraint";
	//echo $query;
	$retval=mysql_query($query);
	//echo mysql_error($this->user_con);
	return $retval;
}

public function storesinglecell($db_name,$con,$tb_name,$column,$cell){
	mysql_select_db($db_name, $this->user_con);
	$query="UPDATE $tb_name SET $cell WHERE $column";
	$retval=mysql_query($query);
	return $retval;
}

public function mysqlclose(){
	mysql_close ($this->user_con);
}

}
?>