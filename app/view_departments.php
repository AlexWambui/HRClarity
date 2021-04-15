<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

$sql_fetch_departments = "SELECT * FROM departments";
$execute_sql_fetch_departments = mysqli_query($db_conn, $sql_fetch_departments) or die(mysqli_error($db_conn));
$fetched_departments = mysqli_fetch_all($execute_sql_fetch_departments, 1);
mysqli_close($db_conn);
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once 'includes/head_section_links.php'?>
    <title>View Departments</title>
</head>
<body>
<?php
    include_once 'includes/top_navbar.php';
    include_once 'includes/side_navbar.php';
?>
<div class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="example" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Department Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fetched_departments as $department): ?>
                        <tr>
                            <td> <?= $department["dpt_name"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
