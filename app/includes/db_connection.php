<?php
$host = "localhost";
$user = "root";
$password = "";
$database_name = "db_nhrms";

$db_conn = mysqli_connect("$host", "$user", "$password", "$database_name") or die(mysqli_connect_error());
?>