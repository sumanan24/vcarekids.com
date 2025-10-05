<?php
// Show PHP errors during development (can be turned off in production)
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');     
define('DB_PASS', '1234'); 
define('DB_NAME', 'vannitamil_vanni'); 

// Enable mysqli exceptions for clearer error messages
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Connect to the database
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Ensure proper charset
    mysqli_set_charset($con, 'utf8mb4');
} catch (Throwable $e) {
    // Fail fast with a readable message
    die('Database connection failed: ' . $e->getMessage());
}
?>
