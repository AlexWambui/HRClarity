<?php 

include_once "../core/init.php";

function post_department()
{
    global $db_connection;

    $department_name = $_REQUEST['department_name'];    

    $sql_post = mysqli_prepare($db_connection, "INSERT INTO departments (`department_name`) VALUES (?) ");
    mysqli_stmt_bind_param($sql_post, "s", $department_name);
    mysqli_stmt_execute($sql_post) or die(mysqli_stmt_error($sql_post));
    mysqli_close($db_connection);
    setcookie('success', "Department has been added!", time()+2);
    header('location: ./departments.php');
}
if(isset($_POST['post_department'])) post_department();

function fetch_departments()
{
    global $db_connection;

    $query = $db_connection->query("SELECT * FROM departments ");
    return mysqli_fetch_all($query, 1);
}

function fetch_department()
{
    global $db_connection;

    $id = $_REQUEST['id'];
    $query = $db_connection->query(" SELECT * FROM departments WHERE id = $id ");
    return mysqli_fetch_all($query, 1);
}

function update_department()
{
    global $db_connection;
    $id = $_REQUEST['id'];
    $department_name = $_REQUEST['department_name'];

    $query = "UPDATE departments SET department_name='$department_name' WHERE id = $id";
    mysqli_query($db_connection, $query) or die(mysqli_error($db_connection));
    setcookie('success', "updated successfully", time()+2);
    header('location: ./departments.php');
    mysqli_close($db_connection);
}
if(isset($_POST['update_department'])) Update_department();

function delete_department()
{
    global $db_connection;

    $id = $_REQUEST["id"];
    $sql = "DELETE FROM departments WHERE id = $id ";
    mysqli_query($db_connection, $sql) or die(mysqli_error($db_connection));
    mysqli_close($db_connection);
    setcookie('success', 'Deleted Successfully', time()+3);
    header("location: ./departments.php");
}
if(isset($_POST['delete_department'])) delete_department();

function count_departments(): int
{
    return count(fetch_departments());
}