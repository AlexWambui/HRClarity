<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    $sql_fetch_recruitments = "SELECT * FROM recruitments WHERE id = $id";
    $fetched_recruitments = mysqli_query($db_conn, $sql_fetch_recruitments) or die(mysqli_error($db_conn));
    if(mysqli_num_rows($fetched_recruitments) == 0){
        header('location: recruitments.php');
    }
    $recruitment = mysqli_fetch_assoc($fetched_recruitments);
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Update Recruitment</title>
</head>
<body>
<?php
include_once 'includes/top_navbar.php';
include_once 'includes/side_navbar.php';
?>
<div class="main_content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="mini_nav_bar d-flex justify-content-center mt-2 mb-3">
                    <a href="recruitments.php" class="text-center"><< Back to Recruitments</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Update Recruitment</h5>
                    </div>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="update_recruitment.php" method="post" autocomplete="off">
                            <input type="hidden" name="id" id="id" value="<?=$recruitment['id']?>">
                            <div class="form-group">
                                <label for="names">Names</label>
                                <input type="text" name="names" id="names" placeholder="Names" class="form-control" value="<?=$recruitment['names']?>" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" value="<?=$recruitment['email_address']?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" value="<?=$recruitment['phone_number']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input type="text" name="occupation" id="occupation" placeholder="Occupation" class="form-control" value="<?=$recruitment['occupation']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="venue">Venue</label>
                                <input type="text" name="venue" id="venue" placeholder="Venue" class="form-control" value="<?=$recruitment['venue']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="interview_date">Interview Date:</label>
                                <input type="date" name="interview_date" id="interview_date" class="form-control" value="<?=$recruitment['interview_date']?>" required>
                            </div>
                            <button class="btn btn-info btn-block" type="submit" name="update_recruitment">Save Updates</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

