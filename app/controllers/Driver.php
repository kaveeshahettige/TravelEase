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

        $profileimage = $this->TravelsModel->getProfileImage($userId);

        // var_dump($profileimage);

    
        // Check if the request method is POST
       
    
        // Call the model to get agency details for the user
        $agencyDetails = $this->TravelsModel->getAgencyDetails($userId);
        $agencyId = $this->TravelsModel->getAgencyId($userId);

        $userDetails = $this->TravelsModel->getUserDetails($_SESSION['user_id']);
    
        $pendingBookings = $this->TravelsModel->getPendingBookings($agencyId);
        $completedBookings = $this->TravelsModel->getCompletedBookings($agencyId);
    
        $paymentAmounts = [];
        foreach ($pendingBookings as $booking ) {
            $paymentAmounts[$booking->booking_id] = $this->TravelsModel->getPaymentAmountForBooking($booking->booking_id);
        }

        // var_dump($paymentAmounts);

        foreach ($completedBookings as $Cbooking ) {
            $CpaymentAmounts[$Cbooking->booking_id] = $this->TravelsModel->getPaymentAmountForBooking($Cbooking->booking_id);
        }
        // var_dump($CpaymentAmounts);

    
        foreach ($pendingBookings as $key => $booking) {
            $plateNumber = $this->TravelsModel->getPlateNumberForVehicle($booking->vehicle_id);
            if ($plateNumber) {
                $pendingBookings[$key]->plate_number = $plateNumber->plate_number;
            }
    
            $details = $this->TravelsModel->getTravelerDetails($booking->user_id);
            if ($details) {
                $pendingBookings[$key]->traveler_details = $details;
            }
    
            $vehicleDetails = $this->TravelsModel->getVehicleBookingDetails($booking->booking_id);
            if ($vehicleDetails) {
                $pendingBookings[$key]->start_time = $vehicleDetails->start_time;
                $pendingBookings[$key]->withDriver = $vehicleDetails->withDriver;
                $pendingBookings[$key]->Pickup_Location = $vehicleDetails->Pickup_Location;
                $pendingBookings[$key]->End_Location = $vehicleDetails->End_Location;
    
                $paymentAmount = $this->TravelsModel->getPaymentAmountForBooking($booking->booking_id);
                $pendingBookings[$key]->payment_amount = $paymentAmount;
            }
        }

        $vehicleCount = $this->TravelsModel->getVehicleCount($agencyId);

        // var_dump($vehicleCount);

        // $CpaymentAmounts = [];

       
        $data = [
            'agencyDetails' => $agencyDetails,
            'pendingBookings' => $pendingBookings,
           'user_id' => $userId,
           'userDetails' => $userDetails,
           'vehicleCount' => $vehicleCount,
           'profileimage' => $profileimage,
            
        ];
    
        $this->view('driver/index', $data);
    }
    
    public function calender() {
        // Get the current date in UTC+05:30 timezone
        $currentDate = new DateTime('now', new DateTimeZone('Asia/Colombo'));
        $formattedDate = $currentDate->format('Y-m-d');
        $userId = $_SESSION['user_id'];


        $profileimage = $this->TravelsModel->getProfileImage($userId);

    
        $data = [
            'profileimage' => $profileimage,
            
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
        $userId = $_SESSION['user_id'];

        $agency_id = $this->TravelsModel->getAgencyIdByUserId($user_id);
        $profileimage = $this->TravelsModel->getProfileImage($userId);

    
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
            'profileimage' => $profileimage,

            'basicInfo' => $this->basicInfo(),
        ];
    
        $this->view('driver/availablevehicles', $data);
    }
    
    public function setUnavailableDate()
{
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Method Not Allowed
        exit(json_encode(['success' => false, 'message' => 'Method not allowed.']));
    }

    // Check if the required POST parameters are set
    if (!isset($_POST['vehicle_id']) || !isset($_POST['date'])) {
        http_response_code(400); // Bad Request
        exit(json_encode(['success' => false, 'message' => 'Missing parameters.']));
    }

    // Retrieve POST data
    $vehicle_id = $_POST['vehicle_id'];
    $date = $_POST['date'];

    // Assuming you have a method in your model to set unavailable dates
    $result = $this->TravelsModel->insertUnavailableDate($vehicle_id, $date);

    // Check if the operation was successful
    if ($result) {
        // Set Unavailability successful
        echo json_encode(['success' => true]);
    } else {
        // Set Unavailability failed
        echo json_encode(['success' => false, 'message' => 'Failed to set unavailability.']);
    }
}

    
    public function removeUnavailableDate()
    {

        
        
        $vehicle_id = $_POST['vehicle_id'];
        $date= $_POST['date'];

        // Assuming you have a method in your model to remove unavailable dates
        $result = $this->TravelsModel->removeUnavailableDate($vehicle_id, $date);
    
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
        $userId = $_SESSION['user_id'];


        $profileimage = $this->TravelsModel->getProfileImage($userId);


        // Get user details
        $userData = $travelModel->getUserById($user_id);

        // Get hotel details
        $driverData = $travelModel->getDiverByUserId($user_id);

        // Pass data to the view
        return ['userData' => $userData, 'driverData' => $driverData];
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

        $profileimage = $this->TravelsModel->getProfileImage($userId);


    
        $agencyId = $this->TravelsModel->getAgencyId($userId);
        $pendingBookings = $this->TravelsModel->getPendingBookings($agencyId);
        $completedBookings = $this->TravelsModel->getCompletedBookings($agencyId);
    
        $paymentAmounts = [];
        foreach ($pendingBookings as $booking ) {
            $paymentAmounts[$booking->booking_id] = $this->TravelsModel->getPaymentAmountForBooking($booking->booking_id);
        }

        // var_dump($paymentAmounts);

        foreach ($completedBookings as $Cbooking ) {
            $CpaymentAmounts[$Cbooking->booking_id] = $this->TravelsModel->getPaymentAmountForBooking($Cbooking->booking_id);
        }
        // var_dump($CpaymentAmounts);

    
        foreach ($pendingBookings as $key => $booking) {
            $plateNumber = $this->TravelsModel->getPlateNumberForVehicle($booking->vehicle_id);
            if ($plateNumber) {
                $pendingBookings[$key]->plate_number = $plateNumber->plate_number;
            }
    
            $details = $this->TravelsModel->getTravelerDetails($booking->user_id);
            if ($details) {
                $pendingBookings[$key]->traveler_details = $details;
            }
    
            $vehicleDetails = $this->TravelsModel->getVehicleBookingDetails($booking->booking_id);
            if ($vehicleDetails) {
                $pendingBookings[$key]->start_time = $vehicleDetails->start_time;
                $pendingBookings[$key]->withDriver = $vehicleDetails->withDriver;
                $pendingBookings[$key]->Pickup_Location = $vehicleDetails->Pickup_Location;
                $pendingBookings[$key]->End_Location = $vehicleDetails->End_Location;
    
                $paymentAmount = $this->TravelsModel->getPaymentAmountForBooking($booking->booking_id);
                $pendingBookings[$key]->payment_amount = $paymentAmount;
            }
        }

        // $CpaymentAmounts = [];

        foreach ($completedBookings as $key => $Cbooking) {
            $CplateNumber = $this->TravelsModel->getPlateNumberForVehicle($Cbooking->vehicle_id);
            if ($CplateNumber) {
                $completedBookings[$key]->plate_number = $plateNumber->plate_number;
            }
    
            $Cdetails = $this->TravelsModel->getTravelerDetails($Cbooking->user_id);
            if ($Cdetails) {
                $completedBookings[$key]->traveler_details = $Cdetails;
            }
    
            $CvehicleDetails = $this->TravelsModel->getVehicleBookingDetails($Cbooking->booking_id);
            if ($CvehicleDetails) {
                $completedBookings[$key]->start_time = $CvehicleDetails->start_time;
                $completedBookings[$key]->withDriver = $CvehicleDetails->withDriver;
                $completedBookings[$key]->Pickup_Location = $CvehicleDetails->Pickup_Location;
                $completedBookings[$key]->End_Location = $CvehicleDetails->End_Location;
    
                $CpaymentAmount = $this->TravelsModel->getPaymentAmountForBooking($Cbooking->booking_id);
                $completedBookings[$key]->Cpayment_amount = $CpaymentAmount;
            }
            
            $feedbacks = $this->TravelsModel->getFeedbacks($Cbooking->booking_id);
            if ($feedbacks) {
                  $completedBookings[$key]->feedbacks_details = $feedbacks;

        }
    }
// 
       

    
        $data = [
            'pendingBookings' => $pendingBookings,
            'completedBookings' => $completedBookings, // Add completed bookings to data array
            'paymentAmounts' => $paymentAmounts,
            'CpaymentAmounts' => $CpaymentAmounts,
            'profileimage' => $profileimage,

        ];
        
        // var_dump($pendingBookings);
        $this->view('driver/bookings', $data);
    
}



public function cancelBooking($temporyid,$booking_id){

    echo '<script>console.log("cancelBooking function is running!");</script>';
      $id = $_SESSION['user_id'];
      $user=$this->TravelsModel->getUserDetails($id);
      
      //$bookingDetails=$this->userModel->findBookingDetails($booking_id,$temporyid);
      
      if ($temporyid==0) {
        //detail of the booking
        $bookingDetails=$this->TravelsModel->getPendingBookings($booking_id);
        $bookingFurtherDetail=$this->TravelsModel->findBookingFurtherDetail($bookingDetails);
        if($bookingDetails->type==4){
          $message="Your Agency vehicle with ID ".$bookingFurtherDetail->vehicle_id."-".$bookingFurtherDetail->brand ." ".$bookingFurtherDetail->model." ".$bookingFurtherDetail->plate_number." ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
        }elseif($bookingDetails->type==3){
          $message="Your Hotel room with ID ".$bookingFurtherDetail->room_id."-".$bookingFurtherDetail->roomType ."Type ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
  
        }
        
        
        //cancel from booking table
        $cancel = $this->TravelsModel->cancelBooking($booking_id);
  
        //refund user
        //$refund = $this->userModel->refundUser($booking_id);
  
        //check type and provide availibility of vehicle_bookings,room_availability
        $availibility=$this->TravelsModel->makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail); 
        
        //send a sms to service provider
  
        //send notofuiaction
        $send=$this->TravelsModel->sendBookingCancellationNotification($id,$bookingDetails->serviceProvider_id,$booking_id,$message);
        
      }else{
  
        $bookingDetails=$this->TravelsModel->findCartBookingDetails($booking_id,$temporyid);
        $bookingFurtherDetail=$this->TravelsModel->findBookingFurtherDetail($bookingDetails);
        if($bookingDetails->type==4){
          $message="Your Agency vehicle with ID ".$bookingFurtherDetail->vehicle_id."-".$bookingFurtherDetail->brand ." ".$bookingFurtherDetail->model." ".$bookingFurtherDetail->plate_number." ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
        }elseif($bookingDetails->type==3){
          $message="Your Hotel room with ID ".$bookingFurtherDetail->room_id."-".$bookingFurtherDetail->roomType ."Type ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
  
        }
        
        //cancel from cartbookings table
        $cancel = $this->TravelsModel->cancelCartBooking($temporyid,$booking_id);
  
        //refund user
        //$refund = $this->userModel->refundUser($booking_id);
  
        //check type and provide availibility of vehicle_bookings,room_availability
        $availibility=$this->TravelsModel->makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail); 
        //send a sms to service provider
  
      
         //send notofuiaction
         $send=$this->TravelsModel->sendBookingCancellationNotification($id,$bookingDetails->serviceProvider_id,$booking_id,$message);
      }    
  }




    
    
    
    public function getPlateNumberForVehicle($vehicleId) {
        $plateNumber = $this->TravelsModel->getPlateNumberForVehicle($vehicleId);
        return $plateNumber;
    }
    

    
    
    
    public function earings() {

        

        
                $user_id = $_SESSION['user_id'];
                $userId = $_SESSION['user_id'];


                $profileimage = $this->TravelsModel->getProfileImage($userId);

                $data = [           'profileimage' => $profileimage,
    ];


                
                    $this->view('driver/earings', $data);
                }
    

    public function notification(){

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page or handle unauthorized access
            redirect('login');
            return; // Add return statement to prevent further execution
        }
        $userId = $_SESSION['user_id'];

        $profileimage = $this->TravelsModel->getProfileImage($userId);


        //var_dump($userId);

        $count = $this->TravelsModel->getNotificationCount($userId);
        $notifications = $this->TravelsModel->getNotifications($userId);

        $data = [
            'notifications' => $notifications,
            'profileimage' => $profileimage,
            'count' => $count];
            

        // var_dump($data);

                    
                           
                    $this->view('driver/notification',$data);
    }
    
    


    public function reviews(){

        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page or handle unauthorized access
            redirect('login');
            return; // Add return statement to prevent further execution
        }
    
        // Get user ID from session
        $userId = $_SESSION['user_id'];
        $profileimage = $this->TravelsModel->getProfileImage($userId);

        $agencyId = $this->TravelsModel->getAgencyId($userId);

        $completedBookings = $this->TravelsModel->getCompletedBookings($agencyId);

        // foreach ($completedBookings as $Cbooking ) {
        //     $CpaymentAmounts[$Cbooking->booking_id] = $this->TravelsModel->getPaymentAmountForBooking($Cbooking->booking_id);
        // }

        foreach ($completedBookings as $key => $Cbooking) {
           
     $Cdetails = $this->TravelsModel->getTravelerDetails($Cbooking->user_id);
            if ($Cdetails) {
                $completedBookings[$key]->traveler_details = $Cdetails;
            }
     $feedbacks = $this->TravelsModel->getFeedbacks($Cbooking->booking_id);
            if ($feedbacks) {
                  $completedBookings[$key]->feedbacks_details = $feedbacks;

        }

    
    }

    $data = [
        'profileimage' => $profileimage,
        'completedBookings' => $completedBookings, // Add completed bookings to data array
    ];
    

    // var_dump($data);


               
                $this->view('driver/reviews',$data);
            }
            
    
            public function settings()
            {
                if (!isset($_SESSION['user_id'])) {
                    // Redirect to login page or handle unauthorized access
                    redirect('login');
                    return; // Add return statement to prevent further execution
                }
                $userId = $_SESSION['user_id'];
            
                $agencyDetails = $this->TravelsModel->getAgencyDetails($userId);
                $profileimage = $this->TravelsModel->getProfileImage($userId);

                $agencyId = $this->TravelsModel->getAgencyId($userId);
            
                $userDetails = $this->TravelsModel->getUserDetails($_SESSION['user_id']);
            
                // var_dump($agencyDetails);
                // var_dump($agencyId);
                // var_dump($userDetails);
            
                // Get user ID from session
            
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
                        $targetDir = "../public/documents/";
            
                        // Construct a unique filename based on user ID and the original filename
                        $originalFilename = $_FILES['service-validation-pdf']['name'];
                        $base = pathinfo($originalFilename, PATHINFO_FILENAME);
                        $base = preg_replace("/[^\w-]/", "_", $base);
                        $filename = "{$userId}_{$base}.pdf";
                        $targetFile = $targetDir . $filename;
            
                        // Move the uploaded file to the target directory
                        if (move_uploaded_file($_FILES['service-validation-pdf']['tmp_name'], $targetFile)) {
                            // Update the user's document filename in the database
                            if ($this->TravelsModel->updateUserDocument($filename, $userId)) {
                                // Success - You can redirect or show a success message
                                flash('success', 'PDF submitted successfully');
                                redirect('driver/settings');
                            } else {
                                // Error - You can redirect or show an error message
                                flash('error', 'Failed to submit PDF');
                                redirect('driver/settings');
                            }
                        } else {
                            // Error - You can redirect or show an error message
                            flash('error', 'Failed to move the uploaded file');
                            redirect('driver/settings');
                        }
                    }
                }
            
                $data = [
                    'profileimage' => $profileimage,
                    'agencyDetails' => $agencyDetails,
                    'userDetails' => $userDetails,
                ];
            
                $this->view('driver/settings', $data);
            }
            
     public function vehicle(){
                    // Get the user_id from session
                    $user_id = $_SESSION['user_id'];
                    $userId = $_SESSION['user_id'];


                    $profileimage = $this->TravelsModel->getProfileImage($userId);

                
                    // Retrieve agency_id from the travelagency table based on user_id
                    $agency_id = $this->TravelsModel->getAgencyId($user_id);
                
                    
                        // If agency_id is found, fetch vehicle details
                        $vehicledetails = $this->TravelsModel->vehicleDetails($agency_id);
                        $data=[

                            'profileimage' => $profileimage,
                            'vehicledetails'=> $vehicledetails
                        
                        ];
                        $this->view('driver/vehicle', $data);
                   
                    }
      

                public function editagency(){
                    if (!isset($_SESSION['user_id'])) {
                        // Redirect to login page or handle unauthorized access
                        redirect('login');
                        return; // Add return statement to prevent further execution
                    }
                    // Get user ID from session
                    $userId = $_SESSION['user_id'];
                    $profileimage = $this->TravelsModel->getProfileImage($userId);

                
                    // Check if the request method is POST
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                        // Get agency ID
                        $agencyId = $this->TravelsModel->getAgencyId($userId);
                
                        // Get form data
                        $data = [
                            'agency_id' => $agencyId,
                            'agency_name' => trim($_POST['agency_name']),
                            'reg_number' => trim($_POST['reg_number']),
                            'address' => trim($_POST['address']),
                            'city' => trim($_POST['city']),
                            'description' => trim($_POST['description']),
                            'website' => trim($_POST['website']),
                            'facebook' => trim($_POST['facebook']),
                            'twitter' => trim($_POST['twitter']),
                            'instagram' => trim($_POST['instagram']),
                        ];
                
                        // Call the model to update agency details
                        if ($this->TravelsModel->updateAgencyDetails($data)) {
                            // Redirect back to the same page or a success page
                            redirect('driver/settings');
                        } else {
                            // Handle update failure
                            die('Update failed');
                        }
                    } else {
                        // Call the model to get agency details for the user
                        $agencyDetails = $this->TravelsModel->getAgencyDetails($userId);
                        $userDetails = $this->TravelsModel->getUserDetails($_SESSION['user_id']);
                
                        $data = [
                            'profileimage' => $profileimage,
                            'agencyDetails' => $agencyDetails,
                            'userDetails' => $userDetails,
                        ];
                
                        $this->view('driver/editagency', $data);
                    }
                }
                
                
    public function addvehicle(){
        $this->view('driver/addvehicle');
                    }
    public function addvehiclesedit(){
        $this->view('driver/addvehiclesedit');
                    }
     public function vehicleedit($vehicle_id) {
        $userId = $_SESSION['user_id'];


        $profileimage = $this->TravelsModel->getProfileImage($userId);


                        // var_dump($vehicle_id);
                        $vehicle = $this->TravelsModel->vehicles($vehicle_id);

                        
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Handle image uploads
                            $imageNames = [];
                            $uploadPath = 'C:\xampp\htdocs\TravelEase\public\images\\'; // Update with your actual upload path
                        
                            foreach ($_FILES as $key => $file) {
                                if ($file['size'] > 0) {
                                    $imageName = uniqid() . '_' . $file['name']; // Generate a unique image name
                                    move_uploaded_file($file['tmp_name'], $uploadPath . $imageName);
                                    $imageNames[$key] = $imageName;
                                }
                            }
                        
                            // Sanitize POST array
                            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                        
                            // Prepare data for update
                            $data = [
                                'vehicle_id' => $vehicle_id,
                                'description' => $_POST['description'],
                                'image' => isset($imageNames['image']) ? $imageNames['image'] : $vehicle->image,
                                'vehi_img2' => isset($imageNames['vehi_img2']) ? $imageNames['vehi_img2'] : $vehicle->vehi_img2,
                                'vehi_img3' => isset($imageNames['vehi_img3']) ? $imageNames['vehi_img3'] : $vehicle->vehi_img3,
                                'vehi_img4' => isset($imageNames['vehi_img4']) ? $imageNames['vehi_img4'] : $vehicle->vehi_img4,
                                
                                'withDriverPerDay' => trim($_POST['withDriverPerDay']),
                                'priceperday' => trim($_POST['priceperday']),
                                'nav' => isset($_POST['nav']) ? 1 : 0, // Checkbox handling
                                'airbag' => isset($_POST['airbag']) ? 1 : 0, // Checkbox handling
                                'tv' => isset($_POST['tv']) ? 1 : 0, // Checkbox handling
                                'usb' => isset($_POST['usb']) ? 1 : 0, // Checkbox handling
                                'ac_type' => isset($_POST['ac_type']) ? 1 : 0, // Checkbox handling
                            ];
                        
                            // Update the vehicle
                            if ($this->TravelsModel->updatevehicle($data)) {
                                flash('user_message', 'Vehicle Updated');
                                redirect('driver/vehicle');
                            } else {
                                die('Something went wrong');
                            }
                        } else {
                            // Prepare data for view
                            $data = [
                                'profileimage' => $profileimage,
                                'vehicle_id' => $vehicle_id,
                                'description' => $vehicle->description, // Access object property correctly
                                'image' => $vehicle->image, // Access object property correctly
                                'vehi_img2' => $vehicle->vehi_img2, // Access object property correctly
                                'vehi_img3' => $vehicle->vehi_img3, // Access object property correctly
                                'vehi_img4' => $vehicle->vehi_img4, // Access object property correctly
                                'withDriverPerDay' => $vehicle->withDriverPerDay, // Access object property correctly
                                'priceperday' => $vehicle->priceperday, // Access object property correctly
                                'nav' => $vehicle->nav, // Access object property correctly
                                'airbag' => $vehicle->airbag, // Access object property correctly
                                'tv' => $vehicle->tv, // Access object property correctly
                                'usb' => $vehicle->usb, // Access object property correctly
                                'ac_type' => $vehicle->ac_type, // Access object property correctly
                            ];
                        }
                        // var_dump($data);
                        $this->view('driver/vehicleedit', $data);
                    }
                    
    public function vehiclereg(){
        $userId = $_SESSION['user_id'];


        $profileimage = $this->TravelsModel->getProfileImage($userId);


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
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
           
            
    
            // Handle form data
            $data = [
                // 'profileimage' => $profileimage,
                'agency_id' => $agencyId, // Assuming you have agency ID in the session
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'plate_number' => $_POST['plate_number'],
                'fuel_type' => $_POST['fuel_type'],
                'year' => $_POST['year'],
                'priceperday' => $_POST['priceperday'],
                'seating_capacity' => $_POST['seating_capacity'],
                'ac_type' => isset($_POST['ac_type']) ? 1 : 0,
                'description' => $_POST['description'],
                'vehicle_type' => $_POST['vehicle_type'],
                'number_of_doors' => $_POST['number_of_doors'],
                'nav' => isset($_POST['nav']) ? 1 : 0,
                'airbag' => isset($_POST['airbag']) ? 1 : 0,
                'tv' => isset($_POST['tv']) ? 1 : 0,
                'usb' => isset($_POST['usb']) ? 1 : 0,
                'withDriverPerDay' => $_POST['withDriverPerDay']
            ];
    
            // Upload images
            $imageNames = [];
            $uploadDir = 'C:/xampp/htdocs/TravelEase/public/images/'; // Adjust this path as per your server configuration
    
            // Process each uploaded image
            foreach ($_FILES as $key => $file) {
                $fileName = basename($file['name']);
                $targetPath = $uploadDir . $fileName;
    
                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    $imageNames[$key] = $fileName;
                } else {
                    // Handle failed uploads
                    // You can add error handling code here
                }
            }
    
            // Add image names to the data array
            $data['image'] = $imageNames['image'] ?? '';
            $data['vehi_img2'] = $imageNames['vehi_img2'] ?? '';
            $data['vehi_img3'] = $imageNames['vehi_img3'] ?? '';
            $data['vehi_img4'] = $imageNames['vehi_img4'] ?? '';
            $data['insurance'] = $imageNames['insurance'] ?? '';
            $data['registration'] = $imageNames['registration'] ?? '';
            $data['revenue'] = $imageNames['revenue'] ?? '';
    
            // Now, save $data to the database using your model
            $this->TravelsModel->saveVehicle($data);
            redirect('driver/vehicle');
    
            // Redirect or show success message
            // Redirect to a success page or show a success message
        } else {

            $data=['profileimage'=> $profileimage,];
            // If not a POST request, show the form
            $this->view('driver/vehiclereg', $data);
        }
    }
    
    
    
    
                

    
           
    public function vehiclepassword(){
        $userId = $_SESSION['user_id'];


        $profileimage = $this->TravelsModel->getProfileImage($userId);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $data = [
                'current-password' => trim($_POST['current-password']),
                'new-password' => trim($_POST['new-password']),
                'confirm-password' => trim($_POST['confirm-password']),
            ];
    
            // Check if current password matches
            $user_id = $_SESSION['user_id'];
            $current_password = $data['current-password'];
            if (!$this->TravelsModel->verifyPassword($user_id, $current_password)) {
                flash('user_message', 'Current password is incorrect');
                redirect('driver/vehiclepassword');
            }
    
            // Update password if new and confirm passwords match
            if ($data['new-password'] === $data['confirm-password']) {
                if ($this->TravelsModel->updatePassword($user_id, $data['new-password'])) {
                    // Logout user
                    unset($_SESSION['user_id']);
                    session_destroy();
    
                    // Redirect to login page
                    redirect('Users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                flash('user_message', 'New password and confirm password do not match');
                redirect('driver/vehiclepassword');
            }
        } else {

            $data = [
                'profileimage'=> $profileimage,

            ];
            $this->view('driver/vehiclepassword', $data);
        }
    }
    
    
          

  

               
                
                       
        
            
    
            
               


         public function vehicledelete($vehicle_id){
            $userId = $_SESSION['user_id'];


            $profileimage = $this->TravelsModel->getProfileImage($userId);

                $data=$this->TravelsModel->vehicledelete($vehicle_id);
                $this->view('driver/vehicle',$data);
                            }

        public function edituser($id){
            $userId = $_SESSION['user_id'];


            $profileimage = $this->TravelsModel->getProfileImage($userId);

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                        // Get form data
                        $data = [
                            'id' => $id,
                            'fname' => trim($_POST['fname']),
                            'lname' => trim($_POST['lname']),
                            'email' => trim($_POST['email']),
                            'number' => trim($_POST['number']),
                        ];
                
                        // Call the model to update user details
                        if ($this->TravelsModel->updateUserDetails($data)) {
                            // Redirect to a success page or handle success
                            redirect('driver/settings');          
                            } else {
                            // Handle update failure
                            die('Update failed');
                        }
                    } else {
                        // Handle non-POST request, maybe redirect to an error page
                        redirect('error');
                    }
                }

                public function editagencydetails(){
                    $userId = $_SESSION['user_id'];


                    $profileimage = $this->TravelsModel->getProfileImage($userId);

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                        // Get form data
                        $data = [
                            'agency_id' => trim($_POST['agency_id']), // Assuming agency_id is the same as user_id in this context
                            'agency_name' => trim($_POST['agency_name']),
                            'reg_number' => trim($_POST['reg_number']),
                            'address' => trim($_POST['address']),
                            'city' => trim($_POST['city']),
                            'description' => trim($_POST['description']),
                            'website' => trim($_POST['website']),
                            'facebook' => trim($_POST['facebook']),
                            'twitter' => trim($_POST['twitter']),
                            'instagram' => trim($_POST['instagram']),
                        ];
                
                        // Call the model to update agency details
                        if ($this->TravelsModel->updateAgencyDetails($data)) {
                            // Redirect back to the same page or a success page
                            redirect('driver/settings');
                        } else {
                            // Handle update failure
                            die('Update failed');
                        }
                    } else {
                        // Handle non-POST request, maybe redirect to an error page
                        redirect('error');
                    }
                }
                
                

            }         