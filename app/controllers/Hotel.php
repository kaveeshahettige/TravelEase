<?php

class Hotel extends Controller
{
    private $hotelsModel;
    private $postModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->hotelsModel = $this->model('Hotels');
    }

    public function navigation()
    {
        $data = ['basicInfo' => $this->basicInfo(), 'roomCount' => $this->roomCount()];
        $this->view('hotel/navigation', $data);
    }

    public function index()
    {
        $bookingData = $this->getBookingsData();
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();
        $totalRevenue = $this->getTotalRevenue();
        $approval = $this->getProfileStatus();
        $verificationStatus = $this->checkServiceValidations();

        $data = [
            'bookingsCount' => $bookingsCount,
            'guestCount' => $guestCount,
            'basicInfo' => $this->basicInfo(),
            'roomCount' => $this->roomCount(),
            'bookingData' => $bookingData,
            'totalRevenue' => $totalRevenue,
            'approval' => $approval,
            'verificationStatus' => $verificationStatus,

        ];

        $this->view('hotel/index',$data);
    }

    public function Calender()
    {
        $roomCount = $this->roomCount();
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();

        $data = [
            'selectedDate' => date('Y-m-d'),
            'basicInfo' => $this->basicInfo(),
            'bookingsCount'=> $bookingsCount,
            'roomCount' => $roomCount,
            'guestCount' => $guestCount,
        ];

        $this->view('hotel/calender', $data);
    }

    public function availablerooms()
    {
        $startDate = date('Y-m-d');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Retrieve the date from the query parameters
            $startDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

            if (empty($startDate)) {
                flash('error', 'Please select a date.');
                redirect('hotel/calender');
            }
        }




        // Get the hotel ID for the logged-in user
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        // Get room data for the hotel
        $roomData = $this->hotelsModel->getHotelRooms($hotel_id);

        $unavailableRooms = $this->hotelsModel->getUnavailableRooms($startDate);

        $unavailableRoomsIds = [];
        foreach ($unavailableRooms as $room) {
            $unavailableRoomsIds[] = $room->room_id;
        }



        // Pass the room data and selected date to the view
        $data = [
            'roomData' => $roomData,
            'date' => $startDate,
            'unavailableRooms' => $unavailableRoomsIds,
            'basicInfo' => $this->basicInfo(),
        ];

        // Load the view
        $this->view('hotel/availablerooms', $data);
    }


    public function bookings()
    {

        $bookingData = $this->getBookingsData();
//        var_dump($bookingData[0]);
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();
        $reviewCount = $this->getReviewCount();

        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);
        $roomData = $this->hotelsModel->getHotelRooms($hotel_id);
//        var_dump($guestCount);

        $data=[
            'bookingData' => $bookingData,
            'basicInfo' => $this->basicInfo(),
            'bookingsCount'=> $bookingsCount,
            'guestCount' => $guestCount,
            'reviewCount'=>$reviewCount,
            'roomData' => $roomData,
            ];
        // Pass the data to the view
        $this->view('hotel/bookings',$data);
    }

    public function combookings()
    {

        $completedBookings = $this->getCompletedBookingsData();
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();
        $reviewCount = $this->getReviewCount();

        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);
        $roomData = $this->hotelsModel->getHotelRooms($hotel_id);
//        var_dump($guestCount);

        $data=[
            'completedBookings' => $completedBookings,
            'basicInfo' => $this->basicInfo(),
            'bookingsCount'=> $bookingsCount,
            'guestCount' => $guestCount,
            'reviewCount'=>$reviewCount,
            'roomData' => $roomData,
        ];
        // Pass the data to the view
        $this->view('hotel/combookings',$data);
    }

    public function rejbookings()
    {

        $cancelledbBokings = $this->getRejectedBookingsData();
//        var_dump($cancelledbBokings);
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();
        $reviewCount = $this->getReviewCount();

        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);
        $roomData = $this->hotelsModel->getHotelRooms($hotel_id);
//        var_dump($guestCount);

        $data=[
            'cancelledbBokings' => $cancelledbBokings,
            'basicInfo' => $this->basicInfo(),
            'bookingsCount'=> $bookingsCount,
            'guestCount' => $guestCount,
            'reviewCount'=>$reviewCount,
            'roomData' => $roomData,
        ];
        // Pass the data to the view
        $this->view('hotel/rejbookings',$data);
    }


    public function gallery()
    {
        $notifications = $this->getnotifications();
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();
        $totalRevenue = $this->getTotalRevenue();

        $data=[
            'notifications' => $notifications,
            'basicInfo' => $this->basicInfo(),
            'guestCount' => $guestCount,
            'bookingsCount' => $bookingsCount,
            'totalRevenue' => $totalRevenue
        ];
        $this->view('hotel/gallery', $data);
    }

    public function revenue()
    {
        $finalPayment = $this->getFinalPayment();
        $totalRevenue = $this->getTotalRevenue();
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();

        $data=[
            'basicInfo' => $this->basicInfo(),
            'finalPayment' => $finalPayment,
            'bookingsCount' => $bookingsCount,
            'guestCount' => $guestCount,
            'totalRevenue' => $totalRevenue
        ];
        $this->view('hotel/revenue', $data);
    }

    public function reviews()
    {
        $bookingsCount = $this->getBookingsCount();
        $guestCount = $this->getGuestCount();
        $reviews = $this->getReviews();
        $reviewCount = $this->getReviewCount();


        $data=[
            'bookingsCount' => $bookingsCount,
            'guestCount' => $guestCount,
            'reviews' => $reviews,
            'reviewCount'=>$reviewCount,
            'basicInfo' => $this->basicInfo(),
        ];

        $this->view('hotel/reviews', $data);
    }

    public function settings()
    {
        // Get basic information
        $verificationStatus = $this->checkServiceValidations();
        // Get room count (assuming $roomCount is an associative array)
        $data = [
            'basicInfo' => $this->basicInfo(),
            'roomCount' => $this->roomCount(),
            'verificationStatus' => $verificationStatus,
        ];

        // Pass data to the view separately
        $this->view('hotel/settings',$data);
    }

    public function hotelvalidation(){

        $data = ['basicInfo' => $this->basicInfo()];

        $this->view('hotel/hotelvalidation', $data);
    }

    public function addrooms()
    {
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        $roomData = $this->hotelsModel->getHotelRooms($hotel_id);

        $activeRooms = $this->getActiveRooms();

        $data = [
            'roomData' => $roomData,
            'basicInfo' => $this->basicInfo(),
            'activeRooms' => $activeRooms,
        ];

        $this->view('hotel/addrooms', $data);
    }

    public function addroomsedit()
    {
        $roomData = $this->hotelsModel->getHotel();

        $data = [
            'roomData' => $roomData,
            'basicInfo' => $this->basicInfo(),
        ];

        $this->view('hotel/addroomsedit', $data);
    }

    public function updateroom()
    {
        $roomData = $this->hotelsModel->getHotel();
        $data["roomData"] = $roomData;
        $this->view('hotel/updateroom');
    }

    public function hoteledit()
    {

        $data = [
            'basicInfo' => $this->basicInfo(),
        ];

        // Pass data to the view
        $this->view('hotel/hoteledit', $data);
    }

    public function hotelpassword()
    {
        $basicInfo = $this->basicInfo();

        $data = [
            'basicInfo' => $this->basicInfo(),
        ];

        $this->view('hotel/hotelpassword', $data);
    }

    public function hoteladdrooms($room_id)
    {
        $roomData = ['room_id' => $room_id,];
        $this->view('hotel/addrooms', $roomData);
    }


    public function hoteladdroomsedit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Fetch hotel_id from the hotels table based on user_id
            $user_id = $_SESSION['user_id'];
            $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

            // Prepare room data array
            $roomData = [
                'hotel_id' => $hotel_id,
                'roomType' => trim($_POST['roomType']),
                'numOfBeds' => trim($_POST['numOfBeds']),
                'numAdults' => trim($_POST['numAdults']),
                'numChildren' => trim($_POST['numChildren']),
                'price' => trim($_POST['price']),
                'roomSize' => trim($_POST['roomSize']),
                'acAvailability' => trim($_POST['acAvailability']),
                'tvAvailability' => trim($_POST['tvAvailability']),
                'wifiAvailability' => trim($_POST['wifiAvailability']),
                'smokingPolicy' => trim($_POST['smokingPolicy']),
                'petPolicy' => trim($_POST['petPolicy']),
                'balconyAvailability' => trim($_POST['balconyAvailability']),
                'privatePoolAvailability' => trim($_POST['privatePoolAvailability']),
                'hotTubAvailability' => trim($_POST['hotTubAvailability']),
                'refrigeratorAvailability' => trim($_POST['refrigeratorAvailability']),
                'hotShowerHeaterAvailability' => trim($_POST['hotShowerHeaterAvailability']),
                'washingMachineAvailability' => trim($_POST['washingMachineAvailability']),
                'kitchenAvailability' => trim($_POST['kitchenAvailability']),
                'breakfastIncluded' => trim($_POST['breakfastIncluded']),
                'lunchIncluded' => trim($_POST['lunchIncluded']),
                'dinnerIncluded' => trim($_POST['dinnerIncluded']),
                'description' => trim($_POST['description']),
                'cancellationPolicy' => trim($_POST['cancellationPolicy']),
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'numAdults_err' => '',
                'numChildren_err' => '',
                'price_err' => '',
                'roomSize_err' => '',
                'acAvailability_err' => '',
                'tvAvailability_err' => '',
                'wifiAvailability_err' => '',
                'smokingPolicy_err' => '',
                'petPolicy_err' => '',
                'balconyAvailability_err' => '',
                'privatePoolAvailability_err' => '',
                'hotTubAvailability_err' => '',
                'refrigeratorAvailability_err' => '',
                'hotShowerHeaterAvailability_err' => '',
                'washingMachineAvailability_err' => '',
                'kitchenAvailability_err' => '',
                'breakfastIncluded_err' => '',
                'lunchIncluded_err' => '',
                'dinnerIncluded_err' => '',
                'description_err' => '',
                'cancellationPolicy_err' => '',
                'roomImages' => [],
            ];

            // Validate roomType
            if (empty($roomData['roomType'])) {
                $roomData['roomType_err'] = 'Please enter room type';
            }

            // Validate numOfBeds
            if (empty($roomData['numOfBeds'])) {
                $roomData['numOfBeds_err'] = 'Please enter the number of beds';
            } elseif (!is_numeric($roomData['numOfBeds']) || $roomData['numOfBeds'] <= 0) {
                $roomData['numOfBeds_err'] = 'Number of beds should be a positive integer';
            }

            // Validate other fields similarly

            // Handle file upload for room images
            $uploadedImages = [];
            if (isset($_FILES['roomImages']) && !empty($_FILES['roomImages']['name'][0])) {
                $images = $_FILES['roomImages'];
                foreach ($images['tmp_name'] as $key => $tmp_name) {
                    $file_name = $images['name'][$key]; // Original file name
                    $upload_dir = "../public/images/" . $file_name; // Destination directory
                    if (move_uploaded_file($tmp_name, $upload_dir)) {
                        $uploadedImages[] = $file_name; // Store the original file name
                    }
                }
            }





            // Check if there are no errors
            if (
                empty($roomData['roomType_err']) && empty($roomData['numOfBeds_err']) &&
                empty($roomData['numAdults_err']) && empty($roomData['numChildren_err']) &&
                empty($roomData['price_err']) && empty($roomData['roomSize_err']) &&
                empty($roomData['acAvailability_err']) && empty($roomData['tvAvailability_err']) &&
                empty($roomData['wifiAvailability_err']) && empty($roomData['smokingPolicy_err']) &&
                empty($roomData['petPolicy_err']) && empty($roomData['balconyAvailability_err']) &&
                empty($roomData['privatePoolAvailability_err']) && empty($roomData['hotTubAvailability_err']) &&
                empty($roomData['refrigeratorAvailability_err']) && empty($roomData['hotShowerHeaterAvailability_err']) &&
                empty($roomData['washingMachineAvailability_err']) && empty($roomData['kitchenAvailability_err']) &&
                empty($roomData['breakfastIncluded_err']) && empty($roomData['lunchIncluded_err']) &&
                empty($roomData['dinnerIncluded_err']) && empty($roomData['description_err']) &&
                empty($roomData['cancellationPolicy_err'])
            ) {
                // Set the correct hotel_id before inserting into the database
                // Set the uploaded images data
                $roomData['roomImages'] = $uploadedImages;
                $roomData['hotel_id'] = $hotel_id;

                // Call the model method to add or edit hotel rooms
                if ($this->hotelsModel->hoteladdroomsedit($roomData)) {
                    flash('register_success', 'Room added successfully');
                    redirect('hotel/addrooms');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Display the form with validation errors
                $data = [
                    'basicInfo' => $this->basicInfo(),
                    'roomData' => $roomData,
                ];
                $this->view('hotel/addroomsedit', $data);
            }
        } else {
            // If it's not a POST request, load the form
            $user_id = $_SESSION['user_id'];
            $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

            // Fetch hotel rooms for the specific hotel_id
            $existingroomData = $this->hotelsModel->getHotelRooms($hotel_id);

            $roomData = [
                'roomType' => '',
                'numOfBeds' => '',
                'numAdults' => '',
                'numChildren' => '',
                'price' => '',
                'roomSize' => '',
                'acAvailability' => '',
                'tvAvailability' => '',
                'wifiAvailability' => '',
                'smokingPolicy' => '',
                'petPolicy' => '',
                'balconyAvailability' => '',
                'privatePoolAvailability' => '',
                'hotTubAvailability' => '',
                'refrigeratorAvailability' => '',
                'hotShowerHeaterAvailability' => '',
                'washingMachineAvailability' => '',
                'kitchenAvailability' => '',
                'breakfastIncluded' => '',
                'lunchIncluded' => '',
                'dinnerIncluded' => '',
                'description' => '',
                'cancellationPolicy' => '',
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'numAdults_err' => '',
                'numChildren_err' => '',
                'price_err' => '',
                'roomSize_err' => '',
                'acAvailability_err' => '',
                'tvAvailability_err' => '',
                'wifiAvailability_err' => '',
                'smokingPolicy_err' => '',
                'petPolicy_err' => '',
                'balconyAvailability_err' => '',
                'privatePoolAvailability_err' => '',
                'hotTubAvailability_err' => '',
                'refrigeratorAvailability_err' => '',
                'hotShowerHeaterAvailability_err' => '',
                'washingMachineAvailability_err' => '',
                'kitchenAvailability_err' => '',
                'breakfastIncluded_err' => '',
                'lunchIncluded_err' => '',
                'dinnerIncluded_err' => '',
                'description_err' => '',
                'cancellationPolicy_err' => '',
                'roomImages' => [],
            ];
            $data = [
                'basicInfo' => $this->basicInfo(),
                'roomData' => $roomData,
            ];

            $this->view('hotel/addroomsedit',$data);
        }
    }


    public function hotelupdaterooms($room_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $roomData = [
                'roomType' => trim($_POST['roomType']),
                'numOfBeds' => trim($_POST['numOfBeds']),
                'numAdults' => trim($_POST['numAdults']), // New field
                'numChildren' => trim($_POST['numChildren']), // New field
                'price' => trim($_POST['price']),
                'acAvailability' => trim($_POST['acAvailability']),
                'tvAvailability' => trim($_POST['tvAvailability']),
                'wifiAvailability' => trim($_POST['wifiAvailability']),
                'smokingPolicy' => trim($_POST['smokingPolicy']),
                'petPolicy' => trim($_POST['petPolicy']),
                'description' => trim($_POST['description']),
                'cancellationPolicy' => trim($_POST['cancellationPolicy']),
                'roomSize' => trim($_POST['roomSize']), // New field
                'balconyAvailability' => trim($_POST['balconyAvailability']), // New field
                'privatePoolAvailability' => trim($_POST['privatePoolAvailability']), // New field
                'hotTubAvailability' => trim($_POST['hotTubAvailability']), // New field
                'refrigeratorAvailability' => trim($_POST['refrigeratorAvailability']), // New field
                'hotShowerHeaterAvailability' => trim($_POST['hotShowerHeaterAvailability']), // New field
                'washingMachineAvailability' => trim($_POST['washingMachineAvailability']), // New field
                'kitchenAvailability' => trim($_POST['kitchenAvailability']), // New field
                'breakfastIncluded' => trim($_POST['breakfastIncluded']), // New field
                'lunchIncluded' => trim($_POST['lunchIncluded']), // New field
                'dinnerIncluded' => trim($_POST['dinnerIncluded']), // New field
                'room_id' => $room_id,
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'numAdults_err' => '', // New field
                'numChildren_err' => '', // New field
                'price_err' => '',
                'acAvailability_err' => '',
                'tvAvailability_err' => '',
                'wifiAvailability_err' => '',
                'smokingPolicy_err' => '',
                'petPolicy_err' => '',
                'description_err' => '',
                'cancellationPolicy_err' => '',
                'roomSize_err' => '',
                'balconyAvailability_err' => '',
                'privatePoolAvailability_err' => '',
                'hotTubAvailability_err' => '',
                'refrigeratorAvailability_err' => '',
                'hotShowerHeaterAvailability_err' => '',
                'washingMachineAvailability_err' => '',
                'kitchenAvailability_err' => '',
                'breakfastIncluded_err' => '',
                'lunchIncluded_err' => '',
                'dinnerIncluded_err' => '',
                'roomImages' => [],
            ];

            $uploadedImages = [];
            if (isset($_FILES['roomImages']) && !empty($_FILES['roomImages']['name'][0])) {
                $images = $_FILES['roomImages'];
                foreach ($images['tmp_name'] as $key => $tmp_name) {
                    $file_name = $images['name'][$key];
                    $upload_dir = "../public/images/" . $file_name;
                    if (move_uploaded_file($tmp_name, $upload_dir)) {
                        $uploadedImages[] = $file_name;
                    }
                }
            }


            $roomData['roomImages'] = $uploadedImages;


            // Check for any validation errors
            if (empty($roomData['roomType_err']) && empty($roomData['numOfBeds_err']) &&
                empty($roomData['numAdults_err']) && empty($roomData['numChildren_err']) && // New fields
                empty($roomData['price_err']) && empty($roomData['acAvailability_err']) &&
                empty($roomData['tvAvailability_err']) && empty($roomData['wifiAvailability_err']) &&
                empty($roomData['smokingPolicy_err']) && empty($roomData['petPolicy_err']) &&
                empty($roomData['description_err']) && empty($roomData['cancellationPolicy_err']) &&
                empty($roomData['roomSize_err']) && empty($roomData['balconyAvailability_err']) && // New fields
                empty($roomData['privatePoolAvailability_err']) && empty($roomData['hotTubAvailability_err']) && // New fields
                empty($roomData['refrigeratorAvailability_err']) && empty($roomData['hotShowerHeaterAvailability_err']) && // New fields
                empty($roomData['washingMachineAvailability_err']) && empty($roomData['kitchenAvailability_err']) && // New fields
                empty($roomData['breakfastIncluded_err']) && empty($roomData['lunchIncluded_err']) && // New fields
                empty($roomData['dinnerIncluded_err']) // New field
            ) {
                // Save the data to the database
                if ($this->hotelsModel->hotelupdaterooms($roomData)) {
                    flash('user_message', 'Room Updated');
                    redirect('hotel/addrooms');
                } else {
                    die('Something went wrong');
                }
            } else {
                $data = [
                    'basicInfo' => $this->basicInfo(),
                    'roomData' => $roomData,
                ];
                // Display the form with validation errors
                $this->view('hotel/updateroom', $data);
            }
        } else {
            // Retrieve room data from the model
            $hotels = $this->hotelsModel->findrooms($room_id);

            $roomData = [
                'room_id' => $room_id,
                'roomType' => $hotels->roomType,
                'numOfBeds' => $hotels->numOfBeds,
                'numAdults' => $hotels->numAdults,
                'numChildren' => $hotels->numChildren,
                'price' => $hotels->price,
                'acAvailability' => $hotels->acAvailability,
                'tvAvailability' => $hotels->tvAvailability,
                'wifiAvailability' => $hotels->wifiAvailability,
                'smokingPolicy' => $hotels->smokingPolicy,
                'petPolicy' => $hotels->petPolicy,
                'description' => $hotels->description,
                'cancellationPolicy' => $hotels->cancellationPolicy,
                'roomSize' => $hotels->roomSize,
                'balconyAvailability' => $hotels->balconyAvailability,
                'privatePoolAvailability' => $hotels->privatePoolAvailability,
                'hotTubAvailability' => $hotels->hotTubAvailability,
                'refrigeratorAvailability' => $hotels->refrigeratorAvailability,
                'hotShowerHeaterAvailability' => $hotels->hotShowerHeaterAvailability,
                'washingMachineAvailability' => $hotels->washingMachineAvailability,
                'kitchenAvailability' => $hotels->kitchenAvailability,
                'breakfastIncluded' => $hotels->breakfastIncluded,
                'lunchIncluded' => $hotels->lunchIncluded,
                'dinnerIncluded' => $hotels->dinnerIncluded,
                'roomImages' => [],
            ];

            $data = [
                'basicInfo' => $this->basicInfo(),
                'roomData' => $roomData,
            ];

            $this->view('hotel/updateroom', $data);
        }
    }


    public function updateHotelSettings($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form submission
            // Sanitize input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get form data
            $userData = [
                'hotelName' => $_POST['hotel-name'],
                'hotelType' => $_POST['hotel-type'],
                'email' => $_POST['email'],
                'phoneNumber' => $_POST['phone-number'],
                'user_id' => $user_id,
                'hotelName_err' => '',
                'hotelType_err' => '',
                'email_err' => '',
                'phoneNumber_err' => '',
            ];

            // Check for any validation errors
            if (empty($userData['hotelName_err']) && empty($userData['hotelType_err']) &&
                empty($userData['email_err']) && empty($userData['phoneNumber_err'])) {
                // Call the model method to update hotel settings
                if ($this->hotelsModel->updateHotelSettings($userData)) {
                    // Hotel settings updated successfully
                    flash('success_message', 'Hotel settings updated successfully');
                    redirect('hotel/hoteledit');
                } else {
                    // Something went wrong with the update
                    flash('error_message', 'Failed to update hotel settings');
                    redirect('hotel/hoteledit');
                }
            }
        } else {
            // Retrieve existing hotel data based on user_id
            $hotels = $this->hotelsModel->getHotelIdByUserId($user_id);

            // Check if hotel data exists
            if ($hotels) {
                $userData = [
                    'hotelName' => $hotels->hotelname,
                    'hotelType' => $hotels->hoteltype,
                    'email' => $hotels->email,
                    'phoneNumber' => $hotels->phonenumber,
                    'user_id' => $user_id
                ];

                // Load the view with hotel data for editing
               return $userData;
            } else {
                // Hotel data not found for the given user ID
                flash('error_message', 'Hotel data not found for the given user ID');
                redirect('hotel/hoteledit');
            }
        }
    }

    public function updateAdditionalDetails($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get form data
            $hotelData = [
                'altPhoneNumber' => $_POST['altPhoneNumber'],
                'managerInfo' => $_POST['managerInfo'],
                'managerPhoneNumber' => $_POST['managerPhoneNumber'],
                'addr' => $_POST['addr'],
                'street_address' => $_POST['street_address'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'check_in_time' => $_POST['check_in_time'],
                'check_out_time' => $_POST['check_out_time'],
                'website' => $_POST['website'],
                'facebook' => $_POST['facebook'],
                'twitter' => $_POST['twitter'],
                'instagram' => $_POST['instagram'],
                'bank_name'=>$_POST['bank_name'],
                'branch' => $_POST['branch'],
                'account_number' => $_POST['account_number'],
                'card_holder_name' => $_POST['card_holder_name'],
                'additionalNotes' => $_POST['additionalNotes'],
                'user_id' => $user_id,
            ];

            // Call the model method to update additional details
            if ($this->hotelsModel->updateAdditionalDetails($hotelData)) {
                // Additional details updated successfully
                flash('success_message', 'Additional details updated successfully');
                redirect('hotel/hoteledit');
            } else {
                // Something went wrong with the update
                flash('error_message', 'Failed to update additional details');
                redirect('hotel/hoteledit');
            }
        } else {
            // Retrieve existing hotel data based on user_id
            $hotelData = $this->hotelsModel->getHotelIdByUserId($user_id);

            // Check if hotel data exists
            if ($hotelData) {
                return $hotelData;
            } else {
                // Hotel data not found for the given user ID
                flash('error_message', 'Hotel data not found for the given user ID');
                redirect('hotel/hoteledit');
            }
        }
    }

    public function checkServiceValidations() {
        // Assuming $verificationStatus is retrieved from the model
        $verificationStatus = $this->hotelsModel->getVerificationStatus($_SESSION['user_id']);

        return $verificationStatus;
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $currentPassword = $_POST['current-password'];
            $newPassword = $_POST['new-password'];
            $confirmPassword = $_POST['confirm-password'];

            // Validate the current password, new password, and confirm password here

            // Check if the new password matches the confirm password
            if ($newPassword !== $confirmPassword) {
                // Handle error - Passwords do not match
                // Redirect back to the form with an error message
                flash('user_message', 'New password and confirm password do not match');
                redirect('hotel/hotelpassword');
            }

            // Get the user's hashed password from the database using their user ID
            $userId = $_SESSION['user_id'];
            $user = $this->hotelsModel->getUserById($userId);
            $hashedPassword = $user->password;

            // Verify the current password
            if (password_verify($currentPassword, $hashedPassword)) {
                // Change the password in the database
                if ($this->hotelsModel->changePassword($userId, $newPassword)) {
                    flash('user_message', 'Password changed successfully');
                    redirect('hotel/hotelpassword');
                } else {
                    // Handle error - Unable to change password
                    flash('user_message', 'Unable to change password. Please try again.');
                    redirect('hotel/hotelpassword');
                }
            } else {
                // Handle error - Incorrect current password
                flash('user_message', 'Incorrect current password');
                redirect('hotel/hotelpassword');
            }
        } else {
            // If it's not a POST request, redirect to the form page
            redirect('hotel/hotelpassword');
        }
    }



    public function deleterooms()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room_id'])) {
            $room_id = $_POST['room_id'];

            // Check if the room is in use before deletion
            $isRoomInUse = $this->hotelsModel->checkRoomUsage($room_id);

            if ($isRoomInUse) {
                // Alert the user
                echo "<script>alert('Unable to delete room. It is currently in use.')</script>";
            } else {
                // Attempt to deactivate the room
                $deactivated = $this->hotelsModel->deactivateRoom($room_id);

                if ($deactivated) {
                    flash('post_message', 'Room Deactivated');
                } else {
                    flash('post_message', 'Unable to deactivate room. An error occurred.');
                }
            }
        } else {
            // Redirect or handle the case when no room_id is provided
            redirect('hotel/addrooms');
        }
    }

    public function getActiveRooms()
    {
        $user_id = $_SESSION['user_id'];

        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        $activeRooms = $this->hotelsModel->getActiveRooms($hotel_id);

        return $activeRooms;
    }

    public function roomCount()
    {
        $hotelModel = $this->model('Hotels');

        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        $roomCount = $hotelModel->getRoomCount($hotel_id);

        return $roomCount;
    }

    public function getBookingsData()
    {
        // Get the hotel_id for the currently logged-in user
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        // Get bookings for the specific hotel
        $bookingData1 = $this->hotelsModel->getBookingsByHotel($hotel_id);


        // Get cart bookings for the specific hotel
        $cartBookingData = $this->hotelsModel->getCartBookingsByHotel($hotel_id);


        // Merge the booking data and cart booking data
        $bookingData = array_merge($bookingData1, $cartBookingData);

        // Order the merged data by start date, closest to the current date
        usort($bookingData, function($a, $b) {
            // Access the startDate property of the objects using -> notation
            return abs(strtotime($a->startDate) - strtotime(date('Y-m-d'))) - abs(strtotime($b->startDate) - strtotime(date('Y-m-d')));
        });

        // Check if any bookings are found
        if (!empty($bookingData)) {
            return $bookingData;
        } else {
            return [];
        }
    }

    public function getRejectedBookingsData()
    {
        // Get the hotel_id for the currently logged-in user
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        // Get bookings for the specific hotel
        $bookingData1 = $this->hotelsModel->getCancelledBookings($hotel_id);


        // Get cart bookings for the specific hotel
        $cartBookingData = $this->hotelsModel->getCancelledCartBookings($hotel_id);



        // Merge the booking data and cart booking data
        $cancelledBookings = array_merge($bookingData1, $cartBookingData);

        // Order the merged data by start date, closest to the current date
        usort($cancelledBookings, function($a, $b) {
            // Access the startDate property of the objects using -> notation
            return abs(strtotime($a->startDate) - strtotime(date('Y-m-d'))) - abs(strtotime($b->startDate) - strtotime(date('Y-m-d')));
        });

        // Check if any bookings are found
        if (!empty($cancelledBookings)) {
            return $cancelledBookings;
        } else {
            return [];
        }
    }

    public function getCompletedBookingsData()
    {
        // Get the hotel_id for the currently logged-in user
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        // Get bookings for the specific hotel
        $bookingData1 = $this->hotelsModel->getCompletedBookings($hotel_id);


        // Get cart bookings for the specific hotel
        $cartBookingData = $this->hotelsModel->getCompletedCartBookings($hotel_id);


        // Merge the booking data and cart booking data
        $completedBookings = array_merge($bookingData1, $cartBookingData);
//        var_dump($completedBookings);

        // Order the merged data by start date, closest to the current date
        usort($completedBookings, function($a, $b) {
            // Access the startDate property of the objects using -> notation
            return abs(strtotime($a->startDate) - strtotime(date('Y-m-d'))) - abs(strtotime($b->startDate) - strtotime(date('Y-m-d')));
        });

        // Check if any bookings are found
        if (!empty($completedBookings)) {
            return $completedBookings;
        } else {
            return [];
        }
    }


    public function getReviews()
    {
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        // Get reviews data from the model
        $reviews = $this->hotelsModel->getReviews($hotel_id);

        if ($reviews) {
            return $reviews;
        } else {
            return [];
        }
    }

    public function processServiceValidation()
    {
        $userId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $registrationNumber = $_POST['registrationNumber'];
            $expiryDate = $_POST['expiryDate'];
            $targetDir = '../public/documents/';
            $fileName = basename($_FILES['service-validation-pdf']['name']); // Extract the filename

            $targetFile = $targetDir . $fileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['service-validation-pdf']['tmp_name'], $targetFile)) {
                // Call the model to insert the filename into the database
                if ($this->hotelsModel->insertPdf($fileName, $userId,$registrationNumber, $expiryDate)) {
                    // Success - You can redirect or show a success message
                    flash('success', 'PDF submitted successfully');
                    redirect('hotel/settings');
                } else {
                    // Error - You can redirect or show an error message
                    flash('error', 'Failed to submit PDF');
                    redirect('hotel/settings');
                }
            } else {
                // Error handling for file upload failure
                flash('error', 'Failed to upload PDF');
                redirect('hotel/settings');
            }
        }
    }


    public function changeProfilePicture()
    {
        // Check if a file was uploaded
        if ($_FILES['profile-picture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/images/';
            $uploadFile = $uploadDir . basename($_FILES['profile-picture']['name']);
            $fileName = basename($_FILES['profile-picture']['name']); // Extracting the file name

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($_FILES['profile-picture']['tmp_name'], $uploadFile)) {
                // Update the session with the new file path
                $_SESSION['user_profile_picture'] = $uploadFile;

                // Update the profile picture file name in the database
                $this->hotelsModel->updateProfilePicture($_SESSION['user_id'], $fileName);
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


    public function basicInfo()
    {
        $hotelsModel = $this->model('Hotels');

        $user_id = $_SESSION['user_id'];

        // Get user details
        $userData = $hotelsModel->getUserById($user_id);

        // Get hotel details
        $hotelData = $hotelsModel->getHotelByUserId($user_id);

        // Pass data to the view
        return ['userData' => $userData, 'hotelData' => $hotelData];
    }

    public function getnotifications()
    {
        $user_id = $_SESSION['user_id'];

        // Get unread notifications
        $notifications = $this->hotelsModel->getNotifications($user_id);


        return $notifications;
    }

    public function markNotificationAsRead() {
        $notification_id = $_POST['notification_id'];

        $updated = $this->hotelsModel->markAsRead($notification_id);

        if ($updated) {
            echo json_encode(['success' => 'Notification marked as read successfully']);
        } else {
            echo json_encode(['error' => 'Failed to mark notification as read']);
        }
    }


    public function updateRoomStatus()
    {
        // Access the data sent from the client-side
        $roomId = $_POST['room_id'];
        $startDate = $_POST['startDate'];
        $inserted = $this->hotelsModel->insertRoomStatus($roomId, $startDate);

        // Check if insertion was successful
        if ($inserted) {
            // Return a success response
            echo json_encode(['success' => 'Room status updated successfully']);
        } else {
            // Return an error response
            echo json_encode(['error' => 'Failed to update room status']);
        }
    }

    function deleteRoomStatus()
    {
        // Access the data sent from the client-side
        $roomId = $_POST['room_id'];
        $startDate = $_POST['startDate'];
        $deleted = $this->hotelsModel->deleteRoomStatus($roomId, $startDate);

        // Check if deletion was successful
        if ($deleted) {
            // Return a success response
            echo json_encode(['success' => 'Room status updated successfully']);
        } else {
            // Return an error response
            echo json_encode(['error' => 'Failed to update room status']);
        }
    }


    public function getBookingsCount(){

        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        $bookingCount = $this->hotelsModel->getBookingsCount($user_id);
//        var_dump($bookingCount);
        $cartCount = $this->hotelsModel->getCartCount($user_id);
//        var_dump($cartCount);

        $bookingsCount = $bookingCount + $cartCount;

        return $bookingsCount;
    }

    public function getGuestCount(){

        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        $guest = $this->hotelsModel->getGuestCount($user_id);
        $cartguestCount = $this->hotelsModel->getCartGuestCount($user_id);

        $guestCount = $guest + $cartguestCount;

        return $guestCount;
    }

    public function getReviewCount(){

        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);
        $reviewCount = $this->hotelsModel->getReviewCount($hotel_id);

        return $reviewCount;

    }


    public function updateBookingStatus()
    {
        // Retrieve room_id, booking_id, and temporyid from the POST request
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $_POST['user_id'];
        $temporyid = $_POST['temporyid'];
        $room_id = $_POST['room_id'];
        $booking_id = $_POST['booking_id'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $roomType = $_POST['roomType'];
        $amount = $_POST['amount'];

        $basicinfo = $this->basicInfo();
        $sender_name = $basicinfo['userData']->fname;

        // Check if temporyid is 0
        if ($temporyid == 0) {
            // Call the model function to update the booking status
            $updated = $this->hotelsModel->updateBookingStatus($booking_id);
        } elseif ($temporyid !== 1) {
            // Handle the case where temporyid is 1
            $updated = $this->hotelsModel->updateCartBookingStatus($booking_id, $room_id);
        } else {
            // Handle the case where temporyid is neither 0 nor 1
            $updated = $this->hotelsModel->updateCartBookingStatus($booking_id, $room_id);
        }

        // Construct the notification message
        $notification_message = "$sender_name" . " has cancelled your booking with the booking details were for" . " $roomType" . " room from" . " $startDate" . " to" . " $endDate." . " We apologize for the inconvenience caused. Your payment refund will be processed within 7 days.";

        // Insert notification
        $notification_inserted = $this->hotelsModel->insertNotification($booking_id, $sender_id, $receiver_id, $notification_message);


        $notification_message2 = "$sender_name" . " has cancelled your booking with the booking details were for" . " $roomType" . " room from" . " $startDate" . " to" . " $endDate." . " Make Sure Refund will be processed within 7 days";

        $businessmanagerID = 2;

        $notification2_inserted = $this->hotelsModel->insertNotification($booking_id, $sender_id,$businessmanagerID , $notification_message2);

        $currentDate = date('Y-m-d');
        $cancelled_id = $_SESSION['user_id'];

        //Update the refund table
        $refund = $this->hotelsModel->updateRefund($temporyid,$booking_id,$sender_id,$receiver_id,$cancelled_id,$amount,$currentDate);


        $availabilityUpdate = $this->hotelsModel->updateAvailability($room_id,$startDate,$endDate);

//       (tempory_id, booking_id, serviceProvider_id,user_id,refund_amount)

        require_once __DIR__ . '/../libraries/sms/vendor/autoload.php';

        $basic  = new \Vonage\Client\Credentials\Basic("992a5e27", "YiQN3gXeYkIkfbcJ");
        $client = new \Vonage\Client($basic);

        $messageBody = "$sender_name has cancelled your booking with the booking details for $roomType room from $startDate to $endDate. We apologize for the inconvenience caused. Your payment refund will be processed within 7 days.";

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

    public function getFinalPayment(){
        $user_id = $_SESSION['user_id'];

        $finalPayment = $this->hotelsModel->getFinalPayment($user_id);

        return $finalPayment;
    }

    public function getTotalRevenue(){

        $user_id = $_SESSION['user_id'];

        $totalRevenue = $this->hotelsModel->getTotalRevenue($user_id);

        return $totalRevenue;
    }

    public function profileDelete()
    {
        $user_id = $_POST['user_id'];

        $ongoingBooking = $this->hotelsModel->getOngoingBookingCount($user_id);
        $ongoingCart = $this->hotelsModel->getOngoingCartCount($user_id);

        $ongoingBookings = $ongoingBooking + $ongoingCart;

        if ($ongoingBookings>0) {
            echo json_encode(['error' => 'You have ongoing bookings. Please cancel them before deleting your profile']);
            return;
        }else {
            $deleted = $this->hotelsModel->deleteProfile($user_id);
        }


        if ($deleted) {
            echo json_encode(['success' => 'Profile deleted successfully']);
        } else {
            echo json_encode(['error' => 'Failed to delete profile']);
        }

    }


    public function getProfileStatus(){
        $user_id = $_SESSION['user_id'];

        $profileStatus = $this->hotelsModel->getProfileStatus($user_id);

        return $profileStatus;
    }


}



