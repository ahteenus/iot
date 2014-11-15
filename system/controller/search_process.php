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
	require_once(DIR_SEARCH."/search.php"); 
   // $tagname = $_POST['keyword'];
	$tagname= $_GET["searchDATA"]; // get search word to variable
	//$tagname = "my watch";
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
		$uid= $_SESSION["user_id"];
		//echo $uid;
		//$uid=94771155234;//$_SESSION['user_id'];
	}
	$a=$shp->gettagno(EPCTAGMAPPING,"hetmr",$tagname,$con,$uid);
	if($a=='empty_cell'){
		//echo $a;
	}
	else {
		//search latest location
		$pplaces=$shp->getpriorityplaces(USER_INFO,'user_priority_places',$con,$a['user_id']);
		//$data1=$shp->searchtagpriority($con,NOTIFICATION,"priority_taglist",$a['tag_no']);
		//if($data1=='empty_cell'){

		//}
		//else{
			//$row_data = array(
         // 'ID'=> $data1['time'],
   		//	'firstname' => $data1['place']
   			//);
			//array_push($datasend, $row_data);
			//echo $data1['time']."\t".$data1['place']."\n";
		//}
		// search immediate locations
		for($i=1; $i<count($pplaces); $i++){
		set_time_limit(0);
		$p="place_".$i;
		$table1="tttr_".$pplaces[$p];
		$table2="ttlr_".$pplaces[$p];
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
		}

		for($i=1; $i<count($pplaces); $i++){
		set_time_limit(0);
		$p="place_".$i;
		$table1="pttr_".$pplaces[$p];
		$table2="ptlr_".$pplaces[$p];
		$data2=$shp->searchtag($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$a['tag_no']);
		if($data2=='empty_row'){
				//echo "<br>"."$i empty_row";
		}
		else{
			$row_data = array(
          'ID'=> $data2[0],
   			'firstname' => $data2[1]
   			);
			array_push($datasend, $row_data);
			//echo $data2[0]."\t".$data2[1]."\n";
		}
		}

	}
	echo json_encode($datasend);
	$con->mysqlclose();
	unset($con);
	unset($shp);
	}
?>