<?php

if (file_exists('C:\xampp\htdocs/mythings/system/controller/config.php')) {
		require_once('C:\xampp\htdocs/mythings/system/controller/config.php');
		//echo $_SERVER['SERVER_NAME'];
	}
	require_once(DIR_DB."/mysql_user_info.php");
	require_once(DIR_DB."/mysql_reader.php");
	require_once(DIR_DB."/mysql_connect.php");
	require_once(DIR_KITCHEN."/kitchenchecklisttags.php");
	$epc = $_POST["epc"];
   	$readerno = $_POST["readerID"];
	$time=$_POST["time"];
	//$epc = 120;
    //$readerno =6;
	//$time=time();
    $con = new Mysql(HOST,USER,PASSWORD);
    if (!$con) {
		die('Could not connect: '.mysql_error());
	}
	else{
	$crdp = new Kitchenchecklisttags();
	$crdp->setepc($epc);
	$crdp->setreadernumber($readerno);
	$crdp->settag_time($time);
	$info=$crdp->check_reader_location($con,READERINFO,READERPUBLIC,READERNO);
	
	$mapinfo=$crdp->map_epc_tagno($con,EPCTAGMAPPING);
	echo "tag_no:".$crdp->gettag_no();
	//echo "user_id:".$crdp->getreaderowner();
	
	if($crdp->getkitchencheck()==1){
		echo "store last read time";
	   $a=$crdp->store_kitchenchecktagdata(NOTIFICATION,"kitchen_taglist",$con);
	   echo $a;
	}

//	$rat = new Antitheft();
//	$aaa=$rat->comparelocation($rdp->getuser_id()."001","priority_taglist",$con,NOTIFICATION,"latest_location",$rdp->getlocation());
	//if($aaa=='0'){ //o means that the tag location is different from in its piority tag group
		//$nnn=$rat->notifyuser(NOTIFICATION,"priority_taglist",$con,$rdp->gettag_no(),"1");
	//}
	//echo $crdp->gettag_no();
	//echo $crdp->getreaderowner()."001";
	/*if($crdp->gettag_no()==$crdp->getreaderowner()."001"){
		echo "store ref receive";
	   $a=$crdp->store_carcheckref(NOTIFICATION,"car_taglist",$con);
	   echo $a;
	}
		
	*/
	

	
	}



	echo $epc."Process";
	$con->mysqlclose();
	unset($con);
	unset($crdp);
?>