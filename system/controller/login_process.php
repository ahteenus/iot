<?php
if (file_exists('config.php')) {
	require_once('config.php');
}
require_once(DIR_DB."/mysql_user_info.php");
require_once(DIR_LOGIN."/login.php");
sec_session_start(); // Our custom secure way of starting a php session. 
 // Include database connection and functions here.
 
if(login_check($mysqli) == true) {
 
   // Add your protected page content here!
   echo "Earlier Login". "\t"."NAme";
   
} else {
$a="361b532f4113639d172883622cf9d71dc0d62a3e1e4ce906cd11eb77e2dcedbcc011f1db63262e65bacaf3eb13dd71909e8b2754b1e9f04cf5b112c5c2213c42";
//$b="090222m";
  // echo 'You are not authorized to access this page, please login. <br/>';
//echo "$c";
if(isset($_POST['username'], $_POST['password'])) { 
   $email = $_POST['username'];
   $password = $_POST['password']; // The hashed password.
   if(login($email, $password, $mysqli) == true) {
      // Login success
      echo 'Success: You have been logged in!'. "\t"."NAme";
   } else {
      // Login failed
     echo $password.'Login Failed'. "\t"."NAme".$a;
     //echo $email;
     //echo $password;
   }
} else { 
   // The correct POST variables were not sent to this page.
   echo 'Invalid Request'. "\t"."NAme";
}

}
?>