<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oshan
 * Date: 3/14/13
 * Time: 10:40 AM
 * To change this template use File | Settings | File Templates.
 */

include_once 'lib/lbs/LbsClient.php';
include_once 'lib/lbs/LbsRequest.php';
include_once 'lib/lbs/LbsResponse.php';
include_once "lib/lbs/KLogger.php";
include 'conf/lbs-conf.php';

if (file_exists('C:\xampp\htdocs/mythings/system/controller/config.php')) {
		require_once('C:\xampp\htdocs/mythings/system/controller/config.php');
		//echo $_SERVER['SERVER_NAME'];
}
	require_once(DIR_DB."/mysql_user_info.php");
	require_once(DIR_DB."/mysql_reader.php");
	require_once(DIR_DB."/mysql_connect.php");
	require_once(DIR_READER."/tag.php");
	require_once(DIR_READER."/antitheft.php");
while(1){
$db_name="etm_pl1";
$tb_name="hetmr";
$constraint="type='PHONE'";
$con = new Mysql(HOST,USER,PASSWORD);

$query="SELECT epc FROM $tb_name WHERE ".$constraint;
	
$data=array();

$a=mysql_select_db($db_name,$con->getcon());
	if($a){
		$result=mysql_query($query);
		while($row = mysql_fetch_assoc($result)){
			set_time_limit(0);
			if(!$row){
				//return "empty_cell"; //search row error
			}
			else{
			//	$row1['counter']=$row['counter'];
				//$row['epc']=substr($tb_name,6,strlen($tb_name));
				array_push($data, $row['epc']);
			}
		}
		//print_r($data);
	}
$data2=array();

foreach ($data as $key => $value) {
	
$db_name="user_info";
$tb_name="users";
$constraint="phone='$value'";
//$con = new Mysql(HOST,USER,PASSWORD);

$query="SELECT encrypted_phone FROM $tb_name WHERE ".$constraint;


$a=mysql_select_db($db_name,$con->getcon());
	if($a){
		$result=mysql_query($query);
		$row = mysql_fetch_assoc($result);
			set_time_limit(0);
			if(!$row){
				//return "empty_cell"; //search row error
			}
			else{
			//	$row1['counter']=$row['counter'];
				//$row['epc']=substr($tb_name,6,strlen($tb_name));
				array_push($data2, $row['encrypted_phone']);
			}
		//}
		//print_r($data2);
	}
}
$con->mysqlclose();

$data3=array();
foreach ($data2 as $key => $value) {

$log = new KLogger ( "lbs_debug.log" , KLogger::DEBUG );

$subscriberId = "tel:".$value;
$log->LogDebug("Received msisdn = ".$subscriberId);

$LBS_QUERY_SERVER_URL='http://127.0.0.1:7000/lbs/locate';
$APP_ID="APP_001768";
$PASSWORD="729fdf8ea178cdea9857eeb9a059fd6e";
$SERVICE_TYPE="IMMEDIATE";
$FRESHNESS="HIGH";
$HORIZONTAL_ACCURACY="1500";
$RESPONSE_TIME="NO_DELAY";

$request = new LbsRequest($LBS_QUERY_SERVER_URL);
$request->setAppId($APP_ID);
$request->setAppPassword($PASSWORD);
$request->setSubscriberId($subscriberId);
$request->setServiceType($SERVICE_TYPE);
$request->setFreshness($FRESHNESS);
$request->setHorizontalAccuracy($HORIZONTAL_ACCURACY);
$request->setResponseTime($RESPONSE_TIME);

function getModifiedTimeStamp($timeStamp){
    try {
        $date= new DateTime($timeStamp,new DateTimeZone('Asia/Colombo'));
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
    return $date->format('Y-m-d H:i:s');
}

$lbsClient = new LbsClient();
$lbsResponse = new LbsResponse($lbsClient->getResponse($request));
$lbsResponse->setTimeStamp(getModifiedTimeStamp($lbsResponse->getTimeStamp()));//Changing the timestamp format. Ex: from '2013-03-15T17:25:51+05:30' to '2013-03-15 17:25:51'
$log->LogDebug("Lbs response:".$lbsResponse->toJson());
$gps= $lbsResponse->toJson();
//$gps=$data[$key].",".$gps;
array_push($data3, $gps);
}
//print_r($data3);

foreach ($data3 as $key => $value) {
$data4=explode(',',$value);
//print_r($data4);
$epc=$data[$key];
echo $epc;
$time=time();//explode(':',$data4[1]);
$h=explode('"',$data4[4]);
$x=explode('"',$data4[7]);
$y=explode('"',$data4[6]);
$h=floatval($h[3]);
//print_r($h[3]);
$gps="s,".$x[3].",".$y[3].",0,0,0,No Des";
//echo $gps;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://localhost/mythings/system/controller/node_process.php");
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS,"epc=value1&gps=value2&time=value3");

// in real life you should use something like:
 curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('epc' => $epc,'gps' => $gps,'time' => $time)));
// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

$server_output = curl_exec ($ch);

curl_close ($ch);

/*
$a=exec ("C:\xampp\php\php.exe -f C:\xampp\htdocs\mythings\controller\node_process.php $epc $gps $time" );
echo $a;
*/
}

sleep(300);
}

?>
