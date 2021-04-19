<?php
include_once 'includes/functions.php';
require_once 'includes/db_connection.php';
protect_page();

if(isset($_POST['add_user'])){
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
    $target_file = $target_dir.rand(1000000, 10000000).basename($_FILES["profile_picture"]["name"]);
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
    mysqli_stmt_execute($sql_register_user) or die(mysqli_stmt_error($sql_register_user));
    mysqli_close($db_conn);
    setcookie('success', 'user has been registered', time()+2);
    header('location: view_users.php');
}

$sql_fetch_users = "SELECT users.id as user_id, users.first_name, users.last_name, users.gender, users.department_id, departments.dpt_name, occupations.title, occupations.basic_salary, occupations.house_allowance, occupations.medical_allowance FROM users JOIN departments ON users.department_id = departments.id JOIN occupations ON users.occupation_id = occupations.id JOIN user_levels ON users.user_level_id = user_levels.id WHERE user_status= 1 ";
$fetched_users = mysqli_query($db_conn, $sql_fetch_users) or die( mysqli_error($db_conn) );// executing the query
$users = mysqli_fetch_all($fetched_users, 1);
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <link rel="stylesheet" href="../assets/css/popup_form.css">
    <title>Employees | View Employees</title>
</head>
<body>
<?php
include 'includes/top_navbar.php';
include 'includes/side_navbar.php';
?>

<div class="main_content">
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <?= alerts() ?>
                <div class="container_header d-flex justify-content-between">
                    <p class="m-1">Employees <span class="badge badge-info"><?=count_users()?></span></p>
                    <a href="archived_users.php" class="text-dark"><p class="m-1">Archived <span class="badge badge-danger"><?=count_archived_users()?></span></p></a>
                </div>
                <hr>
                <table id="example" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Names</th>
                        <th>Department</th>
                        <th>Occupation</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td> <?= $user["first_name"].' '.$user["last_name"] ?> </td>
                            <td> <?= $user["dpt_name"] ?> </td>
                            <td> <?= $user["title"] ?> </td>
                            <td> <?= $user["basic_salary"] + $user["house_allowance"] + $user["medical_allowance"] ?></td>
                            <td>
                                <div class="d-flex flex-row">
                                    <a href="update_user.php?id=<?= $user['user_id']?>" class="mr-1"><span class="text-success table_icons icon-pencil"></span></a> |
                                    <form action="includes/functions.php" method="post" class="form-inline">
                                        <input type="hidden" name="id" id="id" value="<?=$user['user_id']?>">
                                        <button type="submit" name="archive_user" class="btn btn-sm"><span class="text-warning table_icons icon-archive"></span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <?php if($_SESSION['id']==2): ?>
                    <button class="btn btn-success open-button" onclick="makeAnnouncement()"><span class="icon-add_circle"></span> New Employee</button>
                    <div class="form-popup form_add_user" id="announcements_form">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-center">Add Employee</h5>
                            </div>
                            <div class="card-body">
                                <form action="users.php" method="post" enctype="multipart/form-data" autocomplete="off">
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
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" name="id_number" id="id_number" class="form-control" placeholder="ID Number">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                                            </div>
                                            <div class="col">
                                                <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
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
                                            <div class="col">
                                                <select name="user_level" id="user_level" class="custom-select">
                                                    <option value="none_selected">Select User Level</option>
                                                    <?= select_user_level() ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="profile_picture" accept="image/*" name="profile_picture">
                                        <label class="custom-file-label" for="profile_picture">Profile picture</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button class="btn btn-info btn-block" type="submit" name="add_user"><span class="icon-save2"></span> Save</button>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-danger btn-block" type="reset" onclick="closeAnnouncement()"><span class="icon-cancel"></span> Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function makeAnnouncement() {
        document.getElementById("announcements_form").style.display = "block";
    }
    function closeAnnouncement() {
        document.getElementById("announcements_form").style.display = "none";
    }
</script>
</body>
</html>