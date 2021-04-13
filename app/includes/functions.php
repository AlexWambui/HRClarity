<?php
require_once 'db_connection.php';

function protect_page(){
    session_start();
    if(empty($_SESSION['id'])){
        //Redirect the user to login page
        header("location: ../../index.php");
    }
}

function alerts(){
    if(isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> <?= $_COOKIE['error'] ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_COOKIE['success'])): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> <?= $_COOKIE['success'] ?>
        </div>
    <?php endif;
}

function select_departments(): string {
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM departments";
    $result = mysqli_query($db_conn, $sql);
    while ($department = mysqli_fetch_array($result)){
        $output .='<option value=" '.$department["id"].' ">'.$department["dpt_name"].'</option>';
    }
    return $output;
}

function select_occupations(): string {
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM occupations";
    $result = mysqli_query($db_conn, $sql);
    while ($occupation = mysqli_fetch_array($result)){
        $output .='<option value=" '.$occupation["id"].' ">'.$occupation["title"].'</option>';
    }
    return $output;
}

function select_user_levels(): string{
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM user_levels";
    $result = mysqli_query($db_conn, $sql);
    while ($user_level = mysqli_fetch_assoc($result)){
        $output .= '<option value=" '.$user_level["id"].' ">'.$user_level["title"].'</option>';
    }
    return $output;
}

function count_users(): int {
    global $db_conn;
    $query = $db_conn->query("SELECT * FROM users");
    return mysqli_num_rows($query);
}