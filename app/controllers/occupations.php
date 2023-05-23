<?php 

include_once "../core/init.php";

function post_occupation()
{
    global $db_connection;
    
    $department_id = $_REQUEST['department'];
    $occupation_name = $_REQUEST['occupation_name'];    
    $basic_salary = $_REQUEST['basic_salary'];
    $house_allowance = $_REQUEST['house_allowance'];
    $medical_allowance = $_REQUEST['medical_allowance'];

    $sql_post = mysqli_prepare($db_connection, "INSERT INTO occupations (`department_id`, `occupation_name`, `basic_salary`, `house_allowance`, `medical_allowance`) VALUES (?,?,?,?,?) ");
    mysqli_stmt_bind_param($sql_post, "isddd", $department_id, $occupation_name, $basic_salary, $house_allowance, $medical_allowance);
    mysqli_stmt_execute($sql_post) or die(mysqli_stmt_error($sql_post));
    mysqli_close($db_connection);
    setcookie('success', "Occupation has been added!", time()+2);
    header('location: ./occupations.php');
}
if(isset($_POST['post_occupation'])) post_occupation();

function fetch_occupations()
{
    global $db_connection;

    $query = $db_connection->query("SELECT
        *,
        occupations.id AS id,
        departments.department_name,
        COALESCE(occupations.department_id, 'N/A') AS department_id
        FROM occupations
        LEFT JOIN departments ON occupations.department_id = departments.id
    ");
    return mysqli_fetch_all($query, 1);
}

function fetch_occupation()
{
    global $db_connection;

    $id = $_REQUEST['id'];
    $query = $db_connection->query("SELECT
        *,
        occupations.id AS id,
        departments.department_name,
        COALESCE(occupations.department_id, 'N/A') AS department_id
        FROM occupations
        LEFT JOIN departments ON occupations.department_id = departments.id
        WHERE occupations.id = $id
    ");
    return mysqli_fetch_all($query, 1);
}

function update_occupation()
{
    global $db_connection;

    $id = $_REQUEST['id'];
    $department = $_REQUEST['department'];
    $occupation_name = $_REQUEST['occupation_name'];    
    $basic_salary = $_REQUEST['basic_salary'];
    $house_allowance = $_REQUEST['house_allowance'];
    $medical_allowance = $_REQUEST['medical_allowance'];

    $sql_update_occupation = "UPDATE 
            occupations 
        SET 
            occupation_name='$occupation_name', 
            basic_salary='$basic_salary', 
            house_allowance='$house_allowance', 
            medical_allowance='$medical_allowance', 
            department_id = '$department'
        WHERE id = $id ";
    mysqli_query($db_connection, $sql_update_occupation) or die(mysqli_error($db_connection));
    setcookie('success', "Occupation has been updated", time()+2);
    header('location: ./occupations.php');
}
if(isset($_POST['update_occupation'])) Update_occupation();

function delete_occupation()
{
    global $db_connection;

    $id = $_REQUEST["id"];
    $sql = "DELETE FROM occupations WHERE id = ?";
    
    $stmt = mysqli_prepare($db_connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($db_connection);
    
    setcookie('success', 'Deleted Successfully', time()+2);
    header('location: ./occupations.php');
}
if(isset($_POST["delete_occupation"])) delete_occupation();

function count_occupations(): int
{
    return count(fetch_occupations());
}