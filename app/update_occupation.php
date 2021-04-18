<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    $sql_fetch_occupation = "SELECT * FROM occupations WHERE id = $id";
    $fetched_occupation = mysqli_query($db_conn, $sql_fetch_occupation) or die(mysqli_error($db_conn));
    if(mysqli_num_rows($fetched_occupation) == 0){
        header('location: occupations.php');
    }
    $occupation = mysqli_fetch_assoc($fetched_occupation);
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Update user</title>
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
                    <a href="occupations.php" class="text-center"><< Back to Occupations</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Update Occupation</h5>
                    </div>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="includes/functions.php" method="post">
                            <input type="hidden" name="id" id="id" value="<?=$occupation['id']?>">
                            <div class="form-group">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Occupation Title" value="<?=$occupation['title']?>" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="basic_salary" id="basic_salary" class="form-control" placeholder="Basic Salary" value="<?=$occupation['basic_salary']?>" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="house_allowance" id="house_allowance" class="form-control" placeholder="House Allowance" value="<?=$occupation['house_allowance']?>" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="medical_allowance" id="medical_allowance" class="form-control" placeholder="Medical Allowance" value="<?=$occupation['medical_allowance']?>" required>
                            </div>
                            <div class="form-group">
                                <textarea name="responsibilities" id="responsibilities" rows="4" class="form-control" placeholder="Responsibilities"><?=$occupation['responsibilities']?></textarea>
                            </div>
                            <div class="form-group">
                                <select name="department" id="department" class="custom-select">
                                    <option value="none_selected">Select Department</option>
                                    <?=update_department($occupation['id'])?>
                                </select>
                            </div>
                            <button type="submit" name="update_occupation" class="btn btn-success btn-block">Save Updates</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

