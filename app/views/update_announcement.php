<?php 

    include_once "../controllers/announcements.php";   

    start_html("Announcements | Update announcement");   
    navbar(); 
?>

<main>
    <section class="Announcements">
        <div class="update_form">
            <div class="header">
                <h1>Update Announcement</h1>
            </div>

            <div class="body">
                <?php foreach(fetch_announcement() as $announcement): ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="popup_form">
                    <input type="hidden" name="id" id="id" value="<?= $announcement['id'] ?>">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" required value="<?= $announcement['title'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="3" class="form-control"><?= $announcement['message'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <input type="text" name="venue" id="venue" class="form-control" value="<?= $announcement['venue'] ?>">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" min="<?php echo date('Y-m-d') ?>" value="<?= $announcement['start_date'] ?>">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" min="<?php echo date('Y-m-d') ?>" value="<?= $announcement['end_date'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block" name="update_announcement">Update Announcement</button>
                        </div>

                        <div class="col">
                            <a href="./announcements.php" class="btn btn-danger btn-block">Cancel</a>
                        </div>
                    </div>                                
                </form>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php end_html() ?>