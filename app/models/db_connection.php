<?php
$host = "localhost";
$user = "root";
$password = "";
$database_name = "db_hrclarity";

// $host = "localhost";
// $user = "id20793608_root";
// $password = "Admin46_";
// $database_name = "id20793608_hrclarity";

$db_connection = mysqli_connect("$host", "$user", "$password", "$database_name") or die(mysqli_connect_error());
 
