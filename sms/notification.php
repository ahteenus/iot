<?php

include_once 'SmsReceiver.php';
include_once 'SmsSender.php';
include_once 'log.php';
ini_set('error_log', 'sms-app-error.log');


$con1=mysqli_connect("localhost","billz","asdasd","user_info"); // connect to first databse

$con2=mysqli_connect("localhost","billz","asdasd","notification"); // connect to second databse

// sql query to select all columns of priority taglist table with notify = 1 


$current_time= time();

$auto_stop_time= time() + 5*60;

$correct= mysqli_query($con2," SELECT * FROM priority_taglist WHERE autho='NO' AND timetostop BETWEEN 1 AND $current_time ");

        while ($row3= mysqli_fetch_array($correct)) {
            mysqli_query($con2,"UPDATE priority_taglist SET autho='YES', timetostop= 0  WHERE tag_no=$row3[tag_no] ");
        }


$result1 = mysqli_query($con2," SELECT * FROM priority_taglist WHERE notify='1' AND autho='YES'"); 


      while($row1 = mysqli_fetch_array($result1)) // add results to array, and until array ends do following
        {
            echo $row1['user_id'] . " " . $row1['tag_name'] ; 

            $tag_number=$row1['tag_no'];

            $userID = $row1['user_id']; // assign new variables
            $tagNAME = $row1['tag_name'];
            $lastLOCATION= $row1['latest_location'];

            $result2 = mysqli_query($con1, "SELECT * FROM users WHERE user_id='$userID'"); // sql query to select all columns from users table where user id is equal to variable
            $contact;
            while($row2 = mysqli_fetch_array($result2)) // add to array and do following 
                {
                	$contact = $row2['phone'];  // get email
                    $username = $row2['username']; 
                	//echo $contact;
                }
       

           echo $contact;

$sender = new SmsSender("http://api.dialog.lk:8080/sms/send");

    //sending a one message
   $responseMsg="hi $username your $tagNAME has been missing or stolen";
 	$applicationId = "APP_004878";//"APP_004878"
 	$encoding = "0";
 	$version =  "1.0";
    $password = "df4f8d80e05f95cf75af8ffdde862162";
    $sourceAddress = "IOTs";
    $deliveryStatusRequest = "0";
    $charging_amount = ":15.75";
    $destinationAddresses = array("".$contact); // send message to different users
    $binary_header = "";
    $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);

mysqli_query($con2,"UPDATE priority_taglist SET notify='0' WHERE tag_no=$tag_number ");
mysqli_query($con2,"UPDATE priority_taglist SET timetostop= $auto_stop_time , autho='NO' WHERE tag_no=$tag_number ");

}



        //mysqli_query($con2,"UPDATE priority_taglist SET notify='0' "); // change notify column to 0 
        
 

mysqli_close($con1);
mysqli_close($con2);


?>