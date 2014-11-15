<?php
// Include database connection and functions here.
if (file_exists('config.php')) {
	require_once('config.php');
}
require_once(DIR_DB."/mysql_user_info.php");
require_once(DIR_LOGIN."/login.php");
sec_session_start();

if(login_check($mysqli) == true) {
 
   // Add your protected page content here!
   echo "ReLogin Success"."\t"."NAme";
 
} else {
   echo 'You are not authorized to access this page, please login.';
}
?>