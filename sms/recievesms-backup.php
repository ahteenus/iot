<?php

        include_once 'SmsReceiver.php';
        include_once 'SmsSender.php';
        include_once 'log.php';
        ini_set('error_log', 'sms-app-error.log');

    ini_set('error_log', 'sms-app-error.log');

    $receiver = new SmsReceiver(); // Create the Receiver object

    $content = $receiver->getMessage(); // get the message content
    $address = $receiver->getAddress(); // get the sender's address
    $requestId = $receiver->getRequestID(); // get the request ID
    $applicationId = $receiver->getApplicationId(); // get application ID
    $encoding = $receiver->getEncoding(); // get the encoding value
    $version = $receiver->getVersion(); // get the version


    $time=time();

    logFile("[ time=$time, content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ]");

    $responseMsg;
    //echo $content;

   /*
    $split = explode(' ', $content);
    $split_number = explode(':', $address); //split address


    $tag= "$split[2] $split[3]"; // set tag name
   $responseMsg =  $split[1];
   $time_to_stop= $split[4];
   $user_iD=  $split_number[1];
    $contentarray = $split[0];
    $store_data= $split[1];
    //echo $responseMsg;
    */
   $responseMsg ="771155234";
/*

    $update_time= time() + $time_to_stop*60*60;



    $con1=mysqli_connect("localhost","billz","asdasd","notification"); 
    mysqli_query($con1,"UPDATE priority_taglist SET autho='$responseMsg', timetostop= '$update_time' WHERE user_id='$user_iD' AND tag_name ='$tag' ");
    */

  

    $sender = new SmsSender("https://api.dialog.lk/sms/send/");

    //sending a one message

    $applicationId = "APP_004878";
    $encoding = "0";
    $version =  "1.0";
    $password = "df4f8d80e05f95cf75af8ffdde862162";
    $sourceAddress = "77160";
    $deliveryStatusRequest = "0";
    $charging_amount = ":2";
    $destinationAddresses = array($address);//array("tel:94771122336");
    $binary_header = "";
    $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);

    $file = fopen("smstest.txt","w");
echo fwrite($file,"Hello World. Testing!".$address.$content.$res);
fclose($file);


?>