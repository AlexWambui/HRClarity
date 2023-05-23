<?php       
    include_once "../controllers/departments.php";   

    start_html("Departments");   
    navbar(); 
?>

<main>
    <section class="Departments">
        <div class="top_navbar">
            <h1><?= count_departments() ?> Departments</h1>
            <input type="text" id="myInput" onkeyup="searchFunction()" placeholder="Search Departments...">
        </div>

       <div class="body">
            <div class="displayed_departments">  
                <?= alerts() ?>          
                <table class="table table_hover table-stripped">
                    <thead>
                        <tr>
                            <th>Deparment Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        <?php foreach(fetch_departments() as $department): ?>
                        <tr class="searchable">
                            <td><?= $department['department_name'] ?></td>                        
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a href="update_department.php?id=<?=$department['id']?>" class="btn btn-sm mr-2"><span class="icon-pencil text-info"></span></a>
                                    </div>
                                    <div class="col">
                                        <form 
                                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" 
                                        class="form-inline ml-2"
                                        onsubmit="return confirm('Are you sure you want to delete this department?');"
                                        >
                                            <input type="hidden" name="id" id="id" value="<?= $department['id'] ?>">
                                            <button class="btn btn-sm" type="submit" name="delete_department">
                                                <span class="icon-trash text-danger"></span>
                                            </button>
                                    </form>
                                    </div>
                                </div>                                                        
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="add_department">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">    
                    <div class="form-group">
                        <label for="department_name">Department Name</label>
                        <input type="text" name="department_name" id="department_name" class="form-control" required autofocus>
                    </div>

                    <button class="btn btn-success btn-block mt-1 submit_btn" name="post_department">Add Department</button>                                                      
                </form>
            </div>
       </div>
    </section>
</main>

<?php end_html() ?>