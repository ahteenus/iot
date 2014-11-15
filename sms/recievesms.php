<?php
/**
 *   (C) Copyright 1997-2013 hSenid International (pvt) Limited.
 *   All Rights Reserved.
 *
 *   These materials are unpublished, proprietary, confidential source code of
 *   hSenid International (pvt) Limited and constitute a TRADE SECRET of hSenid
 *   International (pvt) Limited.
 *
 *   hSenid International (pvt) Limited retains all title to and intellectual
 *   property rights in these materials.
 */
if (file_exists('C:\xampp\htdocs/mythings/system/controller/config.php')) {
        require_once('C:\xampp\htdocs/mythings/system/controller/config.php');
        //echo $_SERVER['SERVER_NAME'];
}
require_once(DIR_DB."/mysql_user_info.php");
require_once(DIR_DB."/mysql_reader.php");
require_once(DIR_DB."/mysql_connect.php");
require_once(DIR_CAR."/carchecklisttags.php");
include_once 'SmsReceiver.php';
include_once 'SmsSender.php';
include_once 'log.php';
ini_set('error_log', 'sms-app-error.log');
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
try {
    $receiver = new SmsReceiver(); // Create the Receiver object

    $content = $receiver->getMessage(); // get the message content
    $address = $receiver->getAddress(); // get the sender's address
    $requestId = $receiver->getRequestID(); // get the request ID
    $applicationId = $receiver->getApplicationId(); // get application ID
    $encoding = $receiver->getEncoding(); // get the encoding value
    $version = $receiver->getVersion(); // get the version

    

    $responseMsg;

    //your logic goes here......
    $split = explode(' ', $content);
  $responseMsg =LogicHere($split,$address);
   //$responseMsg="sjdhsdhjsdjsdh";
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
    // Create the sender object server url
    $sender = new SmsSender("http://api.dialog.lk:8080/sms/send");

    //sending a one message

    //$applicationId = "APP_004878";
    //$encoding = "0";
    //$version =  "1.0";
    $password = "df4f8d80e05f95cf75af8ffdde862162";
    $sourceAddress = "IOTs";
    $deliveryStatusRequest = "0";
    $charging_amount = ":0";
    $destinationAddresses = array("".$address);
    $binary_header = "";
    $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);


logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ,res=$res]");


} catch (SmsException $ex) {
    //throws when failed sending or receiving the sms
    error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}

/*
    BMI logic function
**/

function LogicHere($split,$address)
{
    $responseMsg="start";
    
    if (sizeof($split) < 2) {
        $responseMsg = "Invalid message content";
    } 
    else {
        if($split[1]=="reg"){

            $con1=mysqli_connect("localhost","billz","asdasd","user_info"); 
            $a=mysqli_query($con1,"UPDATE users SET phone= '$address' WHERE username ='".$split[2]."' ");

            $responseMsg ="your reg success-$a-";
        }
        /*
        else if($split[1]="stop"){
            if(sizeof($split)>2 & is_double(floatval($split[3]))){

                $epc = $split[2];
                $readerno =1;
                $time=time();
                $mapinfo=$crdp->map_epc_tagno($con,EPCTAGMAPPING);
                $con = new Mysql(HOST,USER,PASSWORD);
                if (!$con) {
                    die('Could not connect: '.mysql_error());
                }
                else{
                $crdp = new Carchecklisttags();
                $crdp->setepc($epc);
                $crdp->setreadernumber($readerno);
                $crdp->settag_time($time);
                $info=$crdp->check_reader_location($con,READERINFO,READERPUBLIC,READERNO);
                
                $mapinfo=$crdp->map_epc_tagno($con,EPCTAGMAPPING);
                $tag_no=$crdp->gettag_no();
             
                $con->mysqlclose();
                unset($con);
                unset($crdp);
                $time_to_stop=floatval($split[3]);
                if($time_to_stop>0)
                    $update_time= $time + $time_to_stop*60*60;
                else
                    $update_time= $time + 60*60;
                $con1=mysqli_connect("localhost","billz","asdasd","notification"); 
                mysqli_query($con1,"UPDATE priority_taglist SET autho='NO', timetostop= '$update_time' WHERE tag_no ='$tag_no' ");
                $responseMsg ="your stop success--";
                //echo "user_id:".$crdp->getreaderowner();
            }
        }
        */
        else{
            $responseMsg ="your";
        }

    }
    
    return $responseMsg;
}



?>