<?php
sleep (0); //wait 30 seconds
// rest of code gose here

/////////////////////////////////////// mail sending setting up//////////////////////////////////////////////////////////////////////////////
require("class.phpmailer.php");
$mail = new PHPMailer();
set_time_limit (60); // increase php time out
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "smtp.gmail.com"; // SMTP server
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Port       = 465;  
$mail->Username   = "tharaka.koggalahewa@gmail.com";  // GMAIL username
$mail->Password   = "12abAB!@";  
$mail->From       = "tharaka.koggalahewa@gmail.com";
$mail->FromName   = "Iot Team";

$mail->Subject    = "Missing Item";
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$userID = "94771155234"; // imported user name 

$con1=mysqli_connect("localhost","root","","notification"); // connect to notification databse
$con=mysqli_connect("localhost","root","","user_info"); // connect to User_info databse

 $result_get_contact = mysqli_query($con, "SELECT * FROM users WHERE user_id='$userID'"); // sql query to select all columns from users table where user id is equal to variable

      while($row2 = mysqli_fetch_array($result_get_contact)) // add to array and do following 
          {
          	$contact = $row2['email'];  // get email
          	echo $contact;
          	echo "<br>";
          }


$result_from_userid = mysqli_query($con1," SELECT * FROM car_taglist WHERE user_id= '$userID'");


while($row = mysqli_fetch_array($result_from_userid)) // add results to array, and until array ends do following
  	{
  		if($row['status']=='1')
  		{
  			echo "this item is with user " .$row['tag_name'];
  			echo "<br>";

  		}
  		elseif($row['status']=='0')
  		{
  			echo "this item is not with you " .$row['tag_name'];
  			$missing_item= $row['tag_name'];
  			echo "<br>";

  			//////////////////////////////////////email sending part////////////////////////////////////////////////////////////////////////////
		      $mail->ClearAddresses();
		      $mail->AddAddress($contact);
		      $mail->Body     = "Hi! \n\n your "  .$missing_item .  " is not with you please check";
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
		          $mail->ClearAddresses(); //clear all recipient before next iteration
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  		}
	}
mysqli_close($con1);

?>