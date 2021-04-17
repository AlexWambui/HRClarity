<section class="side_nav_bar">
    <ul class="nav_links">
        <li class="nav_items"><a href="welcome_page.php"><span class="side_nav_icons icon-dashboard"></span> Dashboard</a></li>
        <?php if($_SESSION['user_level'] == 3 or $_SESSION['user_level'] == 2 ): ?>
            <li class="nav_items">
                <button class="dropdown-btn side_nav_dropdown"><span class="side_nav_icons icon-group"></span> Employees <span class="icon-caret-down"></span></button>
                <div class="dropdown-container side_nav_dropdown_container">
                    <a href="view_users.php">View employees</a>
                    <a href="register_user.php">Add employee</a>
                </div>
            </li>
            <li class="nav_items"><a href="recruitments.php"><span class="side_nav_icons icon-folder-open"></span> Recruitments</a></li>
        <?php endif; ?>
        <li class="nav_items"><a href="leaves.php"><span class="side_nav_icons icon-time_to_leave"></span> Leaves</a></li>
        <?php if($_SESSION['user_level'] == 3):?>
            <li class="nav_items"><a href="departments.php"><span class="side_nav_icons icon-group_work"></span> Departments</a></li>
            <li class="nav_items"><a href="occupations.php"><span class="side_nav_icons icon-work"></span> Occupations</a></li>
        <?php endif; ?>
        <li class="nav_items"><a href="payslip.php"><span class="side_nav_icons icon-money"></span> Payslip</a></li>
        <?php if($_SESSION['user_level'] == 3 or $_SESSION['user_level'] == 2 ): ?>
            <li class="nav_items"><a href="reports.php"><span class="side_nav_icons icon-bar-chart"></span> Reports</a></li>
        <?php endif; ?>
        <li class="nav_items"><a href="announcements.php"><span class="side_nav_icons icon-announcement"></span> Announcements</a></li>
    </ul>
</section>



<script>
    //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>