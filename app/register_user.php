<?php
include_once 'includes/functions.php';
require_once "includes/db_connection.php";
if(isset($_REQUEST['first_name'])){
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
    $password = $_REQUEST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);

    $target_dir = "../assets/uploads/profile_pictures/";
    $target_file = $target_dir.rand(10000000, 10000000).basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg"];
    $allowed = in_array($imageFileType, $allowed_types);
    if( $allowed and move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)){
        $status = 1;
    }else{
        $status = 2;
    }

    $sql_register_user = mysqli_prepare($db_conn, "INSERT INTO users (`first_name`, `last_name`, `gender`, `date_of_birth`, `id_number`, `email_address`, `phone_number`, `department_id`, `occupation_id`, `user_level_id`, `profile_picture`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_register_user, "ssssissiiiss", $first_name, $last_name, $gender, $dob, $id_number, $email, $phone, $department, $occupation, $user_level, $target_file, $password);
    mysqli_stmt_execute($sql_register_user);
    mysqli_close($db_conn);
    setcookie('success', 'user has been registered', time()+2);
    header('location: register_user.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Users | Register</title>
</head>
<body>
<?php
    include_once "includes/top_navbar.php";
    include_once "includes/side_navbar.php";
?>
<div class="main_content">
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="card">
                    <h4 class="card-header text-center">Register User</h4>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="register_user.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" autofocus required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" min="1960-01-01" max="2000-01-01">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="gender">Select Gender</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="male" name="gender" value="male">
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="female" name="gender" value="female">
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" name="id_number" id="id_number" class="form-control" placeholder="ID Number">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <select name="department" id="department" class="custom-select">
                                            <option value="none_selected">Select Department</option>
                                            <?= select_department() ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select name="occupation" id="occupation" class="custom-select">
                                            <option value="none_selected">Select Occupation</option>
                                            <?= select_occupation() ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="user_level" id="user_level" class="custom-select">
                                    <option value="none_selected">Select User Level</option>
                                    <?= select_user_level() ?>
                                </select>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profile_picture" accept="image/*" name="profile_picture">
                                <label class="custom-file-label" for="profile_picture">Profile picture</label>
                            </div>
                            <button class="btn btn-success btn-block mt-1">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
</body>
</html>