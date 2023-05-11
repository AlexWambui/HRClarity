<?php
include_once "includes/functions.php";
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
            header('location: welcome_page.php');
        }else{
            setcookie("error", "wrong username or password", time()+2);
            header('location: login.php');
        }
    }else{
        setcookie("error", "wrong username or password", time()+2);
        header('location: login.php');
    }
    mysqli_close($db_conn);
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once 'includes/head_section_links.php'?>
    <title>Home | Login</title>
</head>
<body class="login_page">
<div class="container login_container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <div class="card">
                <h4 class="card-header text-center">Login</h4>
                <div class="card-body">
                    <?= alerts() ?>
                    <form action="login.php" method="post" autocomplete="off">
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
  *enhance the look on the dashboards ✔
  *make add and view employees one page instead of two diff pages ✔
  *make update and delete pages one page for occupations and departments
  *do reports for admin and hr all employees in the org (names, email, phone, department, occupation, net-income)
  ------------------------------------------------------------------------------------------
  -- users side --
  1. enable users to apply for leaves ✔
  2. users can view their work details (dpt, occupation, responsibilities, hod, salaries) ✔
  3. users can view announcements made by hr_manager ✔
  * add the page for archived users ✔
  ------------------------------------------------------------------------------------------
  -- hr_manager's side --
  1. enable hr_manager accept or reject leaves ✔
  2. hr can make announcements ✔
  3. hr can update or delete announcements ✔
  4. hr can add, update or delete recruitments ✔
  ------------------------------------------------------------------------------------------
  --admin's side --
  1. update and delete occupations and dpts should work without being affected by the relationships.
  ------------------------------------------------------------------------------------------
-->