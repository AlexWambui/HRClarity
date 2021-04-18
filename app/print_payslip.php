<?php
include_once "includes/functions.php";
include "includes/db_connection.php";
protect_page();
$id = $_SESSION['id'];
$sql_select_individual_user = "SELECT 
       users.id, 
       users.first_name, 
       users.last_name, 
       users.gender, 
       users.email_address,
       users.phone_number,
       users.department_id, 
       users.profile_picture,
       departments.dpt_name, 
       occupations.title, 
       occupations.basic_salary, 
       occupations.house_allowance, 
       occupations.medical_allowance 
    FROM users 
        JOIN departments ON users.department_id = departments.id 
        JOIN occupations ON users.occupation_id = occupations.id 
        JOIN user_levels ON users.user_level_id = user_levels.id
    WHERE users.id = $id ";
$fetched_user = mysqli_query($db_conn, $sql_select_individual_user) or die(mysqli_error($db_conn));
$user = mysqli_fetch_assoc($fetched_user);
mysqli_close($db_conn);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <?php include_once 'includes/head_section_links.php' ?>
    <title>Employee Payslip</title>
</head>
<body onload="window.print()">
<div class="container mt-3 ml-2">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="payslip_header">
                <h3 class="text-center text-info">EMPLOYEE PAYSLIP</h3>
                <p class="text-center">Date: <?= date('Y-m-d'); ?></p>
            </div>
            <hr>
            <div class="payslip_body">
                <div class="row justify-content-center align-items-center">
                    <div class="col">
                        <img src="<?= $user['profile_picture'] ?>" style="width: 250px; height: 250px; border-radius: 50%;" alt="">
                    </div>
                    <div class="col">
                        <p><i>Names:</i> <?= $user['first_name'] .' '. $user['last_name'] ?></p>
                        <p><i>Phone Number:</i> <?= $user['phone_number'] ?></p>
                        <p><i>Email Address:</i> <?= $user['email_address'] ?></p>
                    </div>
                </div>
                <hr>
                <h3 class="text-center text-info">Payments & Deductions:</h3>
                <div class="row">
                    <div class="col">
                        <p><i>Basic Salary:</i> <?= $user['basic_salary'] ?></p>
                        <p><i>House allowance:</i> <?= $user['house_allowance'] ?></p>
                        <p><i>Medical allowance:</i> <?= $user['medical_allowance'] ?></p>
                        <p><b class="text-success">Gross Income:</b> <?= $user['basic_salary'] + $user['house_allowance'] + $user['medical_allowance'] ?></p>
                    </div>
                    <div class="col">
                        <p><i>NHIF:</i> 500</p>
                        <p><i>Insurance:</i> 200</p>
                        <p><i>Pension:</i> 100</p>
                        <p><b class="text-danger">Total Deductions:</b> 1000</p>
                    </div>
                </div>
                <hr>
                <h4 class="text-center text-info"><b>Net Income:</b> <?= $user['basic_salary'] + $user['house_allowance'] + $user['medical_allowance'] - 1000 ?> </h4>
            </div>
        </div>
    </div>
</div>
</body>
</html>