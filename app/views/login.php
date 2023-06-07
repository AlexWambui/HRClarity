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
            <form action="./login.php" method="post">
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