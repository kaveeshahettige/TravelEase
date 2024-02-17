<?php

class LoggedTraveler extends Controller{
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->userModel=$this->model('User');
    }
    public function index(){
     $id = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($id);
    $bookings = $this->userModel->findBookingAvailable($id);
// $serviceProvider = $booking ? $this->userModel->findUserDetail($booking->serviceProvider_id) : null;
// Ensure $bookings is an array
if (!is_array($bookings)) {
  $bookings = []; // Initialize $bookings as an empty array
} 
$bookingDetailsArray=[];
foreach ($bookings as $booking) {
   //this is from room, vehicle, or package tables
   $furtherbookingDetails = $bookings ? $this->userModel->findBookingFurtherDetail($booking) : null;
  $mainbookingDetails = $booking ? $this->userModel->findBookingDetail($booking->type, $booking->serviceProvider_id) : null;


  $bookingDetailsArray[] = [
    'furtherBookingDetails' => $furtherbookingDetails,
    'mainbookingDetails' => $mainbookingDetails, 
    'bookingIDs' => $booking->booking_id,
    'serviceProviderID' => $booking->serviceProvider_id,
    'serviceProviderName' => $booking->fname,

];
}
     


///////////////////////////random service providers/////////////////////////////////////
$randomServiceProviders=$this->userModel->getRandomServiceProviders();
$service1Name = $this->userModel->findUserDetail($randomServiceProviders[0]->id);
$service1Details=$this->userModel->findBookingDetail($randomServiceProviders[0]->type,$randomServiceProviders[0]->id);
$service2Name = $this->userModel->findUserDetail($randomServiceProviders[1]->id);
$service2Details=$this->userModel->findBookingDetail($randomServiceProviders[1]->type,$randomServiceProviders[1]->id);
$service3Name = $this->userModel->findUserDetail($randomServiceProviders[2]->id);
$service3Details=$this->userModel->findBookingDetail($randomServiceProviders[2]->type,$randomServiceProviders[2]->id);

$data = [
    'id' => $id, // Remove the single quotes
    'email' => $user ? $user->email : null,
    'lname' => $user ? $user->lname : null,
    'fname' => $user ? $user->fname : null,
    'number' => $user ? $user->number : null,
    'profile_picture' => $user ? $user->profile_picture : null,
    // 'serviceProviderID' => $booking ? $booking->serviceProvider_id : null,
    
    // 'bookingDetails' => $bookingDetails,
    
    // 'picture' => $bookingDetails ? $bookingDetails->picture : null,
    'randomServiceProvider1Location'=>$service1Details ? $service1Details->city : null,
    'randomServiceProvider1Id'=>$service1Details ? $service1Details->user_id : null,
    'randomServiceProvider1Name'=>$service1Name ? $service1Name->fname . ' ' . $service1Name->lname : null,
    'randomServiceProvider2Location'=>$service2Details ? $service2Details->city : null,
    'randomServiceProvider2Id'=>$service2Details ? $service2Details->user_id : null,
    'randomServiceProvider2Name'=>$service2Name ? $service2Name->fname . ' ' . $service2Name->lname : null,
    'randomServiceProvider3Location'=>$service3Details ? $service3Details->city : null,
    'randomServiceProvider3Id'=>$service3Details ? $service3Details->user_id : null,
    'randomServiceProvider3Name'=>$service3Name ? $service3Name->fname . ' ' . $service3Name->lname : null,

    'bookingDetailsArray'=>$bookingDetailsArray,
    //'randomServiceProvider1Name'=>$service1Details ? $service1Details->fname . ' ' . $service1Details->lname : null,
    
];

      $this->view('loggedTraveler/index',$data);
    }
    public function hotel(){
      
    // $location = $_POST['location'];
    $id = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($id);
      $hotels=$this->userModel->getRandomHotels();

      $data=[
        'profile_picture' => $user ? $user->profile_picture : null, // Add the profile picture to the data array
        'hotels'=>$hotels,
      ];
      $this->view('loggedTraveler/hotel',$data);
    }
    public function transport(){
      $id = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($id);
      $data=[
        'profile_picture' => $user ? $user->profile_picture : null,
      ];
      $this->view('loggedTraveler/transport',$data);
    }
    public function package(){
      $data=[];
      $this->view('loggedTraveler/package',$data);
     }
    public function searchAll(){
      $data=[];
      $this->view('loggedTraveler/searchAll',$data);
    } 
    public function bookingdetails($Sid,$Bid){

      $id = $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      $serviceProvider = $this->userModel->findUserDetail($Sid);

      //from service provider table(hotel,travelagncy,pacjage tables)
      $mainbookingDetails = $serviceProvider ? $this->userModel->findBookingDetail($serviceProvider->type, $Sid) : null;
      
      //booking table booking data
      $booking = $this->userModel->findBooking($Bid);

      //find further booking details
      $furtherbookingDetails = $serviceProvider ? $this->userModel->findBookingFurtherDetail($booking) : null;

      $cancellationEligibility = $booking ? $this->userModel->checkCancellationEligibility($booking->booking_id) : null;
      
      
      // // Initializing an array to store further booking details for each booking
      // $furtherBookingDetailsArray = [];
      // $startDates;
      // $endDates;

      

      // foreach ($bookings as $booking) {
      //   //this is from room, vehicle, or package tables
      //   $furtherbookingDetails = $serviceProvider ? $this->userModel->findBookingFurtherDetail($booking) : null;
      //   //checking booking can be canceled or not
      //   $cancellationEligibility = $bookings ? $this->userModel->checkCancellationEligibility($booking->booking_id) : null;
        
      //   ////////////////////////////////////////////////////////////
      //   // Adding details to the array for each booking
      //   $furtherBookingDetailsArray[] = [
      //       'furtherBookingDetails' => $furtherbookingDetails, // Corrected variable name
      //       'cancellationEligibility' => $cancellationEligibility, // Corrected variable name
      //       'startDates' => $booking->startDate,
      //       'endDates' => $booking->endDate,
            
      //   ];
    // }
    
      $data=[
        'serviceProviderName' => $serviceProvider ? $serviceProvider->fname . ' ' . $serviceProvider->lname : null,
        'type' => $serviceProvider ? $serviceProvider->type : null,
        'profile_picture' => $user ? $user->profile_picture : null,
        'number' => $serviceProvider ? $serviceProvider->number : null,
        'location' => $mainbookingDetails ? $mainbookingDetails->city : null,
        'serviceDescription' => $mainbookingDetails ? $mainbookingDetails->description : null,
        'mainbookingDetails' => $mainbookingDetails,
        'furtherBookingDetails' => $furtherbookingDetails,
        'booking' => $booking,
        'cancellationEligibility' => $cancellationEligibility,
      ];
      $this->view('loggedTraveler/bookingdetails',$data);
    }
    public function bookingpayment($type,$serviceid,$checkinDate,$checkoutDate){

      $id = $_SESSION['user_id'];
        $user=$this->userModel->findUserDetail($id);
        //from service provider table(hotel,travelagncy,pacjage tables)
        $furtherBookingDetails=$this->userModel->findBookingDetailByServiceid($type,$serviceid);
        $data=[
          'furtherBookingDetails' => $furtherBookingDetails,
          'user' => $user,
          'checkinDate'=>$checkinDate,
          'checkoutDate'=>$checkoutDate,
        ];
        $this->view('loggedTraveler/bookingpayment',$data);
      
    }

    public function tripfurtherdetail($Sid){

      $servicProvider=$this->userModel->findUserDetail($Sid);
      $user=$this->userModel->findUserDetail($_SESSION['user_id']);
      //main booking details from service provider table(hotel,travelagncy,package tables)
      $bookingDetails = $servicProvider ? $this->userModel->findBookingDetail($servicProvider->type, $Sid) : null;
      $rooms=$bookingDetails?$this->userModel->findRooms($bookingDetails->hotel_id) : null;
      $data=[
        'email' => $servicProvider ? $servicProvider->email : null,
        'serviceProviderName' => $servicProvider ? $servicProvider->fname . ' ' . $servicProvider->lname : null,
        'profile_picture' => $user ? $user->profile_picture : null,
        'serviceProvideNumber'=>$servicProvider ? $servicProvider->number : null,
        'hotel_image'=>$servicProvider?$servicProvider->profile_picture:null,
        'type' => $servicProvider ? $servicProvider->type : null,
        'bookingDetails' => $bookingDetails,
        'rooms'=>$rooms,
      ];
      $this->view('loggedTraveler/tripfurtherdetail',$data);
    }

    //dopayment
    public function dopayment($type, $serviceid,$checkinDate,$checkoutDate)
{
    $id = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($id);
    // from service provider table(hotel, travel agency, package tables)
    $furtherBookingDetails = $this->userModel->findBookingDetailByServiceid($type, $serviceid);

    require __DIR__ . "./../libraries/stripe/vendor/autoload.php";
    $stripe_secret_key = "sk_test_51Ocov6EA71SQLGmwC6ccRw0MOKifZar2SWG5ln18XfHjkQN2zMp1wG9XOjVf2Q7mjMSEjrCsL1V8jGKQuYOCp8Un00rNzNhS2c";

    \Stripe\Stripe::setApiKey($stripe_secret_key);
    $checkout_session = \Stripe\Checkout\Session::create([
        'mode' => 'payment',
        'success_url' => "http://localhost/TravelEase/loggedTraveler/paymentSuccessful",
        'line_items' => [[
            'quantity' => 1,
            'price_data' => [
                'currency' => 'lkr',
                'unit_amount' => $furtherBookingDetails->price * 100,
                'product_data' => [
                    'name' => $furtherBookingDetails->description,
                ],
            ],
        ]],
        'cancel_url' => 'https://example.com/cancel',
    ]);

    // After successful payment, update the database with transaction details
    $transactionData = [
        'user'=>$user,
        'furtherBookingDetails' => $furtherBookingDetails,
        'transaction_id' => $checkout_session->payment_intent,
        'checkinDate'=>$checkinDate,
        'checkoutDate'=>$checkoutDate,
        // Add any other relevant transaction details
    ];

    // Assuming you have a method in your model to update the database with transaction details
    //add to booking table
    $this->userModel->addBooking($transactionData);
    $lastBooking=$this->userModel->getLastBooking();
    $this->userModel->addPaymentDetails($transactionData,$lastBooking->booking_id);
    $this->userModel->addUnavailabilty($transactionData);

    // Redirect the user to the Checkout session URL
    http_response_code(303);
    header("Location: " . $checkout_session->url);
}

// public function dopayment($type, $serviceid, $checkinDate, $checkoutDate)
// {
//     $id = $_SESSION['user_id'];
//     $user = $this->userModel->findUserDetail($id);
//     $furtherBookingDetails = $this->userModel->findBookingDetailByServiceid($type, $serviceid);

//     require __DIR__ . "./../libraries/stripe/vendor/autoload.php";
//     $stripe_secret_key = "sk_test_51Ocov6EA71SQLGmwC6ccRw0MOKifZar2SWG5ln18XfHjkQN2zMp1wG9XOjVf2Q7mjMSEjrCsL1V8jGKQuYOCp8Un00rNzNhS2c";

//     \Stripe\Stripe::setApiKey($stripe_secret_key);
//     $checkout_session = \Stripe\Checkout\Session::create([
//         'mode' => 'payment',
//         'success_url' => "http://localhost/TravelEase/bookingpayment/{$type}/{$serviceid}",
//         'line_items' => [[
//             'quantity' => 1,
//             'price_data' => [
//                 'currency' => 'lkr',
//                 'unit_amount' => $furtherBookingDetails->price * 100,
//                 'product_data' => [
//                     'name' => $furtherBookingDetails->description,
//                 ],
//             ],
//         ]],
//         'cancel_url' => 'https://example.com/cancel',
//     ]);

//     // Store the session ID in your database for later reference
//     $this->userModel->storeCheckoutSessionId($checkout_session->id,$id);

//     // Redirect the user to the Checkout session URL
//     http_response_code(303);
//     header("Location: " . $checkout_session->url);
// }

// // Add a separate endpoint to handle the successful payment
// public function handleSuccessfulPayment($type, $serviceid)
// {
//     $id = $_SESSION['user_id'];
//     $user = $this->userModel->findUserDetail($id);
//     $furtherBookingDetails = $this->userModel->findBookingDetailByServiceid($type, $serviceid);

//     require __DIR__ . "./../libraries/stripe/vendor/autoload.php";
//     $stripe_secret_key = "sk_test_51Ocov6EA71SQLGmwC6ccRw0MOKifZar2SWG5ln18XfHjkQN2zMp1wG9XOjVf2Q7mjMSEjrCsL1V8jGKQuYOCp8Un00rNzNhS2c";

//     \Stripe\Stripe::setApiKey($stripe_secret_key);

//     // Retrieve the session ID from your database
//     $checkout_session_id = $this->userModel->getCheckoutSessionId($user->id);

//     // Retrieve the Checkout session to verify the payment
//     $checkout_session = \Stripe\Checkout\Session::retrieve($checkout_session_id);

//     // Verify that the payment is successful
//     if ($checkout_session->payment_intent && $checkout_session->payment_intent->status === 'succeeded') {
//         // Update your database with the confirmed payment details
//         $transactionData = [
//             'user' => $user,
//             'furtherBookingDetails' => $furtherBookingDetails,
//             'transaction_id' => $checkout_session->payment_intent,
//             'checkinDate' => $checkinDate,
//             'checkoutDate' => $checkoutDate,
//             // Add any other relevant transaction details
//         ];

//         // Update the booking table, payment details, and unavailability
//         $this->userModel->addBooking($transactionData);
//         $lastBooking = $this->userModel->getLastBooking();
//         $this->userModel->addPaymentDetails($transactionData, $lastBooking->booking_id);
//         $this->userModel->addUnavailabilty($transactionData);
        
//         // Clear the stored session ID after processing the successful payment
//         $this->userModel->clearCheckoutSessionId($user->id);

//         // Redirect or show a success message to the user
//         header("Location: http://localhost/TravelEase/bookingpayment/{$type}/{$serviceid}");
//     } else {
//         // Handle the case where the payment was not successful
//         header("Location: /error-page");
//     }
// }


//fetchAvailableRooms
public function fetchAvailableRooms()
{
  error_log("fetchAvailableRooms function is executed");
  $checkinDate = $_GET['checkin'];
  $checkoutDate = $_GET['checkout'];
  $hotelId = $_GET['hotelid'];

  // var_dump($checkinDate, $checkoutDate, $hotelId);
    ////
    // $servicProvider = $this->userModel->findUserDetail($Sid);
    
    // $bookingDetails = $servicProvider ? $this->userModel->findBookingDetail(3, $Sid) : null;

    $html = '';
    $rooms = $this->userModel->findAvailableRooms($checkinDate, $checkoutDate, $hotelId);
    if (!empty($rooms) && is_array($rooms)) {
        foreach ($rooms as $room) {
            $html .= '<tr class="t-row">';
            $html .= '<td>' . $room->room_id . '</td>';
            $html .= '<td>' . $room->roomType . '</td>';
            $html .= '<td>' . $room->description . '</td>';
            $html .= '<td>' . $room->price . '</td>';
            $html .= '<td><button class="view-button" onclick="booking(3, ' . $room->room_id . ', \'' . $checkinDate . '\', \'' . $checkoutDate . '\')">Book Now</button></td>';
            $html .= '</tr>';
        }
    } else {
        $html = '<tr><td colspan="6">No Rooms available right now</td></tr>';
    }

    echo $html;
    exit;
     
}

public function paymentSuccessful(){
  $data=[];
  $this->view('loggedTraveler/paymentSuccessful',$data);
}

//removeBooking
public function cancelBooking($bookingId)
{
    $cancel = $this->userModel->cancelBooking($bookingId);
    ///////////////below should be developed///////////
    //system user should be refunded
    //service provider should be notified about the bookingg cancellation
    //should remove the unavailabilty

    if ($cancel) {
        // Booking cancellation successful
        echo '<script>alert("Trip has been cancelled. You will be refunded.");';
        echo 'window.location.href = "/Travelease/loggedTraveler/index";</script>';
    } else {
        // Booking cancellation failed
        echo '<script>alert("Failed to cancel the trip. Please try again.");';
        echo 'window.location.href = "/Travelease/loggedTraveler/index";</script>';
    }
}

//serachhotels
public function searchHotels()
{
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Perform the search operation
        $location = $_POST['location'];
        $user = $this->userModel->findUserDetail($_SESSION['user_id']);
        $hotels = $this->userModel->findHotels($location);

        // Pass the search results to the view and load it
        $data = [
            'hotels' => $hotels,
            'profile_picture' => $user ? $user->profile_picture : null,
            'location' => $location,
        ];
        $this->view('loggedTraveler/hotel', $data);
        exit; // Ensure that script execution stops after loading the view
    } else {
        // If the request method is not POST, redirect to a different URL
        header('Location: /TravelEase/loggedTraveler'); // Redirect to the main page or another appropriate URL
        exit; // Ensure that script execution stops after the redirect
    }
}


}


