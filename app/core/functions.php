<?php

include_once '../models/db_connection.php';

function ensure_user_logged_in()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: ../views/login.php");
    }
}

function admin_page()
{
    session_start();
    if ($_SESSION['user_level'] < 2) 
    {
        header("location: ./dashboard.php");
    }
}

function alerts(){
    if(isset($_COOKIE['error'])): ?>
        <div id="notification" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= $_COOKIE['error'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>        
    <?php endif; ?>

    <?php if(isset($_COOKIE['success'])): ?>
        <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?= $_COOKIE['success'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif;
}

function greet_user() 
{
    if(isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1)
    {
        echo("Hi ".$_SESSION['user_first_name']);
    }   
    else if(isset($_SESSION['user_level'])) {
        echo("Welcome Back ".$_SESSION['user_first_name']);
    }  
    else {
        echo("User level not set in session");
    } 
}

function select_department(): string {
    global $db_connection;
    $output = '';
    $sql = "SELECT * FROM departments";
    $result = mysqli_query($db_connection, $sql);
    while ($department = mysqli_fetch_array($result)){
        $output .='<option value="'.$department["id"].'">'.$department["department_name"].'</option>';
    }
    return $output;
}

function select_occupation(): string 
{
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM occupations";
    $result = mysqli_query($db_conn, $sql);
    while ($occupation = mysqli_fetch_array($result)){
        $output .='<option value=" '.$occupation["id"].' ">'.$occupation["title"].'</option>';
    }
    return $output;
}

function select_update_occupation($id): string 
{
    global $db_connection;
    $output = '';
    $sql = "SELECT * FROM occupations";
    $result = mysqli_query($db_connection, $sql);
    while ($occupation = mysqli_fetch_array($result)){
        $selected = $id == $occupation['id'] ? 'selected': '';
        $output .='<option '.$selected.' value=" '.$occupation["id"].' ">'.$occupation["occupation_name"].'</option>';
    }
    return $output;
}

function count_recruitments(): int{
    global $db_conn;
    $query = $db_conn->query("SELECT * FROM recruitments");
    return mysqli_num_rows($query);
}

function count_expired_recruitments(): int{
    global $db_conn;
    $query = $db_conn->query("SELECT * FROM recruitments WHERE interview_date < CURRENT_DATE() ");
    return mysqli_num_rows($query);
}

function count_recruitments_today(): int{
    global $db_conn;
    $query = $db_conn->query("SELECT * FROM recruitments WHERE interview_date = CURRENT_DATE() ");
    return mysqli_num_rows($query);
}

if(isset($_POST['update_recruitment'])){
    $id = $_REQUEST['id'];
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
    header('location: ../recruitments.php');
    mysqli_close($db_conn);
}

if(isset($_POST['delete_recruitment'])){
    $id = $_REQUEST['id'];
    $sql_delete_recruitment = "DELETE FROM recruitments WHERE id = $id";
    mysqli_query($db_conn, $sql_delete_recruitment) or die(mysqli_error($db_conn));
    setcookie('success', "deleted successfully", time()+2);
    header('location: ../recruitments.php');
    mysqli_close($db_conn);
}