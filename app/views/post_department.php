<?php  
include_once "../controllers/departments.php";   

start_html("Add Department");   
navbar(); 
?>

<main>
    <section class="Departments">
        <div class="department_form pop_form">
            <div class="card-header">
                <h4 class="text-center">Add Department</h4>
            </div>
            <div class="card-body">
                <?= alerts() ?>
                
            </div>
        </div>
    </section>
</main>

<?php end_html() ?>