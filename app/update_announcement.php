<?php
include_once 'includes/db_connection.php';
$id = $_REQUEST['id'];
if(isset($_POST['update_announcement'])){
    $title = $_REQUEST['title'];
    $announcement = $_REQUEST['announcement'];

    $sql_update_announcement = "UPDATE announcements SET title='$title', announcement = '$announcement' WHERE id = $id";
    mysqli_query($db_conn, $sql_update_announcement) or die(mysqli_error($db_conn));
    setcookie('success', "updated successfully", time()+3);
    header('location: announcements.php');
    mysqli_close($db_conn);
}

if(isset($_POST['delete_announcement'])){
    $sql_delete_announcement = "DELETE FROM announcements WHERE id = $id";
    mysqli_query($db_conn, $sql_delete_announcement) or die(mysqli_error($db_conn));
    setcookie('success', "deleted successfully", time()+2);
    header('location: announcements.php');
    mysqli_close($db_conn);
}