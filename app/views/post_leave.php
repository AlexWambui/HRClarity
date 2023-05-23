<?php  
include_once "../controllers/leaves.php";   

start_html("Apply for Leave");   
navbar(); 
?>
<main>
    <section class="Leaves">
        <div class="leave_form pop_form">
            <div class="card-header">
                <h4 class="text-center">Leave Application</h4>
            </div>
            <div class="card-body">
                <?= alerts() ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="leave_type">Leave Type:</label>
                                <select name="leave_type" id="leave_type" class="custom-select">
                                    <option value="none_selected">Select Leave Type</option>
                                    <option value="leave of absence">Leave of Absence</option>
                                    <option value="sick">Sick</option>
                                    <option value="maternal">Maternal</option>
                                    <option value="study">Study</option>
                                    <option value="sabbatical">Sabbatical</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="from_date">From Date:</label>
                                <input type="date" name="from_date" id="from_date" min="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="to_date">To Date:</label>
                                <input type="date" name="to_date" id="to_date" min="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success btn-block mt-1 submit_btn" name="apply_for_leave">Apply for Leave</button>
                        </div>
                        <div class="col">
                            <a href="./leaves.php" class="btn btn-danger btn-block mt-1">Cancel</a>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </section>
</main>
<?php end_html() ?>