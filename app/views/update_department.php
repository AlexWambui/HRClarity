<?php 

    include_once "../controllers/departments.php";   

    start_html("Departments | Update department");   
    navbar(); 
?>

<main>
    <div class="Departments">
        <div class="update_form">
            <div class="header">
                <h1>Update</h1>
            </div>
            <div class="body">                
                <?php foreach(fetch_department() as $department): ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="id" id="id" value="<?= $department['id'] ?>">
                    <div class="form-group">
                        <label for="department_name">Department Name</label>
                        <input type="text" name="department_name" id="department_name" class="form-control" placeholder="Department Name" required value="<?= $department['department_name'] ?>" />
                    </div>                   
                    
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success btn-block" name="update_department">Update Department</button>
                        </div>
                        <div class="col">
                            <a href="./departments.php" class="btn btn-danger btn-block">Cancel</a>
                        </div>
                    </div>
                </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php end_html() ?>