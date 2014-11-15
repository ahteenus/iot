<?php
if (file_exists('C:\xampp\htdocs/mythings/system/controller/config.php')) {
		require_once('C:\xampp\htdocs/mythings/system/controller/config.php');
		//echo $_SERVER['SERVER_NAME'];
	}
	require_once(DIR_DB."/mysql_user_info.php");
	require_once(DIR_DB."/mysql_reader.php");
	require_once(DIR_DB."/mysql_connect.php");
	require_once(DIR_CAR."/carchecklisttags.php");

    $con = new Mysql(HOST,USER,PASSWORD);
    if (!$con) {
		die('Could not connect: '.mysql_error());
	}
	else{
		$con->deletetable(USER_INFO,USER_PLACES);
		$data=array();
		$db_name=EPCTAGMAPPING;
		$tables=$con->gettables($db_name);
		//print_r($tables);
		foreach ($tables as $tb_name) {
			set_time_limit(0);
			if($tb_name=="hetmr"){
				//echo $tb_name;
			}
			else{
				//echo $tb_name;
				$constraint="tag_no LIKE '%001' AND counter > 2";
				$d=$con->getrowscounter($db_name,$tb_name,$constraint);

				foreach($d as $b){
					set_time_limit(0);
					print_r($b);
					echo "<br/>";
					$columns="user_id,place,count";
					$values="'".$b['user_id']."','".$b['priorityplace']."','".$b['counter']."'";
					$ret=$con->storesinglerow(USER_INFO,USER_PLACES,$columns,$values);
					
				}
			}
		}

		//priority places insert and user_place table empty

	}
?>