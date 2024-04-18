<?php

class Businessmanager extends Controller{

    private $postModel;
    public function __construct()
    {
        // $this->userModel = $this->model('Travel');
        if(!isLoggedIn()){
            redirect('users/login');
          }
        $this->BusinessmanagersModel = $this->model('Businessmanagers');
    }

    public function index(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/index', $data);
    }
    public function addpackage(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/addpackage', $data);
    }
    public function bookings(){

        $bookingData = $this->getBookings();
        $profilePicture = $this->getProfilePicture();

        $data = [
                'profilePicture' => $profilePicture,
                'bookingData' => $bookingData
        ];
//              var_dump($data);
            $this->view('businessmanager/bookings', $data);

    }
    public function notifications(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/notifications', $data);
    }
    public function businessmanageredit(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/businessmanageredit', $data);
    }
    public function businessmanagerpassword(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/businessmanagerpassword', $data);
    }
    public function financialmanagement(){

        $profilePicture = $this->getProfilePicture();
        $transactionData = $this->getTransactions();

        $data = [
            'profilePicture' => $profilePicture,
            'transactionData' => $transactionData
        ];
//              var_dump($data);
        $this->view('businessmanager/financialmanagement', $data);
    }
    public function packageedit(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/packageedit', $data);
    }
    public function packages(){

        $packageData = $this->getPackages();
        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture,
            'packageData' => $packageData
        ];
//              var_dump($data);
        $this->view('businessmanager/packages', $data);

    }   public function reports(){

    $profilePicture = $this->getProfilePicture();

    $data = [
        'profilePicture' => $profilePicture
    ];

        $this->view('businessmanager/reports', $data);
    }

    public function settings(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/settings', $data);
    }
    public function navigation(){

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/navigation',$data);
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
                $this->BusinessmanagersModel->updateProfilePicture($_SESSION['user_id'], $uploadFile);
            } else {
                echo 'Error uploading the file.';
            }
        } else {
            echo 'File upload error.';
        }

        // Redirect to the profile page or wherever you want
        header('Location: ' . URLROOT . '/businessmanager/settings');
        exit;
    }

    public function getProfilePicture()
    {
        $profilePicture = $this->BusinessmanagersModel->getProfilePicture($_SESSION['user_id']);

        if ($profilePicture) {
            return $profilePicture;
        } else {
            return [];
        }
    }


    public function getBookings()
    {
        // Get bookings from the bookings table
        $bookingsFromBookingsTable = $this->BusinessmanagersModel->getBookingsFromBookingsTable();

        // Get bookings from the cartbookings table
        $bookingsFromCartBookingsTable = $this->BusinessmanagersModel->getBookingsFromCartBookingsTable();

        // Merge the results from both tables into a single array
        $bookingData = array_merge($bookingsFromBookingsTable, $bookingsFromCartBookingsTable);

        return $bookingData;
    }


    public function getPackages()
    {
        $packageData = $this->BusinessmanagersModel->getPackages();

        if ($packageData) {
            return $packageData;
        } else {
            return [];
        }
    }

    public function getTransactions()
    {
        $transactionData = $this->BusinessmanagersModel->getTransactions();

        if ($transactionData) {
            return $transactionData;
        } else {
            return [];
        }
    }



    public function generateReport()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $serviceType = $_POST['serviceType'];
            $reportType = $_POST['reportType'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $this->BusinessmanagersModel->generateReport($serviceType, $reportType, $startDate, $endDate);
        }


    }

    public function generatePDFReport($serviceType, $startDate, $endDate)
    {
        $reportData = $this->BusinessmanagersModel->generateReport($serviceType, $startDate, $endDate);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Report');

        foreach ($reportData as $report) {
            $pdf->Cell(40, 10, $report['time_range']);
            $pdf->Cell(40, 10, $report['service_type']);
            $pdf->Cell(40, 10, $report['service_provider_name']);
            $pdf->Cell(40, 10, $report['report_type']);
        }

        $pdf->Output();
    }




}