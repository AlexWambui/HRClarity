<?php
include_once "../controllers/leaves.php";
include_once "../controllers/users.php";
include_once "../controllers/departments.php";
include_once "../controllers/announcements.php";

start_html("Dashboard");
navbar();
?>

<main>
    <section class="Dashboard">
        <div class="header">
            <h1><?php greet_user() ?></h1>
            <p><?= date("l d-m-Y") ?></p>
        </div>

        <?php if ($_SESSION['user_level'] == 1) : ?>
            <div class="employee_stats">
                <a href="./leaves.php">
                    <div class="leaves">
                        <h1>You have made <?= count_user_leaves() ?> leave requests.</h1>
                        <p>
                            <span>Pending: <?= count_user_pending_leaves() ?></span>
                        </p>
                    </div>
                </a>
                <a href="./announcements.php">
                    <div class="announcements">
                        <h1>
                            <?php
                            if (count_announcements() == 0) echo "There's no announcements.";
                            else echo "You have " . count_announcements() . " Announcements";
                            ?>
                        </h1>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['user_level'] > 1) : ?>
            <div class="links">
                <div class="link">
                    <a href="./users.php">
                        <div class="details">
                            <h1>Employees</h1>
                            <p>
                                <span>Total: <?= count_all_users() ?></span>
                                <span>Active: <?= count_active_users() ?></span>
                                <span>Inactive: <?= count_inactive_users() ?></span>
                            </p>
                        </div>
                    </a>
                    <div class="illustration">
                        <span class="icon icon-users"></span>
                    </div>
                </div>

                <div class="link">
                    <a href="./leaves.php">
                        <div class="details">
                            <h1>Leaves</h1>
                            <p>
                                <span>Total: <?= count_leaves() ?></span>
                                <span>Pending: <?= count_pending_leaves() ?></span>
                            </p>
                        </div>
                    </a>
                    <div class="illustration">
                        <span class="icon icon-time_to_leave"></span>
                    </div>
                </div>

                <div class="link">
                    <a href="./departments.php">
                        <div class="details">
                            <h1>Departments</h1>
                            <p>Total: <?= count_departments() ?></p>
                        </div>
                    </a>
                    <div class="illustration">
                        <span class="icon icon-building"></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php end_html() ?>