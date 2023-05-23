<?php 

include_once "../core/init.php";

function post_leave()
{
    global $db_connection;

    $leave_type = $_REQUEST['leave_type'];
    $from = $_REQUEST['from_date'];
    $to = $_REQUEST['to_date'];
    $user_id = $_SESSION['user_id'];

    $sql_post_leave = mysqli_prepare($db_connection, "INSERT INTO leaves (`leave_type`, `from_date`, `to_date`, `user_id`) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($sql_post_leave, "sssi", $leave_type, $from, $to, $user_id);
    mysqli_stmt_execute($sql_post_leave) or die(mysqli_stmt_error($sql_post_leave));
    mysqli_close($db_connection);
    setcookie('success', "Leave application has been sent", time()+2);
    header('location: ./leaves.php');
}

if(isset($_POST['apply_for_leave'])) post_leave();

function approve_leave_request()
{
    global $db_connection; 

    $id = $_REQUEST['id'];
    $approved = 'approved';
    $sql_approve_leave = "UPDATE leaves SET leave_status='$approved' WHERE id = $id";
    mysqli_query($db_connection, $sql_approve_leave) or die(mysqli_error($db_connection));
    setcookie('success', "leave has been approved", time()+2 );
    header('location: ./leaves.php');
    mysqli_close($db_connection);
}

if(isset($_POST['approve_leave'])) approve_leave_request();

function reject_leave_request()
{
    global $db_connection; 

    $id = $_REQUEST['id'];
    $rejected = 'rejected';
    $sql_approve_leave = "UPDATE leaves SET leave_status='$rejected' WHERE id = $id";
    mysqli_query($db_connection, $sql_approve_leave) or die(mysqli_error($db_connection));
    setcookie('success', "leave has been rejected", time()+2 );
    mysqli_close($db_connection);
    header('location: ./leaves.php');
}

if(isset($_POST['reject_leave'])) reject_leave_request();

function fetch_user_leaves() 
{
    global $db_connection;

    $user_id = $_SESSION['user_id'];
    $sql_fetch_leave = "SELECT * FROM leaves LEFT JOIN users ON leaves.user_id = users.id WHERE leaves.user_id = '$user_id' ORDER BY leaves.date_created DESC";
    $execute_sql_fetch_leave = mysqli_query($db_connection, $sql_fetch_leave) or die(mysqli_error($db_connection));
    $fetched_user_leaves = mysqli_fetch_all($execute_sql_fetch_leave, 1);

    return $fetched_user_leaves;
}

function fetch_leaves() 
{
    global $db_connection;

    $sql_fetch_leaves = "SELECT leaves.id as leave_id, leaves.leave_type, leaves.from_date, leaves.to_date, leaves.leave_status, leaves.user_id as user_id, leaves.date_created, users.first_name, users.last_name FROM leaves LEFT JOIN users ON leaves.user_id = users.id ORDER BY date_created DESC";
    $execute_sql_fetch_leaves = mysqli_query($db_connection, $sql_fetch_leaves) or die(mysqli_error($db_connection));
    $fetched_leaves = mysqli_fetch_all($execute_sql_fetch_leaves, 1);
    return $fetched_leaves;
}

function count_leaves(): int
{
    return count(fetch_leaves());
}

function count_user_leaves(): int
{
    global $db_connection;
    $id = $_SESSION['user_id'];
    $query = $db_connection->query("SELECT * FROM leaves WHERE user_id = $id");
    return mysqli_num_rows($query);
}

function count_pending_leaves(): int
{
    global $db_connection;
    $query = $db_connection->query("SELECT * FROM leaves WHERE leave_status = 'pending' ");
    return mysqli_num_rows($query);
}

function count_user_pending_leaves(): int
{
    global $db_connection;
    $id = $_SESSION['user_id'];
    $query = $db_connection->query("SELECT * FROM leaves WHERE leave_status = 'pending' AND user_id = $id");
    return mysqli_num_rows($query);
}

function count_expired_leaves(): int
{
    global $db_connection;
    $query = $db_connection->query("SELECT * from leaves WHERE to_date <= CURRENT_DATE()");
    return mysqli_num_rows($query);
}