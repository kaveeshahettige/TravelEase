<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase Login</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/login/style.css">
    <script src="index.js"></script>
    <style>

    </style>
</head>
<body>
    <section class="main1">
    <!-- <?php flash('register_success');?> message apppear after reg -->
        <div class="registerForm">
            <div class="formLeft">
                <div class="c1">
                    <div class="c1_1">
                        <div class="c1_1_1"><img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt=""></div>
                       <div class="c1_1_2">TravelEase</div>
                    </div>
                    <div class="c1_2">Adventure awaits just one login away <br>
                        Join us on your journey!</div>
                </div>
                
                <div class="c2">
                    <form action="<?php echo URLROOT; ?>/users/login" method="POST"> <!-- Specify the action attribute here -->
                        <div class="formcontainer">
                            <div class="logincred">
                                <p>Email</p>
                                <input type="email" id="email" placeholder="Email" name="email" <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

                                <p>Password</p>
                                <input type="password" id="login-password" name="password" placeholder="Password"  <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                            </div>
                        </div>
                        <div class="login-button">
                            <br>
                            <input type="checkbox" ><span>Remember me</span><span id="forgot"> <a href="" style="font-weight:normal">Forgot Password</a></span><br><br>
                            <div class="buttonCA"><button type="submit">Sign In</button></div><br>
                            <span class="buttonCA">Don't have an Account?<a href="<?php echo URLROOT?>users/register">Create Account</a></span>
                        </div>
                    </form>
                </div>

            </div>
            <div class="image">
                <img src="<?php echo URLROOT?>/images/6.jpg" alt="image">
            </div>
        </div>
    </section>
   
</body>
</html>