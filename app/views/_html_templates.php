<?php
function start_html($page_title)
{
    ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../../assets/css/icomoon.css">
            <link rel="stylesheet" href="../../assets/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../assets/css/styles.css">
            <script src="../../assets/js/jquery.min.js"></script>
            <script src="../../assets/js/popper.min.js"></script>
            <script src="../../assets/js/bootstrap.min.js"></script>
            <title><?= $page_title ?></title>
        </head>
        <body>
    <?php
}


function navbar() 
{
    ?>
        <section class="side_navbar">
            <div class="header">
                <h1>HRClarity</h1>
            </div>
            <ul class="nav_links">
                <li><a href="dashboard.php"><span class="icon icon-dashboard"></span> <span>Dashboard</span></a></li>
                <?php if($_SESSION['user_level'] > 1): ?>
                <li><a href="users.php"><span class="icon icon-users"></span> <span>Employees</span></a></li>
                <li><a href="departments.php"><span class="icons icon-building"></span> <span>Departments</span></a></li>
                <li><a href="occupations.php"><span class="icon icon-work"></span> <span>Occupations</span></a></li>
                <?php endif; ?>
                <li><a href="announcements.php"><span class="icon icon-microphone"></span> Announcements</a></li>
                <li><a href="leaves.php"><span class="icon icon-time_to_leave"></span> <span>Leaves</span></a></li>
            </ul>
            <ul class="footer">  
                <li>
                <a href="update_profile.php?id=<?=$_SESSION['user_id']?>" class="btn btn-sm mr-2">
                    <img 
                        src="<?= $_SESSION["user_profile_picture"] ?>" 
                        alt="Profile Picture"
                        class="<?php if($_SESSION['user_status'] == 1) echo "verified"; else echo "unverified" ?>"
                    />
                    </a>
                </li>   
                <li><?= $_SESSION['user_first_name'].' '.$_SESSION['user_last_name'] ?></li>
                <li>
                    <form action="../controllers/auth.php" method="post">
                        <button type="submit" class="btn btn-danger action_btn" name="logout">
                            <span class="icon icon-power-off"></span> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </section>
    <?php
}

function data_table(){
        ?>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/data_table.js"></script>
        <?php
    }

function end_html(){
        ?>
            <script src="../../assets/js/popupform.js"></script>
            <script src="../../assets/js/search.js"></script>
            <script src="../../assets/js/fadeannouncements.js" ></script>
        </body>
        </html>
        <?php
    }