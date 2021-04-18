<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST['title'])){
    $title = $_REQUEST['title'];
    $responsibilities = $_REQUEST['responsibilities'];
    $basic_salary = $_REQUEST['basic_salary'];
    $house_allowance = $_REQUEST['house_allowance'];
    $medical_allowance = $_REQUEST['medical_allowance'];
    $department = $_REQUEST['department'];

    if (!empty($db_conn)) {
        $sql_add_occupation = mysqli_prepare($db_conn, "INSERT INTO occupations (`title`, `responsibilities`, `basic_salary`, `house_allowance`, `medical_allowance`, `department_id`) VALUES(?,?,?,?,?,?)");
        mysqli_stmt_bind_param($sql_add_occupation, "ssdddi", $title, $responsibilities, $basic_salary, $house_allowance, $medical_allowance, $department);
        mysqli_stmt_execute($sql_add_occupation) or die(mysqli_stmt_error($sql_add_occupation));
        mysqli_close($db_conn);
        setcookie('success', 'occupation inserted successfully', time()+2);
        header('location: occupations.php');
    }
}
$sql_fetch_occupations = "SELECT occupations.id as occupations_id, occupations.title, occupations.responsibilities, occupations.basic_salary, departments.dpt_name as dpt_name FROM occupations LEFT JOIN departments ON occupations.department_id = departments.id";
$sql_fetched_occupations = mysqli_query($db_conn, $sql_fetch_occupations) or die(mysqli_error($db_conn));
$fetched_occupations = mysqli_fetch_all($sql_fetched_occupations, 1);
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Occupations</title>
</head>
<body>
<?php
    include_once "includes/top_navbar.php";
    include_once "includes/side_navbar.php";
?>
<div class="main_content">
    <div class="container pt-3">
        <div class="row">
            <div class="col-lg-8">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Occupation</th>
                            <th>Basic Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fetched_occupations as $occupation): ?>
                        <tr>
                            <td> <?= $occupation['dpt_name'] ?> </td>
                            <td> <?= $occupation['title'] ?> </td>
                            <td> <?= $occupation['basic_salary'] ?> </td>
                            <td>
                                <a href="update_occupation.php?id=<?= $occupation['occupations_id']?>"><span class="table_icons icon-pencil text-success"></span></a>|
                                <a href="delete_occupation.php?id=<?= $occupation['occupations_id']?>"><span class="table_icons icon-trash text-success"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Add Occupation</h5>
                    </div>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="occupations.php" method="post">
                            <div class="form-group">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Occupation Title" autofocus required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="basic_salary" id="basic_salary" class="form-control" placeholder="Basic Salary" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="house_allowance" id="house_allowance" class="form-control" placeholder="House Allowance" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="medical_allowance" id="medical_allowance" class="form-control" placeholder="Medical Allowance" required>
                            </div>
                            <div class="form-group">
                                <textarea name="responsibilities" id="responsibilities" rows="4" class="form-control" placeholder="Responsibilities"></textarea>
                            </div>
                            <div class="form-group">
                                <select name="department" id="department" class="custom-select">
                                    <option value="none_selected">Select Department</option>
                                    <?=select_department()?>
                                </select>
                            </div>
                            <button class="btn btn-success btn-block">Add Occupation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

