<?php
include_once "protect.php";
include_once "protect_admin.php";
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
<?php include "nav.php" ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <div class="card">
                <h4 class="card-header text-center">Register User</h4>
                <div class="card-body">
                    <form action="register_user.php" method="post">
                        <div class="form-group">
                            <input type="text" name="names" id="names" class="form-control" placeholder="Names" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <button class="btn btn-success btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>