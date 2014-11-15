<?php



    $con1=mysqli_connect("localhost","billz","asdasd","notification"); 


    $current_time = time();
    //echo $current_time;

    $futuretime= $current_time + 5*60;
   // echo $futuretime;


   // $get_items= mysqli_query($con1,"SELECT * FROM priority_taglist WHERE timetostop BETWEEN 0 AND $current_time ");
    $get_items= mysqli_query($con1,  "SELECT * FROM priority_taglist WHERE timetostop BETWEEN 0 AND $current_time ");

    while ($row = mysqli_fetch_array($get_items)) {

        //echo $row['tag_name'];
        mysqli_query($con1,"UPDATE priority_taglist SET autho='YES', timetostop= 0  WHERE tag_no=$row[tag_no] ");
    }
  
   
mysqli_close($con1);

?>