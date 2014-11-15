<?php
	if (file_exists('C:\xampp\htdocs/mythings/system/controller/config.php')) {
		require_once('C:\xampp\htdocs/mythings/system/controller/config.php');
		//echo $_SERVER['SERVER_NAME'];
	}
	require_once(DIR_DB."/mysql_user_info.php");
	require_once(DIR_DB."/mysql_reader.php");
	require_once(DIR_DB."/mysql_connect.php");
	require_once(DIR_SEARCH."/search.php"); 
   // $tagname = $_POST['keyword'];
	//$tagname= $_GET["searchDATA"];

	date_default_timezone_set('Asia/Colombo'); // set time zone

	$glocation=$_GET["locationsearchdata"]; // get search word to variable
	$tagname= $_GET["tagsearchdata"]; 

	$time1= $_GET["Stime1"];
	$time2= $_GET["Stime2"];

	$date1= $_GET["Sdate1"];
	$date2= $_GET["Sdate2"];
	
	$timef = "$date1 $time1"; 
	$timet = "$date2 $time2";
	


	$timefrom= strtotime("$timef"); // make time stamp
	$timeto= strtotime("$timet"); // make time stamp 

/*	echo "$timefrom     ";
	echo "$timeto";
*/

	
	$datasend = array();
    $con = new Mysql(HOST,USER,PASSWORD);
    if (!$con) {
		die('Could not connect: '.mysql_error());
	}
	else{
	$shp = new Search();
	$shp->settag_no_col('tag_no');
	$shp->settag_name_col('tag_name');
	$shp->setuser_id_col('user_id');
	$shp->setlatest_location_col('latest_location');
	$shp->setlocation_col('location');
	$shp->setunique_id_col('unique_id');


	$a=session_id();
	if ($a == ''){ 
		session_start();
		//$uid= $_SESSION["user_id"];
		//echo $uid;
		$uid=94771155234;//$_SESSION['user_id'];
	}


	$a=$shp->gettagno(EPCTAGMAPPING,"hetmr",$tagname,$con,$uid);

	if($a=='empty_cell'){
		echo $a;
	}
	else {
			if($timeto > time()-24*60*60){
				set_time_limit(0);
				//echo $a['tag_no'];
				$table1="tttr_".$glocation;
				$table2="ttlr_".$glocation;
				$data2=$shp->searchtag($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$a['tag_no']);
				if($data2=='empty_row'){
					echo "<br>"."$i empty_row";
				}
				else{
					$row_data1 = array(
		          'ID'=> $data2[0],
		   			'firstname' => $data2[1]
		   			);
					array_push($datasend, $row_data1);
					//echo $data2[0]."\t".$data2[1]."\n";
				}
			
			}
			else if($timefrom < time()-24*60*60){
				set_time_limit(0);
				echo $a['tag_no'];
				$table1="pttr_".$glocation;
				$table2="ptlr_".$glocation;
				$data2=$shp->searchtag($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$a['tag_no']);
				if($data2=='empty_row'){
						echo "<br> empty_row";
				}
				else{
					$row_data = array(
		          'ID'=> $data2[0],
		   			'firstname' => $data2[1]
		   			);
					array_push($datasend, $row_data);
					echo $data2[0]."\t".$data2[1]."\n";
				}
			
		
			}
			else{
				
				set_time_limit(0);
				//echo $a['tag_no'];
				$table1="tttr_".$glocation;
				$table2="ttlr_".$glocation;
				$data2=$shp->searchtag($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$a['tag_no']);
				if($data2=='empty_row'){
				//echo "<br>"."$i empty_row";
				}
				else{
					$row_data1 = array(
		          'ID'=> $data2[0],
		   			'firstname' => $data2[1]
		   			);
					array_push($datasend, $row_data1);
					//echo $data2[0]."\t".$data2[1]."\n";
				}


				$table1="pttr_".$glocation;
				$table2="ptlr_".$glocation;
				$data2=$shp->searchtag($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$a['tag_no']);
				if($data2=='empty_row'){
						//echo "<br>"."$i empty_row";
				}
				else{
					$row_data2 = array(
		          'ID'=> $data2[0],
		   			'firstname' => $data2[1]
		   			);
					array_push($datasend, $row_data2);
					//echo $data2[0]."\t".$data2[1]."\n";
				}
			}

	}
	//print_r($datasend);
	//$datasendAD= $datasend;
	echo json_encode($datasend);
	$con->mysqlclose();
	unset($con);
	unset($shp);
	}
?>