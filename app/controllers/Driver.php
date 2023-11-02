<?php

class Driver extends Controller{
    

    private $postModel;
    public function __construct()
    {
        $this->userModel = $this->model('Travel');
        if(!isLoggedIn()){
            redirect('users/login');
          }
    }

    public function index(){
        $this->view('driver/index');
    }
    public function Calender(){
        $this->view('driver/calender');
    }
    public function bookings(){
        $this->view('driver/bookings');
        }
    public function earings(){
        $this->view('driver/earings');
        }
    public function notification(){
        $this->view('driver/notification');
            }
    public function reviews(){
        $this->view('driver/reviews');
            }
    public function settings(){
        $this->view('driver/settings');
                }
    public function vehicle(){

        $data=$this->userModel->vehicleDetails();
        $this->view('driver/vehicle',$data);
        // redirect('driver/vehicle');
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
                    'brand' => trim($_POST['brand']),
                    'model' => trim($_POST['model']),
                    'plate_number' => trim($_POST['plate_number']),
                    'fuel_type' => trim($_POST['fuel_type']),
                    'year' => trim($_POST['year']),
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
                    'brand' => '',
                    'model' => '',
                    'plate_number' =>'',
                    'fuel_type' => '',
                    'year' =>'',
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
                           // Data successfully saved
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
               
                   return null; // Handle file upload error
               }
            }         