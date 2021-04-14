<?php
    include_once "includes/functions.php";
    protect_page();
?>

<!doctype html>
<html lang="en">
<head>
    <?php include_once 'includes/head_section_links.php' ?>
    <title>Welcome Page</title>
</head>
<body>
<?php
    include_once "includes/top_navbar.php";
    include_once "includes/side_navbar.php";
?>
<div class="main_content container pt-3 pl-5">
    <div class="row justify-content-center">
        <div class="col-lg-3 mr-2 mb-2 bg_orange">
            <a href="" class="stretched-link"></a>
            <h4>Personal Details</h4>
            <p>View Details <span class="dashboard_icons icon-forward2"></span></p>
        </div>
        <div class="col-lg-3 mr-2 mb-2 bg_dark_cyan">
            <a href="" class="stretched-link"></a>
            <h4>My Salary</h4>
            <p>Total Salary: 15000/=</p>
        </div>
        <div class="col-lg-3 mr-2 mb-2 bg_purple">
            <a href="#" class="stretched_link"></a>
            <h4>Employees</h4>
            <p>Total Employees: 20</p>
        </div>
        <div class="col-lg-3 mr-2 mb-2 bg_dark_cyan">
            <a href="#" class="stretched_link"></a>
            <h4>Leaves</h4>
            <p>Pending Leaves: 4</p>
        </div>
    </div>
</div>
</body>
</html>