<?php

/////////////////////////////////////// mail sending setting up//////////////////////////////////////////////////////////////////////////////
require("class.phpmailer.php");
$mail = new PHPMailer();
set_time_limit (50); // increase php time out
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "smtp.gmail.com"; // SMTP server
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Port       = 465;  
$mail->Username   = "tharaka.koggalahewa@gmail.com";  // GMAIL username
$mail->Password   = "12abAB!@";  
$mail->From       = "tharaka.koggalahewa@gmail.com";
$mail->FromName   = "Iot Team";

$mail->Subject    = "test message";
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$con1=mysqli_connect("localhost","billz","asdasd","user_info"); // connect to first databse

$con2=mysqli_connect("localhost","billz","asdasd","notification"); // connect to second databse



$result1 = mysqli_query($con2," SELECT * FROM priority_taglist WHERE notify='1'"); // sql query to select all columns of priority taglist table with notify = 1 



      while($row1 = mysqli_fetch_array($result1)) // add results to array, and until array ends do following
        {
            echo $row1['user_id'] . " " . $row1['tag_name'] ; 

            $userID = $row1['user_id']; // assign new variables
            $tagNAME = $row1['tag_name'];
            $lastLOCATION= $row1['latest_location'];

            $result2 = mysqli_query($con1, "SELECT * FROM users WHERE user_id='$userID'"); // sql query to select all columns from users table where user id is equal to variable

            while($row2 = mysqli_fetch_array($result2)) // add to array and do following 
                {
                	$contact = $row2['email'];  // get email
                	//echo $contact;
                }
       

            echo $contact;
            echo "<br>";

       //////////////////////////////////////email sending part////////////////////////////////////////////////////////////////////////////
            $mail->ClearAddresses();
            $mail->AddAddress($contact);
            $mail->Body     = "Hi! \n\n your "  .$tagNAME .  " has been stolen";
            $mail->WordWrap = 50;

            if(!$mail->Send()) 
                {
                  echo 'Message was not sent.';
                  echo 'Mailer error: ' . $mail->ErrorInfo;
                } 
                else 
                {
                  echo 'Message has been sent.';
                }
                $mail->ClearAddresses();
              /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }



        mysqli_query($con2,"UPDATE priority_taglist SET notify='0' "); // change notify column to 0 
        
 

mysqli_close($con1);
mysqli_close($con2);



?>