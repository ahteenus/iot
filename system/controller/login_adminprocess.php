<?php
include 'mysql.php';
include 'login.php';
//sec_session_start(); // Our custom secure way of starting a php session. 
 // Include database connection and functions here.
if(login_check($mysqli) == true) {
 
   // Add your protected page content here!
} else {
  // echo 'You are not authorized to access this page, please login. <br/>';

if(isset($_POST['username'], $_POST['password'])) { 
   $email = $_POST['username'];
   $password = $_POST['password']; // The hashed password.
   if(login($email, $password, $mysqli) == true) {
      // Login success
      echo 'Success: You have been logged in!';
   } else {
      // Login failed
     echo 'Login Failed';
   }
} else { 
   // The correct POST variables were not sent to this page.
   echo 'Invalid Request';
}

}
?>