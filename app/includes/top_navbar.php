<header class="top_nav navbar-expand-md bg-dark navbar-dark pl-2 pr-2">
    <nav class="d-flex justify-content-between align-items-center">
        <div class="logo">
            <h4 class="app_name">HRMS</h4>
        </div>
        <ul class="navbar-nav">
            <?php if(isset($_SESSION['id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if($_SESSION['user_level'] == 3) echo 'text-success' ?>" href="#" id="navbardrop" data-toggle="dropdown">
                    <?= $_SESSION["first_name"] ?>
                </a>
                <ul class="dropdown-menu">
                    <a class="dropdown-item" href="#">Your profile</a>
                    <li><hr class="dropdown-divider"></li>
                    <a class="dropdown-item" href="includes/logout.php">Sign out</a>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>