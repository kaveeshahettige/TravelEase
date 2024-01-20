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
 $furtherBookingDetailsArray=[];
foreach ($bookings as $booking) {
   //this is from room, vehicle, or package tables
   $furtherbookingDetails = $bookings ? $this->userModel->findBookingFurtherDetail($booking) : null;
  $mainbookingDetails = $booking ? $this->userModel->findBookingDetail($booking->type, $booking->serviceProvider_id) : null;


  $bookingDetailsArray[] = [
    'furtherBookingDetails' => $furtherbookingDetails,
    'mainbookingDetails' => $mainbookingDetails, 
    'bookingIDs' => $booking->booking_id,

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
    'serviceProviderID' => $booking ? $booking->serviceProvider_id : null,
    'location' => $mainbookingDetails ? $mainbookingDetails->city : null,
    'mainbookingDetails'=>$mainbookingDetails,
    // 'bookingDetails' => $bookingDetails,
    'booking' => $booking,
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
      $data=[];
      $this->view('loggedTraveler/hotel',$data);
    }
    public function transport(){
      $data=[];
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
    public function bookingpayment(){
      $data=[];
      $this->view('loggedTraveler/bookingpayment',$data);
    }
    public function tripfurtherdetail($Sid){
      $servicProvider=$this->userModel->findUserDetail($Sid);
      $user=$this->userModel->findUserDetail($_SESSION['user_id']);
      $bookingDetails = $servicProvider ? $this->userModel->findBookingDetail($servicProvider->type, $Sid) : null;
      $data=[
        'serviceProviderName' => $servicProvider ? $servicProvider->fname . ' ' . $servicProvider->lname : null,
        'location' => $bookingDetails ? $bookingDetails->location : null,
        'profile_picture' => $user ? $user->profile_picture : null,
        'serviceProvideNumber'=>$servicProvider ? $servicProvider->number : null,
        'description' => $bookingDetails ? $bookingDetails->description : null,
      ];
      $this->view('loggedTraveler/tripfurtherdetail',$data);
    }

    
}



