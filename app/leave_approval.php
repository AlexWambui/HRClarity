<?php
include_once 'includes/db_connection.php';
$id = $_REQUEST['id'];
$approved = 'approved';
$rejected = 'rejected';
if(isset($_REQUEST['approve_leave'])){
    $sql_approve_leave = "UPDATE leaves SET status='$approved' WHERE id = $id";
    mysqli_query($db_conn, $sql_approve_leave) or die(mysqli_error($db_conn));
    setcookie('success', "leave has been approved", time()+2 );
    header('location: leaves.php');
    mysqli_close($db_conn);
}
elseif (isset($_REQUEST['reject_leave'])){
    $sql_approve_leave = "UPDATE leaves SET status='$rejected' WHERE id = $id";
    mysqli_query($db_conn, $sql_approve_leave) or die(mysqli_error($db_conn));
    setcookie('success', "leave has been rejected", time()+2 );
    mysqli_close($db_conn);
    header('location: leaves.php');
}
