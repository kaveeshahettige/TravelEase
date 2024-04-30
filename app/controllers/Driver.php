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

        // var_dump($userId);

        $profileimage = $this->TravelsModel->getProfileImage($userId);

        
        $agencyDetails = $this->TravelsModel->getAgencyDetails($userId);
        // var_dump($agencyDetails);

        $agencyId = $this->TravelsModel->getAgencyId($userId);

        $userDetails = $this->TravelsModel->getUserDetails($_SESSION['user_id']);
    
       
    
       $pendingBookings = $this->TravelsModel->getPendingBookings($userId);

        $vehicleCount = $this->TravelsModel->getVehicleCount($agencyId);

        


       
        // var_dump($agencyDetails);

        
    
       
        $data = [
            'agencyDetails' => $agencyDetails,
           'user_id' => $userId,
           'userDetails' => $userDetails,
           'vehicleCount' => $vehicleCount,
           'profileimage' => $profileimage,
           'pendingBookings'=> $pendingBookings,
      
            
        ];

        // var_dump($completedBookings);
    
        $this->view('driver/index', $data);
    }

    public function navigation() {

        $profileimage = $this->TravelsModel->getProfileImage($_SESSION['user_id']);
        $data = [
            'profileimage' => $profileimage,
        ];
        $this->view('driver/navigation', $data);
    }

    public function addagency() {
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page or handle unauthorized access
            redirect('login');
            return; // Add return statement to prevent further execution
        }
    
        // Get user ID from session
        $userId = $_SESSION['user_id'];
        $agencyName = $this->TravelsModel->getAgencyName($userId);
        // var_dump($ageunavailableVehiclesncyName);
        $profileimage = $this->TravelsModel->getProfileImage($userId);

    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form data
            $data = [
                'manager_name' => $_POST['manager_name'],
                'reg_number' => $_POST['reg_number'],
                'address' => $_POST['address'],
                'city' => $_POST['city'],
                'description' => $_POST['description'],
                'website' => $_POST['website'],
                'facebook' => $_POST['facebook'],
                'twitter' => $_POST['twitter'],
                'instagram' => $_POST['instagram'],
                'card_holder_name' => $_POST['card_holder_name'],
                'account_number' => $_POST['account_number'],
                'bank_name' => $_POST['bank_name'],
                'bank_branch' => $_POST['bank_branch'],
                'user_id' => $userId,
                'agency_name' => $agencyName, 
                
                // Set user_id based on session
            ];
    
            // Save data using model
            $this->TravelsModel->addAgency($data);
            // Redirect to desired page after saving
            redirect('driver/index');
        } else {
            $data = [
                'profileimage' => $profileimage,
            ];
            $this->view('driver/addagency',$data);
        }
    }
    
    
    
    public function calender() {
        // Get the current date in UTC+05:30 timezone
        $currentDate = new DateTime('now', new DateTimeZone('Asia/Colombo'));
        $formattedDate = $currentDate->format('Y-m-d');
        $userId = $_SESSION['user_id'];

        $agencyId= $this->TravelsModel->getAgencyId($userId);

        // var_dump($agencyId);


        $profileimage = $this->TravelsModel->getProfileImage($userId);

        $vehicleCount = $this->TravelsModel->getVehicleCount($agencyId);

        // var_dump($vehicleCount);

    
        $data = [
            'profileimage' => $profileimage,
            'vehicleCount'=> $vehicleCount,
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

        // var_dump($unavailableDates);
        
        $unavailableVehicles = [];
        foreach ($unavailableDates as $unavailable) {
            $unavailableVehicles[] = $unavailable->vehicle_id;
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
    
        // Log received POST data for debugging
        error_log('Received POST data: ' . print_r($_POST, true));
    
        // Check if the required POST parameters are set
        if (!isset($_POST['vehicle_id']) || !isset($_POST['date'])) {
            http_response_code(400); // Bad Request
            exit(json_encode(['success' => false, 'message' => 'Missing parameters.']));
        }
    
        // Retrieve POST data
        $vehicle_id = $_POST['vehicle_id'];
        $date = $_POST['date'];
    
        // Log data for debugging
        error_log('Set Unavailability Request - Vehicle ID: ' . $vehicle_id . ', Date: ' . $date);
    
        // Assuming you have a method in your model to set unavailable dates
        $result = $this->TravelsModel->insertUnavailableDate($vehicle_id, $date);
    
        // Check if the operation was successful
        if ($result) {
            // Set Unavailability successful
            echo json_encode(['success' => true]);
        } else {
            // Set Unavailability failed
            http_response_code(500); // Internal Server Error
            exit(json_encode(['success' => false, 'message' => 'Failed to set unavailability.']));
        }
    }
    

public function removeUnavailableDate()
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

    // Log data for debugging
    error_log('Remove Unavailability Request - Vehicle ID: ' . $vehicle_id . ', Date: ' . $date);

    // Assuming you have a method in your model to remove unavailable dates
    $result = $this->TravelsModel->removeUnavailableDate($vehicle_id, $date);

    // Check if the operation was successful
    if ($result) {
        // Remove Unavailability successful
        echo json_encode(['success' => true]);
    } else {
        // Remove Unavailability failed
        echo json_encode(['success' => false, 'message' => 'Failed to remove unavailability.']);
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
    
    
   

    
/////////////////////////////////////////////////////////////////////////////////////////////
// 

public function bookings() {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page or handle unauthorized access
        redirect('login');
        return; // Add return statement to prevent further execution
    }


    
    // $agencyId = $this->TravelsModel->getAgencyId($userId);
    $userId = $_SESSION['user_id'];

    $pendingBookingsCount = $this->TravelsModel->getOngoingBookingsCount($userId);

    // var_dump($pendingBookingsCount);
   
    $pendingBookings = $this->TravelsModel->getPendingBookings( $userId);

    // var_dump($pendingBookings);
    $completedBookings = $this->TravelsModel->getCompleteBookings($userId);
        // var_dump($completedBookings);


    $profileimage = $this->TravelsModel->getProfileImage($userId);


    $totalBookingsArray = $this->TravelsModel->getTotalBookings($userId);

    $totalCustomers = $this->TravelsModel->getTotalCustomers($userId);

    // var_dump($totalCustomerd);

    // var_dump($totalBookingsArray);

    // Assuming the counts are in the order of the SQL query
    // $totalBookingsCount = $totalBookingsArray[0]['count'] + $totalBookingsArray[1]['count'];
    
    

          

    



    $data = [
        'pendingBookings' => $pendingBookings,
        'completedBookings' => $completedBookings, // Add completed bookings to data array
        'profileimage' => $profileimage,
        'totalBookingsArray' => $totalBookingsArray,
        'pendingBookingsCount' => $pendingBookingsCount,
        'totalCustomers' => $totalCustomers,

    ];
    // Get user ID from session
   

    $this->view('driver/bookings',$data);
}

public function combookings() {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page or handle unauthorized access
        redirect('login');
        return; // Add return statement to prevent further execution
    }


    
    // $agencyId = $this->TravelsModel->getAgencyId($userId);
    $userId = $_SESSION['user_id'];
   

    // var_dump($pendingBookings);
    $completedBookings = $this->TravelsModel->getCompleteBookings($userId);
        // var_dump($completedBookings);
        $totalBookingsArray = $this->TravelsModel->getTotalBookings($userId);


    $profileimage = $this->TravelsModel->getProfileImage($userId);

    $completedBookingsCount = $this->TravelsModel->getCompletedBookingsCount($userId);

    



          

    // var_dump($completedBookings);



    $data = [
        'completedBookings' => $completedBookings, // Add completed bookings to data array
        'profileimage' => $profileimage,
        'totalBookingsArray' => $totalBookingsArray,
        'completedBookingsCount' => $completedBookingsCount,

    ];
    // Get user ID from session
   

    $this->view('driver/combookings',$data);
}
public function rejbookings() {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page or handle unauthorized access
        redirect('login');
        return; // Add return statement to prevent further execution
    }


    
    // $agencyId = $this->TravelsModel->getAgencyId($userId);
    $userId = $_SESSION['user_id'];
   

    // var_dump($pendingBookings);
    $CancelledBookings = $this->TravelsModel->getCancelledBookings($userId);
        // var_dump($CancelledBookings);


    $profileimage = $this->TravelsModel->getProfileImage($userId);


    $totalBookingsArray = $this->TravelsModel->getTotalBookings($userId);

    $CancelledBookingsCount = $this->TravelsModel->getCancelledBookingsCount($userId);

          

    // var_dump($completedBookings);



    $data = [
        'CancelledBookings' => $CancelledBookings, // Add completed bookings to data array
        'profileimage' => $profileimage,
        'totalBookingsArray' => $totalBookingsArray,
        'CancelledBookingsCount' => $CancelledBookingsCount,

    ];
    // Get user ID from session
   

    $this->view('driver/rejbookings',$data);
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


 
    public function getPlateNumberForVehicle($vehicleId) {
        $plateNumber = $this->TravelsModel->getPlateNumberForVehicle($vehicleId);
        return $plateNumber;
    }
    

    
    
    
    

                public function earings(){
                    if (!isset($_SESSION['user_id'])) {
                        // Redirect to login page or handle unauthorized access
                        redirect('login');
                        return; // Add return statement to prevent further execution
                    }
                
                
                    
                    // $agencyId = $this->TravelsModel->getAgencyId($userId);
                    $userId = $_SESSION['user_id'];
                    $profileimage = $this->TravelsModel->getProfileImage($userId);

        $finalPayment = $this->getFinalPayment();
        // $totalRevenue = $this->getTotalRevenue();
        // $bookingsCount = $this->getBookingsCount();
        // $guestCount = $this->getGuestCount();

        $data=[
            'basicInfo' => $this->basicInfo(),
            'finalPayment' => $finalPayment,
            'profileimage' => $profileimage,
            // 'bookingsCount' => $bookingsCount,
            // 'guestCount' => $guestCount,
            // 'totalRevenue' => $totalRevenue
        ];
        $this->view('driver/earings',$data);
}

public function getFinalPayment(){
    $user_id = $_SESSION['user_id'];

    $finalPayment = $this->TravelsModel->getFinalPayment($user_id);

    return $finalPayment;
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
        $profileimage = $this->TravelsModel->getProfileImage($userId);

        $count = $this->TravelsModel->getUnreadNotificationCount($userId);
        $notification = $this->TravelsModel->getNotifications($userId);

        // var_dump($notifications);

        $data = [
            'notification' => $notification,
            'profileimage' => $profileimage,
            'count' => $count];
            

        // var_dump($data);

                    
                           
                    $this->view('driver/notification',$data);
    }
    public function markNotificationAsRead() {
        $notification_id = $_POST['notification_id'];
        $userId = $_SESSION['user_id'];


        $updated = $this->TravelsModel->markAsRead($notification_id);

        if ($updated) {
            echo json_encode(['success' => 'Notification marked as read successfully']);
        } else {
            echo json_encode(['error' => 'Failed to mark notification as read']);
        }
        
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


        $feedbackDetails = $this->TravelsModel->getCompletedBookingFeedback($userId);

        $feedbackCount = $this->TravelsModel->getFeedbackCount($userId);

        // var_dump($feedbackCount);

            $data=['profileimage' => $profileimage,
            'feedbackDetails' => $feedbackDetails,
            'feedbackCount' => $feedbackCount
            ];
        
            //    var_dump($feedbackDetails);
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

                // var_dump($userId);

            
                $agencyDetails = $this->TravelsModel->getAgencyDetails($userId);
                $profileimage = $this->TravelsModel->getProfileImage($userId);

                $agencyId = $this->TravelsModel->getAgencyId($userId);
            
                $userDetails = $this->TravelsModel->getUserDetails($_SESSION['user_id']);

                $pendingBookingCount = $this->TravelsModel->checkPendingBookings($userId);

                // var_dump($pendingBookingCount);
            
                
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
                    'pendingBookingCount' => $pendingBookingCount
                ];
            
                $this->view('driver/settings', $data);
            }
            public function deleteProfile($userId) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Handle form submission
                    if ($this->TravelsModel->deleteProfile($userId)) {
                        // Profile deleted successfully
                        session_destroy(); // Destroy the session to log the user out
                        flash('success', 'Profile deleted successfully');
                        redirect('login'); // Redirect to the login page
                    } else {
                        // Error deleting profile
                        flash('error', 'Failed to delete profile');
                        redirect('driver/settings'); // Redirect back to settings page
                    }
                }
            }

            
            
     public function vehicle(){
                    // Get the user_id from session
                    
                    $userId = $_SESSION['user_id'];


                    $profileimage = $this->TravelsModel->getProfileImage($userId);

                    $bookedVehicles = $this->TravelsModel->getBookedVehicles($userId);
                    
                   


                    $agencyId = $this->TravelsModel->getAgencyId($userId);

                    // var_dump($agencyId);
                    $vehicleCount = $this->TravelsModel->getVehicleCount($agencyId);
                
                    
                        // If agency_id is found, fetch vehicle details
                        $vehicledetails = $this->TravelsModel->vehicleDetails($agencyId);
                        $data=[
                            'vehicleCount' =>$vehicleCount,
                            'profileimage' => $profileimage,
                            'vehicledetails'=> $vehicledetails,
                            'bookedVehicles' => $bookedVehicles,
                        
                        ];
                        $this->view('driver/vehicle', $data);
                   
     }public function vehicledelete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the vehicle_id from the POST data
            $vehicleId = $_POST['vehicle_id'];
    
            // Check if the vehicle has pending bookings
            if ($this->TravelsModel->getVehicleBooking($vehicleId)) { // If getVehicleCount returns true
                // Show an error message indicating the vehicle cannot be deleted
                echo 'Error: The vehicle cannot be deleted because it has pending bookings.';
                exit();
            }
    
            // Call your delete method with the received vehicle_id
            $success = $this->TravelsModel->deleteVehicle($vehicleId);
    
            // Redirect back to the same page after deletion
            // Optionally, you can echo a success message here
            echo 'Vehicle deleted successfully.';
            exit();
        } else {
            // Handle other request methods (optional)
            // For example, show an error page
            echo 'Method Not Allowed';
            http_response_code(405); // Method Not Allowed
            exit();
        }
    }
    
    
    
    

     public function setavailability(){
        // Debugging: Check if form data is received
        var_dump($_POST);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['vehicle_id']) && !empty($_POST['temp'])) {  // Check if temp is set and not empty
                // Get vehicle ID from form data
                $vehicleId = $_POST['vehicle_id'];
    
                // Handle form data
                $data = [
                    'vehicle_id' => $vehicleId,
                    'vehicleCondition' => $_POST['temp'] === 'on' ? 'deactivated' : 'activated',
                ];
                // Call the model to set vehicle availability
                $result = $this->TravelsModel->setVehicleAvailability($data);
                if ($result) {
                    // Redirect back to the same page or a success page
                    redirect('driver/vehicle');
                } else {
                    // Handle update failure
                    die('Update failed');
                }
            } else {
                die('Incomplete form data');
            }
        }
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
                            'manager_name' => trim($_POST['manager_name']),
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
                            $uploadPath = '..\public\images\\'; // Update with your actual upload path
                        
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
                                'dailyKmLimit' => trim($_POST['dailyKmLimit']), // Add this line to update 'dailyKmLimit
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
                                'ac_type' => $vehicle->ac_type,
                                'dailyKmLimit'=> $vehicle->dailyKmLimit,
                                // Access object property correctly
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
                'withDriverPerDay' => $_POST['withDriverPerDay'],  
                'dailyKmLimit' => $_POST['dailyKmLimit']
            ];
    
            // Upload images
            $imageNames = [];
            $uploadDir = '../public/images/'; // Adjust this path as per your server configuration
    
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
                            'manager_name' => trim($_POST['manager_name']),
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

    public function updateBookingStatus(){

        //Retrieve vehicle_id, booking_id, and temporyid from the POST request
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $_POST['user_id'];
        $temporyid = $_POST['temporyid'];
        $vehicle_id = $_POST['vehicle_id'];
        $booking_id = $_POST['booking_id'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $payment_amount = $_POST['payment_amount'];
        $plate_number = $_POST['plate_number'];

        $basicinfo = $this->basicInfo();
        $sender_name = $basicinfo['userData']->fname;

        

        if ($temporyid == 0) {
            // Call the model function to update the booking status
            $updated = $this->TravelsModel->updateBookingStatus($booking_id);
        } elseif ($temporyid !== 1) {
            // Handle the case where temporyid is 1
            $updated = $this->TravelsModel->updateCartBookingStatus($booking_id, $vehicle_id);
        } else {
            // Handle the case where temporyid is neither 0 nor 1
            $updated = $this->TravelsModel->updateCartBookingStatus($booking_id, $vehicle_id);
        }

        // Construct the notification message
        $notification_message = "$sender_name" . " has cancelled your booking with the booking details were for" . " $plate_number" . "vehicle from" . " $startDate" . " to" . " $endDate." . " We apologize for the inconvenience caused. Your payment refund will be processed within 7 days.";

        // Insert notification
        $notification_inserted = $this->TravelsModel->insertNotification($booking_id, $sender_id, $receiver_id, $notification_message);


        $manager_notification = "$sender_name" . " has cancelled your booking with the booking details were for" . " $plate_number" . " vehicle from" . " $startDate" . " to" . " $endDate." . " Make Sure Refund will be processed within 7 days";


        $notification2_inserted = $this->TravelsModel->notifyUsersWithType2($booking_id, $sender_id,$manager_notification);

        $currentDate = date('Y-m-d');
        $cancelled_id = $_SESSION['user_id'];

        //Update the refund table
        $refund = $this->TravelsModel->updateRefund($temporyid,$booking_id,$sender_id,$receiver_id,$cancelled_id,$payment_amount,$currentDate);


        $availabilityUpdate = $this->TravelsModel->updateAvailability($vehicle_id,$startDate,$endDate);

//       (tempory_id, booking_id, serviceProvider_id,user_id,refund_amount)

        require_once __DIR__ . '/../libraries/sms/vendor/autoload.php';

        $basic  = new \Vonage\Client\Credentials\Basic("992a5e27", "YiQN3gXeYkIkfbcJ");
        $client = new \Vonage\Client($basic);

        $messageBody = "$sender_name has cancelled your booking with the booking details for $plate_number vehicle from $startDate to $endDate. We apologize for the inconvenience caused. Your payment refund will be processed within 7 days.";

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("94768968161", 'Travelease', $messageBody)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

        // Return JSON response based on the result
        if ($updated && $notification_inserted && $notification2_inserted && $availabilityUpdate && $refund && $message->getStatus() == 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

    }

                
                

            }         