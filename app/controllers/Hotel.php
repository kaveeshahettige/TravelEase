<?php

class Hotel extends Controller{

    private $postModel;
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->hotelsModel = $this->model('Hotels');
    }

    public function index(){
        $this->view('hotel/index');
    }
    public function Calender(){
        $this->view('hotel/calender');
    }
    public function bookings(){
        $bookingData = $this->getBookingsData();
        $data["bookingData"] = $bookingData;
        // Pass the data to the view
        $this->view('hotel/bookings', ['bookingData' => $bookingData]);
    }
    public function gallery(){
        $this->view('hotel/gallery');
    }
    public function revenue(){
        $this->view('hotel/revenue');
    }
    public function reviews(){
        $reviews = $this->getReviewsData();
        $data ["reviews"] = $reviews;
        $this->view('hotel/reviews', $data);
    }
    public function settings(){
        $roomCount = $this->hotelsModel->getRoomCount();
        $data["roomCount"] = $roomCount;
//        print_r($data);
        $this->view('hotel/settings', ['roomCount' => $roomCount]);
    }
    public function addrooms(){
        $roomData = $this->hotelsModel->getHotel();
        $data["roomData"] = $roomData;
//        print_r($data);
        $this->view('hotel/addrooms', $data);

    }
    public function addroomsedit(){
        $roomData = $this->hotelsModel->getHotel();
        $data["roomData"] = $roomData;
        $this->view('hotel/addroomsedit');
    }

//    public function updateroom(){
//        $roomData = $this->hotelsModel->getHotel();
//        $data["roomData"] = $roomData;
//        $this->view('hotel/updateroom');
//    }
    public function hoteledit(){
        $this->view('hotel/hoteledit');
    }
    public function hotelpassword(){
        $this->view('hotel/hotelpassword');
    }

    public function hoteladdrooms($room_id){
        $roomData= [
            'room_id'=>$room_id,
        ];

        $this->view('hotel/addrooms',$roomData);
    }


    public function hoteladdroomsedit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $roomData = [
                'roomType' => trim($_POST['roomType']),
                'numOfBeds' => trim($_POST['numOfBeds']),
                'price' => trim($_POST['price']),
                'roomImages' => trim($_POST['roomImages'][0]),
                'acAvailability' => trim($_POST['acAvailability']),
                'tvAvailability' => trim($_POST['tvAvailability']),
                'wifiAvailability' => trim($_POST['wifiAvailability']),
                'smokingPolicy' => trim($_POST['smokingPolicy']),
                'petPolicy' => trim($_POST['petPolicy']),
                'roomDescription' => trim($_POST['roomDescription']),
                'cancellationPolicy' => trim($_POST['cancellationPolicy']),
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'price_err' => '',
                'roomImages_err' => '',
                'acAvailability_err' => '',
                'tvAvailability_err' => '',
                'wifiAvailability_err' => '',
                'smokingPolicy_err' => '',
                'petPolicy_err' => '',
                'roomDescription_err' => '',
                'cancellationPolicy_err' => '',
            ];

            // Validate roomType
            if (empty($roomData['roomType'])) {
                $roomData['roomType_err'] = 'Please choose Room Type';
            }

            // Validate numOfBeds
            if (empty($roomData['numOfBeds'])) {
                $roomData['numOfBeds_err'] = 'Please enter Number of Beds';
            }

            // Validate price
            if (empty($roomData['price'])) {
                $roomData['price_err'] = 'Please Enter Price';
            }

            // Validate room images
            if (empty($roomData['roomImages'])) {
                $roomData['roomImages_err'] = 'Please Enter Images';
            }

            // Validate AC Availability
            if (empty($roomData['acAvailability'])) {
                $roomData['acAvailability_err'] = 'Please choose AC Availability';
            }

            // Validate TV Availability
            if (empty($roomData['tvAvailability'])) {
                $roomData['tvAvailability_err'] = 'Please choose TV Availability';
            }

            // Validate WiFi Availability
            if (empty($roomData['wifiAvailability'])) {
                $roomData['wifiAvailability_err'] = 'Please choose WiFi Availability';
            }

            // Validate Smoking Policy
            if (empty($roomData['smokingPolicy'])) {
                $roomData['smokingPolicy_err'] = 'Please choose Smoking Policy';
            }

            // Validate Pet Policy
            if (empty($roomData['petPolicy'])) {
                $roomData['petPolicy_err'] = 'Please choose Pet Policy';
            }

            // Validate Description
            if (empty($roomData['roomDescription'])) {
                $roomData['roomDescription_err'] = 'Please choose Room Description';
            }

            // Validate Cancellation Policy
            if (empty($roomData['cancellationPolicy'])) {
                $roomData['cancellationPolicy_err'] = 'Please enter Cancellation Policy';
            }

            // Make sure errors are empty
            if (
                empty($roomData['roomType_err']) && empty($roomData['numOfBeds_err']) &&
                empty($roomData['price_err']) && empty($roomData['roomImages_err']) &&
                empty($roomData['acAvailability_err']) && empty($roomData['tvAvailability_err']) &&
                empty($roomData['wifiAvailability_err']) && empty($roomData['smokingPolicy_err']) &&
                empty($roomData['petPolicy_err']) && empty($roomData['roomDescription_err']) &&
                empty($roomData['cancellationPolicy_err'])
            ) {
                // Save the data to the database
                if ($this->hotelsModel->hoteladdroomsedit($roomData)) {
                    flash('register_success', 'You are registered and can login');
                    redirect('hotel/addrooms');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Display the form with validation errors
                $this->view('hotel/addroomsedit', $roomData);
            }
        } else {
            $roomData = [
                'roomType' => '',
                'numOfBeds' => '',
                'price' => '',
                'roomImages' => '',
                'acAvailability' => '',
                'tvAvailability' => '',
                'wifiAvailability' => '',
                'smokingPolicy' => '',
                'petPolicy' => '',
                'roomDescription' => '',
                'cancellationPolicy' => '',
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'price_err' => '',
                'roomImages_err' => '',
                'acAvailability_err' => '',
                'tvAvailability_err' => '',
                'wifiAvailability_err' => '',
                'smokingPolicy_err' => '',
                'petPolicy_err' => '',
                'roomDescription_err' => '',
                'cancellationPolicy_err' => '',
            ];

            // Display the form
            $this->view('hotel/addroomsedit', ['roomData' => $roomData]);
        }
    }




    public function hotelupdaterooms($room_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $roomData = [
                'roomType' => trim($_POST['roomType']),
                'numOfBeds' => trim($_POST['numOfBeds']),
                'price' => trim($_POST['price']),
                'roomImages' => $_FILES['roomImages'],
                'acAvailability' => trim($_POST['acAvailability']),
                'tvAvailability' => trim($_POST['tvAvailability']),
                'wifiAvailability' => trim($_POST['wifiAvailability']),
                'smokingPolicy' => trim($_POST['smokingPolicy']),
                'petPolicy' => trim($_POST['petPolicy']),
                'roomDescription' => trim($_POST['roomDescription']),
                'cancellationPolicy' => trim($_POST['cancellationPolicy']),
                'room_id' => $room_id,
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'price_err' => '',
                'roomImages_err' => '',
                'acAvailability_err' => '',
                'tvAvailability_err' => '',
                'wifiAvailability_err' => '',
                'smokingPolicy_err' => '',
                'petPolicy_err' => '',
                'roomDescription_err' => '',
                'cancellationPolicy_err' => '',
            ];

            // Validate Room Type
            if (empty($roomData['roomType'])) {
                $roomData['roomType_err'] = 'Please choose Room Type';
            }

            // Validate Number of Beds
            if (empty($roomData['numOfBeds'])) {
                $roomData['numOfBeds_err'] = 'Please enter Number of Beds';
            }

            // Validate Price
            if (empty($roomData['price'])) {
                $roomData['price_err'] = 'Please Enter Price';
            }

            // Validate Room Images
            if (empty($roomData['roomImages']['name'])) {
                $roomData['roomImages_err'] = 'Please upload at least one image';
            }

            // Validate AC Availability
            if (empty($roomData['acAvailability'])) {
                $roomData['acAvailability_err'] = 'Please choose AC Availability';
            }

            // Validate TV Availability
            if (empty($roomData['tvAvailability'])) {
                $roomData['tvAvailability_err'] = 'Please choose TV Availability';
            }

            // Validate WiFi Availability
            if (empty($roomData['wifiAvailability'])) {
                $roomData['wifiAvailability_err'] = 'Please choose WiFi Availability';
            }

            // Validate Smoking Policy
            if (empty($roomData['smokingPolicy'])) {
                $roomData['smokingPolicy_err'] = 'Please choose Smoking Policy';
            }

            // Validate Pet Policy
            if (empty($roomData['petPolicy'])) {
                $roomData['petPolicy_err'] = 'Please choose Pet Policy';
            }

            // Validate Room Description
            if (empty($roomData['roomDescription'])) {
                $roomData['roomDescription_err'] = 'Please enter Room Description';
            }

            // Validate Cancellation Policy
            if (empty($roomData['cancellationPolicy'])) {
                $roomData['cancellationPolicy_err'] = 'Please enter Cancellation Policy';
            }

//            // Handle File Upload
//            $uploadResult = $this->handleFileUpload($roomData['roomImages']);
//
//            if ($uploadResult['success']) {
//                $roomData['roomImages'] = $uploadResult['filePath'];
//            } else {
//                $roomData['roomImages_err'] = $uploadResult['error'];
//            }

            // Check for any validation errors
            if (
                empty($roomData['roomType_err']) && empty($roomData['numOfBeds_err']) &&
                empty($roomData['price_err']) && empty($roomData['roomImages_err']) &&
                empty($roomData['acAvailability_err']) && empty($roomData['tvAvailability_err']) &&
                empty($roomData['wifiAvailability_err']) && empty($roomData['smokingPolicy_err']) &&
                empty($roomData['petPolicy_err']) && empty($roomData['roomDescription_err']) &&
                empty($roomData['cancellationPolicy_err'])
            ) {
                // Save the data to the database
                if ($this->hotelsModel->hotelupdaterooms($roomData)) {
                    flash('user_message', 'Room Updated');
                    redirect('hotel/addrooms');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Display the form with validation errors
                $this->view('hotel/updateroom', $roomData);
            }
        } else {
            // Display the form
            $hotels = $this->hotelsModel->findrooms($room_id);

            $roomData = [
                'room_id' => $room_id,
                'roomType' => $hotels->roomType,
                'numOfBeds' => $hotels->numOfBeds,
                'price' => $hotels->price,
                'acAvailability' => $hotels->acAvailability,
                'tvAvailability' => $hotels->tvAvailability,
                'wifiAvailability' => $hotels->wifiAvailability,
                'smokingPolicy' => $hotels->smokingPolicy,
                'petPolicy' => $hotels->petPolicy,
                'roomDescription' => $hotels->roomDescription,
                'cancellationPolicy' => $hotels->cancellationPolicy,
            ];

            $this->view('hotel/updateroom', $roomData);
        }
    }


    public function deleterooms($room_id){
//        echo $room_id;
//        die;
        if($this->hotelsModel->deleterooms($room_id)){
            flash('post_message', 'Room Removed');
            redirect('hotel/addrooms');
        } else {
            die('Something went wrong');
        }
    }

    public function roomCount(){
        $hotelModel = $this->model('Hotels');
        $roomCount = $hotelModel->getRoomCount();

        // Pass the room count to the view
        $this->view('Hotel/settings', ['roomCount' => $roomCount]);
    }

    public function getBookingsData() {
        // Get bookings data from the model
        $bookingData = $this->hotelsModel->getBookings();

        // Check if any bookings are found
        if ($bookingData) {
            // If there are bookings, return the data
            return $bookingData;
        } else {
            // If no bookings found, return an empty array
            return [];
        }
    }

    public function getReviewsData() {
        // Get reviews data from the model
        $reviews = $this->hotelsModel->getReviews();
        if ($reviews) {
            return $reviews;
        } else {
            return [];
        }
    }

    public function processServiceValidation() {
        $userId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $targetDir = "../public/uploads/service_validations/";
            $targetFile = $targetDir . basename($_FILES['service-validation-pdf']['name']);

            // Move the uploaded file to the target directory
            move_uploaded_file($_FILES['service-validation-pdf']['tmp_name'], $targetFile);

            // Call the model to insert the PDF information into the database
            if ($this->hotelsModel->insertPdf($targetFile, $userId)) {
                // Success - You can redirect or show a success message
                flash('success', 'PDF submitted successfully');
                redirect('hotel/settings');
            } else {
                // Error - You can redirect or show an error message
                flash('error', 'Failed to submit PDF');
                redirect('hotel/settings');
            }
        }
    }

    public function changeProfilePicture() {
        // Check if a file was uploaded
        if ($_FILES['profile-picture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/uploads/profile-pictures/';
            $uploadFile = $uploadDir . basename($_FILES['profile-picture']['name']);

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($_FILES['profile-picture']['tmp_name'], $uploadFile)) {
                // Update the session with the new file path
                $_SESSION['user_profile_picture'] = $uploadFile;

                // Update the profile picture in the database
                $this->hotelsModel->updateProfilePicture($_SESSION['user_id'], $uploadFile);
            } else {
                echo 'Error uploading the file.';
            }
        } else {
            echo 'File upload error.';
        }

        // Redirect to the profile page or wherever you want
        header('Location: ' . URLROOT . '/hotel/settings');
        exit;
    }


}

