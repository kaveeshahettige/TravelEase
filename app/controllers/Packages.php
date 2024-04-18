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

        $data = [
            'userData' => $userData,
        ];

        $this->view('packages/index', $data);
    }

    public function Calender()
    {
        $userData = $this->getUserInfo();

        $data=[
            'selectedDate' => 'null',
            'userData' => $userData,
        ];

        $this->view('packages/calender',$data);
    }

    public function availability()
    {
        $startDate =null;

        if($_SERVER['REQUEST_METHOD'] == 'GET'){

            $startDate = isset($_GET['date']) ? $_GET['date'] : null;

            if (empty($startDate)) {
                flash('error', 'Please select a date.');
                redirect('pacakges/Calender');
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

    public function gallery()
    {
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
        ];

        $this->view('packages/gallery',$data);
    }

    public function revenue()
    {
        $userData = $this->getUserInfo();

        $data = [
            'userData' => $userData,
        ];

        $this->view('packages/revenue',$data);
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

        $data = [
            'userData' => $userData,
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

        $data = [
            'userData' => $userData,
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



}