<?php
if(isset($_REQUEST['names'])){
    require_once "connect.php";
    $names = $_REQUEST['names'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);


    //$sql = "INSERT INTO users (`id`, `names`, `email`, `password`) VALUES (NULL, '$names', '$email', '$password')";
    //mysqli_query($conn, $sql);
    //mysqli_close($conn);
    $stmt = mysqli_prepare($conn, "INSERT INTO users (`names`, `email`, `password`) VALUES (?, ?, ?)");
    //bind data ... like place it in the question marks
    mysqli_stmt_bind_param($stmt, "sss", $names, $email, $password);// s means we only accept strings i is for integers
    mysqli_stmt_execute($stmt);
    mysqli_close($conn);
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Users | Register</title>
</head>
<body>
<?php include_once "includes/side_navbar.php" ?>
<div class="main_content">
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="card">
                    <h4 class="card-header text-center">Register User</h4>
                    <div class="card-body">
                        <form action="register_user.php" method="post">
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
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
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
                                <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <select name="department" id="department" class="custom-select">
                                    <option value="none_selected">Select Department</option>
                                    <option value="computer">Computer</option>
                                    <option value="accounts">Accounts</option>
                                    <option value="management">Management</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="department" id="department" class="custom-select">
                                    <option value="none_selected">Select User Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="hr">HR Manager</option>
                                    <option value="employee">Employee</option>
                                </select>
                            </div>
                            <button class="btn btn-success btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>