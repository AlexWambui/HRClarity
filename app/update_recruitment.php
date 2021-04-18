<?php
include_once 'includes/db_connection.php';
$id = $_REQUEST['id'];
if(isset($_POST['update_recruitment'])){
    $names = $_REQUEST['names'];
    $email = $_REQUEST['email_address'];
    $phone = $_REQUEST['phone_number'];
    $occupation = $_REQUEST['occupation'];
    $venue = $_REQUEST['venue'];
    $date = $_REQUEST['interview_date'];

    $sql_update_recruitment = "UPDATE recruitments 
                                SET 
                                    names = '$names', 
                                    email_address = '$email',
                                    phone_number = '$phone',
                                    occupation = '$occupation',
                                    venue = '$venue',
                                    interview_date = '$date'
                                WHERE id = $id";
    mysqli_query($db_conn, $sql_update_recruitment) or die(mysqli_error($db_conn));
    setcookie('success', "updated successfully", time()+3);
    header('location: recruitments.php');
    mysqli_close($db_conn);
}

if(isset($_POST['delete_recruitment'])){
    $sql_delete_recruitment = "DELETE FROM recruitments WHERE id = $id";
    mysqli_query($db_conn, $sql_delete_recruitment) or die(mysqli_error($db_conn));
    setcookie('success', "deleted successfully", time()+2);
    header('location: recruitments.php');
    mysqli_close($db_conn);
}