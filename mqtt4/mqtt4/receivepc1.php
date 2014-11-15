<?php
require('SAM/php_sam.php');
define("SAM_HOST" , "SAM_HOST");
define("SAM_PORT" , "SAM_PORT");
define("SAM_WAIT" ,"SAM_WAIT" );
define("SAM_MQTT_QOS" ,"SAM_MQTT_QOS" );
//create a new connection object
$conn = new SAMConnection();

//start initialise the connection
$conn->connect(SAM_MQTT, array( SAM_HOST => "test.mosquitto.org",
                                 SAM_PORT => 1883));

//subscribe to topic cpu
    $subUp = $conn->subscribe('topic://cpupc1-asitha',array( SAM_WAIT => 1, SAM_MQTT_QOS => 0)) OR die('could not subscribe');

//print confirmation to terminal
 echo "subscribed";
$i=0;
$prev="";
while($conn)
{
	
       //receive latest message on topic $subUp
       $msgUp = $conn->receive($subUp);
	     //if($msgUp==true)
			 /* echo $conn->errno;
			 echo $conn->error;
			 echo $conn->debug; */
       //if there is a message
  if($msgUp){
  if (!$msgUp->body=="")
  {
          //echo message to terminal
   // echo $msgUp->body;

         //if ($msgUp->body!=$prev)
      //  {
        $url="http://localhost/mythings/system/controller/reader_process.php";
        $ch = curl_init();
        $data4=explode(',',$msgUp->body);
        if($data4[4]=="2")
          $url="http://localhost/mythings/system/controller/carcheck_process.php";

        if($data4[4]=="3")
          $url="http://localhost/mythings/system/controller/kitchen_process.php";

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,"epc=value1&readerID=value2&time=value3");
        $epc=doubleval($data4[1]);
        $readerID=$data4[2];
        $time=doubleval($data4[3]);

       echo "--------".$epc."-----".$readerID."--------".$time."------------".$data4[4];

        // in real life you should use something like:
       $st="";
       if(isset($data4[5])){
          $st=$data4[5];
          echo $st;
       }
       if($data4[4]=="2" & $st=="start")
         curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('epc' => $epc ,'readerID' => $readerID ,'time' => $time,'carstart' => $data4[4] )));
       else
          curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('epc' => $epc ,'readerID' => $readerID ,'time' => $time )));
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

//}
//$prev=$msgUp->body;

 }
}

        //wait 1s
       // sleep(3);
        //$i++;
}

?>