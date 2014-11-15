<?php
if (file_exists('C:\xampp\htdocs/mythings/system/controller/config.php')) {
		require_once('C:\xampp\htdocs/mythings/system/controller/config.php');
		//echo $_SERVER['SERVER_NAME'];
}


require_once(DIR_DB."/mysql_user_info.php");
require_once(DIR_DB."/mysql_reader.php");
require_once(DIR_DB."/mysql_connect.php");
require_once(DIR_ATTENDANCE."/attendancesearch.php");
date_default_timezone_set('Asia/Colombo');

	//$lecturehall= $_GET["searchDATA"]; // get search word to variable
	/*$lecturehall = "entc1";
	$timefrom=time()-24*60*60;
	$timeto=time();
*/

	$lecturehall=$_GET["lacturehallname"]; // get search word to variable
	

	$time1= $_GET["Stimefrom"];
	$time2= $_GET["Stimeto"];

	$date1= $_GET["date"];
	
	
	$timef = "$date1 $time1"; 
	$timet = "$date1 $time2";
	//echo $lecturehall;
	//echo $timef;


	$timefrom= strtotime("$timef"); // make time stamp
	$timeto= strtotime("$timet");
	

	//echo $timeto;

	
	$datasend = array();

    $con = new Mysql(HOST,USER,PASSWORD);

    if (!$con) {
		die('Could not connect: '.mysql_error());
	}
	else{

		$ashp = new Attendancesearch();
		$ashp->setuser_id_col('user_id');
		$ashp->setlecturehall($lecturehall);
		$ashp->settag_name_col('tag_name');
		$ashp->settag_no_col('tag_no');
		$ashp->setlocation_col('location');
		$ashp->setunique_id_col('unique_id');

		$a=session_id();
		$uid=94773151569;
		if ($a == ''){ 
			session_start();
			//$uid= $_SESSION["user_id"];
			//$uid=94771155234;
			//$uid=94773151569;
		}

		$readerstatus=$ashp->mapping_lecture_hall(ATTENDANCE,LECHALLMAP,'lecture_hall',$uid,$con);

		if($readerstatus=='no_reader'){
			echo "no_reader";
		}
		else {
		//get reader group
			//echo $ashp->getreadernumber();
			$place=$ashp->get_reader_info(READERINFO,READERPUBLIC,$con,$uid,'reader_no');
			//echo $ashp->getgroupnumber();

			if($timeto > time()-24*60*60){

				$table1="tttr_".$ashp->getgroupnumber();
				$table2="ttlr_".$ashp->getgroupnumber();
				$data2=$ashp->search_data($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$ashp->getlocation(),$uid,$timefrom,$timeto);
				//print_r($data2);
				if($data2=='empty_row'){
					echo "<br>"."empty_row";
				}
				else{

					$datasend=$ashp->gettagname(EPCTAGMAPPING,'hetmr',$data2,$con,$uid);
					//echo $data2[0]."\t".$data2[1]."\n";
				}
			}
			else if($timefrom < time()-24*60*60){

				$table1="pttr_".$ashp->getgroupnumber();
				$table2="ptlr_".$ashp->getgroupnumber();

				$data2=$ashp->search_data($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$ashp->getlocation(),$uid,$timefrom,$timeto);
				//print_r($data2);
				if($data2=='empty_row'){
					echo "<br>"."empty_row";
				}
				else{

					$datasend=$ashp->gettagname(EPCTAGMAPPING,'hetmr',$data2,$con,$uid);
					//echo $data2[0]."\t".$data2[1]."\n";
				}
		
			}
			else{
				$table1="tttr_".$ashp->getgroupnumber();
				$table2="ttlr_".$ashp->getgroupnumber();
				$data2=$ashp->search_data($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$ashp->getlocation(),$uid,$timefrom,$timeto);
				//print_r($data2);
				if($data2=='empty_row'){
					echo "<br>"."empty_row";
				}
				else{

					$datasend1=$ashp->gettagname(EPCTAGMAPPING,'hetmr',$data2,$con,$uid);
					//echo $data2[0]."\t".$data2[1]."\n";
				}
				array_push($datasend,$datasend1);
				$table1="pttr_".$ashp->getgroupnumber();
				$table2="ptlr_".$ashp->getgroupnumber();

				$data2=$ashp->search_data($con,TIMEREGISTER,$table1,LOCATIONREGISTER,$table2,$ashp->getlocation(),$uid,$timefrom,$timeto);
				//print_r($data2);
				if($data2=='empty_row'){
					echo "<br>"."empty_row";
				}
				else{

					$datasend2=$ashp->gettagname(EPCTAGMAPPING,'hetmr',$data2,$con,$uid);
					//echo $data2[0]."\t".$data2[1]."\n";
				}
				array_push($datasend,$datasend2);

			}

		}
			//print_r($datasend);
			$datasend10 = array();
			foreach ($datasend as $j) {
				if(floatval($j['count']) >1){
					array_push($datasend10,$j);
				}
			}
			echo json_encode($datasend10);
			$con->mysqlclose();
			unset($con);
			unset($ashp);
	}
?>
