<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    $sql_fetch_department = "SELECT * FROM departments WHERE id = $id";
    $fetched_departments = mysqli_query($db_conn, $sql_fetch_department) or die(mysqli_error($db_conn));
    if(mysqli_num_rows($fetched_departments) == 0){
        header('location: occupations.php');
    }
    $department = mysqli_fetch_assoc($fetched_departments);
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Update Department</title>
</head>
<body>
<?php
include_once 'includes/top_navbar.php';
include_once 'includes/side_navbar.php';
?>
<div class="main_content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="mini_nav_bar d-flex justify-content-center mt-2 mb-3">
                    <a href="departments.php" class="text-center"><< Back to Departments</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Update Department</h5>
                    </div>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="includes/functions.php" method="post">
                            <input type="hidden" name="id" id="id" value="<?=$department['id']?>">
                            <div class="form-group">
                                <label for="dpt_name">Department Name:</label>
                                <input type="text" name="dpt_name" id="dpt_name" class="form-control" placeholder="Department Name" value="<?=$department['dpt_name']?>" required>
                            </div>
                            <button type="submit" name="update_department" class="btn btn-success btn-block">Save Updates</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

