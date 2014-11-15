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
	
    $epc = $_POST["epc"];
    $gps =$_POST["gps"];
	$time=$_POST["time"];
	//$time=time();//$_POST["time"];
    $con = new Mysql(HOST,USER,PASSWORD);
    if (!$con) {
		die('Could not connect: '.mysql_error());
	}
	else{
	$rdp = new Tag();
	$rdp->setepc($epc);
	$rdp->setlocation($gps);
	$rdp->settag_time($time);
	$info=$rdp->check_gps_reader_group($con,READERINFO,"readergroup_gps_table","reader_group");
	
	$mapinfo=$rdp->map_epc_tagno($con,EPCTAGMAPPING);
	//echo "tag_no:".$rdp->gettag_no();
	$id=time();
	//echo $time."  ".$rdp->getuser_id();
	$rdp->store_time(TIMEREGISTER,$con,$id);
	$rdp->store_location(LOCATIONREGISTER,$con,$id);
	
	}
	if($rdp->getpriority()==1){
		$rdp->store_prioritytagdata(NOTIFICATION,"priority_taglist",$con);
	}
	if ($rdp->gettag_no() !=$rdp->getuser_id()."001") {
		
	
	$rat = new Antitheft();
	$aaa=$rat->comparelocation($rdp->getuser_id()."001","priority_taglist",$con,NOTIFICATION,"latest_location",$rdp->getlocation());
	if($aaa=='0'){ //o means that the tag location is different from in its piority tag group
		$nnn=$rat->notifyuser(NOTIFICATION,"priority_taglist",$con,$rdp->gettag_no(),"1");
	}
	else{
		$nnn=$rat->notifyuser(NOTIFICATION,"priority_taglist",$con,$rdp->gettag_no(),"0");
	}


	}
	echo $epc."Process";
	$con->mysqlclose();
	unset($con);
	unset($rdp);
?>