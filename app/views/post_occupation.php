<?php       
    include_once "../controllers/occupations.php";   

    start_html("Add Occupation");   
    navbar(); 
?>

<main>
    <section class="Occupations">
        <div class="add_occupation_form">
            <div class="header">
                <h1>Add Occupation</h1>
            </div>
            <div class="body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="custom-select" required>
                                    <?= select_department() ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="occupation_name">Occupation Name</label>
                                <input type="text" name="occupation_name" id="occupation_name" class="form-control" placeholder="Occupation Name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="basic_salary">Basic Salary</label>
                                <input type="number" name="basic_salary" id="basic_salary" class="form-control" placeholder="Basic Salary">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="house_allowance">House Allowance</label>
                                <input type="number" name="house_allowance" id="house_allowance" class="form-control" placeholder="House Allowance">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="medical_allowance">Medical Allowance</label>
                                <input type="number" name="medical_allowance" id="medical_allowance" class="form-control" placeholder="Medical Allowance">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success btn-block mt-1 submit_btn" name="post_occupation">Add Occupation</button>                                                      
                </form>
            </div>
        </div>
    </section>
</main>

<?php end_html() ?>