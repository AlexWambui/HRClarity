<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST['venue'])){
    $names = $_REQUEST['names'];
    $email = $_REQUEST['email_address'];
    $phone = $_REQUEST['phone_number'];
    $occupation = $_REQUEST['occupation'];
    $venue = $_REQUEST['venue'];
    $date = $_REQUEST['interview_date'];

    $sql_add_recruitment = mysqli_prepare($db_conn, "INSERT INTO recruitments (`names`, `email_address`, `phone_number`, `occupation`, `venue`, `interview_date`) VALUES (?,?,?,?,?,?)");
    mysqli_stmt_bind_param($sql_add_recruitment, "ssssss", $names, $email, $phone, $occupation, $venue, $date);
    mysqli_stmt_execute($sql_add_recruitment) or die(mysqli_stmt_error($sql_add_recruitment));
    mysqli_close($db_conn);
    setcookie('success', "recruitment has been added", time()+2);
    header('location: recruitments.php');
}
$sql_fetch_recruitments = "SELECT * FROM recruitments ORDER BY interview_date DESC";
$execute_sql_fetch_recruitments = mysqli_query($db_conn, $sql_fetch_recruitments) or die(mysqli_error($db_conn));
$fetched_recruitments = mysqli_fetch_all($execute_sql_fetch_recruitments, 1);
mysqli_close($db_conn);
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once 'includes/head_section_links.php'?>
    <link rel="stylesheet" href="../assets/css/popup_form.css">
    <title>Recruitments</title>
</head>
<body>
<?php
include_once 'includes/top_navbar.php';
include_once 'includes/side_navbar.php';
?>
<div class="main_content">
    <div class="container pt-3">
        <div class="row">
            <div class="col-lg-12">
                <?= alerts(); ?>
                <table id="example" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Names</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Occupation</th>
                        <th>Venue</th>
                        <th>Interview Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fetched_recruitments as $recruitment): ?>
                        <tr>
                            <td> <?= $recruitment["names"] ?></td>
                            <td> <?= $recruitment["email_address"] ?></td>
                            <td> <?= $recruitment["phone_number"] ?></td>
                            <td> <?= $recruitment["occupation"]?> </td>
                            <td> <?= $recruitment["venue"] ?></td>
                            <td class="<?php if($recruitment["interview_date"] < date('Y-m-d')) echo 'text-danger'; if($recruitment["interview_date"] == date('Y-m-d')) echo 'text-success' ?>"> <?= $recruitment["interview_date"] ?></td>
                            <td>
                                <div class="row d-flex">
                                    <form action="update_recruitment_form.php" method="post" class="form-inline mr-1">
                                        <input type="hidden" name="id" id="id" value="<?= $recruitment['id'] ?>">
                                        <button class="btn btn-sm" type="submit" name="update_recruitment"><span class="icon-pencil text-info"></span></button>
                                    </form> |
                                    <form action="update_recruitment.php" method="post" class="form-inline ml-1">
                                        <input type="hidden" name="id" id="id" value="<?= $recruitment['id'] ?>">
                                        <button class="btn btn-sm" type="submit" name="delete_recruitment"><span class="icon-trash text-danger"></span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button class="btn btn-dark open-button" onclick="addRecruitment()"><span class="icon-add_circle"></span> New Recruitment</button>
        <div class="form-popup" id="recruitment_form">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Add Recruitment</h5>
                </div>
                <div class="card-body">
                    <form action="recruitments.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <input type="text" name="names" id="names" placeholder="Names" class="form-control" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="occupation" id="occupation" placeholder="Occupation" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="venue" id="venue" placeholder="Venue" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="interview_date">Interview Date:</label>
                            <input type="date" name="interview_date" id="interview_date" class="form-control" required>
                        </div>
                        <button class="btn btn-info btn-block"><span class="icon-save"></span> Save</button>
                        <button class="btn btn-danger btn-block" type="submit" onclick="closeRecruitment()"><span class="icon-cancel"></span> Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function addRecruitment() {
        document.getElementById("recruitment_form").style.display = "block";
    }
    function closeRecruitment() {
        document.getElementById("recruitment_form").style.display = "none";
    }
</script>
</body>
</html>
