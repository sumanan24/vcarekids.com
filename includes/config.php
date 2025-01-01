<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     
define('DB_PASS', ''); 
define('DB_NAME', 'vannitamil_vanni'); 

// Try to connect to the database
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
