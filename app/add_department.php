<?php
include_once 'includes/functions.php';
require_once "includes/db_connection.php";
protect_page();
if(isset($_REQUEST['dpt_name'])){
    $dpt_name = $_REQUEST['department_name'];

    $sql_add_department = mysqli_prepare($db_conn, "INSERT INTO departments (`dpt_name`) VALUES (?)");
    mysqli_stmt_bind_param($sql_add_department, "s", $dpt_name);
    mysqli_stmt_execute($sql_add_department);
    mysqli_close($db_conn);
    setcookie('success', 'department has been added', time()+2);
    header('location: add_department.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Departments | Add</title>
</head>
<body>
<?php
include_once "includes/top_navbar.php";
include_once "includes/side_navbar.php";
?>
<div class="main_content">
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-sm-5">
                <div class="card">
                    <h4 class="card-header text-center">New Department</h4>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="add_department.php" method="post">
                            <div class="form-group">
                                <input type="text" name="dpt_name" id="dpt_name" class="form-control" placeholder="Department Name" autofocus required>
                            </div>
                            <button class="btn btn-success btn-block mt-1">Add Department</button>
                        </form>
                    </div>
                </div>
                <a href="view_departments.php" class="btn btn-outline-info btn-block mt-3">View Departments >></a>
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