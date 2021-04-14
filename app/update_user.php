<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();
if(isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    $sql_fetch_user = "SELECT * FROM users WHERE id = $id";
    $fetched_user = mysqli_query($db_conn, $sql_fetch_user) or die(mysqli_error($db_conn));
    if(mysqli_num_rows($fetched_user) == 0){
        header('location: read.php');
    }
    $user = mysqli_fetch_assoc($fetched_user);
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Update user</title>
</head>
<body>
<?php
    include_once 'includes/top_navbar.php';
    include_once 'includes/side_navbar.php';
?>
<div class="main_content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-9">
                <div class="card">
                    <h4 class="card-header text-center">Update User</h4>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="register_user.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" value="<?= $user['id'] ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required value="<?= $user['first_name'] ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?= $user['last_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" min="1960-01-01" max="2000-01-01" value="<?= $user['date_of_birth'] ?>">
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
                                <input type="number" name="id_number" id="id_number" class="form-control" placeholder="ID Number" value="<?= $user['id_number'] ?>">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address" value="<?= $user['email_address'] ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" value="<?= $user['phone_number'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <select name="department" id="department" class="custom-select">
                                            <option value="<?= $user['department_id'] ?>"><?= $user['department_id'] ?></option>
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
</body>
</html>
