<?php
$con=mysqli_connect("localhost","billz","asdasd","etm_pl1"); // database name test hosted at localhost

// Check connection
  if (mysqli_connect_errno($con))
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error(); // if fails give error message
    }
  else{
   
}
$tagNo = $_POST["tagno"];
echo $tagNo;
$tagname = $_POST["tagnamenew"];
$prio = $_POST["prioritynew"];
$pririty= 2;
if ($prio == "YES") {
	$pririty= 1;
}elseif ($prio=="NO") {
	$pririty=0;
}
 mysqli_query($con,"UPDATE hetmr SET tag_name='$tagname',priority='$pririty' WHERE tag_no='$tagNo' ");

/*$sql = "update fullnames set firstname='$firstname',lastname='$lastname' where id='$id'";
mysql_query($sql);*/

?>