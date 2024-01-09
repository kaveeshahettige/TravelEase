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
    $booking = $this->userModel->findBookingAvailable($id);
$serviceProvider = $booking ? $this->userModel->findUserDetail($booking->serviceProvider_id) : null;
$bookingDetails = $serviceProvider ? $this->userModel->findBookingDetail($serviceProvider->type, $booking->serviceProvider_id) : null;
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
    'serviceProviderName' => $serviceProvider ? $serviceProvider->fname . ' ' . $serviceProvider->lname : null,
    'serviceProviderID' => $booking ? $booking->serviceProvider_id : null,
    'serviceProviderType' => $serviceProvider ? $serviceProvider->type : null,
    'location' => $bookingDetails ? $bookingDetails->location : null,
    'picture' => $bookingDetails ? $bookingDetails->picture : null,
    'randomServiceProvider1Location'=>$service1Details ? $service1Details->location : null,
    'randomServiceProvider1Name'=>$service1Name ? $service1Name->fname . ' ' . $service1Name->lname : null,
    'randomServiceProvider2Location'=>$service2Details ? $service2Details->location : null,
    'randomServiceProvider2Name'=>$service2Name ? $service2Name->fname . ' ' . $service2Name->lname : null,
    'randomServiceProvider3Location'=>$service3Details ? $service3Details->location : null,
    'randomServiceProvider3Name'=>$service3Name ? $service3Name->fname . ' ' . $service3Name->lname : null,
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
    public function bookingdetails($Sid){
      $id = $_SESSION['user_id'];
      $serviceProvider = $this->userModel->findUserDetail($Sid);
      $bookingDetails = $serviceProvider ? $this->userModel->findBookingDetail($serviceProvider->type, $Sid) : null;
      
      $booking = $this->userModel->findBookingAvailable($id);
      $cancellationEligiblity = $booking ? $this->userModel->checkCancellationEligibility($booking->booking_id) : null;
      $data=[
        'serviceProviderName' => $serviceProvider ? $serviceProvider->fname . ' ' . $serviceProvider->lname : null,
        // 'serviceProviderID' => $booking ? $booking->serviceProvider_id : null,
        // 'serviceProviderType' => $serviceProvider ? $serviceProvider->type : null,
        'number' => $serviceProvider ? $serviceProvider->number : null,
        'location' => $bookingDetails ? $bookingDetails->location : null,
        'picture' => $bookingDetails ? $bookingDetails->picture : null,
        'description' => $bookingDetails ? $bookingDetails->description : null,
        'start_date' => $booking ? $booking->startDate : null,
        'end_date' => $booking ? $booking->endDate : null,
        'cancellationEligiblity' => $cancellationEligiblity,
      ];
      $this->view('loggedTraveler/bookingdetails',$data);
    }
    public function bookingpayment(){
      $data=[];
      $this->view('loggedTraveler/bookingpayment',$data);
    }
    public function tripfurtherdetail(){
      $data=[];
      $this->view('loggedTraveler/tripfurtherdetail',$data);
    }

    
}



