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
        $transactionData = $this->bookingTransactions();

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

    public function payment(){

        $profilePicture = $this->getProfilePicture();

        // Retrieve the serviceProvider_id from the URL parameter
        $serviceProvider_id = isset($_GET['serviceProvider_id']) ? $_GET['serviceProvider_id'] : null;
        $total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : null;

        $transactionData = $this->bookingTransactions();

        $bookingDetails = $this->BusinessmanagersModel-> getBookingDetails($serviceProvider_id);

        // Prepare data to be passed to the view
        $data = [
            'profilePicture' => $profilePicture,
            'bookingDetails' => $bookingDetails,
            'total_amount' => $total_amount,
            'serviceProvider_id' => $serviceProvider_id,
            'transactionData' => $transactionData
        ];

        // Load the view and pass data to it
        $this->view('businessmanager/payment', $data);
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

    public function bookingTransactions()
    {
        $transactionData = $this->BusinessmanagersModel->getCombinedTransactions();

        if ($transactionData) {
            return $transactionData;
        } else {
            return [];
        }
    }

//    public function bookingTransactions(){
//        $bookingTransactionData = $this->BusinessmanagersModel->getTransactions();
//
//        var_dump($bookingTransactionData);
//
//        if ($bookingTransactionData) {
//            return $bookingTransactionData;
//        } else {
//            return [];
//        }
//    }

//    public function bookingTransactions(){
//        $bookingTransactionData = $this->BusinessmanagersModel->getCartTransactions();
//
//        var_dump($bookingTransactionData);
//
//        if ($bookingTransactionData) {
//            return $bookingTransactionData;
//        } else {
//            return [];
//        }
//    }



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

    public function makePayment(){

        // Check if required parameters are set
        if(!isset($_POST['serviceProvider_id']) || !isset($_POST['total_amount'])) {
            // Handle the error, maybe return an error response
            echo json_encode(['error' => 'Missing required parameters']);
            exit();
        }

        // Sanitize input data to prevent injection attacks
        $serviceProvider_id = htmlspecialchars($_POST['serviceProvider_id']);
        $total_amount = floatval($_POST['total_amount']);

        // Load Stripe library
        require_once __DIR__ . '/../libraries/stripe/vendor/autoload.php';

        // Set your Stripe secret key
        $stripe_secret_key = "sk_test_51P7g7lRpkbdEng6u4lHC2VAZ2XUjWdriCirYwNOfRnOeKcNoPxSYViS5IqSTggVTacRhvAyvXhKLpqS5vqZT0fU200ytYtmU0N";

        // Set Stripe secret key
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        // Create a Stripe checkout session
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/Travelease/businessmanager/success?serviceProvider_id=$serviceProvider_id&total_amount=$total_amount",
            "cancel_url" => "http://localhost/Travelease/businessmanager/cancel",
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "lkr",
                        "unit_amount" => $total_amount * 100, // Convert to cents
                        "product_data" => [
                            "name" => "Payment for service provider" . $serviceProvider_id,
                            // "images" => ["https://example.com/t-shirt.png"]
                        ]
                    ]
                ]
            ]
        ]);


        // Redirect to the checkout page
//        http_response_code(303);
//        header('Location: ' . $checkout_session->url);

        echo json_encode(['url' => $checkout_session->url]);

    }


    public function success(){

        $serviceProvider_id = $_GET['serviceProvider_id'];
        $total_amount = $_GET['total_amount'];
        $paidDate = date('Y-m-d');

        $successPayment = $this->BusinessmanagersModel->insertFinalPayment($serviceProvider_id,$paidDate, $total_amount);

        // Redirect to the financialmanagement page
        redirect('businessmanager/financialmanagement');
    }

    public function cancel(){
        echo "Payment Cancelled";
    }

    public function makeInvoice(){

        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Import the Dompdf class
//    use Dompdf\Dompdf;

        $dompdf = new Dompdf\Dompdf();

        $html = '<h1>Invoice</h1>
             <p>Invoice Number: INV-001</p>
             <p>Date: 2024-04-21</p>
             <p>Customer: John Doe</p>
             <p>Amount: $100.00</p>';

        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("invoice.pdf", array("Attachment" => 0));

    }







}