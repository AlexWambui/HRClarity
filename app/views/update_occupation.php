<?php 
    include_once "../controllers/occupations.php";   

    start_html("Occupations | Update occupation");   
    navbar(); 
?>

<main>
    <div class="Occupations">
        <div class="update_form">
            <div class="header">
                <h1>Update</h1>
            </div>
            <div class="body">                
                <?php foreach(fetch_occupation() as $occupation): ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">    
                    <input type="hidden" name="id" id="id" value="<?= $occupation['id'] ?>">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="custom-select" required>
                                    <option value="<?= $occupation['department_id'] ?>">
                                        <?php
                                            if($occupation['department_name'] == "") echo "undefined";
                                            else echo $occupation['department_name'];
                                        ?>
                                    </option>
                                    <?= select_department() ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="occupation_name">Occupation Name</label>
                                <input type="text" name="occupation_name" id="occupation_name" class="form-control" placeholder="Occupation Name" required 
                                value="<?= $occupation['occupation_name'] ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="basic_salary">Basic Salary</label>
                                <input type="number" name="basic_salary" id="basic_salary" class="form-control" placeholder="Basic Salary"  
                                value="<?= $occupation['basic_salary'] ?>" />
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="house_allowance">House Allowance</label>
                                <input type="number" name="house_allowance" id="house_allowance" class="form-control" placeholder="House Allowance"
                                value="<?= $occupation['house_allowance'] ?>" >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="medical_allowance">Medical Allowance</label>
                                <input type="number" name="medical_allowance" id="medical_allowance" class="form-control" placeholder="Medical Allowance"
                                value="<?= $occupation['medical_allowance'] ?>" >
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success btn-block mt-1 submit_btn" name="update_occupation">Update Occupation</button>                                                      
                </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php end_html() ?>