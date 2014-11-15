<?php
		


		$con1=mysqli_connect("localhost","billz","asdasd","notification"); // connect to notification databse
		$con=mysqli_connect("localhost","billz","asdasd","user_info"); // connect to User_info databse
		

		$time= time();

		$ten= 0;

		$use_time = $time - $ten;

		$Time = (string)$use_time;

		$get_user_ids= mysqli_query($con1,  "SELECT * FROM car_taglist WHERE notify BETWEEN 2 AND $use_time ");

		while ($row3 = mysqli_fetch_array($get_user_ids) ) {

			$userID= $row3['user_id'];
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
			  			

			  		}
			  		elseif($row['status']=='0')
			  		{
			  			echo "this item is not with you " .$row['tag_name'];
			  			$missing_item= $row['tag_name'];
			  			echo "<br>";

			  			
					      

					     
					          
			        }
				}
		}
		mysqli_query($con1,"UPDATE car_taglist SET notify='0' ");

		
		mysqli_close($con1);
?>