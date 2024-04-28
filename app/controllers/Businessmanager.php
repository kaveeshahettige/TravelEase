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
        $bookingsCount = $this->getBookingsCount();
        $bookingData = $this->getBookings();
        $refundData = $this->getRefunds();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();
        $monthlyData = $this->getMonthlyData();
        $revenueData = $this->getRevenueData();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingsCount' => $bookingsCount,
            'bookingData' => $bookingData,
            'refundData'=>$refundData,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount,
            'monthlyData' => $monthlyData,
            'revenueData' => $revenueData
        ];

        $this->view('businessmanager/index', $data);
    }


    public function bookings()
    {

        $bookingData = $this->getBookings();
        $profilePicture = $this->getProfilePicture();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingData' => $bookingData,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];
//              var_dump($data);
        $this->view('businessmanager/bookings', $data);

    }

    public function reports(){

        $profilePicture = $this->getProfilePicture();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();
        $reports = $this->BusinessmanagersModel->getReports();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount,
            'reports' => $reports
        ];

        $this->view('businessmanager/reports', $data);
    }

    public function rejectedBookings()
    {
        $profilePicture = $this->getProfilePicture();
        $bookingData = $this->getRejectedBookings();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingData' => $bookingData,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];

        $this->view('businessmanager/rejectedBookings', $data);
    }

    public function completedBookings()
    {
        $profilePicture = $this->getProfilePicture();
        $bookingData = $this->getCompletedBookings();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();

        $data = [
            'profilePicture' => $profilePicture,
            'bookingData' => $bookingData,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];

        $this->view('businessmanager/completedBookings', $data);
    }

    public function notifications()
    {

        $profilePicture = $this->getProfilePicture();
        $notifications = $this->getNotifications();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();
//        var_dump($notifications);

        $data = [
            'profilePicture' => $profilePicture,
            'notifications'=> $notifications,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];

        $this->view('businessmanager/notifications', $data);
    }

    public function services(){

        $profilePicture = $this->getProfilePicture();
        $hotelRooms = $this->getHotelRooms();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();

        $data = [
           'profilePicture' => $profilePicture,
            'hotelRooms' => $hotelRooms,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];
        $this->view('businessmanager/services', $data);
    }

    public function vehicles(){
        $profilePicture = $this->getProfilePicture();
        $vehicles = $this->getVehicles();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();

        $data = [
            'profilePicture' => $profilePicture,
            'vehicles' => $vehicles,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];
        $this->view('businessmanager/vehicles', $data);
    }

    public function guide(){

        $profilePicture = $this->getProfilePicture();
        $guides = $this->getGuides();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();

        $data = [
            'profilePicture' => $profilePicture,
            'guides' => $guides,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];
        $this->view('businessmanager/guide', $data);
    }

    public function businessmanageredit()
    {

        $profilePicture = $this->getProfilePicture();
        $userData = $this->updateSettings($_SESSION['user_id']);


        $data = [
            'profilePicture' => $profilePicture,
            'userData' => $userData
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
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();
//        var_dump($finalTransactionData);


        $totalAmount = 0;

        if (!empty($finalTransactionData) && is_array($finalTransactionData) && isset($finalTransactionData[0])) {
            foreach ($finalTransactionData[0] as $transaction) {
                if (isset($transaction->payment_amount)) {
                    $totalAmount += $transaction->payment_amount;
                }
            }
        }

        $data = [
            'profilePicture' => $profilePicture,
//            'transactionData' => $transactionData,
            'finalTransactionData' => $finalTransactionData,
            'totalAmount' => $totalAmount,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
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
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();


        $data = [
            'profilePicture' => $profilePicture,
            'refundData' => $refundData,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
        ];
//              var_dump($data);
        $this->view('businessmanager/refund', $data);

    }

    public function CompletedRefunds()
    {
        $profilePicture = $this->getProfilePicture();
        $completeRefundData = $this->getCompletedRefunds();
        $bookingsCount = $this->getBookingsCount();
        $OngoingCount = $this->getOngoingCount();
        $guestCount = $this->getGuestCount();


        $data = [
            'profilePicture' => $profilePicture,
            'completeRefundData' => $completeRefundData,
            'bookingsCount' => $bookingsCount,
            'OngoingCount'=> $OngoingCount,
            'guestCount'=> $guestCount
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
            'profilePicture' => $profilePicture,
        ];

        $this->view('businessmanager/navigation', $data);
    }

    public function updateSettings($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form submission
            // Sanitize input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get form data
            $userData = [
                'name' => $_POST['business-manager-name'],
                'last_name' => $_POST['business-manager-lname'],
                'email' => $_POST['email'],
                'phone_number' => $_POST['phone-number'],
                'user_id' => $user_id,
                'name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'phone_number_err' => '',
            ];

            // Check for any validation errors
            if (empty($userData['name_err']) && empty($userData['last_name_err']) &&
                empty($userData['email_err']) && empty($userData['phone_number_err'])) {
                // Call the model method to update user settings
                if ($this->BusinessmanagersModel->updateSettings($userData)) {
                    // User settings updated successfully
                    flash('success_message', 'User settings updated successfully');
                    redirect('businessmanager/businessmanageredit');
                } else {
                    // Something went wrong with the update
                    flash('error_message', 'Failed to update user settings');
                    redirect('businessmanager/businessmanageredit');
                }
            }
        } else {
            // Retrieve existing user data based on user_id
            $userData = $this->BusinessmanagersModel->basicInfo($user_id);

            // Check if user data exists
            if ($userData) {
                // Load the view with user data for editing
                return $userData;
            } else {
                // User data not found for the given user ID
                flash('error_message', 'User data not found for the given user ID');
                redirect('businessmanager/businessmanageredit');
            }
        }
    }



    public function changeProfilePicture()
    {
        // Check if a file was uploaded
        if ($_FILES['profile-picture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/images/';
            $uploadFile = $uploadDir . basename($_FILES['profile-picture']['name']);
            $fileName = basename($_FILES['profile-picture']['name']);

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($_FILES['profile-picture']['tmp_name'], $uploadFile)) {
                // Update the session with the new file path
                $_SESSION['user_profile_picture'] = $uploadFile;

                // Update the profile picture file name in the database
                $this->BusinessmanagersModel->updateProfilePicture($_SESSION['user_id'], $fileName);
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
//        var_dump($bookingsFromBookingsTable);

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
//       $paidAmount = $total_amount * 0.9;
        $income = $totalAmount * 0.1;

        $invoiceData = $this->makePaymentInvoice($serviceProvider_id, $totalAmount);

        $Invoicepdf = $invoiceData['Invoicepdf'];
        $file_path = $invoiceData['file_path'];

        $bookingStatus = $this->BusinessmanagersModel->updateBookingCondition($serviceProvider_id);
        $CartBookingStatus = $this->BusinessmanagersModel->updateCartBookingCondition($serviceProvider_id);

        $sender_id = $_SESSION['user_id'];
        $date = date('Y-m-d');
        $notification = "Your Payment till" . " $date" . " has been Paid";

        $notificationInserted = $this->BusinessmanagersModel->InsertNotification($sender_id,$serviceProvider_id,$notification, $date);

        // Insert final payment with $file_path
        $successPayment = $this->BusinessmanagersModel->insertFinalPayment($serviceProvider_id, $paidDate, $paidAmount,$income, $file_path);


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

        $invoice_number = 'IV-' . uniqid();

        // Current date
        $current_date = date('Y-m-d');

        $bookingDetail = $this->BusinessmanagersModel->getBookingDetails($serviceProvider_id);
        $cartBookingDetails = $this->BusinessmanagersModel->getCartBookingDetails($serviceProvider_id);

        $bookingDetails = array_merge($bookingDetail, $cartBookingDetails);


        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Create a new Dompdf instance
        $dompdf = new Dompdf\Dompdf();

        $data = [
            'totalAmount' => $totalAmount,
            'invoice_number' => $invoice_number,
            'current_date' => $current_date,
            'bookingDetails' => $bookingDetails
        ];

        // HTML content for the invoice with booking details
        ob_start();
        $this->view('businessmanager/invoice',$data);
        $html = ob_get_clean();

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


    public function getCartBookingCount()
    {
        $cartBookingCount = $this->BusinessmanagersModel->getCartBookingCount();
//        var_dump($cartBookingCount);

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

        $updated = $this->BusinessmanagersModel->markAsRead($notification_id);

        if ($updated) {
            echo json_encode(['success' => 'Notification marked as read successfully']);
        } else {
            echo json_encode(['error' => 'Failed to mark notification as read']);
        }
    }

    public function confirmRefund(){

        $booking_id = $_POST['booking_id'];
        $refund_id = $_POST['refund_id'];
        $refund_date = date('Y-m-d');

        $refundUpdated = $this->BusinessmanagersModel->confirmRefund($refund_id,$booking_id,$refund_date);

        if ($refundUpdated) {
            echo json_encode(['success' => 'Refund is successfully completed']);
        } else {
            echo json_encode(['error' => 'Failed to make refund completed']);
        }

    }


    public function getBookingsCount(){


        $bookingCount = $this->BusinessmanagersModel->getBookingsCount();

        $cartCount = $this->BusinessmanagersModel->getCartCount();


        $bookingsCount = $bookingCount + $cartCount;

        return $bookingsCount;

    }

    public function getOngoingCount(){


        $OnbookingCount = $this->BusinessmanagersModel->getOngoingBookingsCount();
//       var_dump($OnbookingCount);
        $OncartCount = $this->BusinessmanagersModel->getOngoingCartCount();
//      var_dump($OncartCount);

        $OngoingCount = $OnbookingCount + $OncartCount;

        return  $OngoingCount;

    }

    public function getGuestCount(){

        $guest= $this->BusinessmanagersModel->getGuestCount();

        $cartguestCount = $this->BusinessmanagersModel->getcartGuestCount();


        $guestCount = $guest + $cartguestCount;

        return  $guestCount;
    }


    public function generateReport()
    {

        $reportType = $_POST['reportType'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        if ($reportType == 'booking') {

//            $reportData1 = $this->BusinessmanagersModel->getBookingReportData($startDate, $endDate);
//            $reportData2 = $this->BusinessmanagersModel->getCartBookingReportData($startDate, $endDate);

            $reportData1 = $this->BusinessmanagersModel->getCompletedBookings();

            $reportData2 = $this->BusinessmanagersModel->getCompletedCartBookings();

            $reportData = array_merge($reportData1, $reportData2);

            $this->generateBookingReport($reportData, $startDate, $endDate);

        } else if ($reportType == 'guest') {

            $reportData1 = $this->BusinessmanagersModel->getGuestReportData($startDate, $endDate);
            $reportData2 = $this->BusinessmanagersModel->getCartGuestReportData($startDate, $endDate);

            $reportData = array_merge($reportData1, $reportData2);
            $r = array();

            //merge by User_ID
            foreach ($reportData as $key => $row) {
                if (!isset($r[$row->User_ID])) {
                    $r[$row->User_ID] = $row;
                } else {
                    $r[$row->User_ID]->booking_count += $row->booking_count;
                }
            }

            $this->generateGuestReport($r, $startDate, $endDate);
        } else if ($reportType == 'hotel') {

            $reportData1 = $this->BusinessmanagersModel->getHotelReportData($startDate, $endDate);
            $reportData2 = $this->BusinessmanagersModel->getCartHotelReportData($startDate, $endDate);

            $reportData = array_merge($reportData1, $reportData2);
            $r = array();

            //merge by serviceProvider_ID

            foreach ($reportData as $key => $row) {
                if (!isset($r[$row->serviceProvider_id])) {
                    $r[$row->serviceProvider_id] = $row;
                } else {
                    $r[$row->serviceProvider_id]->booking_count += $row->booking_count;
                }
            }

            $this->generateHotelReport($r, $startDate, $endDate);

        }else if($reportType =='transport') {

            $reportData1 = $this->BusinessmanagersModel->getTransportReportData($startDate, $endDate);
            $reportData2 = $this->BusinessmanagersModel->getCartTransportReportData($startDate, $endDate);

            $reportData = array_merge($reportData1, $reportData2);
            $r = array();

            //merge by serviceProvider_ID

            foreach ($reportData as $key => $row) {
                if (!isset($r[$row->serviceProvider_id])) {
                    $r[$row->serviceProvider_id] = $row;
                } else {
                    $r[$row->serviceProvider_id]->booking_count += $row->booking_count;
                }
            }

            $this->generateTransportReport($r, $startDate, $endDate);

        }else if ($reportType == 'guide') {

                $reportData1 = $this->BusinessmanagersModel->getGuideReportData($startDate, $endDate);
                $reportData2 = $this->BusinessmanagersModel->getCartGuideReportData($startDate, $endDate);

                $reportData = array_merge($reportData1, $reportData2);
                $r = array();

                //merge by serviceProvider_ID

                foreach ($reportData as $key => $row) {
                    if (!isset($r[$row->serviceProvider_id])) {
                        $r[$row->serviceProvider_id] = $row;
                    } else {
                        $r[$row->serviceProvider_id]->booking_count += $row->booking_count;
                    }
                }

                $this->generateGuideReport($r, $startDate, $endDate);
        } else {
            echo 'Invalid report type';
        }
    }


    public function generateBookingReport($reportData, $startDate, $endDate){

    require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

    // Create a new Dompdf instance
    $dompdf = new Dompdf\Dompdf();

    // HTML content for the report
    $html = '<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Booking Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .date-range {
            margin-bottom: 20px;
        }
        .total-revenue {
            margin-top: 20px;
            text-align: right;
        }
        .logo {
            display: block;
            margin: 0 auto 10px; /* Center the image */
            max-width: 75px;
            height: auto;
        }
    </style>
</head>
<body>
    <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="Logo" class="logo"> 
    <h1>Details of Bookings</h1>
    <div class="date-range">
        <strong>Start Date:</strong> ' . $startDate . '<br>
        <strong>End Date:</strong> ' . $endDate . '
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Service Provider</th>
                <th>Service Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Service Details</th>
                <th>Service Price</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>';

    $totalRevenue = 0;
    $rowNumber = 1;

    foreach ($reportData as $row) {
        // Ensure that the values are not NULL before accessing them
        $serviceName = isset($row->serviceprovider_name) ? $row->serviceprovider_name : '';
        $serviceType = isset($row->service_type) ? $row->service_type : '';
        $startDate = isset($row->startDate) ? $row->startDate : '';
        $endDate = isset($row->endDate) ? $row->endDate : '';
        $serviceDetails = isset($row->service_detail) ? $row->service_detail : '';
        $servicePrice = isset($row->payment_amount) ? $row->payment_amount : 0;
        $revenue = isset($row->payment_amount) ? $row->payment_amount * 0.1 : 0;

        // Accumulate total revenue
        $totalRevenue += $revenue;

        // Output the row in the table
        $html .= '<tr>
            <td>' . $rowNumber . '</td>
            <td>' . $serviceName . '</td>
            <td>' . $serviceType . '</td>
            <td>'. $startDate .'</td>
            <td>'. $endDate .'</td>
            <td>' . $serviceDetails . '</td>
            <td>Rs. ' . $servicePrice . '</td>
            <td>Rs. ' . $revenue . '</td>
        </tr>';
        $rowNumber++;
    }

    $html .= '</tbody>
    </table>
    <div class="total-revenue">
        <strong>Total Revenue:</strong>Rs. ' . $totalRevenue . '
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

    // Define the directory where PDF reports will be stored
    $directory = '../public/report/';

    // Generate a unique filename for the PDF report
    $filename = 'booking_report_' . uniqid() . '.pdf';

    // Save the PDF file to the directory
    file_put_contents($directory . $filename, $pdfContent);

    $created_date = date('Y-m-d');

    $reports = $this->BusinessmanagersModel->insertReport($filename,'Bookings', $startDate, $endDate,$created_date);

    //view pdf
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="bookingReport.pdf"');
    header('Content-Length: ' . strlen($pdfContent));
    echo $pdfContent;
}


    public function generateGuestReport($reportData, $startDate, $endDate){

        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Create a new Dompdf instance
        $dompdf = new Dompdf\Dompdf();

        // HTML content for the report
        $html = '<!DOCTYPE html>
<head>
    <title>Guest Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .date-range {
            margin-bottom: 20px;
        }
        .footer {
            text-align: right;
            margin-top: 50px;
        }
        .logo {
            display: block;
            margin: 0 auto 10px; /* Center the image */
            max-width: 75px;
            height: auto;
        }
    </style>
</head>
<body>
    <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="Logo" class="logo"> 
    <h1>Guest Report</h1>
    <div class="date-range">
        <strong>Start Date:</strong> ' . $startDate . '<br>
        <strong>End Date:</strong> ' . $endDate . '
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Guest Name</th>
                <th>Booking Count</th>
            </tr>
        </thead>
        <tbody>';

        $rowNumber = 1;
        $totalGuests = 0;

        foreach ($reportData as $row) {
            // Ensure that the values are not NULL before accessing them
            $guestName = isset($row->Guest_Name) ? $row->Guest_Name : '';
            $bookingCount = isset($row->booking_count) ? $row->booking_count : 0;

            // Accumulate total guests

            // Output the row in the table
            $html .= '<tr>
            <td>' . $rowNumber . '</td>
            <td>' . $guestName . '</td>
            <td>' . $bookingCount . '</td>
        </tr>';
            $rowNumber++;
        }
        $totalGuests = $rowNumber-1;

        $html .= '</tbody>
</table>
<div class="footer">
    <strong>Total Guests:</strong> ' . $totalGuests . '
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

        // Define the directory where PDF reports will be stored
        $directory = '../public/report/';

        // Generate a unique filename for the PDF report
        $filename = 'guest_report_' . uniqid() . '.pdf';

        // Save the PDF file to the directory
        file_put_contents($directory . $filename, $pdfContent);

        $created_date = date('Y-m-d');

        $reports = $this->BusinessmanagersModel->insertReport($filename,'Traveler Report', $startDate, $endDate,$created_date);

        //view pdf
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="Guest Report.pdf"');
        header('Content-Length: ' . strlen($pdfContent));
        echo $pdfContent;
    }



    public function generateHotelReport($reportData, $startDate, $endDate){
        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Create a new Dompdf instance
        $dompdf = new Dompdf\Dompdf();

        // Total count of hotel bookings
        $totalHotelBookings = 0;
        foreach ($reportData as $row) {
            $totalHotelBookings += isset($row->booking_count) ? $row->booking_count : 0;
        }

        // HTML content for the report
        $html = '<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    
    <title>Hotel Report</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .date-range {
            margin-bottom: 20px;
        }
        .logo {
            display: block;
            margin: 0 auto 10px; /* Center the image */
            max-width: 75px;
            height: auto;
        }
        .footer {
            text-align: right;
            margin-top: 50px;
        }
        .main-footer {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="Logo" class="logo"> 
    <h1>Hotel Report</h1>
    <div class="date-range">
        <strong>Start Date:</strong> ' . $startDate . '<br>
        <strong>End Date:</strong> ' . $endDate . '
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hotel Name</th>
                <th>Booking Count</th>
            </tr>
        </thead>
        <tbody>';

        $rowNumber = 1;

        foreach ($reportData as $row) {
            // Ensure that the values are not NULL before accessing them
            $hotelName = isset($row->hotel_name) ? $row->hotel_name : '';
            $bookingCount = isset($row->booking_count) ? $row->booking_count : 0;

            // Output the row in the table
            $html .= '<tr>
            <td>' . $rowNumber . '</td>
            <td>' . $hotelName . '</td>
            <td>' . $bookingCount . '</td>
        </tr>';
            $rowNumber++;
        }

        $html .= '</tbody>
    </table>
    <div class="footer">
        Total Hotel Bookings: ' . $totalHotelBookings . '<br>
    </div>
    <div class="main-footer">
        Generated by Your Company &copy; ' . date("Y") . '
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

        // Define the directory where PDF reports will be stored
        $directory = '../public/report/';

        // Generate a unique filename for the PDF report
        $filename = 'hotel_report_' . uniqid() . '.pdf';

        // Save the PDF file to the directory
        file_put_contents($directory . $filename, $pdfContent);

        $created_date = date('Y-m-d');

        $reports = $this->BusinessmanagersModel->insertReport($filename,'Hotel Report', $startDate, $endDate,$created_date);

        //view pdf
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="hotelReport.pdf"');
        header('Content-Length: ' . strlen($pdfContent));
        echo $pdfContent;
    }



    public function generateTransportReport($reportData, $startDate, $endDate){
        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Create a new Dompdf instance
        $dompdf = new Dompdf\Dompdf();

        // Total count of transport bookings
        $totalTransportBookings = 0;
        foreach ($reportData as $row) {
            $totalTransportBookings += isset($row->booking_count) ? $row->booking_count : 0;
        }

        // HTML content for the report
        $html = '<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        
        <title>Transport Report</title>
        <style>
            body {
                font-family: Poppins, sans-serif;
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            .date-range {
                margin-bottom: 20px;
            }
            .logo {
                display: block;
                margin: 0 auto 10px; /* Center the image */
                max-width: 75px;
                height: auto;
            }
            .footer {
                text-align: right;
                margin-top: 50px;
            }
            .main-footer {
                position: fixed;
                bottom: 20px;
                width: 100%;
                text-align: center;
                font-size: 12px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="Logo" class="logo"> 
        <h1>Transport Report</h1>
        <div class="date-range">
            <strong>Start Date:</strong> ' . $startDate . '<br>
            <strong>End Date:</strong> ' . $endDate . '
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Transport Name</th>
                    <th>Booking Count</th>
                </tr>
            </thead>
            <tbody>';

        $rowNumber = 1;

        foreach ($reportData as $row) {
            // Ensure that the values are not NULL before accessing them
            $transportName = isset($row->transport_name) ? $row->transport_name : '';
            $bookingCount = isset($row->booking_count) ? $row->booking_count : 0;

            // Output the row in the table
            $html .= '<tr>
            <td>' . $rowNumber . '</td>
            <td>' . $transportName . '</td>
            <td>' . $bookingCount . '</td>
        </tr>';
            $rowNumber++;
        }

        $html .= '</tbody>
        </table>
        <div class="footer">
            Total Transport Bookings: ' . $totalTransportBookings . '<br>
        </div>
        <div class="main-footer">
            Generated by Your Company &copy; ' . date("Y") . '
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

        // Define the directory where PDF reports will be stored
        $directory = '../public/report/';

        // Generate a unique filename for the PDF report
        $filename = 'transport_report_' . uniqid() . '.pdf';

        // Save the PDF file to the directory
        file_put_contents($directory . $filename, $pdfContent);

        $created_date = date('Y-m-d');

        $reports = $this->BusinessmanagersModel->insertReport($filename,'Transport Provider Report', $startDate, $endDate,$created_date);

        //view pdf
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="transportReport.pdf"');
        header('Content-Length: ' . strlen($pdfContent));
        echo $pdfContent;
    }


    public function generateGuideReport($reportData, $startDate, $endDate){
        require_once __DIR__ . '/../libraries/dompdf/vendor/autoload.php';

        // Create a new Dompdf instance
        $dompdf = new Dompdf\Dompdf();

        // Total count of guide bookings
        $totalGuideBookings = 0;
        foreach ($reportData as $row) {
            $totalGuideBookings += isset($row->booking_count) ? $row->booking_count : 0;
        }

        // HTML content for the report
        $html = '<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        
        <title>Guide Report</title>
        <style>
            body {
                font-family: Poppins, sans-serif;
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            .date-range {
                margin-bottom: 20px;
            }
            .logo {
                display: block;
                margin: 0 auto 10px; /* Center the image */
                max-width: 75px;
                height: auto;
            }
            .footer {
                text-align: right;
                margin-top: 50px;
            }
            .main-footer {
                position: fixed;
                bottom: 20px;
                width: 100%;
                text-align: center;
                font-size: 12px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="Logo" class="logo"> 
        <h1>Guide Report</h1>
        <div class="date-range">
            <strong>Start Date:</strong> ' . $startDate . '<br>
            <strong>End Date:</strong> ' . $endDate . '
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Guide Name</th>
                    <th>Booking Count</th>
                </tr>
            </thead>
            <tbody>';

        $rowNumber = 1;

        foreach ($reportData as $row) {
            // Ensure that the values are not NULL before accessing them
            $guideName = isset($row->guide_name) ? $row->guide_name : '';
            $bookingCount = isset($row->booking_count) ? $row->booking_count : 0;

            // Output the row in the table
            $html .= '<tr>
            <td>' . $rowNumber . '</td>
            <td>' . $guideName . '</td>
            <td>' . $bookingCount . '</td>
        </tr>';
            $rowNumber++;
        }

        $html .= '</tbody>
        </table>
        <div class="footer">
            Total Guide Bookings: ' . $totalGuideBookings . '<br>
        </div>
        <div class="main-footer">
            Generated by Your Company &copy; ' . date("Y") . '
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

        // Define the directory where PDF reports will be stored
        $directory = '../public/report/';

        // Generate a unique filename for the PDF report
        $filename = 'guide_report_' . uniqid() . '.pdf';

        // Save the PDF file to the directory
        file_put_contents($directory . $filename, $pdfContent);


        $created_date = date('Y-m-d');

        $reports = $this->BusinessmanagersModel->insertReport($filename,'Tour Guide Report', $startDate, $endDate,$created_date);

        //view pdf
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="guideReport.pdf"');
        header('Content-Length: ' . strlen($pdfContent));
        echo $pdfContent;
    }


    public function getReports(){

        $reports = $this->BusinessmanagersModel->getReports();

        if ($reports) {
            return $reports;
        } else {
            return [];
        }
    }

    public function getMonthlyData()
    {
        $bookingData = $this->BusinessmanagersModel->getBookingChartData();
        $cartBookingData = $this->BusinessmanagersModel->getCartBookingChartData();

        $chartData = array_merge($bookingData, $cartBookingData);
        $monthlyData = [];

        // Group by month-year and calculate total booking count for each month
        foreach ($chartData as $row) {
            $monthYear = date('Y-m', strtotime($row->bookingDate));
            if (!isset($monthlyData[$monthYear])) {
                $monthlyData[$monthYear] = 0;
            }
            // Increment the booking count for the corresponding month-year
            $monthlyData[$monthYear]++;
        }

        return $monthlyData;
    }


    public function getRevenueData()
    {
        $bookingData = $this->BusinessmanagersModel->getBookingChartData();
        $cartBookingData = $this->BusinessmanagersModel->getCartBookingChartData();


        $allBookingsData = array_merge($bookingData, $cartBookingData);
        $revenueData = [];

        // Iterate over all bookings to calculate revenue for each month
        foreach ($allBookingsData as $booking) {
            $monthYear = date('Y-m', strtotime($booking->bookingDate));

            // Calculate revenue for this booking (10% of payment_amount)
            $revenue = $booking->payment_amount * 0.1;

            // Add revenue to the corresponding month-year key
            if (!isset($revenueData[$monthYear])) {
                $revenueData[$monthYear] = 0;
            }
            $revenueData[$monthYear] += $revenue;
        }

//        var_dump($revenueData);

        return $revenueData;
    }


    public function getHotelRooms(){

            $hotelRooms = $this->BusinessmanagersModel->getHotelRooms();
//            var_dump($hotelRooms);

            if ($hotelRooms) {
                return $hotelRooms;
            } else {
                return [];
            }
    }

    public function getVehicles(){

        $vehicles = $this->BusinessmanagersModel->getVehicles();

        if ($vehicles) {
            return $vehicles;
        } else {
            return [];
        }

    }

    public function getGuides(){

        $guides = $this->BusinessmanagersModel->getGuides();

        if ($guides) {
            return $guides;
        } else {
            return [];
        }

    }

}
