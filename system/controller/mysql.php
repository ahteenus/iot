<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "user_info"); // The database username.
define("PASSWORD", "mLR7ZV7HnDsPQ4ts"); // The database password. 
define("DATABASE", "user_info"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// If you are connecting via TCP/IP rather than a UNIX socket remember to add the port number as a parameter.
?>