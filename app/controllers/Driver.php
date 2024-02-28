<?php

class Driver extends Controller{
    

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
            // For example:
            redirect('login');
        }
    
        // Get user ID from session
        $userId = $_SESSION['user_id'];
    
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the form for adding agency details is submitted
            if (isset($_POST['agency_name']) && isset($_POST['reg_number']) && isset($_POST['address']) && isset($_POST['description']) && isset($_POST['location'])) {
                // Handle agency details submission
                $agencyName = htmlspecialchars($_POST['agency_name']);
                $regNumber = htmlspecialchars($_POST['reg_number']);
                $address = htmlspecialchars($_POST['address']);
                $description = htmlspecialchars($_POST['description']);
                $location = htmlspecialchars($_POST['location']);
    
                // Call the model to insert agency details into the database
                if ($this->TravelsModel->addAgency($agencyName, $regNumber, $address, $description, $location, $userId)) {
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
    
        // Load the view
        $this->view('driver/index');
    }
    
    
    
    
    
    
    
    public function Calender(){
        $this->view('driver/calender');
    }
    public function bookings() {
        $user_id = $_SESSION['user_id'];
        $column = isset($_GET['column']) ? $_GET['column'] : 'trip_id';
    
        // Check if the sort parameter is set in the URL
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
    
        // Determine the sorting order based on the current order
        $newSort = ($sort === 'asc') ? 'desc' : 'asc';
    
        // Get pending bookings and sort by the specified column
        $pendingBookings = $this->TravelsModel->getPendingBookingsSorted($column, $newSort,$user_id);
    
        $acceptedbookings = $this->TravelsModel->getAcceptedBookingsSorted($column, $newSort, $user_id);
    
        // Get completed bookings
        $completedbookings = $this->TravelsModel->getCompletedBookingsSorted($column, $newSort, $user_id);
    
        // Handle update status form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookingId = $_POST['booking_id'];
            $action = $_POST['status'];
    
            $TravelsModel = $this->loadModel('Travel');
    
            // Call a method in the model to handle the status update
            $result = $TravelsModel->updateBookingStatus($bookingId, $action);
    
            if ($result) {
                // Successful update, you may redirect or perform additional actions
                // For example, redirect back to the bookings page
                header('Location: ' . URLROOT . '/driver/bookings');
                exit();
            } else {
                // Handle update failure
                // You may display an error message or redirect to an error page
                echo "Error updating booking status";
            }
        }
    
        // Assign the data to be passed to the view
        $data = [
            'acceptedbookings' => $acceptedbookings,
            'completedbookings' => $completedbookings,
            'pendingbookings' => $pendingBookings,
            'sort' => $newSort, // Include the sort order in the data
            'column' => $column, // Include the current column in the data
        ];
    
        // Load the view
        $this->view('driver/bookings', $data);
    }
    

    protected function loadModel($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
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
                            $pendingbookings = $this->TravelsModel->getPendingBookings($user_id);
                
                            $data = [
                                'pendingbookings' => $pendingbookings,
                            ];
                    $this->view('driver/notification', $data);
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
    public function vehicleedit($id){
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
                $data = [
                    'vehicle_id' => $id,
                 'seating_capacity' => trim($_POST['seating_capacity']),
                    'ac_type' => trim($_POST['ac_type']),
                    'description' => trim($_POST['description']),
                ];

                
                if ($this->TravelsModel->updatevehicle($data)) {
                     flash('user_message', 'User Updated');
                    //  redirect('driver/vehicleedit');
                } else {
                    die('Something went wrong');
                }
            } else {
                                
                $data = [
                    'vehicle_id' => $id,
                    'seating_capacity' => '',
                    'ac_type' => '',
                    'description' => '',
                ];


            }
            $this->view('driver/vehicleedit',$data);
            
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

                public function vehiclereg() {
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