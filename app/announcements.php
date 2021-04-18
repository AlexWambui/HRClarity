<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST['announcement'])){
    $title = $_REQUEST['title'];
    $announcement = $_REQUEST['announcement'];

    $sql_add_announcement = mysqli_prepare($db_conn, "INSERT INTO announcements (`title`, `announcement`) VALUES (?,?)");
    mysqli_stmt_bind_param($sql_add_announcement, "ss", $title, $announcement);
    mysqli_stmt_execute($sql_add_announcement) or die(mysqli_stmt_error($sql_add_announcement));
    mysqli_close($db_conn);
    setcookie('success', "announcement has been sent", time()+2);
    header('location: announcements.php');
}
$sql_fetch_announcements = "SELECT * FROM announcements";
$execute_sql_fetch_announcements = mysqli_query($db_conn, $sql_fetch_announcements) or die(mysqli_error($db_conn));
$fetched_announcements = mysqli_fetch_all($execute_sql_fetch_announcements, 1);
mysqli_close($db_conn);
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once 'includes/head_section_links.php'?>
    <link rel="stylesheet" href="../assets/css/popup_form.css">
    <title>Announcements</title>
</head>
<body>
<?php
include_once 'includes/top_navbar.php';
include_once 'includes/side_navbar.php';
?>
<div class="main_content">
    <div class="container pt-3">
        <div class="row">
            <div class="col-lg-8 <?php if($_SESSION['id'] == 2) echo 'col-lg-12' ?>">
                <?php if($_SESSION['id'] == 2): ?>
                    <?= alerts(); ?>
                <?php endif; ?>
                <table id="example" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Announcement</th>
                        <th>Date</th>
                        <?php if($_SESSION['id'] == 2): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fetched_announcements as $announcement): ?>
                        <tr>
                            <td> <?= $announcement["title"] ?></td>
                            <td> <?= $announcement["announcement"] ?></td>
                            <td> <?= $announcement["date_created"] ?></td>
                            <?php if($_SESSION['id'] == 2): ?>
                                <td>
                                    <div class="row d-flex">
                                        <a href="update_announcement_form.php?id=<?=$announcement['id']?>" class="btn btn-outline-success btn-sm mr-2"><span class="icon-pencil"></span> Update</a>|
                                        <form action="includes/functions.php" method="post" class="form-inline ml-2">
                                            <input type="hidden" name="id" id="id" value="<?= $announcement['id'] ?>">
                                            <button class="btn btn-outline-danger btn-sm" type="submit" name="delete_announcement"><span class="icon-cancel"></span> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if($_SESSION['id']==2): ?>
                <div class="col-lg-6">
                    <button class="btn btn-dark open-button" onclick="makeAnnouncement()"><span class="icon-microphone"></span> Make Announcement</button>
                    <div class="form-popup" id="announcements_form">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-center">Announcement</h5>
                            </div>
                            <div class="card-body">
                                <form action="announcements.php" method="post" autocomplete="off">
                                    <div class="form-group">
                                        <input type="text" name="title" id="title" placeholder="Enter Title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="announcement">Announcement</label>
                                        <textarea name="announcement" id="announcement" class="form-control" rows="4" placeholder="Type your Announcement" required></textarea>
                                    </div>
                                    <button class="btn btn-info btn-block"><span class="icon-send"></span> Send</button>
                                    <button class="btn btn-danger btn-block" type="submit" onclick="closeAnnouncement()"><span class="icon-cancel"></span> Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    function makeAnnouncement() {
        document.getElementById("announcements_form").style.display = "block";
    }
    function closeAnnouncement() {
        document.getElementById("announcements_form").style.display = "none";
    }
</script>
</body>
</html>
