<?php



    $tag= "my wallet"; // set tag name
   ///$responseMsg =  $split[1];
   //$time_to_stop= $split[4];
   $user_iD= "94773151569";
    //$contentarray = $split[0];
    //$store_data= $split[1];
    //echo $responseMsg;
    $responseMsg = $user_iD;


    $update_time= time() + 0*60*60;



    $con1=mysqli_connect("localhost","billz","asdasd","notification"); 
    mysqli_query($con1,"UPDATE priority_taglist SET autho='$responseMsg', timetostop= '$update_time' WHERE user_id='$user_iD' AND tag_name ='$tag' ");

  
    



?>