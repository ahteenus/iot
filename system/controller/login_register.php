<?php
include 'mysql.php';
// The hashed password from the form
$password = $_POST['password']; 
$username =$_POST['username'];
//$email=$_POST[''];
//$password = "090222m"; 
//$username ="090222m";
$email=$username."@ent.mrt.ac.lk";
$user_id="94771155234";
// Create a random salt
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
// Create salted password (Careful not to over season)
$password = hash('sha512', $password.$random_salt);
 
// Add your insert to database script here. 
// Make sure you use prepared statements!
if ($insert_stmt = $mysqli->prepare("INSERT INTO users (username, email, password, user_id, salt) VALUES (?, ?, ?, ?, ?)")) {    
   $insert_stmt->bind_param('sssss', $username, $email, $password, $user_id, $random_salt); 
   // Execute the prepared query.
   $insert_stmt->execute();
   echo "success";
}
?>