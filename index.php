<?php
require_once 'app/includes/db_connection.php';
include_once 'app/includes/functions.php';
if(isset($_REQUEST['password'])){
    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];

    $sql_fetch_users = mysqli_prepare($db_conn, "SELECT * FROM users WHERE email_address = ? LIMIT 1");
    mysqli_stmt_bind_param($sql_fetch_users, "s", $email);
    mysqli_stmt_execute($sql_fetch_users);
    $fetched_users = mysqli_stmt_get_result($sql_fetch_users);

    //if email is found in the db
    if(mysqli_num_rows($fetched_users) == 1){
        $user = mysqli_fetch_assoc($fetched_users);
        $hash = $user['password'];
        if(password_verify($password, $hash)){
            session_start();
            $_SESSION['user_level'] = $user['user_level_id'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            header('location: app/welcome_page.php');
        }else{
            setcookie("error", "wrong username or password", time()+2);
            header('location: index.php');
        }
    }else{
        setcookie("error", "wrong username or password", time()+2);
        header('location: index.php');
    }
    mysqli_close($db_conn);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <title>Home | Login</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <div class="card">
                <h4 class="card-header text-center">Login</h4>
                <div class="card-body">
                    <?= alerts() ?>
                    <form action="index.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <input type="text" name="email_address" id="email_address" class="form-control" placeholder="Email Address" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button class="btn btn-success btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!--
TODO
  ------------------------------------------------------------------------------------------
  -- users side --
  1. enable users to apply for leaves
  2. users can view their work details (dpt, occupation, responsibilities, hod, salaries)
  3. users can view announcements made by hr_manager
  ------------------------------------------------------------------------------------------
  -- hr_manager's side --
  1. enable hr_manager accept or reject leaves
  ------------------------------------------------------------------------------------------
  --admin's side --
  1.
  ------------------------------------------------------------------------------------------
-->