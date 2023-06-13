<?php 

include_once "../core/init.php";

function fetch_all_users()
{
    global $db_connection;

    $query = "SELECT 
        users.id as user_id, 
        users.first_name, 
        users.last_name, 
        users.email_address, 
        users.phone_number, 
        users.gender, 
        users.occupation_id,
        users.user_level_id, 
        users.user_status, 
        users.date_created, 

        departments.department_name, 
        
        occupations.occupation_name, 
        occupations.basic_salary, 
        occupations.house_allowance, 
        occupations.medical_allowance 
        FROM users         
        LEFT JOIN occupations ON users.occupation_id = occupations.id 
        LEFT JOIN departments ON occupations.department_id = departments.id 
        WHERE users.user_level_id != 2 
        ORDER BY user_status, first_name ASC 
    ";
    $users = mysqli_query($db_connection, $query) or die( mysqli_error($db_connection) );
    $users = mysqli_fetch_all($users, 1);
    return $users;
}

function fetch_active_users()
{
    global $db_connection;

    $sql_fetch_users = "SELECT users.id as user_id, users.first_name, users.last_name, users.email_address, users.phone_number, users.gender, users.user_level_id, users.user_status, users.date_created, departments.department_name, occupations.occupation_name, occupations.basic_salary, occupations.house_allowance, occupations.medical_allowance 
    FROM users     
    LEFT JOIN occupations ON users.occupation_id = occupations.id
    LEFT JOIN departments ON occupations.department_id = departments.id 
    WHERE user_status= 1 
    AND user_level_id != 2 ";
    $fetched_users = mysqli_query($db_connection, $sql_fetch_users) or die( mysqli_error($db_connection) );
    $fetched_users = mysqli_fetch_all($fetched_users, 1);
    return $fetched_users;
}

function fetch_user($id) 
{
    global $db_connection;
    
    $id = $id;
    $sql_fetch_user = "SELECT             
            users.id as user_id, 
            users.first_name, 
            users.last_name, 
            users.id_number, 
            users.email_address, 
            users.phone_number, 
            users.gender, 
            users.date_of_birth, 
            users.occupation_id,
            users.user_level_id, 
            users.user_status, 
            users.password,
            users.date_created, 

            departments.department_name, 

            occupations.occupation_name, 
            occupations.basic_salary, 
            occupations.house_allowance, 
            occupations.medical_allowance 
        FROM users                 
        LEFT JOIN occupations ON users.occupation_id = occupations.id 
        LEFT JOIN departments ON occupations.department_id = departments.id
        WHERE users.id = '$id' 
    ";
    $fetched_user = mysqli_query($db_connection, $sql_fetch_user) or die( mysqli_error($db_connection) );
    $fetched_user = mysqli_fetch_all($fetched_user, 1);
    return $fetched_user;
}

function update_user() 
{
    global $db_connection; 

    $id = $_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $dob = $_REQUEST['date_of_birth'];
    $gender = $_REQUEST['gender'];
    $id_number = $_REQUEST['id_number'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];   
    $password = $_REQUEST['password'];
    $occupation = $_REQUEST['occupation_id'];           
    $user_level = $_REQUEST['user_level'];
    $user_status = $_REQUEST['user_status'];

    $sql_update_user = "UPDATE users 
        SET 
            first_name='$first_name', 
            last_name='$last_name', 
            gender='$gender', 
            date_of_birth='$dob', 
            id_number = '$id_number', 
            email_address = '$email',
            phone_number = '$phone',
            occupation_id = '$occupation',
            user_level_id = '$user_level',
            user_status = '$user_status',
            password = '$password' 
        WHERE id = $id 
    ";
    mysqli_query($db_connection, $sql_update_user) or die(mysqli_error($db_connection));
    setcookie('message', "$first_name was updated", time()+3);
    header('location: ./users.php');
}
if(isset($_POST['update_user'])) update_user();

function update_profile() 
{
    global $db_connection; 

    $id = $_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $dob = $_REQUEST['date_of_birth'];
    $gender = $_REQUEST['gender'];
    $id_number = $_REQUEST['id_number'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];   
    $password = $_REQUEST['password'];

    $sql_update_user = "UPDATE users 
        SET 
            first_name='$first_name', 
            last_name='$last_name', 
            gender='$gender', 
            date_of_birth='$dob', 
            id_number = '$id_number', 
            email_address = '$email',
            phone_number = '$phone',
            password = '$password' 
        WHERE id = $id 
    ";
    mysqli_query($db_connection, $sql_update_user) or die(mysqli_error($db_connection));
    setcookie('message', "Your profile was updated", time()+3);
    session_destroy();
    header('location: ./login.php');
}
if(isset($_POST['update_profile'])) update_profile();

function count_all_users(): int 
{
    return count(fetch_all_users());
}

function count_active_users(): int
{
    return count(fetch_active_users());
}

function count_inactive_users(): int
{
    global $db_connection;
    $query = $db_connection->query("SELECT * FROM users WHERE user_status = 2");
    $result = mysqli_fetch_all($query, 1);
    return count($result);
}