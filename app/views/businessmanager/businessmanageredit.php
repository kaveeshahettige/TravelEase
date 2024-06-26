<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/business-manager edit.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Edit Profile</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/settings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>

            <div id="base">
                <?php
                $userData= $data['userData'];
//                var_dump($userData);
                ?>
                <h3 style="padding-left:20px;">Basic Info</h3>
                <div id="form">
                    <form class="registration-form" method="post" action="<?php echo URLROOT; ?>/businessmanager/updateSettings/<?php echo $_SESSION['user_id']; ?>" >
                        <div>
                            <div class="form-group">
                                <label for="business-manager-name">Name</label>
                                <input type="text" id="business-manager-name" name="business-manager-name" placeholder="Name" value="<?php echo $userData->fname ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="location">Last Name</label>
                                <input type="text" id="business-manager-lname" name="business-manager-lname" placeholder="Last Name" value="<?php echo $userData->lname; ?>" required>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" placeholder="email@gmail.com" value="<?php echo $userData->email; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="phone-number">Phone Number</label>
                                <input type="text" id="phone-number" name="phone-number" placeholder="0764532789" value="<?php echo $userData->number; ?>" required>
                            </div>
                        </div>

                        <div >
                            <div class="baseButtons">
                                <button id="cancelBut">Cancel</button>
                                <button id="saveBut" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </main>
</body>
</html>
