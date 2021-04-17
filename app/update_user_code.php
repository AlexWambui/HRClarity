<?php
include_once 'includes/db_connection.php';
if(isset($_POST['update_user'])){
    $id = $_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $gender = $_REQUEST['gender'];
    $dob = $_REQUEST['date_of_birth'];
    $id_number = $_REQUEST['id_number'];
    $email = $_REQUEST['email_address'];
    $phone = $_REQUEST['phone_number'];
    $department = $_REQUEST['department'];
    $occupation = $_REQUEST['occupation'];
    $user_level = $_REQUEST['user_level'];

    $sql_update_user = "UPDATE users 
                        SET 
                            first_name='$first_name', 
                            last_name='$last_name', 
                            gender='$gender', 
                            date_of_birth='$dob', 
                            id_number = '$id_number', 
                            email_address = '$email',
                            phone_number = '$phone',
                            department_id = '$department',
                            occupation_id = '$occupation',
                            user_level_id = '$user_level'   
                        WHERE id = $id ";
    mysqli_query($db_conn, $sql_update_user) or die(mysqli_error($db_conn));
    setcookie('message', "$first_name is updated", time()+3);
}
header('location: view_users.php');