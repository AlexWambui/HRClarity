<?php
include_once '../controllers/users.php';

start_html('Payslip');
navbar();
?>

<main>
    <section class="Payslip">
        <?php foreach (fetch_user($_SESSION['user_id']) as $user) : ?>
            <div class="payslip_wrapper">
                <div class="header">
                    <h1>HRClarity</h1>
                    <h2>Payslip</h2>
                </div>

                <div class="body">
                    <div class="details">
                        <div>
                            <p>Employee: <span><?= $user['first_name'] . ' ' . $user['last_name'] ?></span></p>
                            <p>ID Number: <span><?= $user['id_number'] ?></span></p>
                            <p>Email: <span><?= $user['email_address'] ?></span></p>
                        </div>
                        <div>
                            <p>Pay Roll: <span><?= rand(0, 10000) ?></span></p>
                            <p>Pay Period: <span><?= date('M') ?></span></p>
                        </div>
                    </div>

                    <div class="payments">
                        <table class="table table-hoverable table-bordered">
                            <thead>
                                <tr>
                                    <th>Earnings</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Basic Salary</td>
                                    <td><?= $user['basic_salary'] ?></td>
                                </tr>
                                <tr>
                                    <td>House Allowance</td>
                                    <td><?= $user['house_allowance'] ?></td>
                                </tr>
                                <tr>
                                    <td>Medical Allowance</td>
                                    <td><?= $user['medical_allowance'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>Total</b></td>
                                    <td>
                                        <b>
                                            <?php
                                                $total_salary = $user['basic_salary'] + $user['house_allowance'] + $user['medical_allowance'];
                                                echo $total_salary;
                                            ?>
                                        </b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-hoverable table-bordered">
                            <thead>
                                <tr>
                                    <th>Deductions</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tax</td>
                                    <td>3%</td>
                                </tr>
                                <tr>
                                    <td>Pension</td>
                                    <td>5%</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>Total</b></td>
                                    <td>
                                        <b>
                                            <?php 
                                                $total_deduction = (0.03 * $total_salary) + (0.05 * $total_salary);
                                                echo $total_deduction;
                                            ?>
                                        </b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h4>Net Pay: <?= $total_salary - $total_deduction ?></h4>
                </div>
            <?php endforeach; ?>
            </div>
    </section>
</main>

<?php end_html(); ?>