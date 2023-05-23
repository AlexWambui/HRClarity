<?php 
    include_once "../controllers/auth.php";

    start_html("Login");
?>
<section class="Authentication">
    <div class="container login_form_card">

        <div class="header">
            <h1>Login</h1>
        </div>

        <div class="body">
            <?= alerts() ?>
            <form action="./login.php" method="post" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="email_address" id="email_address" class="form-control" placeholder="Email Address" autofocus required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <button class="btn btn-success btn-block" name="login">Login</button>
                <p>Don't have an account? <a href="./signup.php">Signup</a></p>
                <p><a href="../../index.php">Home</a></p>
            </form>
        </div>
        
    </div>
</section>
<?php end_html() ?>

<!--
TODO
  *enhance the look on the dashboards ✔
  *make add and view employees one page instead of two diff pages ✔
  *make update and delete pages one page for occupations and departments
  *do reports for admin and hr all employees in the org (names, email, phone, department, occupation, net-income)
  ------------------------------------------------------------------------------------------
  -- users side --
  1. enable users to apply for leaves ✔
  2. users can view their work details (dpt, occupation, responsibilities, hod, salaries) ✔
  3. users can view announcements made by hr_manager ✔
  * add the page for archived users ✔
  ------------------------------------------------------------------------------------------
  -- hr_manager's side --
  1. enable hr_manager accept or reject leaves ✔
  2. hr can make announcements ✔
  3. hr can update or delete announcements ✔
  4. hr can add, update or delete recruitments ✔
  ------------------------------------------------------------------------------------------
  --admin's side --
  1. update and delete occupations and dpts should work without being affected by the relationships.
  ------------------------------------------------------------------------------------------
-->