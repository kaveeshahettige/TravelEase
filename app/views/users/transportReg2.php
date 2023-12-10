<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase Registration</title>
    <link rel="icon" type="image/x-icon" href="./assets/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/trRegister/stylet.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
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
                    <div class="c1_2">Agency details</div><br><br>
                    
                </div>
                <div class="c2">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST"> <!-- Specify the action attribute here -->
                        <div class="formcontainer">
                            <div class="left-column">
                                <p>Agency Name</p>
                                <input type="text" id="first-name" placeholder="Agency Name" name="agencyname" <?php echo (!empty($data['agencyname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['agencyname']; ?>" ><br>
                                <span class="invalid-feedback"><?php echo $data['agencyname_err']; ?></span>
                                <p>Business Address</p>
                                <input type="text" id="No" placeholder="123 Main Street,ityville, State" name="address" <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>"><br>
                                <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
                                
                                
                            </div>
                            <div class="right-column">
                                
                                <p>Agency Register Number</p>
                                <input type="text" id="regnumber" placeholder="Register Number" name="renumber" <?php echo (!empty($data['renumber_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['renumber']; ?>"><br>
                                <span class="invalid-feedback"><?php echo $data['renumber_err']; ?></span>
                                
                                
                            </div>
                        </div>
                        

                        <div class="back-buttonP">
                            <br>
                            <input type="checkbox"><span>By registering, you agree to our <a href="">Terms and Conditions.</a></span><br><br>
                            <br>
                            
                        </div>
                        <div class="submit-button">
                            <br>
                            <!-- <input type="checkbox"><span>By registering, you agree to our <a href="">Terms & Conditions.</a></span><br><br> -->
                            
                            <div class="buttonCA"><button type="submit" id="next-button">save</button></div><br>
                            <!-- <span class="buttonCA">Already have an Account?<a href="#">Log in</a></span> -->
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
            var nextPageURL = "#";
            // Redirect to the next page
            window.location.href = nextPageURL;
        }

        // Attach a click event listener to the "back" button
        document.getElementById("next-button").addEventListener("click", goToNextPage);

        // Function to be executed when the "back" button is clicked
        function goToBackPage() {
            // Specify the URL of the page you want to navigate to
            var backPageURL = "index.html";
            // Redirect to the next page
            window.location.href = backPageURL;
        }

        // Attach a click event listener to the "back" button
        document.getElementById("back-button").addEventListener("click", goToBackPage);
    </script>
    -->
</body>
</html>