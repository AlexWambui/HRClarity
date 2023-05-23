<?php       
    include_once "../controllers/occupations.php";   

    start_html("Occupations");   
    navbar(); 
?>

<main>
    <section class="Occupations">
        <div class="top_navbar">
            <h1><?= count_occupations() ?> Occupations</h1>
            <input type="text" id="myInput" onkeyup="searchFunction()" placeholder="Search Occupations...">
            <div class="add_occupation">
                <a href="./post_occupation.php" class="btn btn-success submit_btn">Add Occupation</a>
            </div>
        </div>

        <div class="displayed_departments">  
            <?= alerts() ?>          
            <table class="table table_hover table-stripped">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Occupation Name</th>
                        <th>Basic Salary</th>
                        <th>House Allowance</th>
                        <th>Medical Allowance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php foreach(fetch_occupations() as $occupation): ?>
                    <tr class="searchable">
                        <td class="<?php if($occupation['department_name'] == "") echo "text-danger" ?>">
                            <?php 
                                if($occupation['department_name'] == "") echo "Undefined";
                                else echo $occupation['department_name'];
                            ?>
                        </td>
                        <td><?= $occupation['occupation_name'] ?></td> 
                        <td><?= $occupation['basic_salary'] ?></td>                       
                        <td><?= $occupation['house_allowance'] ?></td>
                        <td><?= $occupation['medical_allowance'] ?></td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <a href="update_occupation.php?id=<?=$occupation['id']?>" class="btn btn-sm mr-2"><span class="icon-pencil text-info"></span></a>
                                </div>
                                <div class="col">
                                    <form 
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                                    method="post" 
                                    class="form-inline ml-2"
                                    onsubmit="return confirm('Are you sure you want to delete this occupation?');"
                                    >
                                        <input type="hidden" name="id" id="id" value="<?= $occupation['id'] ?>">
                                        <button class="btn btn-sm" type="submit" name="delete_occupation">
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
    </section>
</main>

<?php end_html() ?> 