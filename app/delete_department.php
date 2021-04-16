<?php
include_once 'includes/db_connection.php';
if(isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    $sql = "DELETE FROM departments WHERE id = $id";
    mysqli_query($db_conn, $sql) or die(mysqli_error($db_conn));
    mysqli_close($db_conn);
    setcookie('success', 'Deleted Successfully', time()+3);
}
header("location: departments.php");
