<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase Registration</title>
    <link rel="icon" type="image/x-icon" href="./assets/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/trRegister/stylet.css">
    <script src="indext.js"></script>
    <style>

    </style>
</head>
<body>
    <section class="main1">
        <div class="registerForm">
            <div class="image">
                <img src="<?php echo URLROOT?>/images/6.jpg" alt="image">
            </div>
            <div class="formRight">
                <div class="c1">
                    <div class="c1_1">
                        <div class="c1_1_1"><img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt=""></div>
                       <div class="c1_1_2">TravelEase</div>
                    </div>
                    <div class="c1_2">Start Your Journey Here</div>
                </div>
                <div class="c2">
                    <form action="<?php echo URLROOT?>users/transportReg1" method="POST"> <!-- Specify the action attribute here -->
                        <div class="formcontainer">
                        <div class="left-column">
                                <p>Name</p>
                                <input type="text" id="first-name" name="fname" placeholder="First Name" <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['fname']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
                                <p>Email</p>
                                <input type="email" id="email" name="email" placeholder="Email" <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                                <p>Create Password</p>
                                <input type="password" id="create-password" name="password" placeholder="Create Password" <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                            </div>
                            <div class="right-column">
                                <input type="text" id="last-name" name="lname" placeholder="Last Name" <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lname']; ?>"  style="margin-top: 50px;"><br>
                                <span class="invalid-feedback"><?php echo $data['lname_err']; ?></span>
                                <p>Contact Number</p>
                                <input type="tel" id="telephone" name="number" placeholder="Contact Number" <?php echo (!empty($data['number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['number']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['number_err']; ?></span>
                                <p>Confirm Password</p>
                                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                            </div>
                        </div>
                        <div class="submit-button">
                            <br>
                            <div class="buttonCA"><button type="submit" id="next-button">Next</button></div><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- <script>
        // Function to be executed when the "Next" button is clicked
        function goToNextPage() {
            // Specify the URL of the page you want to navigate to
            var nextPageURL = "2 nd page.html";
            // Redirect to the next page
            window.location.href = nextPageURL;
        }

        // Attach a click event listener to the "Next" button
        document.getElementById("next-button").addEventListener("click", goToNextPage);
    </script> -->
</body>
</html>
