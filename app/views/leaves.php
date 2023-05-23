<?php
include_once "../controllers/leaves.php";

start_html("Leaves");
navbar();
?>

<main>
    <section class="Leaves">
        <div class="top_navbar">
            <h1>
                <?php
                if ($_SESSION['user_level'] != 1) echo count_leaves();
                else echo count_user_leaves();
                ?> Leaves</h1>
            <input type="text" id="myInput" onkeyup="searchFunction()" placeholder="Search Leaves...">
            <?php if ($_SESSION['user_level'] == 1) : ?>
                <div class="navbar_button">
                    <a href="./post_leave.php" class="btn btn-success submit_btn action_btn">Apply for Leave</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="displayed_leaves">
            <?= alerts() ?>
            <div class="details">
                <?php if ($_SESSION['user_level'] == 1) : ?>
                    <p>You have <span><?= count_user_pending_leaves() ?> pending</span> leave requests.</p>
                <?php endif; ?>
            </div>
            <table class="table table_hover table-stripped">
                <thead>
                    <tr>
                        <?php if ($_SESSION['user_level'] == 2) : ?>
                            <th>Names</th>
                        <?php endif; ?>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                        <?php if ($_SESSION['user_level'] == 2) : ?>
                            <th>Approval</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($_SESSION['user_level'] != 2) : ?>
                        <?php foreach (fetch_user_leaves() as $leave) : ?>
                            <tr class="searchable">
                                <?php if ($_SESSION['user_level'] == 2) : ?>
                                    <td><?= $leave['first_name'] . ' ' . $leave['last_name'] ?></td>
                                <?php endif; ?>
                                <td> <?= $leave["leave_type"] ?></td>
                                <td> <?= $leave["from_date"] ?></td>
                                <td> <?= $leave["to_date"] ?></td>
                                <td class="text-success <?php if ($leave['leave_status'] == 'pending') echo 'text-info';
                                                        if ($leave['leave_status'] == 'rejected') echo 'text-danger'; ?>"> <?= $leave["leave_status"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($_SESSION['user_level'] == 2) : ?>
                        <?php foreach (fetch_leaves() as $leave) : ?>
                            <tr class="searchable">
                                <td><?= $leave['first_name'] . ' ' . $leave['last_name'] ?></td>
                                <td> <?= $leave["leave_type"] ?></td>
                                <td> <?= $leave["from_date"] ?></td>
                                <td> <?= $leave["to_date"] ?></td>
                                <td class="text-success <?php if ($leave['leave_status'] == 'pending') echo 'text-warning';
                                                        if ($leave['leave_status'] == 'rejected') echo 'text-danger'; ?>"> <?= $leave["leave_status"] ?></td>
                                <td>
                                    <div class="row d-flex">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-inline mr-2">
                                            <input type="hidden" name="id" id="id" value="<?= $leave['leave_id'] ?>">
                                            <button class="btn btn-sm" type="submit" name="approve_leave"><span class="text-success icon-check-circle"></span> Approve</button>
                                        </form> |
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-inline ml-2">
                                            <input type="hidden" name="id" id="id" value="<?= $leave['leave_id'] ?>">
                                            <button class="btn btn-sm" type="submit" name="reject_leave"><span class="text-danger icon-cancel"></span> Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php end_html() ?>