<?php       
    include_once "../controllers/users.php"; 
    admin_page();

    start_html("Employees");   
    navbar(); 
?>

<main>    
    <section class="Users">
        <div class="top_navbar">
            <h1><?= count_all_users() ?> Employees</h1>
            <input type="text" id="myInput" onkeyup="searchFunction()" placeholder="Search Employees...">
        </div>

        <div class="users_wrapper">
            <?php foreach(fetch_all_users() as $user):  ?>
            <div class="user searchable">
                <div class="header">
                    <span class="user_status <?php if($user['user_status'] == 2) echo "inactive"?> ">
                        <?php 
                            if($user['user_status'] == 1) echo "verified"; 
                            else echo "unverified" 
                        ?>
                    </span>
                    <span class="icon">
                    <a href="update_user.php?id=<?=$user['user_id']?>" class="btn btn-sm mr-2"><span class="icon-pencil text-success"></span></a>
                    </span>
                </div>
                <div class="body">
                    <div class="personal_info">
                        <div class="profile_pic">
                            <img src="../../assets/uploads/profile_pictures/default.png" alt="profile pic">
                        </div>
                        <div class="details">
                            <h1><?= $user['first_name'].' '. $user['last_name'] ?></h1>
                            <p>
                                <?php 
                                    if($user['occupation_name'] == NULL) echo "undefined";
                                    else echo $user['occupation_name'];
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="more_details">
                        <div class="info">
                            <p>                                
                                <?php 
                                    if($user['department_name'] == "") echo "undefined";
                                    else echo $user['department_name'];
                                ?> department
                            </p>                           
                        </div>

                        <div class="contacts">
                            <p><i class="icon-envelope"></i> <?= $user['email_address'] ?></p>
                            <p><i class="icon-phone"></i> <?= $user['phone_number'] ?></p>
                        </div>
                    </div>                    
                </div>
            </div>
            <?php endforeach; ?>
        </div>        
    </section>
</main>

<?php end_html() ?>