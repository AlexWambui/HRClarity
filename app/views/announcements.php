<?php
include_once "../controllers/announcements.php";

start_html("Announcements");
navbar();
?>

<main>
    <section class="Announcements">
        <div class="top_navbar">
            <h1><?= count_announcements() ?> Announcements</h1>
            <input type="text" id="myInput" onkeyup="searchFunction()" placeholder="Search Announcements...">
            <?php if ($_SESSION['user_level'] != 1) : ?>
                <div class="navbar_button">
                    <button onclick="popupForm()" class="btn btn-success submit_btn action_btn" id="popupFormButton">Make an Announcement</button>
                </div>
            <?php endif; ?>
        </div>

        <div class="anouncement_post_form popupform_wrapper form" id="announcementForm">
            <div class="header">
                <h1>Add Announcement</h1>
            </div>

            <div class="body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="popup_form">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <input type="text" name="venue" id="venue" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" min="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" min="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block" name="post_announcement">Submit</button>
                        </div>

                        <div class="col">
                            <button type="button" class="btn btn-danger btn-block" onclick="closeForm()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?= alerts() ?>
        <div class="announcements_wrapper">
            <?php foreach (fetch_announcements() as $announcement) : ?>
                <div class="announcement searchable <?php if ($announcement['end_date'] < date('Y-m-d')) echo "expired" ?>">
                    <div class="header">
                        <h1><?= $announcement['title'] ?></h1>
                        <?php if ($_SESSION['user_level'] != 1) : ?>
                            <div class="actions">
                                <div class="action">
                                    <a href="./update_announcement.php?id=<?= $announcement['id'] ?>" class="btn btn-sm mr-2"><span class="icon-pencil text-info"></span></a>
                                </div>
                                <div class="action">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-inline ml-2" onsubmit="return confirm('Are you sure you want to delete this Announcement?');">
                                        <input type="hidden" name="id" id="id" value="<?= $announcement['id'] ?>">
                                        <button class="btn btn-sm" type="submit" name="delete_announcement">
                                            <span class="icon-trash text-danger"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="body">
                        <p><?= $announcement['message'] ?></p>
                        <p><span class="icon icon-map-marker"></span> <?= $announcement['venue'] ?></p>
                        <p><span class="icon icon-calendar"></span> From <?= $announcement['start_date'] ?> To <?= $announcement['end_date'] ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</main>

<?php end_html() ?>