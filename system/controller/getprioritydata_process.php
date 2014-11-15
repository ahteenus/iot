<?php
$con=mysqli_connect("localhost","user_info","mLR7ZV7HnDsPQ4ts","notification"); // database name test hosted at localhost

// Check connection
  if (mysqli_connect_errno($con))
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error(); // if fails give error message
    }
  else{
    $a=session_id();
  if ($a == ''){ 
    session_start();
    $uid= $_SESSION["user_id"];
  }
  	$sql = "SELECT * FROM priority_taglist WHERE user_id='$uid'";
 
 	// run sql function
 	$result = mysqli_query($con,$sql);
 
 	// new array
 	$data = array();

 	//loop create an array with all alements of the table
 	while($row = mysqli_fetch_array($result)){
    set_time_limit(0);
  			$row_data = array(
          'ID'=> $row['tag_no'],
   			'firstname' => $row['tag_name'], 
   			'lastname' => $row['latest_location'],
    		
   	);

  // push row data array to array			
  array_push($data, $row_data);
 }
 
 // encode with jason format and now available
 echo json_encode($data);

 



 mysqli_close($con); // close the connection

}
?>