<header class="top_nav navbar-expand-md pl-2 pr-2">
    <nav class="d-flex justify-content-between align-items-center">
        <div class="logo d-flex flex-row align-items-center">
            <a href="welcome_page.php" class="m-1"><img src="../assets/images/logo.png" alt="logo"></a>
<!--            <h4 class="app_name">MS</h4>-->
        </div>
        <ul class="navbar-nav">
            <?php if(isset($_SESSION['id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if($_SESSION['user_level'] == 3) echo 'text-warning' ?>" href="#" id="navbardrop" data-toggle="dropdown">
                    <?= $_SESSION["first_name"] ?>
                </a>
                <ul class="dropdown-menu">
                    <a class="dropdown-item text-dark" href="leaves.php">Leaves</a>
                    <a class="dropdown-item text-dark" href="announcements.php">Announcements</a>
                    <a class="dropdown-item text-dark" href="payslip.php">Payslips</a>
                    <li><hr class="dropdown-divider"></li>
                    <a class="dropdown-item text-dark" href="includes/logout.php">Sign out</a>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>