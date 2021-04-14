<?php
include_once 'includes/functions.php';
require_once 'includes/db_connection.php';
protect_page();
$sql_fetch_users = "SELECT * FROM users 
    LEFT JOIN departments ON departments.id = users.department_id
    LEFT JOIN occupations ON occupations.id = users.occupation_id";
$fetched_users = mysqli_query($db_conn, $sql_fetch_users) or die( mysqli_error($db_conn) );// executing the query
$users = mysqli_fetch_all($fetched_users, 1);
mysqli_close($db_conn);
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Employees | View Employees</title>
</head>
<body>
<?php
include 'includes/top_navbar.php';
include 'includes/side_navbar.php';
?>

<div class="main_content">
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-sm-11">
                <table id="example" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Profile Picture</th>
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
                            <td> <img src="<?=$user['profile_picture']?>" style="width: 35px; height: 35px; border-radius: 50%;" alt="profile"> </td>
                            <td> <?= $user["first_name"].' '.$user["last_name"] ?> </td>
                            <td> <?= $user["dpt_name"] ?> </td>
                            <td> <?= $user["title"] ?> </td>
                            <td> <?= $user["basic_salary"] + $user["house_allowance"] + $user["medical_allowance"] ?></td>
                            <td>
                                <a href="update_user.php?id=<?= $user['id']?>"><span class="text-success table_icons icon-pencil"></span></a> |
                                <a href="archive_user.php?id=<?= $user['id']?>"><span class="text-warning table_icons icon-archive"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
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
</script>
</body>
</html>