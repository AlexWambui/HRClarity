<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    $sql_fetch_announcement = "SELECT * FROM announcements WHERE id = $id";
    $fetched_announcement = mysqli_query($db_conn, $sql_fetch_announcement) or die(mysqli_error($db_conn));
    if(mysqli_num_rows($fetched_announcement) == 0){
        header('location: occupations.php');
    }
    $announcement = mysqli_fetch_assoc($fetched_announcement);
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "includes/head_section_links.php" ?>
    <title>Update Announcement</title>
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
                    <a href="announcements.php" class="text-center"><< Back to Announcements</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Update Announcement</h5>
                    </div>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="update_announcement.php" method="post">
                            <input type="hidden" name="id" id="id" value="<?=$announcement['id']?>">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Occupation Title" value="<?=$announcement['title']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="announcement">Announcement</label>
                                <textarea name="announcement" id="announcement" rows="4" class="form-control" required><?= $announcement['announcement'] ?></textarea>
                            </div>
                            <button type="submit" name="update_announcement" class="btn btn-success btn-block">Save Updates</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

