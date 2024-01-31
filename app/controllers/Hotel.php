<?php

class Hotel extends Controller
{

    private $postModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->hotelsModel = $this->model('Hotels');
    }

    public function index()
    {
        $this->view('hotel/index');
    }

    public function Calender()
    {

        $data = [
            'selectedDate' => '2012-12-07',
        ];

        $this->view('hotel/calender', $data);
    }

    public function availablerooms()
    {

        $date = null;

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Retrieve the date from the query parameters
            $date = isset($_GET['date']) ? $_GET['date'] : null;


            if (empty($date)) {
                flash('error', 'Please select a date.');
                redirect('hotel/calender');
            }
        }

        // Get the hotel ID for the logged-in user
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        // Get room data for the hotel
        $roomData = $this->hotelsModel->getHotelRooms($hotel_id);
        $unavailableRooms = $this->hotelsModel->getUnavailableRooms($date);
        $unavailableRoomsIds = [];
        foreach ($unavailableRooms as $room) {
            $unavailableRoomsIds[] = $room->room_id;
        }

        // Pass the room data and selected date to the view
        $data = [
            'roomData' => $roomData,
            'date' => $date,
            'unavailableRooms' => $unavailableRoomsIds,
        ];

        // Load the view
        $this->view('hotel/availablerooms', $data);
    }





    public function bookings()
    {
        $bookingData = $this->getBookingsData();
        $data["bookingData"] = $bookingData;
        // Pass the data to the view
        $this->view('hotel/bookings', ['bookingData' => $bookingData]);
    }

    public function gallery()
    {
        $notifications = $this->getnotifications();
        $data["notifications"] = $notifications;
        $this->view('hotel/gallery', $data);
    }

    public function revenue()
    {
        $this->view('hotel/revenue');
    }

    public function reviews()
    {
        $reviews = $this->getReviewsData();
        $data["reviews"] = $reviews;
        $this->view('hotel/reviews', $data);
    }

    public function settings()
    {
        // Get basic information

        // Get room count (assuming $roomCount is an associative array)
        $data = ['basicInfo' => $this->basicInfo(), 'roomCount' => $this->roomCount()];

        // Pass data to the view separately
        $this->view('hotel/settings',$data);
    }

    public function addrooms()
    {
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        $roomData = $this->hotelsModel->getHotelRooms($hotel_id);

        $data = [
            'roomData' => $roomData,
        ];

        $this->view('hotel/addrooms', $data);
    }

    public function addroomsedit()
    {
        $roomData = $this->hotelsModel->getHotel();
        $data["roomData"] = $roomData;
        $this->view('hotel/addroomsedit');
    }

    public function updateroom()
    {
        $roomData = $this->hotelsModel->getHotel();
        $data["roomData"] = $roomData;
        $this->view('hotel/updateroom');
    }

    public function hoteledit()
    {
        $data = $this->basicInfo();

        // Pass data to the view
        $this->view('hotel/hoteledit', $data);
    }

    public function hotelpassword()
    {
        $this->view('hotel/hotelpassword');
    }

    public function hoteladdrooms($room_id)
    {
        $roomData = ['room_id' => $room_id,];
        $this->view('hotel/addrooms', $roomData);
    }


    //    public function updateHotelInfo() {
    //        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //            // Sanitize and validate the form data
    //            $hotelData = [
    //                'hotelName' => trim($_POST['hotel-name']),
    //                'hotelType' => trim($_POST['hotel-type']),
    //                'email' => trim($_POST['email']),
    //                'phoneNumber' => trim($_POST['phone-number']),
    //                'altPhoneNumber' => trim($_POST['altPhoneNumber']),
    //                'managerName' => trim($_POST['managerInfo']),
    //                'managerPhoneNumber' => trim($_POST['manager-phone-number']),
    //                'address' => trim($_POST['Address']),
    //                'city' => trim($_POST['city']),
    //                'province' => trim($_POST['state']),
    //                'website' => trim($_POST['website']),
    //                'facebook' => trim($_POST['facebook']),
    //                'twitter' => trim($_POST['twitter']),
    //                'instagram' => trim($_POST['instagram']),
    //                'additionalNotes' => trim($_POST['additionalNotes']),
    //            ];
    //
    //            // You can add more validation if needed
    //
    //            // Call the model to update hotel information
    //            if ($this->hotelsModel->updateHotelInfo($_SESSION['user_id'], $hotelData)) {
    //                flash('success', 'Hotel information updated successfully');
    //                redirect('hotel/settings');
    //            } else {
    //                flash('error', 'Failed to update hotel information');
    //                redirect('hotel/hoteledit');
    //            }
    //        } else {
    //            redirect('hotel/hoteledit'); // Redirect if the form is not submitted via POST
    //        }
    //    }

    public function hoteladdroomsedit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Fetch hotel_id from the hotels table based on user_id
            $user_id = $_SESSION['user_id'];
            $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);


            $existingroomData = $this->hotelsModel->getHotelRooms($hotel_id);

            $roomData = [
                'hotel_id' => $hotel_id,
                'roomType' => trim($_POST['roomType']),
                'numOfBeds' => trim($_POST['numOfBeds']),
                'price' => trim($_POST['price']),
                'roomImages' => isset($_POST['roomImages'][0]) ? trim($_POST['roomImages'][0]) : '',
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
                $roomData['roomType_err'] = 'Please enter room type';
            }

            // Validate numOfBeds
            if (empty($roomData['numOfBeds'])) {
                $roomData['numOfBeds_err'] = 'Please enter the number of beds';
            } elseif (!is_numeric($roomData['numOfBeds']) || $roomData['numOfBeds'] <= 0) {
                $roomData['numOfBeds_err'] = 'Number of beds should be a positive integer';
            }

            // Validate price
            if (empty($roomData['price'])) {
                $roomData['price_err'] = 'Please enter the price';
            } elseif (!is_numeric($roomData['price']) || $roomData['price'] <= 0) {
                $roomData['price_err'] = 'Price should be a positive number';
            }

            // Validate roomImages
            // if (empty($roomData['roomImages'])) {
            //     $roomData['roomImages_err'] = 'Please upload room images';
            // } else {
            //     // You can add more detailed validation for image upload if needed
            // }

            // Validate other fields similarly

            // Check if there are no errors
            if (
                empty($roomData['roomType_err']) && empty($roomData['numOfBeds_err']) &&
                empty($roomData['price_err']) && empty($roomData['roomImages_err']) &&
                empty($roomData['acAvailability_err']) && empty($roomData['tvAvailability_err']) &&
                empty($roomData['wifiAvailability_err']) && empty($roomData['smokingPolicy_err']) &&
                empty($roomData['petPolicy_err']) && empty($roomData['roomDescription_err']) &&
                empty($roomData['cancellationPolicy_err'])
            ) {
                // Set the correct hotel_id before inserting into the database
                $roomData['hotel_id'] = $hotel_id;

                if ($this->hotelsModel->hoteladdroomsedit($roomData)) {
                    flash('register_success', 'Room added successfully');
                    redirect('hotel/addrooms');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Display the form with validation errors
                $this->view('hotel/addroomsedit', $roomData);
            }
        } else {
            $user_id = $_SESSION['user_id'];
            $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

            // Fetch hotel rooms for the specific hotel_id
            $existingroomData = $this->hotelsModel->getHotelRooms($hotel_id);

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
                //                'roomImages' => $_FILES['roomImages'],
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



            //            // Validate Room Type
            //            if (empty($roomData['roomType'])) {
            //                $roomData['roomType_err'] = 'Please choose Room Type';
            //            }
            //
            //            // Validate Number of Beds
            //            if (empty($roomData['numOfBeds'])) {
            //                $roomData['numOfBeds_err'] = 'Please enter Number of Beds';
            //            }
            //
            //            // Validate Price
            //            if (empty($roomData['price'])) {
            //                $roomData['price_err'] = 'Please Enter Price';
            //            }
            //
            ////            // Validate Room Images
            ////            if (empty($roomData['roomImages']['name'])) {
            ////                $roomData['roomImages_err'] = 'Please upload at least one image';
            ////            }
            //
            //            // Validate AC Availability
            //            if (empty($roomData['acAvailability'])) {
            //                $roomData['acAvailability_err'] = 'Please choose AC Availability';
            //            }
            //
            //            // Validate TV Availability
            //            if (empty($roomData['tvAvailability'])) {
            //                $roomData['tvAvailability_err'] = 'Please choose TV Availability';
            //            }
            //
            //            // Validate WiFi Availability
            //            if (empty($roomData['wifiAvailability'])) {
            //                $roomData['wifiAvailability_err'] = 'Please choose WiFi Availability';
            //            }
            //
            //            // Validate Smoking Policy
            //            if (empty($roomData['smokingPolicy'])) {
            //                $roomData['smokingPolicy_err'] = 'Please choose Smoking Policy';
            //            }
            //
            //            // Validate Pet Policy
            //            if (empty($roomData['petPolicy'])) {
            //                $roomData['petPolicy_err'] = 'Please choose Pet Policy';
            //            }
            //
            //            // Validate Room Description
            //            if (empty($roomData['roomDescription'])) {
            //                $roomData['roomDescription_err'] = 'Please enter Room Description';
            //            }
            //
            //            // Validate Cancellation Policy
            //            if (empty($roomData['cancellationPolicy'])) {
            //                $roomData['cancellationPolicy_err'] = 'Please enter Cancellation Policy';
            //            }
            //
            ////            // Handle File Upload
            ////            $uploadResult = $this->handleFileUpload($roomData['roomImages']);
            ////
            ////            if ($uploadResult['success']) {
            ////                $roomData['roomImages'] = $uploadResult['filePath'];
            ////            } else {
            ////                $roomData['roomImages_err'] = $uploadResult['error'];
            ////            }

            // Check for any validation errors
            if (
                empty($roomData['roomType_err']) && empty($roomData['numOfBeds_err']) &&
                empty($roomData['price_err']) &&
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
                var_dump("Case");
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

    public function deleterooms($room_id)
    {
        //        echo $room_id;
        //        die;
        if ($this->hotelsModel->deleterooms($room_id)) {
            flash('post_message', 'Room Removed');
            redirect('hotel/addrooms');
        } else {
            die('Something went wrong');
        }
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
        $bookingData = $this->hotelsModel->getBookingsByHotel($hotel_id);

        // Check if any bookings are found
        if ($bookingData) {
            // If there are bookings, return the data
            return $bookingData;
        } else {
            // If no bookings found, return an empty array
            return [];
        }
    }

    public function getReviewsData()
    {
        $user_id = $_SESSION['user_id'];
        $hotel_id = $this->hotelsModel->getHotelIdByUserId($user_id);

        // Get reviews data from the model
        $reviews = $this->hotelsModel->getReviews($hotel_id);
        //        var_dump($reviews);

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

    public function changeProfilePicture()
    {
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
        var_dump($notifications);

        return $notifications;
    }

    public function markNotificationAsRead($notification_id)
    {
        // Mark the notification as read
        if ($this->hotelsModel->markNotificationAsRead($notification_id)) {
            // Notification marked as read successfully
            flash('success', 'Notification marked as read.');
        } else {
            // Failed to mark the notification as read
            flash('error', 'Failed to mark the notification as read.');
        }
        // Redirect back to the notifications page or any other desired page
        redirect('hotel/gallery');
    }

    public function updateRoomStatus()
    {
        // Access the data sent from the client-side
        $roomId = $_POST['room_id'];
        $date = $_POST['date'];
        $inserted = $this->hotelsModel->insertRoomStatus($roomId, $date);

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
        $date = $_POST['date'];
        $deleted = $this->hotelsModel->deleteRoomStatus($roomId, $date);

        // Check if insertion was successful
        if ($deleted) {
            // Return a success response
            echo json_encode(['success' => 'Room status updated successfully']);
        } else {
            // Return an error response
            echo json_encode(['error' => 'Failed to update room status']);
        }
    }



}
