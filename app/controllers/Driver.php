<?php

class Driver extends Controller{
    

    private $postModel;
    public function __construct(){
        
        if(!isLoggedIn()){
            redirect('users/login');
          }
          $this->userModel = $this->model('Travel');
    }

    public function index(){
        $this->view('driver/index');
    }
    public function Calender(){
        $this->view('driver/calender');
    }
    public function bookings() {
        $user_id = $_SESSION['user_id'];
    

    
        // Get accepted bookings
        $acceptedbookings = $this->userModel->acceptedbookings($user_id);
    
        $data['acceptedbookings'] = $acceptedbookings;
    
       

        
        //Get completed bookings
$completedbookings = $this->userModel->completedbookings($user_id);

$data['completedbookings'] = $completedbookings;

        $this->view('driver/bookings', $data);
    }
    

        
    public function earings() {

        
        $user_id = $_SESSION['user_id'];
        $totalEarnings = $this->userModel->getTotalPayments($user_id);
    
        if ($totalEarnings !== null) {
            $payments = $this->userModel->getPayments($user_id);
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
                $pendingbookings = $this->userModel->getPendingBookings($user_id);
       
                $data = [
                    'pendingbookings' => $pendingbookings,
                ];
        $this->view('driver/notification', $data);
    }
    
    


            public function reviews(){
                $user_id = $_SESSION['user_id'];    
                $reviews = $this->userModel->getReviews($user_id);
                $data = [
                    'reviews' => $reviews,
                ];
                $this->view('driver/reviews', $data);
            }
            
    
    public function settings(){
        $this->view('driver/settings');
                }
    public function vehicle(){
        $user_id=$_SESSION['user_id'];
        $data=$this->userModel->vehicleDetails($user_id);
        $this->view('driver/vehicle',$data);

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
                ];

                
                if ($this->userModel->updatevehicle($data)) {
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
                ];


            }
            $this->view('driver/vehicleedit',$data);
            
                    }
                

    
           
    public function vehiclepassword(){
          $this->view('driver/vehiclepassword');
               }

    public function vehiclereg()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Initialize these variables
            $vehPhoto = $insPhoto = $regPhoto = null;
    
            // Check if images were uploaded
            if (!empty($_FILES['images']['name'])) {
                $uploadDirectory = STOREROOT; // Use the constant directly
                
                // Loop through each uploaded file
                foreach ($_FILES['images']['name'] as $key => $fileName) {
                    $tempFilePath = $_FILES['images']['tmp_name'][$key];
                    $destinationFilePath = $uploadDirectory . $fileName;
    
                    if (move_uploaded_file($tempFilePath, $destinationFilePath)) {
                        // File has been successfully moved to the specified directory
                        // You can store the file path in the database or perform other actions
                    } else {
                        // Handle file upload error
                    }
                }
            }
    
            // Retrieve text data
            $data = [
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'plate_number' => $_POST['plate_number'],
                'fuel_type' => $_POST['fuel_type'],
                'year' => $_POST['year'],
                'seating_capacity' => $_POST['seating_capacity'],
                'user_id' => $_SESSION['user_id'], 
                // 'owner_id' => $_SESSION['user_id'], // This is the user ID of the logged in user

                'ac_type' => $_POST['ac_type'],
                //    'veh_photo' => $vehPhoto,
                'ins_number' => $_POST['ins_number'],
                'ins_name' => $_POST['ins_name'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                //    'ins_photo' => $insPhoto,
                //    'reg_photo' => $regPhoto,
            ];
    
            // Now, save this data to the database using your model
            $travelModel = $this->model('Travel');
            if ($travelModel->vehiclereg($data)) {
                redirect ('driver/vehicle');
            } else {
                // Data save failed, handle the error
            }
        } else {
            // Handle other cases, such as GET requests
        }
    
        $this->view('driver/vehiclereg');
    }
    
    // Define the handleFileUpload function outside the method
    private function handleFileUpload($fileInputName, $uploadDirectory)
    {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $tempFile = $_FILES[$fileInputName]['tmp_name'];
            $targetFile = $uploadDirectory . $_FILES[$fileInputName]['name'];
    
            if (move_uploaded_file($tempFile, $targetFile)) {
                return $_FILES[$fileInputName]['name'];
            }
        }
    
        return null; 
    }

               public function vehicledelete($id){
                $data=$this->userModel->vehicledelete($id);
                            }
            }         