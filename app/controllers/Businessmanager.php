<?php

class Businessmanager extends Controller
{

    private $postModel;

    public function __construct()
    {
        // $this->userModel = $this->model('Travel');
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->BusinessmanagersModel = $this->model('Businessmanagers');
    }

    public function index()
    {

        $profilePicture = $this->getProfilePicture();
        $bookingCount = $this->getBookingCount();
        $bookingData = $this->getBookings();
        $refundData = $this->getRefunds();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingCount' => $bookingCount,
            'bookingData' => $bookingData,
            'refundData'=>$refundData
        ];

        $this->view('businessmanager/index', $data);
    }


    public function bookings()
    {

        $bookingData = $this->getBookings();
        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingData' => $bookingData
        ];
//              var_dump($data);
        $this->view('businessmanager/bookings', $data);

    }

    public function rejectedBookings()
    {
        $profilePicture = $this->getProfilePicture();
        $bookingData = $this->getRejectedBookings();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingData' => $bookingData
        ];

        $this->view('businessmanager/rejectedBookings', $data);
    }

    public function completedBookings()
    {
        $profilePicture = $this->getProfilePicture();
        $bookingData = $this->getCompletedBookings();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingData' => $bookingData
        ];

        $this->view('businessmanager/completedBookings', $data);
    }

    public function notifications()
    {

        $profilePicture = $this->getProfilePicture();
        $notifications = $this->getNotifications();
        var_dump($notifications);

        $data = [
            'profilePicture' => $profilePicture,
            'notifications'=> $notifications
        ];

        $this->view('businessmanager/notifications', $data);
    }


    public function businessmanageredit()
    {

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/businessmanageredit', $data);
    }


    public function businessmanagerpassword()
    {

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/businessmanagerpassword', $data);
    }

    public function financialmanagement()
    {

        $profilePicture = $this->getProfilePicture();
//        $transactionData = $this->bookingTransactions();
        $finalTransactionData = $this->getFinancialDetails();


        $totalAmount = 0;
        foreach ($finalTransactionData[0] as $transaction) {
            $totalAmount += $transaction->payment_amount;
        }

        $data = [
            'profilePicture' => $profilePicture,
//            'transactionData' => $transactionData,
            'finalTransactionData' => $finalTransactionData,
            'totalAmount' => $totalAmount
        ];
//              var_dump($data);
        $this->view('businessmanager/financialmanagement', $data);
    }

    public function payment()
    {

        $profilePicture = $this->getProfilePicture();

        // Retrieve the serviceProvider_id from the URL parameter
        $serviceProvider_id = isset($_GET['serviceProvider_id']) ? $_GET['serviceProvider_id'] : null;
        $totalAmount = isset($_GET['totalAmount']) ? $_GET['totalAmount'] : null;


        $bookingDetail = $this->BusinessmanagersModel->getBookingDetails($serviceProvider_id);
        $cartBookingDetails = $this->BusinessmanagersModel->getCartBookingDetails($serviceProvider_id);

        $bookingDetails = array_merge($bookingDetail, $cartBookingDetails);

        // Prepare data to be passed to the view
        $data = [
            'profilePicture' => $profilePicture,
            'bookingDetails' => $bookingDetails,
            'totalAmount' => $totalAmount,
            'serviceProvider_id' => $serviceProvider_id,
        ];

        // Load the view and pass data to it
        $this->view('businessmanager/payment', $data);
    }


    public function refund()
    {


        $profilePicture = $this->getProfilePicture();
        $refundData = $this->getRefunds();


        $data = [
            'profilePicture' => $profilePicture,
            'refundData' => $refundData
        ];
//              var_dump($data);
        $this->view('businessmanager/refund', $data);

    }

    public function CompletedRefunds()
    {
        $profilePicture = $this->getProfilePicture();
        $completeRefundData = $this->getCompletedRefunds();


        $data = [
            'profilePicture' => $profilePicture,
            'completeRefundData' => $completeRefundData
        ];
//              var_dump($data);
        $this->view('businessmanager/CompletedRefunds', $data);
    }


    public function settings()
    {

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/settings', $data);
    }


    public function navigation()
    {

        $profilePicture = $this->getProfilePicture();

        $data = [
            'profilePicture' => $profilePicture
        ];

        $this->view('businessmanager/navigation', $data);
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

    public function getRejectedBookings()
    {
        $rejectedBooking = $this->BusinessmanagersModel->getRejectedBookings();

        $rejectedCartBookings = $this->BusinessmanagersModel->getRejectedCartBookings();

        $rejectedBookings = array_merge($rejectedBooking, $rejectedCartBookings);

        if ($rejectedBookings) {
            return $rejectedBookings;
        } else {
            return [];
        }
    }


    public function getCompletedBookings()
    {
        $completedBooking = $this->BusinessmanagersModel->getCompletedBookings();

        $completedCartBookings = $this->BusinessmanagersModel->getCompletedCartBookings();

        $completedBookings = array_merge($completedBooking, $completedCartBookings);

        if ($completedBookings) {
            return $completedBookings;
        } else {
            return [];
        }
    }







    public function makePayment()
    {

        // Check if required parameters are set
        if (!isset($_POST['serviceProvider_id']) || !isset($_POST['totalAmount'])) {
            // Handle the error, maybe return an error response
            echo json_encode(['error' => 'Missing required parameters']);
            exit();
        }

        // Sanitize input data to prevent injection attacks
        $serviceProvider_id = htmlspecialchars($_POST['serviceProvider_id']);
        $totalAmount = floatval($_POST['totalAmount']);

        // Calculate 90% of the total amount
        $final_amount = $totalAmount * 0.9;

        // Load Stripe library
        require_once __DIR__ . '/../libraries/stripe/vendor/autoload.php';

        // Set your Stripe secret key
        $stripe_secret_key = "sk_test_51P7g7lRpkbdEng6u4lHC2VAZ2XUjWdriCirYwNOfRnOeKcNoPxSYViS5IqSTggVTacRhvAyvXhKLpqS5vqZT0fU200ytYtmU0N";

        // Set Stripe secret key
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        // Create a Stripe checkout session
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/Travelease/businessmanager/success?serviceProvider_id=$serviceProvider_id&final_amount=$final_amount&totalAmount=$totalAmount",
            "cancel_url" => "http://localhost/Travelease/businessmanager/cancel",
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "lkr",
                        "unit_amount" => $final_amount * 100, // Convert to cents
                        "product_data" => [
                            "name" => "Payment for service provider" . $serviceProvider_id,
//                            images" => ["https://example.com/t-shirt.png"]
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

    public function success()
    {

        $serviceProvider_id = $_GET['serviceProvider_id'];
        $paidAmount = $_GET['final_amount'];
        $totalAmount = $_GET['totalAmount'];
        $paidDate = date('Y-m-d');
//        $paidAmount = $total_amount * 0.9;

        $invoiceData = $this->makePaymentInvoice($serviceProvider_id, $totalAmount);

        $Invoicepdf = $invoiceData['Invoicepdf'];
        $file_path = $invoiceData['file_path'];

        $bookingStatus = $this->BusinessmanagersModel->updateBookingCondition($serviceProvider_id);
        $CartBookingStatus = $this->BusinessmanagersModel->updateCartBookingCondition($serviceProvider_id);

        // Insert final payment with $file_path
        $successPayment = $this->BusinessmanagersModel->insertFinalPayment($serviceProvider_id, $paidDate, $paidAmount, $file_path);


        // Redirect to the financialmanagement page
        redirect('businessmanager/financialmanagement');
    }

    public function cancel()
    {
        echo "Payment Cancelled";
    }

    public function makeInvoice()
    {
        // Retrieve data from the request
        $serviceProvider_id = $_POST['serviceProvider_id'];
        $totalAmount = $_POST['totalAmount'];

        // Fetch booking details based on the serviceProvider_id
        $bookingDetail = $this->BusinessmanagersModel->getBookingDetails($serviceProvider_id);
        $cartBookingDetails = $this->BusinessmanagersModel->getCartBookingDetails($serviceProvider_id);

        $bookingDetails = array_merge($bookingDetail, $cartBookingDetails);

        $invoice_number = 'IV-' . uniqid();

        // Current date
        $current_date = date('Y-m-d');


        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Create a new Dompdf instance
        $dompdf = new Dompdf\Dompdf();

        // HTML content for the invoice with booking details
        $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
        }
        .logo {
            max-width: 120px;
        }
        h1 {
            font-size: 32px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            font-weight: bold;
        }
        .total-section {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px solid #ddd;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="TravelEase Logo" class="logo">
    <h1>Invoice</h1>
</div>
<div class="invoice-details">
    <p><strong>Invoice Number:</strong>' . $invoice_number . '</p>
    <p><strong>Billed To:</strong> ' . $bookingDetails[0]->serviceprovider_name . '</p>
    <p><strong>Date:</strong> ' . $current_date . '</p>
</div>
<table>
    <thead>
    <tr>
        <th>Traveler Name</th>
        <th>Booking Type</th>
        <th>Booking Date</th>
        <th>Check-in Date</th>
        <th>Check-out Date</th>
        <th>Service Detail</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>';
        foreach ($bookingDetails as $bookingDetail) {
            $html .= '<tr>
         <td>' . $bookingDetail->traveler_name . '</td>
        <td>' . $bookingDetail->booking_type . '</td>
        <td>' . $bookingDetail->bookingDate . '</td>
        <td>' . $bookingDetail->startDate . '</td>
        <td>' . $bookingDetail->endDate . '</td>
        <td>' . $bookingDetail->service_detail . '</td>
        <td>Rs' . $bookingDetail->payment_amount . '</td>
    </tr>';
        }
        $html .= '</tbody>
</table>
<div class="total-section">
    <p><strong>Total Amount:</strong> Rs' . $totalAmount . '</p>
    <p><strong>Commission Fee (10%):</strong> Rs' . ($totalAmount * 0.1) . '</p>
    <p><strong>Final Payment:</strong> Rs' . ($totalAmount * 0.9) . '</p>
</div>
<div class="footer">
    <p>Thank you for your business!</p>
    <p>For any inquiries regarding this invoice, please contact TravelEase at 0701184956 or traveease@gmail.com.</p>
</div>
</body>
</html>    ';

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->set_option('isRemoteEnabled', true);

        // Render the HTML as PDF
        $dompdf->render();

        // Get the PDF content
        $pdfContent = $dompdf->output();

        // Define the directory where PDF invoices will be stored
        $directory = '../public/invoice/';

        // Generate a unique filename for the PDF invoice
        $filename = 'invoice_' . uniqid() . '.pdf';

        // Save the PDF file to the directory
        file_put_contents($directory . $filename, $pdfContent);

        $file_path = $filename;
        $invoice_date = date('Y-m-d');
        $final_amount = $totalAmount * 0.9;

        // Assuming you have a method to insert data into your database
        $Invoicepdf = $this->BusinessmanagersModel->insertInvoice($serviceProvider_id, $totalAmount, $final_amount, $invoice_date, $file_path);

        // Open the PDF invoice in a new browser window
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="invoice.pdf"');
        header('Content-Length: ' . strlen($pdfContent));
        echo $pdfContent;
    }

    public function makePaymentInvoice($serviceProvider_id, $totalAmount)
    {


        // Fetch booking details based on the serviceProvider_id
        $bookingDetail = $this->BusinessmanagersModel->getBookingDetails($serviceProvider_id);
        $cartBookingDetails = $this->BusinessmanagersModel->getCartBookingDetails($serviceProvider_id);

        $bookingDetails = array_merge($bookingDetail, $cartBookingDetails);

        $invoice_number = 'IV-' . uniqid();

        // Current date
        $current_date = date('Y-m-d');

        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Create a new Dompdf instance
        $dompdf = new Dompdf\Dompdf();

        // HTML content for the invoice with booking details
        $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice</title>
        <style>
            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                background-color: #ffffff;
            }
            .header {
                text-align: center;
            }
            .logo {
                max-width: 120px;
            }
            h1 {
                font-size: 32px;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                font-size: 12px;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 12px;
            }
            th {
                font-weight: bold;
            }
            .total-section {
                margin-top: 30px;
                padding-top: 10px;
                border-top: 2px solid #ddd;
            }
            .footer {
                margin-top: 50px;
                text-align: center;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
            <div class="header">
                <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="TravelEase Logo" class="logo">
                <h1>Invoice</h1>
            </div>
            <div class="invoice-details">
                <p><strong>Invoice Number:</strong>' . $invoice_number . '</p>
                <p><strong>Billed To:</strong> ' . $bookingDetails[0]->serviceprovider_name . '</p>
                <p><strong>Date:</strong> ' . $current_date . '</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Traveler Name</th>
                        <th>Booking Type</th>
                        <th>Booking Date</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Service Detail</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($bookingDetails as $bookingDetail) {
            $html .= '<tr>
                <td>' . $bookingDetail->traveler_name . '</td>
                <td>' . $bookingDetail->booking_type . '</td>
                <td>' . $bookingDetail->bookingDate . '</td>
                <td>' . $bookingDetail->startDate . '</td>
                <td>' . $bookingDetail->endDate . '</td>
                <td>' . $bookingDetail->service_detail . '</td>
                <td>Rs' . $bookingDetail->payment_amount . '</td>
            </tr>';
        }
        $html .= '</tbody>
            </table>
            <div class="total-section">
                <p><strong>Total Amount:</strong> Rs' . $totalAmount . '</p>
                <p><strong>Commission Fee (10%):</strong> Rs' . ($totalAmount * 0.1) . '</p>
                <p><strong>Final Payment:</strong> Rs' . ($totalAmount * 0.9) . '</p>
            </div>
            <div class="footer">
                <p>Thank you for your business!</p>
                <p>For any inquiries regarding this invoice, please contact TravelEase at 0701184956 or traveease@gmail.com.</p>
            </div>
    </body>
    </html>';

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->set_option('isRemoteEnabled', true);

        // Render the HTML as PDF
        $dompdf->render();

        // Get the PDF content
        $pdfContent = $dompdf->output();

        // Define the directory where PDF invoices will be stored
        $directory = '../public/invoice/';

        // Generate a unique filename for the PDF invoice
        $filename = 'invoice_' . uniqid() . '.pdf';

        // Save the PDF file to the directory
        file_put_contents($directory . $filename, $pdfContent);

        $file_path = $filename;
        $invoice_date = date('Y-m-d');
        $final_amount = $totalAmount * 0.9;

        // Assuming you have a method to insert data into your database
        $Invoicepdf = $this->BusinessmanagersModel->insertInvoice($serviceProvider_id, $totalAmount, $final_amount, $invoice_date, $file_path);

        return [
            'Invoicepdf' => $Invoicepdf,
            'file_path' => $file_path
        ];
    }


    public function getBookingCount()
    {
        $bookingCount = $this->BusinessmanagersModel->getBookingCount();
//        var_dump($bookingCount);

        if ($bookingCount) {
            return $bookingCount;
        } else {
            return [];
        }
    }

    public function getCartBookingCount()
    {
        $cartBookingCount = $this->BusinessmanagersModel->getCartBookingCount();
        var_dump($cartBookingCount);

        if ($cartBookingCount) {
            return $cartBookingCount;
        } else {
            return [];
        }
    }

    public function getFinancialDetails()
    {
        $bookingFinancialDetails = $this->BusinessmanagersModel->getBookingFinancialDetails();
        $cartBookingFinancialDetails = $this->BusinessmanagersModel->getCartBookingFinancialDetails();

        $financialDetails = [];

        // Merge booking financial details by serviceProvider_id
        foreach ($bookingFinancialDetails as $booking) {
            $serviceProviderId = $booking->serviceProvider_id;
            if (!isset($financialDetails[$serviceProviderId])) {
                $financialDetails[$serviceProviderId] = [];
            }
            $financialDetails[$serviceProviderId][] = $booking;
        }

        // Merge cart booking financial details by serviceProvider_id
        foreach ($cartBookingFinancialDetails as $cartBooking) {
            $serviceProviderId = $cartBooking->serviceProvider_id;
            if (!isset($financialDetails[$serviceProviderId])) {
                $financialDetails[$serviceProviderId] = [];
            }
            $financialDetails[$serviceProviderId][] = $cartBooking;
        }

        // Convert the associative array to indexed array
        $financialDetails = array_values($financialDetails);
//        echo "<pre>";
//        print_r($financialDetails);

        if ($financialDetails) {
            return $financialDetails;
        } else {
            return [];
        }
    }


    public function getRefunds(){

            $refundData = $this->BusinessmanagersModel->getRefunds();

//            var_dump($refundData);

            if ($refundData) {
                return $refundData;
            } else {
                return [];
            }
   }

   public function getCompletedRefunds(){

        $refundData = $this->BusinessmanagersModel->getCompletedRefunds();

        if ($refundData) {
            return $refundData;
        } else {
            return [];
        }

   }

   public function getNotifications(){

        $reciever_id = $_SESSION['user_id'];

        $notifications = $this->BusinessmanagersModel->getNotifications($reciever_id);

        if ($notifications) {
            return $notifications;
        }else{
            return[];
        }
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





}
