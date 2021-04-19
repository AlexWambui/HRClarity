<?php
include_once 'includes/functions.php';
include_once 'includes/db_connection.php';
protect_page();

if(isset($_REQUEST['from_date'])){
    $type = $_REQUEST['leave_type'];
    $from = $_REQUEST['from_date'];
    $to = $_REQUEST['to_date'];
    $user_id = $_SESSION['id'];

    $sql_add_leave = mysqli_prepare($db_conn, "INSERT INTO leaves (`leave_type`, `from_date`, `to_date`, `user_id`) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($sql_add_leave, "sssi", $type, $from, $to, $user_id);
    mysqli_stmt_execute($sql_add_leave) or die(mysqli_stmt_error($sql_add_leave));
    mysqli_close($db_conn);
    setcookie('success', "leave sent", time()+2);
    header('location: leaves.php');
}
if($_SESSION['user_level'] == 2) {
    $sql_fetch_leaves = "SELECT leaves.id as leave_id, leaves.leave_type, leaves.from_date, leaves.to_date, leaves.status, leaves.user_id as user_id, leaves.date_created, users.first_name, users.last_name FROM leaves LEFT JOIN users ON leaves.user_id = users.id ORDER BY date_created DESC";
    $execute_sql_fetch_leaves = mysqli_query($db_conn, $sql_fetch_leaves) or die(mysqli_error($db_conn));
    $fetched_leaves = mysqli_fetch_all($execute_sql_fetch_leaves, 1);

}
if($_SESSION['user_level'] == 1 or $_SESSION['user_level'] == 3){
    $id = $_SESSION['id'];
    $sql_fetch_leave = "SELECT * FROM leaves LEFT JOIN users ON leaves.user_id = users.id WHERE user_id = $id ORDER BY date_created DESC";
    $execute_sql_fetch_leave = mysqli_query($db_conn, $sql_fetch_leave) or die(mysqli_error($db_conn));
    $fetched_leave = mysqli_fetch_all($execute_sql_fetch_leave, 1);

}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once 'includes/head_section_links.php'?>
    <title>Leaves</title>
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
                <div class="container_header d-flex justify-content-between">
                    <p>Leaves <span class="badge badge-info"><?=count_leaves()?></span></p>
                    <p>Pending <span class="badge badge-danger"><?=count_pending_leaves()?></span></p>
                </div>
                <?php endif; ?>
                <table id="" class="table table-striped">
                    <thead>
                    <tr>
                        <?php if($_SESSION['id'] == 2): ?>
                        <th>Names</th>
                        <?php endif; ?>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                        <?php if($_SESSION['id'] == 2): ?>
                        <th>Approval</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($_SESSION['user_level'] == 1 or $_SESSION['user_level'] == 3): ?>
                    <?php foreach($fetched_leave as $leave): ?>
                        <tr>
                            <?php if($_SESSION['user_level'] == 2): ?>
                            <td><?= $leave['first_name'].' '.$leave['last_name'] ?></td>
                            <?php endif; ?>
                            <td> <?= $leave["leave_type"] ?></td>
                            <td> <?= $leave["from_date"] ?></td>
                            <td> <?= $leave["to_date"] ?></td>
                            <td class="text-success <?php if ($leave['status'] == 'pending') echo 'text-warning'; if($leave['status'] == 'rejected') echo 'text-danger'; ?>"> <?= $leave["status"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if($_SESSION['user_level'] == 2): ?>
                    <?php foreach($fetched_leaves as $leave): ?>
                    <tr>
                        <td><?= $leave['first_name'].' '.$leave['last_name'] ?></td>
                        <td> <?= $leave["leave_type"] ?></td>
                        <td> <?= $leave["from_date"] ?></td>
                        <td> <?= $leave["to_date"] ?></td>
                        <td class="text-success <?php if ($leave['status'] == 'pending') echo 'text-warning'; if($leave['status'] == 'rejected') echo 'text-danger'; ?>"> <?= $leave["status"] ?></td>
                        <td>
                            <div class="row d-flex">
                                <form action="includes/functions.php" method="post" class="form-inline mr-2">
                                    <input type="hidden" name="id" id="id" value="<?= $leave['leave_id'] ?>">
                                    <button class="btn btn-sm" type="submit" name="approve_leave"><span class="text-success icon-check-circle"></span> Approve</button>
                                </form> |
                                <form action="includes/functions.php" method="post" class="form-inline ml-2">
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
            <?php if($_SESSION['user_level'] == 1 or $_SESSION['user_level'] == 3): ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Leave Application</h4>
                    </div>
                    <div class="card-body">
                        <?= alerts() ?>
                        <form action="leaves.php" method="post">
                            <div class="form-group">
                                <label for="leave_type">Leave Type:</label>
                                <select name="leave_type" id="leave_type" class="custom-select">
                                    <option value="none_selected">Select Leave Type</option>
                                    <option value="leave_of_absence">Leave of Absence</option>
                                    <option value="sick">Sick</option>
                                    <option value="maternal">Maternal</option>
                                    <option value="study">Study</option>
                                    <option value="sabbatical">Sabbatical</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="from_date">From Date:</label>
                                <input type="date" name="from_date" id="from_date" min="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="to_date">To Date:</label>
                                <input type="date" name="to_date" id="to_date" min="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                            <button class="btn btn-success btn-block mt-1">Apply Leave</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
