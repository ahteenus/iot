<?php
		include_once 'SmsReceiver.php';
		include_once 'SmsSender.php';
		include_once 'log.php';
		ini_set('error_log', 'sms-app-error.log');



		$con1=mysqli_connect("localhost","billz","asdasd","notification"); // connect to notification databse
		$con=mysqli_connect("localhost","billz","asdasd","user_info"); // connect to User_info databse
		

		$time= time();
		$ten= 10;
		$use_time = $time - $ten;
		$Time = (string)$use_time;
		$state= 0;
		$forgot_items= array(); // create array
		$i=0;


		$get_user_ids= mysqli_query($con1,  "SELECT * FROM car_taglist WHERE notify BETWEEN 2 AND $use_time ");

		while ($row3 = mysqli_fetch_array($get_user_ids) ) {

			$state= 1;

			$userID= $row3['user_id'];
			$result_get_contact = mysqli_query($con, "SELECT * FROM users WHERE user_id='$userID'"); // sql query to select all columns from users table where user id is equal to variable
			$contact;
		      while($row2 = mysqli_fetch_array($result_get_contact)) // add to array and do following 
		          {
		          	$contact = $row2['phone'];  // get contact  number
		          	$username = $row2['username'];
		          	echo $contact;
		          	echo "<br>";
		          }


			$result_from_userid = mysqli_query($con1," SELECT * FROM car_taglist WHERE user_id= '$userID'");


			while($row = mysqli_fetch_array($result_from_userid)) // add results to array, and until array ends do following
			  	{
			  		if($row['status']=='1')
			  		{
			  			

			  		}
			  		elseif($row['status']=='0')
			  		{
			  			echo "this item is not with you " .$row['tag_name'];
			  			$forgot_items[$i]=$row['tag_name']; // adding data into array
			  			$i = $i+1; // increment of array index
			  			//$missing_item= $row['tag_name'];
			  			echo "<br>"; 
			  			//echo "$i"; 
			  			echo "<br>";  
					          
			        }
				}

				echo $contact;
				$length_of_array= sizeof($forgot_items); // get length of array
				echo "<br>";
				$all_missing_items=""; 

				$list_of_data=join(', ', $forgot_items);

					$sender = new SmsSender("http://api.dialog.lk:8080/sms/send");

    //sending a one message
   $responseMsg=" $username you have forgotten to bring following items  $list_of_data  IOT TEAM";
 	$applicationId = "APP_004878";
 	$encoding = "0";
 	$version =  "1.0";
    $password = "df4f8d80e05f95cf75af8ffdde862162";
    $sourceAddress = "IOTs";
    $deliveryStatusRequest = "0";
    $charging_amount = ":15.75";
    $destinationAddresses = array("".$contact); // send message to different users
    $binary_header = "";
    $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);





				/*$sender = new SmsSender("https://localhost:7443/sms/send");
				
    	//sending a one message
	   	$responseMsg=" $userID you have forgotten to bring following items <br> $list_of_data <br> <br> IOT TEAM";
	 	$applicationId = "APP_000001";
	 	$encoding = "0";
	 	$version =  "1.0";
	    $password = "password";
	    $sourceAddress = "77000";
	    $deliveryStatusRequest = "1";
	    $charging_amount = ":15.75";
	    $destinationAddresses = array("tel:$contact"); // send message to different users
	    $binary_header = "";
	    $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);*/

	    	mysqli_query($con1,"UPDATE car_taglist SET notify='0' ");



		}






		if ($state==1) {
			mysqli_query($con1,"UPDATE car_taglist SET notify='-1',status='0' WHERE user_id= '$userID'");

		}
		
		//mysqli_query($con1,"UPDATE car_taglist SET status='0' ");

		mysqli_close($con1);
?>