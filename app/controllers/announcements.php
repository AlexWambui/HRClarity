<?php 

include_once "../core/init.php";

if(isset($_POST['post_announcement']))
{
    $title = $_REQUEST['title'];
    $message = $_REQUEST['message'];
    $venue = $_REQUEST['venue'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];

    $sql = mysqli_prepare($db_connection, "INSERT INTO announcements (`title`, `message`, `venue`, `start_date`, `end_date`) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($sql, "sssss", $title, $message, $venue, $start_date, $end_date);
    mysqli_stmt_execute($sql) or die(mysqli_stmt_error($sql));
    mysqli_close($db_connection);
    setcookie('success', "Announcement has been made", time()+2);
    header('location: ./announcements.php');
}

function fetch_announcements() 
{
    global $db_connection;

    $sql = "SELECT * FROM announcements WHERE end_date >= CURDATE() ORDER BY start_date ASC";
    $announcements = mysqli_query($db_connection, $sql) or die(mysqli_error($db_connection));
    $announcements = mysqli_fetch_all($announcements, 1);

    return $announcements;
}

function fetch_announcement() 
{
    global $db_connection;

    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM announcements WHERE id = '$id' ";
    $announcements = mysqli_query($db_connection, $sql) or die(mysqli_error($db_connection));
    $announcements = mysqli_fetch_all($announcements, 1);

    return $announcements;
}

if(isset($_POST['update_announcement']))
{ 
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $message = $_REQUEST['message'];
    $venue = $_REQUEST['venue'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];

    $sql = "UPDATE announcements 
    SET 
        title='$title', 
        message='$message',
        venue='$venue',
        start_date='$start_date',
        end_date='$end_date'
    WHERE id = $id";
    mysqli_query($db_connection, $sql) or die(mysqli_error($db_connection));
    setcookie('success', "updated successfully", time()+3);
    header('location: ./announcements.php');
    mysqli_close($db_connection);
}

if(isset($_POST['delete_announcement']))
{
    $id = $_REQUEST['id'];

    $sql_delete = "DELETE FROM announcements WHERE id = $id";
    mysqli_query($db_connection, $sql_delete) or die(mysqli_error($db_connection));
    setcookie('success', "Announcement has been deleted!", time()+2);
    header('location: ./announcements.php');
    mysqli_close($db_connection);
}

function count_announcements ()
{
    return count(fetch_announcements());
}