<?php

include_once "../controllers/users.php";

start_html("Users | Update profile");
navbar();
?>

<main>
    <div class="Users">
        <div class="update_form">
            <div class="header">
                <h1>Update</h1>
            </div>
            <div class="body">
                <?php foreach (fetch_user($_REQUEST['id']) as $user) : ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="id" id="id" value="<?= $user['user_id'] ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required value="<?= $user['first_name'] ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required value="<?= $user['last_name'] ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" min="1960-01-01" max="2006-01-01" value="<?= $user['date_of_birth'] ?>" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="gender">Gender : </label>
                                    <br />
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="male" name="gender" value="male" <?php if ($user['gender'] == "male") echo 'checked' ?> />
                                        <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="female" name="gender" value="female" <?php if ($user['gender'] == "female") echo 'checked' ?> />
                                        <label class="custom-control-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_number">ID Number</label>
                                    <input type="number" name="id_number" id="id_number" class="form-control" placeholder="ID Number" value="<?= $user['id_number'] ?>" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" value="<?= $user['phone_number'] ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address" value="<?= $user['email_address'] ?>" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?= $user['password'] ?>" />
                                </div>
                            </div>
                        </div>                   

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success btn-block" name="update_profile">Update</button>
                            </div>
                            <div class="col">
                                <a href="./dashboard.php" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php end_html() ?>