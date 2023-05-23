<?php 

include_once "../core/functions.php";
include_once "../views/_html_templates.php";

function login()
{
    global $db_connection;

    $email = $_REQUEST["email_address"];
    $password = $_REQUEST["password"];

    $sql = mysqli_prepare($db_connection, "SELECT * FROM users WHERE email_address = ?");
    mysqli_stmt_bind_param($sql, "s", $email);
    mysqli_stmt_execute($sql) or die (mysqli_stmt_error($sql));
    $fetched_user = mysqli_stmt_get_result($sql);

    if (mysqli_num_rows($fetched_user) == 1) {
        $user = mysqli_fetch_assoc($fetched_user);
        $db_password = $user['password'];
        if ($db_password == $password) {
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_first_name"] = $user["first_name"];
            $_SESSION["user_last_name"] = $user["last_name"];
            $_SESSION["user_level"] = $user['user_level_id'];
            $_SESSION["user_status"] = $user['user_status'];
            $_SESSION["user_profile_picture"] = $user['profile_picture'];
            $_SESSION["user_login_status"] = true;
            header('location: ./dashboard.php');
        } else {
            setcookie('error', "Wrong username or Password", time() + 3);
            header('location: ./login.php');
        }
    } else {
        setcookie('error', "Wrong username or Password", time() + 3);
        header('location: ./login.php');
    }
}
if(isset($_POST['login'])) login();

function signup()
{
    global $db_connection; 

    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $gender = $_REQUEST['gender'];    
    $id_number = $_REQUEST['id_number'];
    $email = $_REQUEST['email_address'];
    $phone = $_REQUEST['phone_number'];
    $dob = $_REQUEST['date_of_birth'];
    $password = $_REQUEST['password'];
    $occupation = NULL;
    $user_level = 1;   
    $user_status = 2;
    $target_file = '../../assets/uploads/profile_pictures/default.png';

    $sql_register_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `gender`, `date_of_birth`, `id_number`, `email_address`, `phone_number`, `occupation_id`, `user_level_id`, `user_status`, `profile_picture`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_register_user, "ssssissiiiss", $first_name, $last_name, $gender, $dob, $id_number, $email, $phone, $occupation, $user_level, $user_status, $target_file, $password);
    mysqli_stmt_execute($sql_register_user) or die(mysqli_stmt_error($sql_register_user));
    mysqli_close($db_connection);
    setcookie('success', 'Your account has been created!', time()+2);
    header('location: ./login.php');
}
if(isset($_POST['signup'])) signup();


function logout()
{
    session_start();
    session_destroy();
    //to destroy only one session
    //unset($_SESSION["id"]);
    header('location: ../views/login.php');
}
if(isset($_POST['logout'])) logout();