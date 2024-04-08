<?php
class Driver extends Controller{

    private $TravelsModel;
    

    private $postModel;
    public function __construct(){
        
        if(!isLoggedIn()){
            redirect('users/login');
          }
          $this->TravelsModel = $this->model('Travel');
    }

    
    
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page or handle unauthorized access
            redirect('login');
            return; // Add return statement to prevent further execution
        }
        // Get user ID from session
        $userId = $_SESSION['user_id'];
    
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submissions
            if (isset($_POST['agency_name']) && isset($_POST['reg_number']) && isset($_POST['address']) && isset($_POST['description']) && isset($_POST['location'])) {
                // Handle agency details submission
                $agencyName = htmlspecialchars($_POST['agency_name']);
                $regNumber = htmlspecialchars($_POST['reg_number']);
                $address = htmlspecialchars($_POST['address']);
                $description = htmlspecialchars($_POST['description']);
                $website = isset($_POST['website']) ? htmlspecialchars($_POST['website']) : '-';
                $facebook = isset($_POST['facebook']) ? htmlspecialchars($_POST['facebook']) : '-';
                $twitter = isset($_POST['twitter']) ? htmlspecialchars($_POST['twitter']) : '-';
                $instagram = isset($_POST['instagram']) ? htmlspecialchars($_POST['instagram']) : '-';
                $location = htmlspecialchars($_POST['location']);
    
                // Call the model to insert agency details into the database
                if ($this->TravelsModel->addAgency($agencyName, $regNumber, $address, $description, $website, $facebook, $twitter, $instagram, $location, $userId)) {
                    // Agency added successfully
                    // You can redirect or show a success message
                    flash('success', 'Agency added successfully');
                    redirect('driver/index');
                } else {
                    // Error adding agency
                    // You can redirect or show an error message
                    flash('error', 'Failed to add agency');
                    redirect('driver/index');
                }
            } elseif (isset($_FILES['service-validation-pdf'])) {
                // Handle file submission
                $targetDir = "../public/uploads/service_validations/";
    
                // Construct a unique filename based on user ID and the original filename
                $originalFilename = $_FILES['service-validation-pdf']['name'];
                $base = pathinfo($originalFilename, PATHINFO_FILENAME);
                $base = preg_replace("/[^\w-]/", "_", $base);
                $filename = "{$userId}_{$base}.pdf";
                $targetFile = $targetDir . $filename;
    
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['service-validation-pdf']['tmp_name'], $targetFile)) {
                    // Call the model to insert the PDF information into the database
                    if ($this->TravelsModel->insertPdf($filename, $userId)) {
                        // Success - You can redirect or show a success message
                        flash('success', 'PDF submitted successfully');
                        redirect('driver/index');
                    } else {
                        // Error - You can redirect or show an error message
                        flash('error', 'Failed to submit PDF');
                        redirect('driver/index');
                    }
                } else {
                    // Error - You can redirect or show an error message
                    flash('error', 'Failed to move the uploaded file');
                    redirect('driver/index');
                }
            }
        }
    
        // Call the model to get agency details for the user
        $agencyDetails = $this->TravelsModel->getAgencyDetails($userId);
        $userDetails = $this->TravelsModel->getUserDetails($_SESSION['user_id']);
    
        // Check if all required fields in agency details are filled
        $emptyFields = []; // Initialize emptyFields array
        if (empty($agencyDetails->website)) {
            $emptyFields[] = 'website';
        }
        if (empty($agencyDetails->facebook)) {
            $emptyFields[] = 'facebook';
        }
        if (empty($agencyDetails->twitter)) {
            $emptyFields[] = 'twitter';
        }
        if (empty($agencyDetails->instagram)) {
            $emptyFields[] = 'instagram';
        }
    
        // Debug code to show empty fields
        echo "<pre>";
        print_r($emptyFields);
        echo "</pre>";
    
        // Pass the emptyFields flag and list of empty fields to the view along with other data
        $data = [
            'agencyDetails' => $agencyDetails,
            'formVisible' => count($emptyFields) > 0,
            'user_id' => $userId,
            'emptyFields' => $emptyFields,
            'userDetails' => $userDetails,
            'emptyAgencyFields' => $this->checkEmptyAgencyFields($agencyDetails), // Add this line
        ];
    
        $this->view('driver/index', $data);
    }
    
    public function calender() {
        // Get the current date in UTC+05:30 timezone
        $currentDate = new DateTime('now', new DateTimeZone('Asia/Colombo'));
        $formattedDate = $currentDate->format('Y-m-d');
    
        $data = [
            'selectedDate' => $formattedDate,
            'basicInfo' => $this->basicInfo(),
        ];
    
        $this->view('driver/calender', $data);
    }
    
    

    public function availablevehicles()
    {
        $date = $_GET['date'] ?? null;
    
        if (empty($date)) {
            flash('error', 'Please select a date.');
            redirect('driver/calender');
        }
    
        $user_id = $_SESSION['user_id'];
        $agency_id = $this->TravelsModel->getAgencyIdByUserId($user_id);
    
        $vehicleData = $this->TravelsModel->getAgencyvehicles($agency_id);
        $vehicleIds = array_column($vehicleData, 'vehicle_id');
    
        $unavailableDates = $this->TravelsModel->getUnavailableDatesForVehicles($vehicleIds, $date);
    
        $unavailableVehicles = [];
        foreach ($unavailableDates as $unavailable) {
            $unavailableVehicles[$unavailable->vehicle_id] = true;
        }
    
        $data = [
            'vehicleData' => $vehicleData,
            'date' => $date,
            'unavailableVehicles' => $unavailableVehicles,
            'basicInfo' => $this->basicInfo(),
        ];
    
        $this->view('driver/availablevehicles', $data);
    }
    
    public function setUnavailableDate()
    {
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Assuming you have a method in your model to set unavailable dates
        $result = $this->TravelsModel->setUnavailableDate($data['vehicle_id'], $data['date']);
    
        if ($result) {
            // Set Unavailability successful
            echo json_encode(['success' => true]);
        } else {
            // Set Unavailability failed
            echo json_encode(['success' => false]);
        }
    }
    
    public function removeUnavailableDate()
    {
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Assuming you have a method in your model to remove unavailable dates
        $result = $this->TravelsModel->removeUnavailableDate($data['vehicle_id'], $data['date']);
    
        if ($result) {
            // Remove Unavailability successful
            echo json_encode(['success' => true]);
        } else {
            // Remove Unavailability failed
            echo json_encode(['success' => false]);
        }
    }
    


    
    public function basicInfo()
    {
        $travelModel = $this->model('Travel');

        $user_id = $_SESSION['user_id'];

        // Get user details
        $userData = $travelModel->getUserById($user_id);

        // Get hotel details
        $driverData = $travelModel->getDiverByUserId($user_id);

        // Pass data to the view
        return ['userData' => $userData, 'driverData' => $driverData];
    }
    
    
   

    private function checkEmptyAgencyFields($agencyDetails) {
        $emptyFields = [];
        if (empty($agencyDetails->agency_name)) {
            $emptyFields[] = 'agency_name';
        }
        if (empty($agencyDetails->reg_number)) {
            $emptyFields[] = 'reg_number';
        }
        // Add checks for other fields as needed
        return $emptyFields;
    }
    public function bookings() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page or handle unauthorized access
            redirect('login');
            return; // Add return statement to prevent further execution
        }
       
        // Get user ID from session
        $userId = $_SESSION['user_id'];
        // var_dump($userId);
        
        $agencyId = $this->TravelsModel->getAgencyId($userId);
        // var_dump($agencyId);
        
        $pendingBookings = $this->TravelsModel->getPendingBookings($agencyId);
    
        // Fetch payment amounts for each booking ID and store them in an array
        $paymentAmounts = [];
        foreach ($pendingBookings as $booking) {
            $paymentAmounts[$booking->booking_id] = $this->TravelsModel->getPaymentAmountForBooking($booking->booking_id);
        }
    
        // var_dump($paymentAmounts); // Debug: Display booking IDs with their corresponding payment amounts
        
        foreach ($pendingBookings as $key => $booking) {
            // Call getPlateNumberForVehicle with the vehicle_id property of the $booking object
            $plateNumber = $this->TravelsModel->getPlateNumberForVehicle($booking->vehicle_id);
            // if ($plateNumber) {       

            //     // Append the plate_number property of $plateNumber to $plateNumbers
            //     $pendingBookings[$key]->plate_number = $plateNumber->plate_number;
            // }
        var_dump($plateNumber);
            // Call getTravelerDetails with the user_id property of the $booking object
            $details = $this->TravelsModel->getTravelerDetails($booking->user_id);
            if ($details) {
                // Append the traveler's details to $travelerDetails
                $pendingBookings[$key]->traveler_details = $details;
            }
        
            // Call getVehicleBookingDetails with the booking_id property of the $booking object
            $vehicleDetails = $this->TravelsModel->getVehicleBookingDetails($booking->booking_id);
            if ($vehicleDetails) {
                // Merge vehicle details with booking details
                $pendingBookings[$key]->start_time = $vehicleDetails->start_time;
                $pendingBookings[$key]->withDriver = $vehicleDetails->withDriver;
                $pendingBookings[$key]->Pickup_Location = $vehicleDetails->Pickup_Location;
                $pendingBookings[$key]->End_Location = $vehicleDetails->End_Location;
        
                // Get payment amount for the booking
                $paymentAmount = $this->TravelsModel->getPaymentAmountForBooking($booking->booking_id);
                $pendingBookings[$key]->payment_amount = $paymentAmount;
            }

        }
        $data = [
            'pendingBookings' => $pendingBookings,
            'paymentAmounts' => $paymentAmounts,
            'plateNumber' => $plateNumber,
            // var_dump($pendingBookings)
        ];
        // var_dump($plateNumber); // Debug: Display the data array
        $this->view('driver/bookings', $data);
    }
    
    
    
    public function getPlateNumberForVehicle($vehicleId) {
        $plateNumber = $this->TravelsModel->getPlateNumberForVehicle($vehicleId);
        return $plateNumber;
    }
    
        
    
    
    
    public function earings() {

        
                $user_id = $_SESSION['user_id'];
                $totalEarnings = $this->TravelsModel->getTotalPayments($user_id);
            
                if ($totalEarnings !== null) {
                    $payments = $this->TravelsModel->getPayments($user_id);
                    $data = [
                        'payments' => $payments,
                        'totalEarnings' => $totalEarnings,
                    ];
                    $this->view('driver/earings', $data);
                } else {
                    // If $totalEarnings is not set, provide a default value or handle it accordingly
                    $data = [
                        'payments' => [], // or any default value you want to set
                        'totalEarnings' => 0.00, // or any default value you want to set
                    ];
                    $this->view('driver/earings', $data);
                }
    }

    public function notification(){
                    $user_id = $_SESSION['user_id'];

                            // Get pending bookings
                            // $pendingbookings = $this->TravelsModel->getPendingBookings($user_id);
                
                            // $data = [
                            //     'pendingbookings' => $pendingbookings,
                            // ];
                    $this->view('driver/notification');
    }
    
    


    public function reviews(){
                $user_id = $_SESSION['user_id'];    
                $reviews = $this->TravelsModel->getReviews($user_id);
                $data = [
                    'reviews' => $reviews,
                ];
                $this->view('driver/reviews', $data);
            }
            
    
    public function settings(){
        $this->view('driver/settings');
                }
     public function vehicle(){
                    // Get the user_id from session
                    $user_id = $_SESSION['user_id'];
                
                    // Retrieve agency_id from the travelagency table based on user_id
                    $agency_id = $this->TravelsModel->getAgencyId($user_id);
                
                    if ($agency_id) {
                        // If agency_id is found, fetch vehicle details
                        $data = $this->TravelsModel->vehicleDetails($agency_id);
                        $this->view('driver/vehicle', $data);
                    } else {
                        // Handle case where agency_id is not found
                        // You can redirect or show an error message
                        echo "Agency ID not found for this user.";
                    }
                }
                
    public function addvehicle(){
        $this->view('driver/addvehicle');
                    }
    public function addvehiclesedit(){
        $this->view('driver/addvehiclesedit');
                    }
    // public function vehicleedit($id){
        
    //         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
    //             // Sanitize POST array
    //             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
    //             $data = [
    //                 'vehicle_id' => $id,
    //              'seating_capacity' => trim($_POST['seating_capacity']),
    //                 'ac_type' => trim($_POST['ac_type']),
    //                 'description' => trim($_POST['description']),
    //             ];

                
    //             if ($this->TravelsModel->updatevehicle($data)) {
    //                  flash('user_message', 'User Updated');
    //                 //  redirect('driver/vehicleedit');
    //             } else {
    //                 die('Something went wrong');
    //             }
    //         } else {
                                
    //             $data = [
    //                 'vehicle_id' => $id,
    //                 'seating_capacity' => '',
    //                 'ac_type' => '',
    //                 'description' => '',
    //             ];


    //         }
    //         $this->view('driver/vehicleedit',$data);
            
    //                 }

    public function vehiclereg(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            
            // Instantiate VehicleModel
            $vehicleModel = $this->model('VehicleModel');

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Upload images and get filenames

            // Construct data array
            $data = [
                'agency_id' => 'YourAgencyID',
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'plate_number' => $_POST['plate_number'],
                'fuel_type' => $_POST['fuel_type'],
                'year' => $_POST['year'],
                'priceperday' => $_POST['priceperday'],
                'seating_capacity' => $_POST['seating_capacity'],
                'ac_type' => isset($_POST['ac_type']) ? 1 : 0,
                'description' => $_POST['description'],
                'image' => 'image_filename.jpg', // Replace with uploaded filename
                'vehi_img2' => 'image_filename2.jpg', // Replace with uploaded filename
                'vehi_img3' => 'image_filename3.jpg', // Replace with uploaded filename
                'vehi_img4' => 'image_filename4.jpg', // Replace with uploaded filename
                'insurance' => 'insurance_filename.jpg', // Replace with uploaded filename
                'registration' => 'registration_filename.jpg', // Replace with uploaded filename
                'revenue' => 'revenue_filename.jpg', // Replace with uploaded filename
                'status' => 1, // Example status
                'withDriverPerDay' => $_POST['withDriverPerDay'],
                'pricing_option' => $_POST['pricing_option'],
                'driver_name' => $_POST['driver_name'],
                'driver_license_number' => $_POST['driver_license_number'],
                'per_day_price_with_driver' => $_POST['per_day_price_with_driver'],
                'daily_mileage_limit_with_driver' => $_POST['daily_mileage_limit_with_driver'],
                'extra_mileage_charge_with_driver' => $_POST['extra_mileage_charge_with_driver'],
                'per_day_price_without_driver' => $_POST['per_day_price_without_driver'],
                'daily_mileage_limit_without_driver' => $_POST['daily_mileage_limit_without_driver'],
                'extra_mileage_charge_without_driver' => $_POST['extra_mileage_charge_without_driver'],
                'vehicle_type' => $_POST['vehicle_type'],
                'number_of_doors' => $_POST['number_of_doors'],
                'nav' => isset($_POST['nav']) ? 1 : 0,
                'airbag' => isset($_POST['airbag']) ? 1 : 0,
                'tv' => isset($_POST['tv']) ? 1 : 0,
                'usb' => isset($_POST['usb']) ? 1 : 0,
                'driver_license_image' => 'license_filename.jpg' // Replace with uploaded filename
            ];

            // Call model method to add vehicle
            if($vehicleModel->addVehicle($data)){
                // Redirect to success page
                redirect('driver/success');
            } else {
                // Redirect to error page
                redirect('driver/error');
            }

        } else {
            // If not a POST request, redirect to home
            redirect('home');
        }
    }
                

    
           
    public function vehiclepassword(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $data = [
                'current-password' => trim($_POST['current-password']),
                'new-password' => trim($_POST['new-password']),
                'confirm-password' => trim($_POST['confirm-password']),
            ];
            if ($this->TravelsModel->updatePassword($data)) {
                flash('user_message', 'Password Updated');
                redirect('driver/vehiclepassword');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'current-password' => '',
                'new-password' => '',
                'confirm-password' => '',
            ];
        }
        $this->view('driver/vehiclepassword');
                }
          

    public function upload(){
        $this->view('driver/upload');
                }

               
                
                public function vehicule() {
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Check if necessary form fields are set
                        if (!isset($_POST['brand'], $_POST['model'], $_POST['plate_number'], $_POST['fuel_type'], $_POST['year'], $_POST['seating_capacity'], $_POST['ac_type'], $_POST['description'],$_POST['airbag'],$_POST['nav'],$_POST['tv'],$_POST['usb']) || 
                            !isset($_FILES['vehi_img1'], $_FILES['vehi_img2'], $_FILES['vehi_img3'], $_FILES['vehi_img4'], $_FILES['insurance'], $_FILES['registration'], $_FILES['revenue'])) {
                            echo "Some form fields are missing.";
                            return;
                        }
                
                        // Get the user_id from session
                        $user_id = $_SESSION['user_id'];
                
                        // Retrieve agency_id from the travelagency table based on user_id
                        $agency_id = $this->TravelsModel->getAgencyId($user_id);
                
                        if (!$agency_id) {
                            // Handle case where agency_id is not found
                            echo "Agency ID not found for this user.";
                            return;
                        }
                
                        $data = [
                            'brand' => $_POST['brand'],
                            'model' => $_POST['model'],
                            'plate_number' => $_POST['plate_number'],
                            'fuel_type' => $_POST['fuel_type'],
                            'year' => $_POST['year'],
                            'seating_capacity' => $_POST['seating_capacity'],
                            'ac_type' => $_POST['ac_type'],
                            'description' => $_POST['description'],
                            'airbag' => $_POST['airbag'],
                            'tv' => $_POST['tv'],
                            'usb' => $_POST['usb'],
                            'nav' => $_POST['nav'],
                        ];
                
                        $imageFiles = [
                            'vehi_img1' => $_FILES['vehi_img1'],
                            'vehi_img2' => $_FILES['vehi_img2'],
                            'vehi_img3' => $_FILES['vehi_img3'],
                            'vehi_img4' => $_FILES['vehi_img4'],
                            'insurance' => $_FILES['insurance'],
                            'registration' => $_FILES['registration'],
                            'revenue' => $_FILES['revenue'],
                        ];
                
                        // Now, save this data to the database using your model
                        $travelModel = $this->model('Travel');
                
                        if ($travelModel->vehiclereg($data, $imageFiles, $agency_id)) {
                            redirect('driver/vehicle');
                        } else {
                            // Handle data save failure
                            $this->view('driver/vehiclereg', ['error' => 'Failed to save data']);
                            return;
                        }
                    } else {
                        // Handle other cases, such as GET requests
                    }
                
                    $this->view('driver/vehiclereg');
                }
                
            
    public function morebookingdetails(){
                $this->view('driver/morebookingdetails');
            }
            
               


         public function vehicledelete($id){
                $data=$this->TravelsModel->vehicledelete($id);
                $this->view('driver/vehicle',$data);
                            }
            }         