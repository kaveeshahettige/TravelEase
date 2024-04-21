<?php


class Packages extends Controller
{

    /**
     * @var mixed
     */
    private $packagesModel;

    public function __construct()
    {
        $this->packagesModel = $this->model('Package');
    }

    public function index()
    {
        $userData = $this->getUserInfo();
        $guideData = $this->updateGuideDetails($userData->id);
        $bookings = $this->getBookings();

        $data = [
            'userData' => $userData,
            'guideData' => $guideData,
            'bookings' => $bookings,
        ];

        $this->view('packages/index', $data);
    }

    public function Calender()
    {
        $userData = $this->getUserInfo();

        $data=[
            'selectedDate' => date('Y-m-d'),
            'userData' => $userData,
        ];

        $this->view('packages/calender',$data);
    }

    public function availability()
    {
        $startDate = date('Y-m-d');

        if($_SERVER['REQUEST_METHOD'] == 'GET'){

            $startDate = isset($_GET['date']) ? $_GET['date'] : null;

            if (empty($startDate)) {
                flash('error', 'Please select a date.');
                redirect('packages/Calender');
            }
        }

        $user_id = $_SESSION['user_id'];

        $availability = $this->packagesModel->getAvailability($user_id,$startDate);
//        var_dump($availability);


        $userData = $this->getUserInfo();

        $data = [
            'date' => $startDate,
            'availability' => $availability,
            'userData' => $userData,
        ];


        $this->view('packages/availability',$data);
    }

    public function bookings()
    {
        $userData = $this->getUserInfo();
        $bookings = $this->getBookings();

        $data = [
            'userData' => $userData,
            'bookings' => $bookings,
        ];

        $this->view('packages/bookings',$data);
    }


    public function revenue()
    {
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
        ];

        $this->view('packages/revenue',$data);
    }

    public function notifications()
    {

        $notifications = $this->getNotifications();
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
            'notifications' => $notifications,
        ];

        $this->view('packages/notifications',$data);
    }

    public function review()
    {
        $reviews = $this->getReviews();
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
            'reviews' => $reviews,
        ];

        $this->view('packages/review',$data);
    }

    public function settings()
    {
        $userData = $this->getUserInfo();
        $guideData = $this->updateGuideDetails($userData->id);

        $data = [
            'userData' => $userData,
            'guideData' => $guideData,
        ];

        $this->view('packages/settings', $data);
    }

    public function addpackages()
    {
        $userData = $this->getUserInfo();
        $packageData = $this->packagesModel->getpackages();

        $data =[
            'packageData' => $packageData,
            'userData' => $userData,
        ];

        $this->view('packages/addpackages', $data);
    }

    public function addpackagesedit()
    {
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
        ];

        $this->view('packages/addpackagesedit', $data);
    }

    public function packagesedit()
    {
        $userData = $this->getUserInfo();
        $guideData = $this->updateGuideDetails($userData->id);

        $data = [
            'userData' => $userData,
            'guideData' => $guideData,
        ];

        $this->view('packages/packagesedit', $data);
    }

    public function packagespassword()
    {
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
        ];

        $this->view('packages/packagespassword', $data);
    }

    public function navigation()
    {
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
        ];

        $this->view('packages/navigation', $data);
    }

    public function packagesaddpackages($package_id)
    {
        $packageData = [
            'package_id' => $package_id,
        ];
        $this->view('packages/addpackages', $packageData);
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
                $this->packagesModel->updateProfilePicture($_SESSION['user_id'], $uploadFile);
            } else {
                echo 'Error uploading the file.';
            }
        } else {
            echo 'File upload error.';
        }

        // Redirect to the profile page or wherever you want
        header('Location: ' . URLROOT . '/packages/settings');
        exit;
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
            if ($this->packagesModel->insertPdf($targetFile, $userId)) {
                // Success - You can redirect or show a success message
                flash('success', 'PDF submitted successfully');
                redirect('packages/settings');
            } else {
                // Error - You can redirect or show an error message
                flash('error', 'Failed to submit PDF');
                redirect('packages/settings');
            }
        }
    }

    public function updateStatus(){
        // Access the data sent from the client-side
        $user_id = $_POST['user_id'];
        $startDate = $_POST['startDate'];
        $inserted = $this->packagesModel->insertStatus($user_id, $startDate);

        // Check if insertion was successful
        if ($inserted) {
            // Return a success response
            echo json_encode(['success' => 'Availability status updated successfully']);
        } else {
            // Return an error response
            echo json_encode(['error' => 'Failed to update Availability status']);
        }
    }

    function deleteStatus()
    {
        // Access the data sent from the client-side
        $user_id = $_POST['user_id'];
        $startDate = $_POST['startDate'];
        $deleted = $this->packagesModel->deleteStatus($user_id, $startDate);

        // Check if deletion was successful
        if ($deleted) {
            // Return a success response
            echo json_encode(['success' => 'Availability status updated successfully']);
        } else {
            // Return an error response
            echo json_encode(['error' => 'Failed to update Availability status']);
        }
    }

    public function getUserInfo()
    {
        $user_id = $_SESSION['user_id'];
        $userData = $this->packagesModel->getUserInfo($user_id);


        if ($userData)
            return $userData;
        else{
                return [];
            }
    }

    public function getBookings()
    {
        $user_id = $_SESSION['user_id'];

        // Retrieve normal bookings
        $normalBookings = $this->packagesModel->getBookings($user_id);
        if ($normalBookings === null) {
            $normalBookings = []; // Set to empty array if null
        }

        // Retrieve cart bookings
        $cartBookings = $this->packagesModel->getCartBookings($user_id);
        if ($cartBookings === null) {
            $cartBookings = []; // Set to empty array if null
        }

        // Merge bookings
        $bookings = array_merge($normalBookings, $cartBookings);

        if ($bookings)
            return $bookings;
        else
            return [];
    }

    public function getReviews(){

        $user_id = $_SESSION['user_id'];

        $reviews = $this->packagesModel->getReviews($user_id);

        if ($reviews)
            return $reviews;
        else
            return [];
    }

    public function updateGuideDetails($user_id)
    {
        // Sanitize input
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $guideData = [
                'address' => $_POST['address'],
                'pricePerDay' => $_POST['pricePerDay'],
                'city' => $_POST['city'],
                'province' => $_POST['province'],
                'facebook' => $_POST['facebook'],
                'instagram' => $_POST['instagram'],
                'category' => $_POST['category'],
                'languages' => isset($_POST['languages']) ? $_POST['languages'] : [],
                'GuideRegNumber' => $_POST['GuideRegNumber'],
                'LisenceExpDate' => $_POST['LisenceExpDate'],
                'description' => $_POST['description'],
                'sites' => $_POST['sites'],
                'user_id' => $user_id,
            ];

            // Call the model method to update guide details
            if ($this->packagesModel->updateGuideDetails($guideData)) {
                // Details updated successfully
                flash('success_message', 'Guide details updated successfully');
                redirect('packages/packagesedit');
            } else {
                // Something went wrong with the update
                flash('error_message', 'Failed to update hotel details');
                redirect('packages/packagesedit');
            }
        } else {
            // Retrieve existing guide data based on user_id
            $guideData = $this->packagesModel->getGuideDetails($user_id);

            // Check if guide data exists
            if ($guideData) {
                return $guideData;
            } else {
                // guide data not found for the given user ID
                flash('error_message', 'Guide data not found for the given user ID');
                redirect('packages/packagesedit');
            }
        }
    }

    public function updateBookingStatus(){

        // Retrieve room_id, booking_id, and temporyid from the POST request
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $_POST['user_id'];
        $temporyid = $_POST['temporyid'];
        $package_id = $_POST['package_id'];
        $booking_id = $_POST['booking_id'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $meetTime = $_POST['meetTime'];

        $userData = $this->getUserInfo();
        $sender_name = $userData->fname;

        // Check if temporyid is 0
        if ($temporyid == 0) {
            // Call the model function to update the booking status
            $updated = $this->packagesModel->updateBookingStatus($booking_id);
        } elseif ($temporyid !== 1) {
            // Handle the case where temporyid is 1
            $updated = $this->packagesModel->updateCartBookingStatus($booking_id, $package_id);
        } else {
            // Handle the case where temporyid is neither 0 nor 1
            $updated = $this->packagesModel->updateCartBookingStatus($booking_id, $package_id);
        }

        // Construct the notification message
        $notification_message = "Tour Guide,"." $sender_name" . " has cancelled your booking with the booking details were for tour guide room from" . " $startDate". " to" ." $endDate." ." We apologize for the inconvenience caused. Your payment refund will be processed within 7 days.";

        // Insert notification
        $notification_inserted = $this->packagesModel->insertNotification($booking_id, $sender_id, $receiver_id, $notification_message);

        require_once __DIR__ . '/../libraries/sms/vendor/autoload.php';

        $basic  = new \Vonage\Client\Credentials\Basic("992a5e27", "YiQN3gXeYkIkfbcJ");
        $client = new \Vonage\Client($basic);

        $messageBody = "Tour Guide,"." $sender_name" . " has cancelled your booking with the booking details were for tour guide room from" . " $startDate". " to" ." $endDate." ." We apologize for the inconvenience caused. Your payment refund will be processed within 7 days.";

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
        if ($updated && $notification_inserted && $message->getStatus() == 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function getNotifications()
    {
        $user_id = $_SESSION['user_id'];

        $notifications = $this->packagesModel->getNotifications($user_id);

        if ($notifications)
            return $notifications;
        else
            return [];
    }

    public function markNotificationAsRead()
    {
        // Retrieve notification_id from the POST request
        $notification_id = $_POST['notification_id'];

        // Call the model function to mark the notification as read
        $marked = $this->packagesModel->markNotificationAsRead($notification_id);

        // Return JSON response based on the result
        if ($marked) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }


}