<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_hrclarity';

// Try connecting with the local credentials
$db_connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection failed
if (!$db_connection) {
    // Fallback to online credentials
    $host = 'localhost';
    $username = 'id20793608_root';
    $password = 'Admin46_';
    $database = 'id20793608_hrclarity';
    
    // Connect using online credentials
    $db_connection = mysqli_connect($host, $username, $password, $database);

    // Check if the connection still fails
    if (!$db_connection) {
        die('Failed to connect to the database.');
    }
}

// Connection succeeded, continue with your code...
?>
