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
    'temporyIDs' => $booking->temporyid,
    'serviceProviderID' => $booking->serviceProvider_id,
    'serviceProviderName' => $booking->fname,
    'type'=>$booking->type,

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
$service1Ratings = $this->userModel->getRatings($randomServiceProviders[0]->id);
$service2Ratings = $this->userModel->getRatings($randomServiceProviders[1]->id);
$service3Ratings = $this->userModel->getRatings($randomServiceProviders[2]->id);



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
    'service1Ratings' => $service1Ratings ? $service1Ratings : null,
    'service2Ratings' => $service2Ratings ? $service2Ratings : null,
    'service3Ratings' => $service3Ratings ? $service3Ratings : null,
    'service1pp' => $service1Name ? $service1Name->profile_picture : null,
    'service2pp' => $service2Name ? $service2Name->profile_picture : null,
    'service3pp' => $service3Name ? $service3Name->profile_picture : null,
   
    //'service1Name'=>$service1Name,

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
    //$ratings = $this->userModel->getRatings($hotels->id);

    // Initialize an empty array to store ratings for each hotel
$ratings = [];

// Iterate through each hotel
foreach ($hotels as $hotel) {
    // Fetch ratings for the current hotel
    $hotelRatings = $this->userModel->getRatings($hotel->user_id);
    
    // Store ratings in the ratings array with hotel id as key
    $ratings[$hotel->hotel_id] = $hotelRatings;
}

// Iterate through each hotel again to add ratings to the hotel data
foreach ($hotels as &$hotel) {
    // Add ratings to the hotel data
    $hotel->ratings = isset($ratings[$hotel->hotel_id]) ? $ratings[$hotel->hotel_id] : null;
}

      $data=[
        'profile_picture' => $user ? $user->profile_picture : null, // Add the profile picture to the data array
        'hotels'=>$hotels,
      ];
      $this->view('loggedTraveler/hotel',$data);
    }


public function transport(){
      $id = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($id);
    $agencies=$this->userModel->getRandomAgencies();
     // Initialize an empty array to store ratings for each hotel
$ratings = [];

// Iterate through each hotel
foreach ($agencies as $agency) {
    // Fetch ratings for the current hotel
    $agencyRatings = $this->userModel->getRatings($agency->user_id);
    
    // Store ratings in the ratings array with hotel id as key
    $ratings[$agency->agency_id] = $agencyRatings;
}

// Iterate through each hotel again to add ratings to the hotel data
foreach ($agencies as $agency) {
    // Add ratings to the hotel data
    $agency->ratings = isset($ratings[$agency->agency_id]) ? $ratings[$agency->agency_id] : null;
}


      $data=[
        'profile_picture' => $user ? $user->profile_picture : null,
        'agencies'=>$agencies,
      ];
      $this->view('loggedTraveler/transport',$data);
    }
    public function package(){
      $id = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($id);
    $packages=$this->userModel->getRandomPackages();
      $data=[
        'profile_picture' => $user ? $user->profile_picture : null,
        'packages'=>$packages,  
      ];
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
    $vehicleprice=null;
    $driver=null;
    if($serviceProvider->type==4){
      $vehicleprice=$this->userModel->findVehiclePrice($Bid);
      $driver=$this->userModel->findDriverAvilability($Bid);
    }
    
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
        'vehicleprice'=>$vehicleprice?$vehicleprice:null,
        'driver'=>$driver?$driver:null,
      ];
      $this->view('loggedTraveler/bookingdetails',$data);
    }
    /////////
    public function bookingdetailsCart($Tid,$Sid,$Bid){
        $newTid=$Tid;
        $id = $_SESSION['user_id'];
        $user=$this->userModel->findUserDetail($id);
        $serviceProvider = $this->userModel->findUserDetail($Sid);
        // echo "<script>";
        //   echo "console.log('Booking ID:');";
        //   echo "</script>";
      
      
      
        //from service provider table(hotel,travelagncy,pacjage tables)
        $mainbookingDetails = $serviceProvider ? $this->userModel->findBookingDetail($serviceProvider->type, $Sid) : null;
        
        //booking table booking data
        $booking = $this->userModel->findCartBooking($Bid,$Tid);
      
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
      $vehicleprice=null;
      $driver=null;
      if($serviceProvider->type==4){
        $vehicleprice=$this->userModel->findCartVehiclePrice($Bid);
        $driver=$this->userModel->findDriverAvilabilityCart($Bid);
      }
      
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
          'vehicleprice'=>$vehicleprice?$vehicleprice:null,
          'driver'=>$driver?$driver:null,
          'Tid'=>$newTid,
        ];
        $this->view('loggedTraveler/bookingdetails',$data);
      }
    ////////
    public function bookingpayment($type,$serviceid,$checkinDate,$checkoutDate,$pickupTime = null){

      $id = $_SESSION['user_id'];
        $user=$this->userModel->findUserDetail($id);
        //from service provider table(hotel,travelagncy,pacjage tables)
        $furtherBookingDetails=$this->userModel->findBookingDetailByServiceid($type,$serviceid);
        if ($type == 4) {
          // Calculate the number of days between check-in and check-out dates
          $numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24)+1; 
          // Calculate the total price for the booking
          $price = $furtherBookingDetails->priceperday * $numDays;

          if ($pickupTime !== null) {
            $pickupTime = date("g:i A", strtotime($pickupTime));       
        }
      }
      
      $data = [
        'furtherBookingDetails' => $furtherBookingDetails,
        'user' => $user,
        'checkinDate' => $checkinDate,
        'checkoutDate' => $checkoutDate,
        'type' => $type,
        'pickupTime' => $pickupTime ? $pickupTime : ''
    ];
    
    if ($type == 4) {
        $data['price'] = $price ? $price : 0;
    }
    
        $this->view('loggedTraveler/bookingpayment',$data);
      
    }

    //////////
    public function viewDeal($type,$serviceid,$checkinDate,$checkoutDate,$pickupTime = null){

      $id = $_SESSION['user_id'];
        $user=$this->userModel->findUserDetail($id);
        //from service provider table(hotel,travelagncy,pacjage tables)
        $furtherBookingDetails=$this->userModel->findBookingDetailByServiceid($type,$serviceid);
        if ($type == 4) {
          // Calculate the number of days between check-in and check-out dates
          $numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24)+1; 
          // Calculate the total price for the booking
          $price = $furtherBookingDetails->priceperday * $numDays;

          if ($pickupTime !== null) {
            $pickupTime = date("g:i A", strtotime($pickupTime));       
        }
      }
      
      $data = [
        'furtherBookingDetails' => $furtherBookingDetails,
        'user' => $user,
        'checkinDate' => $checkinDate,
        'checkoutDate' => $checkoutDate,
        'type' => $type,
        'pickupTime' => $pickupTime ? $pickupTime : ''
    ];
    
    if ($type == 4) {
        $data['price'] = $price ? $price : 0;
    }
    
        $this->view('loggedTraveler/viewDeal',$data);
      
    }
    ///////////

    public function tripfurtherdetail($Sid){

      $servicProvider=$this->userModel->findUserDetail($Sid);
      $user=$this->userModel->findUserDetail($_SESSION['user_id']);
      //main booking details from service provider table(hotel,travelagncy,package tables)
      $bookingDetails = $servicProvider ? $this->userModel->findBookingDetail($servicProvider->type, $Sid) : null;
      $feedbacks = $servicProvider ? $this->userModel->findFeedbacks($Sid) : null;
      if($servicProvider->type==3){
        $rooms=$bookingDetails?$this->userModel->findRooms($bookingDetails->hotel_id) : null;
        $vehicles=null;
        $NoVehicles=0;
      }else if($servicProvider->type==4){
        $rooms=null;
        $NoVehicles=$bookingDetails?$this->userModel->findNoOfVehicles($bookingDetails->agency_id) : null;
        $vehicles=$bookingDetails?$this->userModel->findVehicles($bookingDetails->agency_id) : null;
      }else if($servicProvider->type==5){
        $rooms=null;
        $NoVehicles=0;
        $vehicles=null;
        //$packages=$bookingDetails?$this->userModel->findPackages($bookingDetails->) : null
      }
      
      $data=[
        'email' => $servicProvider ? $servicProvider->email : null,
        'serviceProviderName' => $servicProvider ? $servicProvider->fname . ' ' . $servicProvider->lname : null,
        'profile_picture' => $user ? $user->profile_picture : null,
        'serviceProvideNumber'=>$servicProvider ? $servicProvider->number : null,
        'service_image'=>$servicProvider?$servicProvider->profile_picture:null,
        'type' => $servicProvider ? $servicProvider->type : null,
        'bookingDetails' => $bookingDetails,
        'rooms'=>$rooms?$rooms:null,
        'NoVehicles'=>$NoVehicles?$NoVehicles:0,
        'vehicles'=>$vehicles?$vehicles:null,
        'feedbacks'=>$feedbacks?$feedbacks:null,
      ];
      $this->view('loggedTraveler/tripfurtherdetail',$data);
    }

    //dopayment for hotels
    public function dopayment($type, $serviceid, $checkinDate, $checkoutDate) {
      // Retrieve user details
      $id = $_SESSION['user_id'];
      $user = $this->userModel->findUserDetail($id);
  
      // Retrieve booking details
      $furtherBookingDetails = $this->userModel->findBookingDetailByServiceid($type, $serviceid);
  
      // Construct transaction data
      $transactionData = [
          'user' => $user,
          'furtherBookingDetails' => $furtherBookingDetails,
          'checkinDate' => $checkinDate,
          'checkoutDate' => $checkoutDate,
          // Add any other relevant transaction details
      ];
  
      // Create a Stripe Checkout session
      require __DIR__ . "./../libraries/stripe/vendor/autoload.php";
      $stripe_secret_key = "sk_test_51Ocov6EA71SQLGmwC6ccRw0MOKifZar2SWG5ln18XfHjkQN2zMp1wG9XOjVf2Q7mjMSEjrCsL1V8jGKQuYOCp8Un00rNzNhS2c";
      \Stripe\Stripe::setApiKey($stripe_secret_key);
      $checkout_session = \Stripe\Checkout\Session::create([
          'mode' => 'payment',
          'success_url' => "http://localhost/TravelEase/loggedTraveler/paymentSuccessful/3",
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
  
      // Store the Stripe Checkout session ID in the transaction data
      $transactionData['stripe_session_id'] = $checkout_session->id;

      //
      

  
      // Store the transaction data in the session or database for retrieval in the paymentSuccessful() function
      $_SESSION['transaction_data'] = $transactionData;
  
      // Redirect the user to the Stripe Checkout session URL
      http_response_code(303);
      header("Location: " . $checkout_session->url);
  }
  
  public function paymentSuccessful($type) {
      // Check if transaction data exists in the session
      if (isset($_SESSION['transaction_data'])) {
          // Retrieve transaction data from the session
          $transactionData = $_SESSION['transaction_data'];
  
          // Add the transaction data to the database based on the type
          if ($type == 3) {
              $this->userModel->addBooking($transactionData);
              $lastBooking = $this->userModel->getLastBooking();
              $this->userModel->addPaymentDetails($transactionData, $lastBooking->booking_id);
              $this->userModel->addUnavailability($transactionData);
          } elseif ($type == 4) {
              // Retrieve driver and price from transaction data
              $driver = $transactionData['driver'];
              $price = $transactionData['price'];
  
              // Add to booking table
              $this->userModel->addBooking($transactionData);
              $lastBooking = $this->userModel->getLastBooking();
              $this->userModel->addVehicleBooking($lastBooking->booking_id,$transactionData, $driver); // Booking to vehicle booking table
              $this->userModel->addPaymentDetailsVehicles($transactionData, $lastBooking->booking_id, $price);
          }
  
          // Optionally, you can pass data to the view if needed
          $data = [
              // Add any data you want to pass to the view
              'transaction'=>$transactionData,
          ];
  
          // Load the view for the payment successful page
          $this->view('loggedTraveler/paymentSuccessful', $data);
      } else {
          // Handle the case where transaction data is missing
          // Redirect the user to an error page or perform any other action as needed
      }
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
            $html .= '<td><button class="view-button" onclick="booking(3, ' . $room->room_id . ', \'' . $checkinDate . '\', \'' . $checkoutDate . '\')">View</button></td>';
            $html .= '</tr>';
        }
    } else {
        $html = '<tr><td colspan="6">No Rooms available right now</td></tr>';
    }

    echo $html;
    exit;
     
}




// //removeBooking
// public function cancelBooking($bookingId)
// {
//     $cancel = $this->userModel->cancelBooking($bookingId);
//     ///////////////below should be developed///////////
//     //system user should be refunded
//     //service provider should be notified about the bookingg cancellation
//     //should remove the unavailabilty

//     if ($cancel) {
//         // Booking cancellation successful
//         echo '<script>alert("Trip has been cancelled. You will be refunded.");';
//         echo 'window.location.href = "/Travelease/loggedTraveler/index";</script>';
//     } else {
//         // Booking cancellation failed
//         echo '<script>alert("Failed to cancel the trip. Please try again.");';
//         echo 'window.location.href = "/Travelease/loggedTraveler/index";</script>';
//     }
// }

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


//searchVehicles
public function searchVehicles()
{
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Perform the search operation
        $location = $_POST['location'];
        $checkinDate = $_POST['pickupdate'];
        $checkinTime = $_POST['pickuptime'];
        $checkoutDate = $_POST['dropoffdate'];
        $user = $this->userModel->findUserDetail($_SESSION['user_id']);
        $vehicles = $this->userModel->findVehiclesByLocation($location, $checkinDate, $checkoutDate);

        // Pass the search results to the view and load it
        $data = [
            'vehicles' => $vehicles,
            'profile_picture' => $user ? $user->profile_picture : null,
            'location' => $location,
            'checkinDate' => $checkinDate,
            'checkinTime' => $checkinTime,
            'checkoutDate' => $checkoutDate,
        ];
        $this->view('loggedTraveler/searchVehicles', $data);
        exit; // Ensure that script execution stops after loading the view
    } else {
        // If the request method is not POST, redirect to a different URL
        header('Location: /TravelEase/loggedTraveler'); // Redirect to the main page or another appropriate URL
        exit; // Ensure that script execution stops after the redirect
    }
}


//fetchAvailableVehicles
public function fetchAvailableVehicles()
{
    // Log that the function is executed
    error_log("fetchAvailableVehicles function is executed");

    // Retrieve parameters from the GET request
    $pickupDate = $_GET['pickupDate'];
    $pickupTime = $_GET['pickupTime'];
    $dropoffDate = $_GET['dropoffDate'];
    // $dropoffTime = $_GET['dropoffTime'];
    $agencyId = $_GET['agencyId'];

    // Retrieve available vehicles from the model
    $vehicles = $this->userModel->findAvailableVehicles($pickupDate, $dropoffDate, $agencyId);



    // Start building the HTML response
    $html = '<tbody>';

    // Initialize counter
    $count = 1;

    // Check if vehicles are found
    if (!empty($vehicles) && is_array($vehicles)) {
        // Iterate over each vehicle and construct HTML
        foreach ($vehicles as $vehicle) {
            $html .= '<tr class="t-row">';
            $html .= '<td>' . $count . '</td>';
            $html .= '<td>' . $vehicle->brand . '</td>';
            $html .= '<td>' . $vehicle->model . '</td>';
            $html .= '<td>' . $vehicle->plate_number . '</td>';
            $html .= '<td>' . $vehicle->fuel_type . '</td>';
            $html .= '<td>' . $vehicle->year . '</td>';
            $html .= '<td>' . $vehicle->seating_capacity . '</td>';
            // Construct the button to book the vehicle
            //hidden input to take pickyptime
$html .= '<input type="hidden" id="pickupTime" value="' . $pickupTime . '">';
            
            $html .= '<td><button class="view-button" onclick="booking(4, ' . $vehicle->vehicle_id . ', \'' . $pickupDate . '\', \'' . $dropoffDate . '\')">View</button></td>';
            $html .= '</tr>';
            $count++;
        }
    } else {
        // If no vehicles are found, display a message
        $html .= '<tr><td colspan="7">No Vehicles available right now</td></tr>';
    }

    // Complete the HTML response
    $html .= '</tbody>';

    // Output HTML and exit
    echo $html;
    exit; 
}


//dopaymentVehicles
public function dopaymentVehicles($type, $serviceid, $checkinDate, $checkoutDate,$pickupTime,$price,$driver)
{
    $id = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($id);

    //from vehicles
    $furtherBookingDetails = $this->userModel->findBookingDetailByServiceid($type,$serviceid);

    // After successful payment, update the database with transaction details
    $transactionData = [
      'user' => $user,
      'furtherBookingDetails' => $furtherBookingDetails,
      // 'transaction_id' => $checkout_session->payment_intent,
      'checkinDate' => $checkinDate,
      'checkoutDate' => $checkoutDate,
      'pickupTime' => $pickupTime,
        'price' => $price,
        'driver' => $driver,
      // Add any other relevant transaction details
  ];


    require __DIR__ . "./../libraries/stripe/vendor/autoload.php";
    $stripe_secret_key = "sk_test_51Ocov6EA71SQLGmwC6ccRw0MOKifZar2SWG5ln18XfHjkQN2zMp1wG9XOjVf2Q7mjMSEjrCsL1V8jGKQuYOCp8Un00rNzNhS2c";

    \Stripe\Stripe::setApiKey($stripe_secret_key);
    $checkout_session = \Stripe\Checkout\Session::create([
        'mode' => 'payment',
        'success_url' => "http://localhost/TravelEase/loggedTraveler/paymentSuccessful/4",
        'line_items' => [[
            'quantity' => 1,
            'price_data' => [
                'currency' => 'lkr',
                'unit_amount' => $price * 100,
                'product_data' => [
                    'name' => $furtherBookingDetails->description,
                ],
            ],
        ]],
        'cancel_url' => 'https://example.com/cancel',
    ]);

    // Store the Stripe Checkout session ID in the transaction data
    $transactionData['stripe_session_id'] = $checkout_session->id;

    // Store the transaction data in the session or database for retrieval in the paymentSuccessful() function
    $_SESSION['transaction_data'] = $transactionData;

    // Redirect the user to the Stripe Checkout session URL
    http_response_code(303);
    header("Location: " . $checkout_session->url);


}

//fetchPriceWithDriver
public function fetchPriceWithDriver()
{
    $driverType = isset($_GET['driverType']) ? $_GET['driverType'] : null;
    $vehicleId = isset($_GET['vehicleId']) ? $_GET['vehicleId'] : null;
    $days=isset($_GET['days']) ? $_GET['days'] : null;

    if ($driverType !== null && $vehicleId !== null) {
        $vehicleDetail = $this->userModel->fetchPriceByDriverTypeAndVehicleId($vehicleId);
        $price=($vehicleDetail->withDriverPerDay+$vehicleDetail->priceperday)*$days;
        if ($price !== false) {
            header('Content-Type: application/json'); // Set response header
            echo json_encode(['price' => $price]);
            return;
        }
    }

    http_response_code(500);
    header('Content-Type: application/json'); // Set response header
    echo json_encode(['error' => 'Failed to fetch price']);
}

public function plantrip(){
  //post
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform the search operation
    $location = $_POST['location'];
    $checkinDate = $_POST['checkinDate'];
    $checkoutDate = $_POST['checkoutDate'];
    // $checkinDate = date('Y-m-d', strtotime($checkinDate));
    // $checkoutDate = date('Y-m-d', strtotime($checkoutDate));

    $city=$this->userModel->findCitydetails($location);
    $places = $this->userModel->findPlaces($location);
    $user = $this->userModel->findUserDetail($_SESSION['user_id']);
    $hotels = $this->userModel->findAvailableHotelRooms($location, $checkinDate, $checkoutDate);
    $vehicles = $this->userModel->findAvailableVehiclesByLocation($location, $checkinDate, $checkoutDate);
    //$packages = $this->userModel->findPackages($location);


    $vehiclePrices = []; // Array to hold prices for each vehicle
//////////
    $city=$this->userModel->findCitydetails($location);
    $places = $this->userModel->findPlaces($location);
    $user = $this->userModel->findUserDetail($_SESSION['user_id']);
    $hotels = $this->userModel->findAvailableHotelRooms($location, $checkinDate, $checkoutDate);
    $vehicles = $this->userModel->findAvailableVehiclesByLocation($location, $checkinDate, $checkoutDate);
    //$packages = $this->userModel->findPackages($location);


          $vehiclePrices = []; // Array to hold prices for each vehicle

          // Initialize an empty array to store ratings for each hotel
$ratings = [];

// Iterate through each hotel
foreach ($hotels as $hotel) {
    // Fetch ratings for the current hotel
    $roomRatings = $this->userModel->getRatingsOfRooms($hotel->room_id);
    
    // Store ratings in the ratings array with hotel id as key
    $ratings[$hotel->room_id] = $roomRatings;
}

// Iterate through each hotel again to add ratings to the hotel data
foreach ($hotels as &$hotel) {
    // Add ratings to the hotel data
    $hotel->ratings = isset($ratings[$hotel->room_id]) ? $ratings[$hotel->room_id] : null;
}
////////////////
// Initialize an empty array to store ratings for each hotel
$vratings = [];

// Iterate through each hotel
foreach ($vehicles as $vehicle) {
    // Fetch ratings for the current hotel
    $vehicleRatings = $this->userModel->getRatingsOfVehicles($vehicle->vehicle_id);
    
    // Store ratings in the ratings array with hotel id as key
    $vratings[$vehicle->vehicle_id] = $vehicleRatings;
}

// Iterate through each hotel again to add ratings to the vehcle data
foreach ($vehicles as &$vehicle) {
    // Add ratings to the vehicle data
    $vehicle->vratings = isset($vratings[$vehicle->vehicle_id]) ? $vratings[$vehicle->vehicle_id] : null;
}

/////////

if ($vehicles) {
foreach ($vehicles as $vehicle) {
  // Assuming you have a method to find prices for a specific vehicle and dates
  $prices = $this->userModel->findVehiclePrices($vehicle->vehicle_id);
  //prices per data gap
  $numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24)+1;
  $totalPrice = $prices->priceperday * $numDays;
  
  // Add prices to the vehiclePrices array
  $vehiclePrices[$vehicle->vehicle_id] = $totalPrice; // Assuming vehicle_id is unique
}
} else {
//echo "No vehicles available";
}


    // Pass the search results to the view and load it
    $data = [
      'places' => $places,
      'city' => $city, 
        'hotelrooms' => $hotels,
        // 'agencies' => $agencies,
        // 'packages' => $packages,
        'vehiclePrices'=>$vehiclePrices,
        'vehicles' => $vehicles,
        'profile_picture' => $user ? $user->profile_picture : null,
        'location' => $location,
        'checkinDate' => $checkinDate,
        'checkoutDate' => $checkoutDate,
    ];
    $this->view('loggedTraveler/plantripServices', $data);
    exit; 
 }else{
  $data=[];
  $this->view('loggedTraveler/plantrip',$data);
 }

}

 //searchAllServices
  public function searchAllServices(){
      // Check if the request method is POST
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Perform the search operation
          $location = $_POST['location'];
          $checkinDate = $_POST['checkinDate'];
          $checkoutDate = $_POST['checkoutDate'];
          // $checkinDate = date('Y-m-d', strtotime($checkinDate));
          // $checkoutDate = date('Y-m-d', strtotime($checkoutDate));

          $city=$this->userModel->findCitydetails($location);
      $places = $this->userModel->findPlaces($location);
      if (!$city && !$places) {
        // Echo the HTML for the modal
        echo "
        <div id='myModali' class='modali' style='display: block;'>
            <div class='modali-content'>
                <span class='closei'>&times;</span>
                <h2>No Matching Locations Found</h2>
                <p>We couldn't find any locations matching your search.</p>
                <p>Please try again or contact support for assistance.</p>
            </div>
        </div>";
    
        // Include modal JavaScript and CSS
        echo "<script src='" . URLROOT . "js/loggedTraveler/script.js'></script>";
        echo "<link rel='stylesheet' type='text/css' href='" . URLROOT . "css/loggedTraveler/style.css'>";
    
        // JavaScript to handle modal close and redirection
        echo "
        <script>
            // Function to close the modal
            function closeModal() {
                var modal = document.getElementById('myModali');
                if (modal) {
                    modal.style.display = 'none';
                }
            }
    
            // When the user clicks on the close button, close the modal
            var closeButton = document.querySelector('.closei');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    closeModal();
                    window.location.href = '/TravelEase/loggedTraveler/index';
                });
            }
    
            // Redirect to index after a delay
            setTimeout(function() {
                window.location.href = '/TravelEase/loggedTraveler/index';
            }, 5000); // Adjust the delay as needed
        </script>";
    
        exit;
    }
    
    else{
      $user = $this->userModel->findUserDetail($_SESSION['user_id']);
      $hotels = $this->userModel->findAvailableHotelRooms($location, $checkinDate, $checkoutDate);
      $vehicles = $this->userModel->findAvailableVehiclesByLocation($location, $checkinDate, $checkoutDate);
      //$packages = $this->userModel->findPackages($location);


      $vehiclePrices = []; // Array to hold prices for each vehicle

     // Check if $hotels is iterable (array or object)
if (is_iterable($hotels)) {
// Initialize an empty array to store ratings for each hotel
$ratings = [];

// Iterate through each hotel
foreach ($hotels as $hotel) {
  // Fetch ratings for the current hotel
  $roomRatings = $this->userModel->getRatingsOfRooms($hotel->room_id);
  
  // Store ratings in the ratings array with hotel id as key
  $ratings[$hotel->room_id] = $roomRatings;
}

// Iterate through each hotel again to add ratings to the hotel data
foreach ($hotels as &$hotel) {
  // Add ratings to the hotel data
  $hotel->ratings = isset($ratings[$hotel->room_id]) ? $ratings[$hotel->room_id] : null;
}
} else {
// Handle the case where $hotels is not iterable
// For example, display a message indicating no hotels are available
//echo "No hotels available.";
}

////////////////
// Check if $vehicles is iterable (array or object)
if (is_iterable($vehicles)) {
// Initialize an empty array to store vehicle ratings
$vratings = [];

// Iterate through each vehicle
foreach ($vehicles as $vehicle) {
    // Fetch ratings for the current vehicle
    $vehicleRatings = $this->userModel->getRatingsOfVehicles($vehicle->vehicle_id);
    
    // Store ratings in the ratings array with vehicle id as key
    $vratings[$vehicle->vehicle_id] = $vehicleRatings;
}

// Iterate through each vehicle again to add ratings to the vehicle data
foreach ($vehicles as &$vehicle) {
    // Add ratings to the vehicle data
    $vehicle->vratings = isset($vratings[$vehicle->vehicle_id]) ? $vratings[$vehicle->vehicle_id] : null;
}
} else {
// Handle the case where $vehicles is not iterable
// For example, display a message indicating no vehicles are available
//echo "No vehicles available.";
}


/////////////

if ($vehicles) {
foreach ($vehicles as $vehicle) {
    // Assuming you have a method to find prices for a specific vehicle and dates
    $prices = $this->userModel->findVehiclePrices($vehicle->vehicle_id);
    //prices per data gap
    $numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24)+1;
    $totalPrice = $prices->priceperday * $numDays;
    
    // Add prices to the vehiclePrices array
    $vehiclePrices[$vehicle->vehicle_id] = $totalPrice; // Assuming vehicle_id is unique
}
} else {
// echo "No vehicles available";
}


      // Pass the search results to the view and load it
      $data = [
        'places' => $places,
        'city' => $city, 
          'hotelrooms' => $hotels,
          // 'agencies' => $agencies,
          // 'packages' => $packages,
          'vehiclePrices'=>$vehiclePrices,
          'vehicles' => $vehicles,
          'profile_picture' => $user ? $user->profile_picture : null,
          'location' => $location,
          'checkinDate' => $checkinDate,
          'checkoutDate' => $checkoutDate,
      ];
      $this->view('loggedTraveler/serachAllServices', $data);
      exit; // Ensure that script execution stops after loading the view

    } 
           
      } else {
          // If the request method is not POST, redirect to a different URL
          header('Location: /TravelEase/loggedTraveler'); // Redirect to the main page or another appropriate URL
          exit; // Ensure that script execution stops after the redirect
      }
  }

  //bookingcart
  public function bookingcart($bookingcart, $checkinDate, $checkoutDate, $pickupTime=null) {
    // Decode the JSON string into an array
    $bookingcartArray = json_decode($bookingcart, true);
    
    // Check if decoding was successful
    if ($bookingcartArray === null) {
        // Handle JSON decoding error
        echo "Error: Unable to decode bookingcart JSON.";
        return;
    }
    
    // Result array to store processed data
    $resultArray = [];
    
    // Fetch user details
    $userId = $_SESSION['user_id'];
    $user = $this->userModel->findUserDetail($userId);
    
    // Loop through each cart element
    foreach ($bookingcartArray as $type => $services) {
        foreach ($services as $serviceId) {
            // Fetch booking details for each service
            $furtherBookingDetails = $this->userModel->findBookingDetailByServiceid($type, $serviceId);
            
            // Initialize variables
            $numDays = 0;
            $price = 0;
           // $pickupTime = null; // Initialize pickupTime
            
            // Calculate values for type 4 bookings
            if ($type == 4 && $furtherBookingDetails !== false) {
                // Calculate the number of days between check-in and check-out dates
                $numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24) + 1; 
                // Calculate the total price for the booking
                $price = $furtherBookingDetails->priceperday * $numDays;

                // Check if pickupTime exists in booking details
                if (property_exists($furtherBookingDetails, 'pickupTime')) {
                    $pickupTime = date("g:i A", strtotime($furtherBookingDetails->pickupTime));       
                }
            }
            
            // Store the processed data in the result array
            $resultArray[] = [
                'type' => $type,
                'serviceId' => $serviceId,
                'user' => $user,
                'furtherBookingDetails' => $furtherBookingDetails,
                'numDays' => $numDays,
                'price' => $price,
                'pickupTime' => $pickupTime ,// Assign pickupTime
                'checkinDate' => $checkinDate,
                'checkoutDate' => $checkoutDate,
                
            ];
        }
    }
    
    // Prepare data to pass to the view
    $data = [
      'bookingcartArray'=>$bookingcartArray,
        'resultArray' => $resultArray,
        'user' => $user,     
        'checkinDate' => $checkinDate,
        'checkoutDate' => $checkoutDate,
        'pickupTime' => $pickupTime,
    ];
    
    // Pass data to the view
    $this->view('loggedTraveler/bookingcart', $data);
}

//cartpayment
public function cartpayment($bookingcartArrayString, $checkinDate, $checkoutDate, $pickupTime=null) {
  $bookingcartArray = json_decode(urldecode($bookingcartArrayString), true);

  $totalAmount = $_POST['totalAmount'];
  $driverType = $_POST['driverType'];
  //echo $driverType;
  //if driver type==withdriver
  if($driverType=='withDriver'){
    $driver = 1;
  }else{
      $driver=0;
    };
  //echo $driverType;

  // Retrieve user details
  
  $id = $_SESSION['user_id'];
  $user = $this->userModel->findUserDetail($id);

  // Initialize an empty array to store booking details
$furtherBookingDetails = [];

// Iterate over each key-value pair in the $bookingcartArray
foreach ($bookingcartArray as $type => $serviceIds) {
    // Iterate over each service ID for the current type
    foreach ($serviceIds as $serviceId) {
        // Retrieve booking details for the current type and service ID
        $bookingDetails = $this->userModel->findBookingDetailByServiceid($type, $serviceId);
        // Add the retrieved booking details to the array
        $furtherBookingDetails[] = $bookingDetails;
    }
}

// Now $allBookingDetails contains booking details for all items in $bookingcartArray


  //Construct transaction data
  $transactionData = [
      'user' => $user,
      'checkinDate' => $checkinDate,
      'checkoutDate' => $checkoutDate,
      'bookingcartArray' => $bookingcartArray,
      'pickupTime' => $pickupTime ? $pickupTime : null,
      'price' => $totalAmount,
      'furtherBookingDetails' => $furtherBookingDetails,
      'driver' => $driver,
      
      // Add any other relevant transaction details
  ];

  // Create a Stripe Checkout session
  require __DIR__ . "./../libraries/stripe/vendor/autoload.php";
  $stripe_secret_key = "sk_test_51Ocov6EA71SQLGmwC6ccRw0MOKifZar2SWG5ln18XfHjkQN2zMp1wG9XOjVf2Q7mjMSEjrCsL1V8jGKQuYOCp8Un00rNzNhS2c";
  \Stripe\Stripe::setApiKey($stripe_secret_key);
  $checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
      'mode' => 'payment',
      'success_url' => "http://localhost/TravelEase/loggedTraveler/cartpaymentSuccessful",
      'line_items' => [[
          'quantity' => 1,
          'price_data' => [
              'currency' => 'lkr',
              'unit_amount' => $totalAmount * 100,
              'product_data' => [
                  'name' => 'Cart Payment',
              ],
          ],
      ]],
      'cancel_url' => 'https://example.com/cancel',
  ]);

  // Store the Stripe Checkout session ID in the transaction data
  $transactionData['stripe_session_id'] = $checkout_session->id;

  // Store the transaction data in the session or database for retrieval in the paymentSuccessful() function
  $_SESSION['transaction_data'] = $transactionData;

  // Redirect the user to the Stripe Checkout session URL
  http_response_code(303);
  header("Location: " . $checkout_session->url);
  
}
/////////////////////////////////////

public function cartpaymentSuccessful() {
  // Check if transaction data exists in the session
  if (isset($_SESSION['transaction_data'])) {
      // Retrieve transaction data from the session
      $transactionData = $_SESSION['transaction_data'];
      $this->userModel->addBookingfromCart($transactionData);
      $lastcartBooking = $this->userModel->getLastCartBooking();
      $this->userModel->addCartPaymentDetails($transactionData, $lastcartBooking->booking_id);

      // Iterate over each booking detail in $transactionData['furtherBookingDetails']
      foreach ($transactionData['furtherBookingDetails'] as $bookingDetail) {
          $type = $bookingDetail->type; 
          $driver = isset($transactionData['driver']) ? $transactionData['driver'] : null; 
          if ($type == 3) {
         
              $this->userModel->addroomUnavailabilityfromCart($bookingDetail, $transactionData);
          } elseif ($type == 4) {
              $this->userModel->addVehicleBookingfromCart($lastcartBooking->booking_id,$bookingDetail,$transactionData,$driver);
             
          }
      }
      
      // Optionally, you can pass data to the view if needed
      $data = [
          // Add any data you want to pass to the view
      ];

      // Load the view for the payment successful page
      $this->view('loggedTraveler/paymentSuccessful', $data);
  } else {
      // Handle the case where transaction data is missing
      // Redirect the user to an error page or perform any other action as needed
  }
}
//addtocart
public function addtocart($bookingcartArrayString, $checkinDate, $checkoutDate, $pickupTime=null) {
  $bookingcartArray = json_decode(urldecode($bookingcartArrayString), true);
  

  $totalAmount = $_POST['totalAmount'];
  $driverType = $_POST['driverType'];
  //echo $driverType;
  //if driver type==withdriver
  if($driverType=='withDriver'){
    $driver = 1;
  }else{
      $driver=0;
    };
  //echo $driverType;

  // Retrieve user details
  
  $id = $_SESSION['user_id'];
  $user = $this->userModel->findUserDetail($id);

  // Initialize an empty array to store booking details
$furtherBookingDetails = [];

// Iterate over each key-value pair in the $bookingcartArray
foreach ($bookingcartArray as $type => $serviceIds) {
    // Iterate over each service ID for the current type
    foreach ($serviceIds as $serviceId) {
        // Retrieve booking details for the current type and service ID
        $bookingDetails = $this->userModel->findBookingDetailByServiceid($type, $serviceId);
        // Add the retrieved booking details to the array
        $furtherBookingDetails[] = $bookingDetails;
    }
}

  //Construct transaction data
  $transactionData = [
      'user' => $user,
      'checkinDate' => $checkinDate,
      'checkoutDate' => $checkoutDate,
      'bookingcartArray' => $bookingcartArray,
      'pickupTime' => $pickupTime ? $pickupTime : null,
      'price' => $totalAmount,
      'furtherBookingDetails' => $furtherBookingDetails,
      'driver' => $driver,
      
      // Add any other relevant transaction details
  ];
  /////////////////////////////
  //similar to addBookingfromCart
  $this->userModel->addtoCartTable($transactionData);
  // var_dump($transactionData);
  
  // Optionally, you can pass data to the view if needed
  $data = [
      // Add any data you want to pass to the view
  ];

  // Load the view for the payment successful page
  $this->view('loggedTraveler/addToCartSuccessful', $data);
  ///////////////////////////

}

////////////////



//////////////////////////////////////////
//cancelBooking
public function cancelBooking($temporyid,$booking_id){

    echo '<script>console.log("cancelBooking function is running!");</script>';
      $id = $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      //$bookingDetails=$this->userModel->findBookingDetails($booking_id,$temporyid);
      
      if ($temporyid==0) {
        //detail of the booking
        $bookingDetails=$this->userModel->findBookingDetails($booking_id);
        $bookingFurtherDetail=$this->userModel->findBookingFurtherDetail($bookingDetails);
        if($bookingDetails->type==4){
          $message="Your Agency vehicle with ID ".$bookingFurtherDetail->vehicle_id."-".$bookingFurtherDetail->brand ." ".$bookingFurtherDetail->model." ".$bookingFurtherDetail->plate_number." ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
        }elseif($bookingDetails->type==3){
          $message="Your Hotel room with ID ".$bookingFurtherDetail->room_id."-".$bookingFurtherDetail->roomType ."Type ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
  
        }
        
        
        //cancel from booking table
        $cancel = $this->userModel->cancelBooking($booking_id);
  
        //refund user
        //$refund = $this->userModel->refundUser($booking_id);
  
        //check type and provide availibility of vehicle_bookings,room_availability
        $availibility=$this->userModel->makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail); 
        
        //send a sms to service provider
  
        //send notofuiaction
        $send=$this->userModel->sendBookingCancellationNotification($id,$bookingDetails->serviceProvider_id,$booking_id,$message);
        
      }else{
  
        $bookingDetails=$this->userModel->findCartBookingDetails($booking_id,$temporyid);
        $bookingFurtherDetail=$this->userModel->findBookingFurtherDetail($bookingDetails);
        if($bookingDetails->type==4){
          $message="Your Agency vehicle with ID ".$bookingFurtherDetail->vehicle_id."-".$bookingFurtherDetail->brand ." ".$bookingFurtherDetail->model." ".$bookingFurtherDetail->plate_number." ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
        }elseif($bookingDetails->type==3){
          $message="Your Hotel room with ID ".$bookingFurtherDetail->room_id."-".$bookingFurtherDetail->roomType ."Type ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
        }
        
        //cancel from cartbookings table
        $cancel = $this->userModel->cancelCartBooking($temporyid,$booking_id);
  
        //refund user
        //$refund = $this->userModel->refundUser($booking_id);
  
        //check type and provide availibility of vehicle_bookings,room_availability
        $availibility=$this->userModel->makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail); 
        //send a sms to service provider
  
      
         //send notofuiaction
         $send=$this->userModel->sendBookingCancellationNotification($id,$bookingDetails->serviceProvider_id,$booking_id,$message);
      }    
  }

  ////////////////////////////
  //suggestLocations
  public function suggestLocations(){
    if (isset($_GET['query'])) {
      $query = $_GET['query'];
      // Implement code to query the database for location suggestions based on the user input
      // Fetch locations that match the query and return them as JSON
       // Query the database and fetch locations
    $locations = $this->userModel->findLocations($query);
      echo json_encode($locations);
  }
   
  }

  




}


