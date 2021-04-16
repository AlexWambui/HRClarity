<?php
include_once 'includes/db_connection.php';
if(isset($_POST['update_occupation'])){
$id = $_REQUEST['id'];
$title = $_REQUEST['title'];
$responsibilities = $_REQUEST['responsibilities'];
$basic_salary = $_REQUEST['basic_salary'];
$house_allowance = $_REQUEST['house_allowance'];
$medical_allowance = $_REQUEST['medical_allowance'];
$department = $_REQUEST['department'];

$sql_update_occupation = "UPDATE occupations SET title='$title', basic_salary='$basic_salary', house_allowance='$house_allowance', medical_allowance='$medical_allowance', department_id = '$department', responsibilities = '$responsibilities' WHERE id = $id ";
mysqli_query($db_conn, $sql_update_occupation) or die(mysqli_error($db_conn));
setcookie('message', "$title updated Successfully", time()+3);
}
header('location: occupations.php');