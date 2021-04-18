<?php
require_once 'db_connection.php';

function protect_page(){
    session_start();
    if(empty($_SESSION['id'])){
        //Redirect the user to login page
        header("location: ../index.php");
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

function select_department(): string {
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM departments";
    $result = mysqli_query($db_conn, $sql);
    while ($department = mysqli_fetch_array($result)){
        $output .='<option value="'.$department["id"].'">'.$department["dpt_name"].'</option>';
    }
    return $output;
}

function update_department($id): string {
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM departments";
    $result = mysqli_query($db_conn, $sql);
    while ($department = mysqli_fetch_array($result)){
        $selected = $id == $department['id'] ? 'selected': '';
        $output .='<option '.$selected.' value=" '.$department["id"].' ">'.$department["dpt_name"].'</option>';
    }
    return $output;
}

function select_occupation(): string {
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM occupations";
    $result = mysqli_query($db_conn, $sql);
    while ($occupation = mysqli_fetch_array($result)){
        $output .='<option value=" '.$occupation["id"].' ">'.$occupation["title"].'</option>';
    }
    return $output;
}

function update_occupation($id): string {
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM occupations";
    $result = mysqli_query($db_conn, $sql);
    while ($occupation = mysqli_fetch_array($result)){
        $selected = $id == $occupation['id'] ? 'selected': '';
        $output .='<option '.$selected.' value=" '.$occupation["id"].' ">'.$occupation["title"].'</option>';
    }
    return $output;
}

function select_user_level(): string{
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM user_levels";
    $result = mysqli_query($db_conn, $sql);
    while ($user_level = mysqli_fetch_assoc($result)){
        $output .= '<option value=" '.$user_level["id"].' ">'.$user_level["title"].'</option>';
    }
    return $output;
}

function update_user_level($id): string {
    global $db_conn;
    $output = '';
    $sql = "SELECT * FROM user_levels";
    $result = mysqli_query($db_conn, $sql);
    while ($user_level = mysqli_fetch_array($result)){
        $selected = $id == $user_level['id'] ? 'selected': '';
        $output .='<option '.$selected.' value=" '.$user_level["id"].' ">'.$user_level["title"].'</option>';
    }
    return $output;
}

function count_users(): int {
    global $db_conn;
    $query = $db_conn->query("SELECT * FROM users");
    return mysqli_num_rows($query);
}


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
    header('location: ../occupations.php');
}

if(isset($_POST['update_announcement'])){
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $announcement = $_REQUEST['announcement'];

    $sql_update_announcement = "UPDATE announcements SET title='$title', announcement = '$announcement' WHERE id = $id";
    mysqli_query($db_conn, $sql_update_announcement) or die(mysqli_error($db_conn));
    setcookie('success', "updated successfully", time()+3);
    header('location: ../announcements.php');
    mysqli_close($db_conn);
}

if(isset($_POST['delete_announcement'])){
    $id = $_REQUEST['id'];
    $sql_delete_announcement = "DELETE FROM announcements WHERE id = $id";
    mysqli_query($db_conn, $sql_delete_announcement) or die(mysqli_error($db_conn));
    setcookie('success', "deleted successfully", time()+2);
    header('location: ../announcements.php');
    mysqli_close($db_conn);
}

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
    header('location: ../users.php');
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

if(isset($_POST['approve_leave'])){
    $id = $_REQUEST['id'];
    $approved = 'approved';
    $rejected = 'rejected';
    $sql_approve_leave = "UPDATE leaves SET status='$approved' WHERE id = $id";
    mysqli_query($db_conn, $sql_approve_leave) or die(mysqli_error($db_conn));
    setcookie('success', "leave has been approved", time()+2 );
    header('location: ../leaves.php');
    mysqli_close($db_conn);
}
if(isset($_POST['reject_leave'])){
    $id = $_REQUEST['id'];
    $approved = 'approved';
    $rejected = 'rejected';
    $sql_approve_leave = "UPDATE leaves SET status='$rejected' WHERE id = $id";
    mysqli_query($db_conn, $sql_approve_leave) or die(mysqli_error($db_conn));
    setcookie('success', "leave has been rejected", time()+2 );
    mysqli_close($db_conn);
    header('location: ../leaves.php');
}

if(isset($_POST['update_department'])){
    $id = $_REQUEST['id'];
    $dpt_name = $_REQUEST['dpt_name'];

    $sql_update_department = "UPDATE departments SET dpt_name='$dpt_name' WHERE id = $id";
    mysqli_query($db_conn, $sql_update_department) or die(mysqli_error($db_conn));
    setcookie('success', "updated successfully", time()+3);
    header('location: ../departments.php');
    mysqli_close($db_conn);
}

if(isset($_POST["delete_department"])){
    $id = $_REQUEST["id"];
    $sql = "DELETE FROM departments WHERE id = $id";
    mysqli_query($db_conn, $sql) or die(mysqli_error($db_conn));
    mysqli_close($db_conn);
    setcookie('success', 'Deleted Successfully', time()+3);
    header("location: ../departments.php");
}

if(isset($_POST["delete_occupation"])){
    $id = $_REQUEST["id"];
    $sql = "DELETE FROM occupations WHERE id = $id";
    mysqli_query($db_conn, $sql) or die(mysqli_error($db_conn));
    mysqli_close($db_conn);
    setcookie('success', 'Deleted Successfully', time()+3);
    header("location: ../occupations.php");
}