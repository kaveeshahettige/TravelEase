<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/driver/vehicleAdd.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">

    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">

</head>

<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>"
                alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname'] ?></span>
            <a class="" href="<?php echo URLROOT; ?>/driver/notification">
                <i class="bx bx-bell"></i>
            </a>
        </div>

        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>

        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily
                    Calendar</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i>
                    Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle" class="active"><i class='bx bxs-car bx-sm'></i>
                    Vehicle Information </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earnings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i>
                    Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a>
            </li>
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div>
                <h1>Vehicle Registration Form</h1>
            </div>

            <div id="base">
                <div id="form">
                    <form class="registration-form" action="<?php echo URLROOT ?>driver/vehiclereg" method="POST"
                        enctype="multipart/form-data">
                        <h2>Vehicle Details</h2>

                        <div class="form-group">
                            <label for="vehicle_type">Vehicle Type :</label>
                            <select id="vehicle_type" name="vehicle_type" required>
                                <option value="car">Car</option>
                                <option value="van">Van</option>
                                <option value="bus">SUV</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="brand">Vehicle Brand:</label>
                            <select id="brand" name="brand" required onchange="populateModels()">
                                <option value="">Select Brand</option>
                                <option value="Acura">Acura</option>
                                <option value="Alfa Romeo">Alfa Romeo</option>
                                <option value="Aprilia">Aprilia</option>
                                <option value="Audi">Audi</option>
                                <option value="Austin">Austin</option>
                                <option value="BMW">BMW</option>
                                <option value="Chery">Chery</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Citroen">Citroen</option>
                                <option value="Daewoo">Daewoo</option>
                                <option value="Daihatsu">Daihatsu</option>
                                <option value="DEF">DEF</option>
                                <option value="Dimo">Dimo</option>
                                <option value="Dsk Benelli">Dsk Benelli</option>
                                <option value="Ducati">Ducati</option>
                                <option value="Fiat">Fiat</option>
                                <option value="Ford">Ford</option>
                                <option value="Foton">Foton</option>
                                <option value="Harley Davidson">Harley Davidson</option>
                                <option value="Honda">Honda</option>
                                <option value="Hyundai">Hyundai</option>
                                <option value="Isuzu">Isuzu</option>
                                <option value="Jaguar">Jaguar</option>
                                <option value="Jeep">Jeep</option>
                                <option value="KIA">KIA</option>
                                <option value="Mazda">Mazda</option>
                                <option value="Mercedes-Benz">Mercedes-Benz</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Nissan">Nissan</option>
                                <option value="Perodua">Perodua</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Land Rover">Land Rover</option>
                                <option value="Micro">Micro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="model">Model:</label>
                            <select id="model" name="model" required>
                                <option value="">Select Model</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="plate_number">Plate Number:<div class="error-message">Please enter a valid
                                    plate number (e.g., AAA 0001)</div>
                            </label>
                            <input type="text" id="plate_number" name="plate_number" pattern="[A-Za-z]{2,3}\s\d{4}"
                                title="Please enter a valid plate number (e.g., AAA 0001)" required>

                        </div>


                        <div class="form-group">
                            <label for="fuel-type">Fuel Type:</label>
                            <select id="fuel-type" name="fuel_type" required>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="year">Year:</label>
                            <select id="year" name="year" required>
                                <?php
                                $currentYear = date("Y");
                                $startYear = $currentYear-25; // Set the start year, e.g., 50 years ago
                                $endYear = $currentYear; // Set the end year as the current year
                                
                                for ($year = $endYear; $year >= $startYear; $year--) {
                                    echo "<option value='$year'>$year</option>";
                                }
                                ?>
                            </select>
                        </div>

                       

                        <div class="form-group">
                            <label for="seating_capacity">Seating Capacity: <div class="error-message">Please enter a
                                    valid seating capacity.</div></label>
                            <input type="text" id="seating_capacity" name="seating_capacity" pattern="[1-9][0-9]*"
                                title="Please enter a positive number" required>
                        </div>


                        <div class="form-group">
    <label for="number_of_doors">Number of Doors: <div class="error-message">Please enter a valid number.</div></label>
    <input type="text" id="number_of_doors" name="number_of_doors" pattern="[1-9][0-9]*" title="Please enter a positive number" required>
</div>







                        <label for="description">Description :</label>
                        <textarea id="description" name="description" rows="4" required></textarea>

                        <h2>Pricing</h2>



                        <h3>Without Driver Pricing:</h3>

                        <div class="form-group">
    <label for="priceperday">Driver Price for Day (LKR)*:</label>
    <input type="text" id="priceperday" name="priceperday" pattern="[0-9]+" title="Please enter a positive number" required>
</div>


                        <h3>Driver Pricing:</h3>

                        <p class="description">Leave this field blank if no driver is provided.</p>

                        <div class="form-group">
    <label for="withDriverPerDay">Per Day Price For Driver (LKR)*:</label>
    <input type="text" id="withDriverPerDay" name="withDriverPerDay" pattern="^[0-9]+$" title="Please enter a positive number" required>
</div>





                        <h3>Daily Kilometer Limit:</h3>
                        <p class="description">Leave this field blank for unlimited kilometers.</p>

                        <div class="form-group">
    <label for="dailyKmLimit">Kilometer Limit (LKR)*:</label>
    <input type="number" id="dailyKmLimit" name="dailyKmLimit" min="0" required>
</div>



                        <h2>Upload Photos</h2>

                        <div class="container">
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview1"></div>
                                <label for="image" class="uploadButton">Main Image</label>
                                <input type="file" id="image" name="image" class="imageUpload" accept="image/*">
                            </div>
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview2"></div>
                                <label for="vehi_img2" class="uploadButton">Front Image</label>
                                <input type="file" id="vehi_img2" name="vehi_img2" class="imageUpload" accept="image/*">
                            </div>
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview3"></div>
                                <label for="vehi_img3" class="uploadButton">Rear Image</label>
                                <input type="file" id="vehi_img3" name="vehi_img3" class="imageUpload" accept="image/*">
                            </div>
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview4"></div>
                                <label for="vehi_img4" class="uploadButton">Side Image</label>
                                <input type="file" id="vehi_img4" name="vehi_img4" class="imageUpload" accept="image/*">
                            </div>
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview5"></div>
                                <label for="insurance" class="uploadButton">Insurance</label>
                                <input type="file" id="insurance" name="insurance" class="imageUpload" accept="image/*">
                            </div>
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview6"></div>
                                <label for="registration" class="uploadButton">Registration</label>
                                <input type="file" id="registration" name="registration" class="imageUpload"
                                    accept="image/*">
                            </div>
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview7"></div>
                                <label for="revenue" class="uploadButton">Revenue</label>
                                <input type="file" id="revenue" name="revenue" class="imageUpload" accept="image/*">
                            </div>
                        </div>
                        <h2>Extras</h2>
                        <div class="checkbox-group">
                            <div class="row">
                                <label><input type="checkbox" name="ac_type"> AC</label>
                                <label><input type="checkbox" name="airbag"> Airbag</label>

                                <label><input type="checkbox" name="nav"> NAV</label>
                                <label><input type="checkbox" name="tv"> TV</label>

                                <label><input type="checkbox" name="usb"> USB</label>
                            </div>
                        </div>



                        <p>If the vehicle owner name on the vehicle documents is different from mine, then I
                            hereby confirm that I have the vehicle owner's consent to drive this vehicle on the
                            TravelEase Platform. This declaration can be treated as a No-Objection Certificate
                            and releases TravelEase from any legal obligations and consequences.</p>

                        <div class="baseButtons">
                            <button id="saveBut" type="submit" name="submit" value="Upload">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
    document.querySelectorAll('.imageUpload').forEach(function(input) {
        input.addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            var preview = event.target.parentElement.querySelector('.imagePreview');

            reader.onload = function(e) {
                preview.style.backgroundImage = 'url(' + e.target.result + ')';
            };

            reader.readAsDataURL(file);
        });
    });


    function populateModels() {
        var brandSelect = document.getElementById("brand"); // Corrected id
        var modelSelect = document.getElementById("model");
        var selectedBrand = brandSelect.value;
        // Clear existing options
        modelSelect.innerHTML = "<option value=''>Select Model</option>";
        if (selectedBrand === "") {
            // If no brand is selected, leave model dropdown empty
            return;
        }
        // Add options based on selected brand
        var models = getModelOptions(selectedBrand);
        models.forEach(function(model) {
            var option = document.createElement("option");
            option.text = model;
            option.value = model;
            modelSelect.appendChild(option);
        });
    }


    function getModelOptions(brand) {
        // Here you can provide model options for each brand available in Sri Lanka
        switch (brand) {
            case "Acura":
                return ["MDX", "RDX", "TLX"];
            case "Alfa Romeo":
                return ["Giulia", "Stelvio"];
            case "Aprilia":
                return ["RSV4", "Tuono", "RS 660"];
            case "Audi":
                return ["A3", "A4", "Q5"];
            case "Austin":
                return ["Mini", "1300"];
            case "BMW":
                return ["3 Series", "5 Series", "X1", "X3", "X5"];
            case "Chery":
                return ["Arrizo 5", "Tiggo 7"];
            case "Chevrolet":
                return ["Cruze", "Spark", "Trailblazer"];
            case "Citroen":
                return ["C3", "C5 Aircross"];
            case "Daewoo":
                return ["Lanos", "Matiz"];
            case "Daihatsu":
                return ["Mira", "Terios"];
            case "DEF":
                return ["DEF Model1", "DEF Model2"];
            case "Dimo":
                return ["Batta", "L300"];
            case "Dsk Benelli":
                return ["TNT 300", "TNT 600i"];
            case "Ducati":
                return ["Panigale V4", "Monster 821"];
            case "Fiat":
                return ["500", "Punto"];
            case "Ford":
                return ["Fiesta", "Focus", "Ranger"];
            case "Foton":
                return ["View", "Thunder"];
            case "Harley Davidson":
                return ["Street Glide", "Iron 883"];
            case "Honda":
                return ["Civic", "City", "CR-V"];
            case "Hyundai":
                return ["i10", "i20", "Tucson"];
            case "Isuzu":
                return ["D-Max", "MU-X"];
            case "Jaguar":
                return ["XE", "F-Pace"];
            case "Jeep":
                return ["Wrangler", "Cherokee"];
            case "KIA":
                return ["Rio", "Seltos", "Sportage"];
            case "Mazda":
                return ["3", "CX-5"];
            case "Mercedes-Benz":
                return ["C-Class", "E-Class", "GLA", "GLC", "GLE"];
            case "Mitsubishi":
                return ["Lancer", "Outlander", "Pajero", "Mirage", "Montero"];
            case "Nissan":
                return ["Sunny", "March", "X-Trail", "Leaf", "Navara"];
            case "Perodua":
                return ["Axia", "Myvi"];
            case "Suzuki":
                return ["Alto", "Swift", "Wagon R", "Baleno", "Vitara"];
            case "Toyota":
                return ["Corolla", "Yaris", "Vitz", "Prius", "Hiace"];
            case "Land Rover":
                return ["Range Rover", "Discovery"];
            case "Micro":
                return ["Panda Cross", "Rhino"];
            default:
                return []; // If brand not found or no models available
        }
    }

    function validateSeatingCapacity() {
        var brandSelect = document.getElementById("make");
        var modelSelect = document.getElementById("model");
        var seatingCapacityInput = document.getElementById("seating_capacity");
        var selectedBrand = brandSelect.value;
        var selectedModel = modelSelect.value;
        var seatingCapacity = parseInt(seatingCapacityInput.value);

        // Seating capacity limits for various brands and models
        var seatingCapacityLimits = {
            "Toyota": {
                "Corolla": 5,
                "Yaris": 5,
                "Vitz": 4,
                "Prius": 5,
                "Hiace": 10
            },
            "Honda": {
                "Civic": 5,
                "City": 5,
                "CR-V": 5
            },
        };

        if (selectedBrand && selectedModel) {
            var brandModels = seatingCapacityLimits[selectedBrand];
            if (brandModels && brandModels[selectedModel]) {
                var maxSeatingCapacity = brandModels[selectedModel];
                if (seatingCapacity > 0 && seatingCapacity <= maxSeatingCapacity) {
                    // Valid seating capacity
                    return true;
                } else {
                    // Invalid seating capacity
                    return false;
                }
            }
        }
        // If brand or model not found, assume seating capacity is valid
        return true;
    }

    function validateForm() {
        var isValidSeatingCapacity = validateSeatingCapacity();
        if (!isValidSeatingCapacity) {
            // Show error message for seating capacity
            var errorMessage = document.querySelector(".error-message");
            errorMessage.style.display = "block";
            return false;
        }
        return true;
    }

    // Call validateForm() when form is submitted
    var form = document.querySelector(".registration-form");
    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
    </script>

</body>

</html>