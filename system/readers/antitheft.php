<?php
class Antitheft {

	function comparelocation($tagno,$tb_name,$con,$db_name,$latest_location_col,$latestlocation){
	
		$constraint="tag_no='".$tagno."'";
		$refferancelocation=$con->getsinglecells($db_name,$tb_name,$latest_location_col,$constraint);
		echo "Antitheft";
		//echo "<br>Antitheft".$refferancelocation["latest_location"];
		//print_r($refferancelocation);
		$gpsref=explode(',',$refferancelocation[$latest_location_col]);
		$gps=explode(',',$latestlocation);

		$gpsref[1]=floatval($gpsref[1]);
		$gpsref[2]=floatval($gpsref[2]);
		$gpsref[3]=floatval($gpsref[3]);
		$gpsref[4]=floatval($gpsref[4]);
		$gpsref[5]=floatval($gpsref[5]);

		$gps[1]=floatval($gps[1]);
		$gps[2]=floatval($gps[2]);
		$gps[3]=floatval($gps[3]);
		$gps[4]=floatval($gps[4]);
		$gps[5]=floatval($gps[5]);

		$a=$gpsref[1]-(($gpsref[4]+$gps[4]+0.000018)/2);
		$b=$gpsref[1]+(($gpsref[4]+$gps[4]+0.000018)/2);
		$c=$gpsref[2]-(($gpsref[4]+$gps[4]+0.000018)/2);
		$d=$gpsref[2]+(($gpsref[4]+$gps[4]+0.000018)/2);
		$e=$gpsref[3]-(($gpsref[5]+$gps[5]+0.000018)/2);
		$f=$gpsref[3]+(($gpsref[5]+$gps[5]+0.000018)/2);

		if($latestlocation==$refferancelocation[$latest_location_col]){
			return '1';
		}
		//else if(  $gps[1] >= $a  && $gps[1] <= $b  &&  $gps[2] >= $c && $gps[2] <= $d && $gps[3] >= $e && $gps[3] <= $f){
		//	return '1';
		//}
		else{
			return '0';
		}
	}
	function notifyuser($db_name,$table,$con,$tag_no,$nofify){
		$contraint="tag_no=".$tag_no;
		$values="notify = $nofify,";
		$values=$values."antitheft = 0";
		$a=$con->storemulticell($db_name,$con,$table,$values,$contraint);
		return $a;
	}

}
?>