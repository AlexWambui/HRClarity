<?php 
include_once "../controllers/auth.php";

start_html("Signup");
?>
<section class="Authentication">
    <div class="container signup_form_card">

        <div class="header">
            <h1>Signup</h1>
        </div>

        <div class="body">
            <form action="./signup.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" autofocus required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender">Gender : </label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="male" name="gender" value="male">
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="female" name="gender" value="female">
                        <label class="custom-control-label" for="female">Female</label>
                    </div>                        
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="id_number">ID Number</label>
                            <input type="number" name="id_number" id="id_number" class="form-control" placeholder="ID Number">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email_address">Email Address</label>
                            <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                </div>                   

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" min="1960-01-01" max="2006-01-01">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                </div>                                 

                <button class="btn btn-success btn-block" name="signup">Signup</button>
                <p>Already have an account? <a href="./login.php">Login</a></p>    
                <p><a href="../../index.php">Home</a></p>           
            </form>
        </div>
        
    </div>
</section>
<?php end_html() ?>