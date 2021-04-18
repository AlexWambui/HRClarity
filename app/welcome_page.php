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
<div class="main_content container-fluid pt-1">
    <?php if($_SESSION['user_level'] == 1): ?>
    <div class="row dashboard">
        <div class="col m-1 p-2 bg_purple">
            <a href="leaves.php" class="stretched-link"></a>
            <h5 class="text-center"><span class="icon-time_to_leave"></span> Leaves:</h5>
            <p class="m-1">Pending: <span class="dashboard_info"><?=count_individual_pending_leaves()?></span></p>
            <p class="m-1">Total: <span class="dashboard_info"><?=count_individual_leaves()?></span></p>
        </div>
        <div class="col m-1 p-2 bg_dark_cyan">
            <a href="payslip.php" class="stretched-link"></a>
            <h5 class="text-center"><span class="icon-money"></span> Payslip:</h5>
            <p class="m-1">Your Payslip is Ready.</p>
            <p class="m-1">Print Now</p>
        </div>
        <div class="col m-1 p-2 bg_orange">
            <a href="announcements.php" class="stretched-link"></a>
            <h5 class="text-center"><span class="icon-folder-open"></span> Announcements:</h5>
            <p class="m-1">View New Announcements</p>
        </div>
    </div>
    <?php endif; ?>
    <?php if($_SESSION['user_level'] == 2): ?>
    <div class="row dashboard">
        <div class="col m-1 p-2 bg_dark_cyan">
            <a href="users.php" class="stretched-link"></a>
            <h5 class="text-center"><span class="icon-users"></span> Employees:</h5>
            <p class="m-0">Active: <span class="dashboard_info"><?=count_active_users()?></span></p>
            <p class="m-0">Archived: <span class="dashboard_info"><?=count_archived_users()?></span></p>
            <p class="m-0">Total: <span class="dashboard_info"><?=count_users()?></span></p>
        </div>
        <div class="col m-1 p-2 bg_purple">
            <a href="leaves.php" class="stretched-link"></a>
            <h5 class="text-center"><span class="icon-time_to_leave"></span> Leaves:</h5>
            <p class="m-0">Pending: <span class="dashboard_info"><?=count_pending_leaves()?></span></p>
            <p class="m-0">Expired: <span class="dashboard_info"><?=count_expired_leaves()?></span></p>
            <p class="m-0">Total: <span class="dashboard_info"><?=count_leaves()?></span></p>
        </div>
        <div class="col m-1 p-2 bg_orange">
            <a href="recruitments.php" class="stretched-link"></a>
            <h5 class="text-center"><span class="icon-folder-open"></span> Recruitments:</h5>
            <p class="m-0">Expired: <span class="dashboard_info"><?=count_expired_recruitments()?></span></p>
            <p class="m-0">Today: <span class="dashboard_info"><?=count_recruitments_today()?></span></p>
            <p class="m-0">Total: <span class="dashboard_info"><?=count_recruitments()?></span></p>
        </div>
    </div>
    <?php endif; ?>
    <?php if($_SESSION['user_level'] == 3): ?>
    <div class="row dashboard">
            <div class="col m-1 p-2 bg_dark_cyan">
                <a href="users.php" class="stretched-link"></a>
                <h5 class="text-center"><span class="icon-users"></span> Employees:</h5>
                <p class="m-0">Active: <span class="dashboard_info"><?=count_active_users()?></span></p>
                <p class="m-0">Archived: <span class="dashboard_info"><?=count_archived_users()?></span></p>
                <p class="m-0">Total: <span class="dashboard_info"><?=count_users()?></span></p>
            </div>
            <div class="col m-1 p-2 bg_purple">
                <a href="departments.php" class="stretched-link"></a>
                <h5 class="text-center"><span class="icon-time_to_leave"></span> Departments:</h5>
                <p class="m-0">Total: <span class="dashboard_info"><?=count_departments()?></span></p>
            </div>
            <div class="col m-1 p-2 bg_orange">
                <a href="occupations.php" class="stretched-link"></a>
                <h5 class="text-center"><span class="icon-folder-open"></span> Occupations:</h5>
                <p class="m-0">Total: <span class="dashboard_info"><?=count_occupations()?></span></p>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>