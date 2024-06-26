<?php

class TravelerDashboard extends Controller{
    
      public function __construct(){
        if(!isLoggedIn()){
          redirect('users/login');
        }
        $this->userModel=$this->model('User');
        $id= $_SESSION['user_id'];
        $user=$this->userModel->findUserDetail($id);
        
      }
    
    public function index(){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      $noOfBooking=$this->userModel->countMyBooking($id);
      $noOfUpcomingTrips=$this->userModel->countMyUpcomingBooking($id);
      $monthlyPayment=$this->userModel->amountPaymentMonthly($id);
      $noOfFeedbacks=$this->userModel->countFeedbacks($id);

      $data = [
        'id' => '$id',
        'user'=>$user,
        'profile_picture'=>$user->profile_picture,
        'noOfBooking'=>$noOfBooking,
        'noOfUpcomingTrips'=>$noOfUpcomingTrips,
        'monthlyPayment'=>$monthlyPayment,
        'noOfFeedbacks'=>$noOfFeedbacks,
      ];
      $this->view('travelerDashboard/index',$data);
    }
    public function settings($id){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
      ];
        $this->view('travelerDashboard/settings',$data);
    }
    public function editInfo(){
      
      $this->view('travelerDashboard/editInfo');
    }

    //bookings
    public function bookings($id){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      $noOfBooking=$this->userModel->countMyUpcomingBooking($id);
      $mybooking = $this->userModel->findMyUpcomingBooking($id);

      // echo var_dump($mybooking);

    if ($mybooking) {
    // Check cancellation eligibility for each booking and store it in $mybooking
    foreach ($mybooking as $key => $booking) {
        $cancellationEligibility = $this->userModel->checkCancellationEligibility($booking->booking_id);
        $mybooking[$key]->cancellation_eligibility = $cancellationEligibility;
    }
}

    

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
        'mybooking'=>$mybooking,
        'noOfBooking'=>$noOfBooking,

      ];
      $this->view('travelerDashboard/bookings',$data);
    }

    //payments
    public function payments($id){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      $noofPayments=$this->userModel->countPayment($id);
      $payments=$this->userModel->findPayment($id);
      $noofPaymentsMonth=$this->userModel->countPaymentMonthly($id);
      $amountofPaymentsMonth=$this->userModel->amountPaymentMonthly($id);

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
        'noofPayments'=>$noofPayments,
        'payments'=>$payments,
        'noofPaymentsMonth'=>$noofPaymentsMonth,
        'amountofPaymentsMonth'=>$amountofPaymentsMonth,
        
      ];

      $this->view('travelerDashboard/payments',$data);
    }

    //notifications
    public function notifications($id){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      $noOfNotifications=$this->userModel->countNotifications($id);
      $notifications=$this->userModel->findNotifications($id);
      $noOfUnreadNotification=$this->userModel->countUnreadNotifications($id);

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
        'noOfNotifications'=>$noOfNotifications,
        'notifications'=>$notifications,
        'noOfUnreadNotification'=>$noOfUnreadNotification,
        
      ];
      $this->view('travelerDashboard/notifications',$data);
    }

    //previous trips
    public function previoustrips($id){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      $noOfPreviousTrips=$this->userModel->countPreviousTrips($id);
      $previousTrips = $this->userModel->findPreviousTrips($id);
      $feedbacks=$this->userModel->findPreviousFeedbacks($id);

    $feedbackStatus = [];

    if (is_array($previousTrips) || is_object($previousTrips)) {
      foreach ($previousTrips as $trip) {
          // Check if feedback has been provided for this booking
          $feedbackProvided = $this->userModel->checkFeedbackProvided($trip->booking_id, $trip->temporyid);
          
          // Store the feedback status (1 if feedback provided, 0 otherwise)
          $feedbackStatus[$trip->booking_id . '_' . $trip->temporyid] = $feedbackProvided ? 1 : 0;
      }
  } else {
      // Handle the case where $previousTrips is not an array or object
      // For example, you can log an error message or display a user-friendly error
      // echo "Error: Unable to retrieve previous trips.";
  }
  
  // Store the feedback status array in the $previousTrips array
  if (is_array($previousTrips) || is_object($previousTrips)) {
  foreach ($previousTrips as $key => $trip) {
      $previousTrips[$key]->feedback_provided = $feedbackStatus[$trip->booking_id . '_' . $trip->temporyid];
  }
}
  

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
        'noOfPreviousTrips'=>$noOfPreviousTrips,
        'previousTrips'=>$previousTrips,
        
      ];

      $this->view('travelerDashboard/previoustrips',$data);
    }
    
//     public function changeProfilePicture(){
//       if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     if (isset($_FILES['profilePicture'])) {
//         $file = $_FILES['profilePicture'];

//         // Validate file type
//         $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
//         if (!in_array($file['type'], $allowedTypes)) {
//             http_response_code(400);
//             echo json_encode(['error' => 'Invalid file type.']);
//             exit;
//         }

//         // Validate file size (2MB)
//         if ($file['size'] > 2 * 1024 * 1024) {
//             http_response_code(400);
//             echo json_encode(['error' => 'File size exceeds the limit.']);
//             exit;
//         }

//         // Handle file upload
//         $targetDirectory = 'uploads/';
//         $targetFile = $targetDirectory . basename($file['name']);

//         if (move_uploaded_file($file['tmp_name'], $targetFile)) {
//             // File uploaded successfully
//             echo json_encode(['message' => 'File uploaded successfully.']);

//             // Now, you can store the file path in the database
//             $filePathInDatabase = $targetFile;

//             $data = [
//               'id' => $_SESSION['user_id'],
//               'picture'=>$filePathInDatabase,
              
//             ];

//             $user=$this->userModel->updatePicture($data);

//             if ($user) {
//                 // Database update successful
//                 echo json_encode(['message' => 'Profile picture updated successfully.']);
//             } else {
//                 // Database update failed
//                 http_response_code(500);
//                 echo json_encode(['error' => 'Error updating profile picture.']);
//             }
//         } else {
//             http_response_code(500);
//             echo json_encode(['error' => 'Error uploading file.']);
//         }
//     } else {
//         http_response_code(400);
//         echo json_encode(['error' => 'Invalid request.']);
//     }
// } else {
//     http_response_code(400);
//     echo json_encode(['error' => 'Invalid request method.']);
// }

//     }

    public function changePicture(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['savePic'])) {
          // echo "working have file";
          // print_r($_POST);
          // print_r($_FILES);
          $profilePictureName=$_FILES['newProfilePicture']['name'];
          $data = [
            'id' => $_SESSION['user_id'],
            'picture'=>$profilePictureName,
            
          ];
          // echo $profilePictureName;
          $target = 'images1/' . $profilePictureName;
          if(move_uploaded_file($_FILES['newProfilePicture']['tmp_name'],$target)){
            // echo "file uploaded";
            if($user=$this->userModel->updateProPicture($data)){
              redirect('travelerDashboard/settings/'.$_SESSION['user_id']);
            }
            
            // redirect('travelerDashboard/settings');

          }else{
            // echo "file not uploaded"; 
            
echo '<script>';
echo 'alert("Click on image to change the image");';
echo 'window.location.href = "settings/' . $_SESSION['user_id'] . '";';
echo '</script>';

          }
          
        }else{
          echo "Post working,no file" ;
        }

      }else{
        echo "POST not working";
      }

    }

    public function changePassword(){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Sanitize POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
    
          $data = [
           
            'current-password' => trim($_POST['current-password']),
            'new-password' => trim($_POST['new-password']),
            'confirm-password' => trim($_POST['confirm-password']),
            'id' => $_SESSION['user_id'],
            'current-password_err'=>'',
            'new-password_err'=>'',
            'confirm-password_err'=>'',
            'fname'=>$user->fname,
            'lname'=>$user->lname,
            'profile_picture'=>$user->profile_picture,
            
          ];
          
          //get current password
          //$currentpassword=$this->userModel->getpassword($data['id']);
          // $userData = $this->userModel->getpassword($data['id']);
          $currentPasswordHash = $user->password;;
          // var_dump($currentpassword);
    
          // Validate data
        //  validate current_password
         if(empty($data['current-password'])){
            $data['current-password_err']='Please enter current password';      
        }else if(!password_verify($data['current-password'], $currentPasswordHash)){
          //current== entered
            $data['current-password_err']='Current password is incorrect';
        }
        
        //validate new password
        if(empty($data['new-password'])){
            $data['new-password_err']='Please enter new password';      
         }else{
            if(strlen($data['new-password'])<6){
                $data['new-password_err']='password must have atleast 6 characters'; 
            }
          }
        
        //validate confirmpassword
        if(empty($data['confirm-password'])){
            $data['confirm-password_err']='Please enter password';      
        }else
        if($data['new-password'] != $data['confirm-password']){
            $data['confirm-password_err']='password does not match'; 
        }
    
          // Make sure no errors
          if(empty($data['confirm-password_err']) && empty($data['new-password_err']) && empty($data['current-password_err'])){
            // Validated
            $hashedNewPassword = password_hash($data['new-password'], PASSWORD_DEFAULT);
            $data1 = [
              'hashed-password' => $hashedNewPassword,
              'id' => $_SESSION['user_id'],
              
            ];
            if($this->userModel->updatePassword($data1)){
              flash('user_message', 'user Updated');
              redirect('travelerDashboard/settings/'.$_SESSION['user_id']);
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('travelerDashboard/changePassword', $data);
          }
    
        }
        $data=[
           'fname'=>$user->fname,
           'lname'=>$user->lname,
          'current-password' => '',
            'new-password' => '',
            'confirm-password' => '',
            'id' => '',
            'current-password_err'=>'',
            'new-password_err'=>'',
            'confirm-password_err'=>'',
            'profile_picture'=>$user->profile_picture,
        ];
          $this->view('travelerDashboard/changePassword',$data);
      }
    

    


//submitfeedback
 public function submitFeedback(){
  $id= $_SESSION['user_id'];
  $user=$this->userModel->findUserDetail($id);

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Sanitize POST array
   // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $feedback = $_POST["feedback"];
    $rating = $_POST["rating"];
    $bookingId = $_POST["bookingId"];
    $serviceProvider_id=$_POST["Spid"];
    $temporyid=$_POST["tid"];

   $submit=$this->userModel->submitFeedback($id,$feedback,$rating,$bookingId,$serviceProvider_id,$temporyid);
   //if tru alert feedback submitted
    if($submit){
      echo '<script>';
      echo 'alert("Feedback submitted");';
      //echo 'window.location.href = "previoustrips/' . $_SESSION['user_id'] . '";';
      echo '</script>';
    }
   
  } else {
    $data = [
      
    ];
    $this->view('travelerDashboard/submitFeedback', $data);
  }
 }


 public function bookingdetails($Sid,$Bid){

  $id = $_SESSION['user_id'];
  $user=$this->userModel->findUserDetail($id);
  $serviceProvider = $this->userModel->findUserDetail($Sid);
  // echo "<script>";
  //   echo "console.log('Booking ID:');";
  //   echo "</script>";



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
$guideTable = null;
    if ($serviceProvider->type == 5) {
      $guideTable = $this->userModel->getGuidebookings($booking->booking_id);
    }

$vehicleprice=null;
$driver=null;
if($serviceProvider->type==4){
  $vehicleprice=$this->userModel->findVehiclePrice($Bid);
  $driver=$this->userModel->findDriverAvilability($Bid);
}

  $data=[
    'serviceProviderName' => $serviceProvider ? $serviceProvider->fname . ' ' . $serviceProvider->lname : null,
    'type' => $serviceProvider ? $serviceProvider->type : null,
    'serviceProvider' => $serviceProvider ? $serviceProvider : null,
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
    'guideTable' => $guideTable,
  ];
  $this->view('travelerDashboard/bookingpopup',$data);
}

public function bookingdetailscart($Tid,$Sid,$Bid){

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
  ];
  $this->view('travelerDashboard/bookingpopup',$data);
}

// //myCartDetails- havent implement yet - similar to bookingdetails
// public function myCartDetails($Bid){

//   $id = $_SESSION['user_id'];
//   //$cartData=$this->userModel->findCartDetails($id);
//   $user=$this->userModel->findUserDetail($id);
//   $serviceProvider = $this->userModel->findUserDetail($Sid);
//   // echo "<script>";
//   //   echo "console.log('Booking ID:');";
//   //   echo "</script>";



//   //from service provider table(hotel,travelagncy,pacjage tables)
//   $mainbookingDetails = $serviceProvider ? $this->userModel->findBookingDetail($serviceProvider->type, $Sid) : null;
  
//   //booking table booking data
//   $booking = $this->userModel->findCartBooking($Bid,$Tid);

//   //find further booking details
//   $furtherbookingDetails = $serviceProvider ? $this->userModel->findBookingFurtherDetail($booking) : null;

//   $cancellationEligibility = $booking ? $this->userModel->checkCancellationEligibility($booking->booking_id) : null;
  
  
//   // // Initializing an array to store further booking details for each booking
//   // $furtherBookingDetailsArray = [];
//   // $startDates;
//   // $endDates;

  

//   // foreach ($bookings as $booking) {
//   //   //this is from room, vehicle, or package tables
//   //   $furtherbookingDetails = $serviceProvider ? $this->userModel->findBookingFurtherDetail($booking) : null;
//   //   //checking booking can be canceled or not
//   //   $cancellationEligibility = $bookings ? $this->userModel->checkCancellationEligibility($booking->booking_id) : null;
    
//   //   ////////////////////////////////////////////////////////////
//   //   // Adding details to the array for each booking
//   //   $furtherBookingDetailsArray[] = [
//   //       'furtherBookingDetails' => $furtherbookingDetails, // Corrected variable name
//   //       'cancellationEligibility' => $cancellationEligibility, // Corrected variable name
//   //       'startDates' => $booking->startDate,
//   //       'endDates' => $booking->endDate,
        
//   //   ];
// // }
// $vehicleprice=null;
// $driver=null;
// if($serviceProvider->type==4){
//   $vehicleprice=$this->userModel->findCartVehiclePrice($Bid);
//   $driver=$this->userModel->findDriverAvilabilityCart($Bid);
// }

//   $data=[
//     'serviceProviderName' => $serviceProvider ? $serviceProvider->fname . ' ' . $serviceProvider->lname : null,
//     'type' => $serviceProvider ? $serviceProvider->type : null,
//     'profile_picture' => $user ? $user->profile_picture : null,
//     'number' => $serviceProvider ? $serviceProvider->number : null,
//     'location' => $mainbookingDetails ? $mainbookingDetails->city : null,
//     'serviceDescription' => $mainbookingDetails ? $mainbookingDetails->description : null,
//     'mainbookingDetails' => $mainbookingDetails,
//     'furtherBookingDetails' => $furtherbookingDetails,
//     'booking' => $booking,
//     'cancellationEligibility' => $cancellationEligibility,
//     'vehicleprice'=>$vehicleprice?$vehicleprice:null,
//     'driver'=>$driver?$driver:null,
//   ];
//   $this->view('travelerDashboard/viewCart',$data);
// }

//cancelBooking
public function cancelBooking($temporyid,$booking_id){

  echo '<script>console.log("cancelBooking function is running!");</script>';
    $id = $_SESSION['user_id'];
    $user=$this->userModel->findUserDetail($id);
    //$bookingDetails=$this->userModel->findBookingDetails($booking_id,$temporyid);
    
     if ($temporyid==0) {
    //   //detail of the booking
       $bookingDetails=$this->userModel->findBookingDetails($booking_id);
      $bookingFurtherDetail=$this->userModel->findBookingFurtherDetail($bookingDetails);
      if($bookingDetails->type==4){
        $message="Agency vehicle with ID ".$bookingFurtherDetail->vehicle_id." - ".$bookingFurtherDetail->brand ."  ".$bookingFurtherDetail->model."  ".$bookingFurtherDetail->plate_number." ,booked during ".$bookingDetails->startDate." to ".$bookingDetails->endDate." has been cancelled.";
      }elseif($bookingDetails->type==3){
        $message="Hotel room with ID ".$bookingFurtherDetail->room_id." - ".$bookingFurtherDetail->roomType ."Type ,booked during ".$bookingDetails->startDate." to ".$bookingDetails->endDate." has been cancelled.";
    }elseif($bookingDetails->type==5){
      $message="Guide service,booked during ".$bookingDetails->startDate." to ".$bookingDetails->endDate." has been cancelled.";
    }
      
      
      //cancel from booking table
      $cancel = $this->userModel->cancelBooking($booking_id);

      //refundamount
      $More=$this->userModel->refundAmount($booking_id);
      //refund user
      $refund = $this->userModel->refundUser($temporyid,$booking_id,$bookingDetails->serviceProvider_id,$id,$More->amount);


      //check type and provide availibility of vehicle_availbilty,room_availability,guide_availability
      $availibility=$this->userModel->makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail); 
      
      //send a sms to service provider

      //send notofuiaction to service Provider
      $send=$this->userModel->sendBookingCancellationNotification($id,$bookingDetails->serviceProvider_id,$booking_id,$message);
      $BMs=$this->userModel->findBusinessManagers();
      //send notofuiaction to  Business Managers
      $sendBM=$this->userModel->sendBookingCancellationNotificationtoBM($id,$booking_id,$message,$BMs);
      
    }else{

      $bookingDetails=$this->userModel->findCartBookingDetails($booking_id,$temporyid);
      $bookingFurtherDetail=$this->userModel->findBookingFurtherDetail($bookingDetails);
      if($bookingDetails->type==4){
        $message="Agency vehicle with ID ".$bookingFurtherDetail->vehicle_id."-".$bookingFurtherDetail->brand ." ".$bookingFurtherDetail->model." ".$bookingFurtherDetail->plate_number." ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
      }elseif($bookingDetails->type==3){
        $message="Hotel room with ID ".$bookingFurtherDetail->room_id."-".$bookingFurtherDetail->roomType ."Type ,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";

      }elseif($bookingDetails->type==5){
        $message="Guide service,booked during ".$bookingDetails->startDate."to ".$bookingDetails->endDate."has been cancelled.";
      }
      
      //cancel from cartbookings table
      $cancel = $this->userModel->cancelCartBooking($temporyid,$booking_id);

      //refundamount
      $result=$this->userModel->refundAmountCart($booking_id,$temporyid);
      //refund user
      $refund = $this->userModel->refundUserCart($temporyid,$booking_id,$bookingDetails->serviceProvider_id,$id,$result->amount);

      //check type and provide availibility of vehicle_bookings,room_availability
      $availibility=$this->userModel->makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail); 
      //send a sms to service provider

    
       //send notofuiaction
       $send=$this->userModel->sendBookingCancellationNotification($id,$bookingDetails->serviceProvider_id,$booking_id,$message);
       $BMs=$this->userModel->findBusinessManagers();
       //send notofuiaction to  Business Managers
       $sendBM=$this->userModel->sendBookingCancellationNotificationtoBM($id,$booking_id,$message,$BMs);
    }    
}

//markAsRead
public function markAsRead($notification_id) {
  // Call the UserModel method to mark the notification as read
  $mark = $this->userModel->markAsRead($notification_id);

  // Return a response indicating success or failure (if needed)
  echo json_encode(['success' => $mark]); // Assuming the markAsRead method returns a boolean indicating success or failure

  // Optionally, you can return additional data in the response, such as a message
  // echo json_encode(['success' => $mark, 'message' => 'Notification marked as read successfully']);
}


//deactivateUser
public function deactivateUser($id){
  $user=$this->userModel->deactivateUser($id);
  redirect('../Landpage/');
  
}

//cart
public function cart($id){
  $id= $_SESSION['user_id'];
  $user=$this->userModel->findUserDetail($id);
  $cartDetails=$this->userModel->findCartDetails($id);
  $noofCarts=$this->userModel->countCart($id);
  $noofCartItems=$this->userModel->countCartItems($id);
  
  $serviceProvidersNamesArray = []; // Initialize an empty array to store names

// foreach ($cartDetails as $cart) {
//     $serviceProvidersinCart = $this->userModel->findServiceProviderInCart($cart->cartbooking_id);

//     // Loop through service providers in the cart
    
//         // Add each provider's name to the array
//         $serviceProvidersNamesArray[] = $serviceProvidersinCart;
    
// }
// echo var_dump($cartDetails);

  $data = [
    'id' => '$id',
    'email'=>$user->email,
    'lname' => $user->lname,
    'fname' => $user->fname,
    'number' => $user->number,
    'profile_picture'=>$user->profile_picture,
    'cartDetails'=>$cartDetails,
    'noofCarts'=>$noofCarts,
    'noofCartItems'=>$noofCartItems,
    //'serviceProvidersNamesArray' => $serviceProvidersNamesArray,
    
  ];
  $this->view('travelerDashboard/cart',$data);
}

//removeCart(cartbooking_id)
public function removeCart($cartbooking_id){
  $remove=$this->userModel->removefromCart($cartbooking_id);

}

//myCartDetails($cartbooking_id) from  bookingcart($bookingcart, $checkinDate, $checkoutDate, $pickupTime=null,$meetTime=null)
public function myCartDetails($cartbooking_id,$newcheckinDate,$newcheckoutDate){
  
  // Result array to store processed data
  $resultArray = [];
  
  // Fetch user details
  $userId = $_SESSION['user_id'];
  $user = $this->userModel->findUserDetail($userId);
  //cart details
  $cartDetails=$this->userModel->findCartDetailsByBookingId($cartbooking_id);
  
  
 // Loop through each cart element
 
      foreach ($cartDetails as $cartDetail) {
        $serviceId = $cartDetail->room_id ? $cartDetail->room_id : ($cartDetail->vehicle_id ? $cartDetail->vehicle_id : $cartDetail->package_id);;
          // Fetch booking details for each service
          $furtherBookingDetails = $this->userModel->findBookingDetailByServiceid($cartDetail->type, $serviceId);
          $checkAvailbility=$this->userModel->checkAvailbility($cartDetail->type, $serviceId,$newcheckinDate,$newcheckoutDate);
          
          
          // Initialize variables
          $numDays = 0;
          $price = 0;
          $serviceProvider = null;
         // $pickupTime = null; // Initialize pickupTime
          
         $checkinDate = $cartDetail->startDate;
         $checkoutDate = $cartDetail->endDate;
          // Calculate values for type 4 bookings
          if ($cartDetail->type == 4 && $furtherBookingDetails !== false) {
              // Calculate the number of days between check-in and check-out dates
              $numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24) + 1; 
              // Calculate the total price for the booking
              $price = $furtherBookingDetails->priceperday * $numDays;

              // Check if pickupTime exists in booking details
              if (property_exists($furtherBookingDetails, 'pickupTime')) {
                  $pickupTime = date("g:i A", strtotime($furtherBookingDetails->pickupTime));       
              }
          }
          if ($cartDetail->type == 5 && $furtherBookingDetails !== false) {
            // Calculate the number of days between check-in and check-out dates
            $numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24) + 1; 
            // Calculate the total price for the booking
            $price = $furtherBookingDetails->pricePerDay * $numDays;
            $serviceProvider=$this->userModel->findUserDetail($furtherBookingDetails->user_id);
        }
          
          
          // Store the processed data in the result array
          $resultArray[] = [
              'cart_id' => $cartDetail->cart_id,
              'type' => $cartDetail->type,
              'serviceId' => $serviceId,
              'user' => $user,
              'furtherBookingDetails' => $furtherBookingDetails,
              'numDays' => $numDays,
              'price' => $price,
              'pickupTime' => $cartDetail->pickupTime?$cartDetail->pickupTime:null ,// Assign pickupTime
              'checkinDate' => $checkinDate,
              'checkoutDate' => $checkoutDate,
              'meetTime' => $cartDetail->meetTime?$cartDetail->meetTime:null,
              'serviceProvider'=>$serviceProvider?$serviceProvider:null,
              'checkAvailbility'=>$checkAvailbility,
              'newcheckinDate'=>$newcheckinDate,
              'newcheckoutDate'=>$newcheckoutDate,
              
          ];
      }
  
  
  // Prepare data to pass to the view
  $data = [
      'resultArray' => $resultArray,
      'user' => $user,   
      'cartbooking_id'=>$cartbooking_id,
  ];
  
  // Pass data to the view

  $this->view('travelerDashboard/myCartDetails',$data);


}

//removefromCart(cart_id)
public function removefromCartByCartId($cart_id){
  $remove=$this->userModel->removefromCartByCartId($cart_id);
}


/////////////


//proceedWishList($cartid, $newcheckinDate, $newcheckoutDate)
public function proceedWishList($cartid, $newcheckinDate, $newcheckoutDate){
  $cartDetails=$this->userModel->findCartDetailsByBookingId($cartid);
  $id = $_SESSION['user_id'];
  $user=$this->userModel->findUserDetail($id);
  $driverType = $_POST['driverType'];
  $meetTime = $_POST['meetTime'];
  $pickupTime = $_POST['pickupTime'];
  //echo $cartid;
  //echo $driverType;
  //echo $pickupTime;
  //echo $meetTime;

  //echo var_dump($cartDetails);

  $furtherBookingDetails = [];
foreach ($cartDetails as $cartDetail) {
    // Reset $allDetails for each iteration
   
    $allDetails = [];

    //find type
    if ($cartDetail->room_id != null) {
        $type = 3;
        $serviceId = $cartDetail->room_id;
    } else if ($cartDetail->vehicle_id != null) {
        $type = 4;
        $serviceId = $cartDetail->vehicle_id;
    } else if ($cartDetail->package_id != null) {
        $type = 5;
        $serviceId = $cartDetail->package_id;
    }
    
    //find availability
    // echo $serviceId ."".$type;
    $available = $this->userModel->checkAvailbility($type, $serviceId, $newcheckinDate, $newcheckoutDate);
  
    if ($available) {
        // if available, retrieve further details
        $allDetails = $this->userModel->findBookingDetailByServiceId($type, $serviceId);
        //echo var_dump($allDetails);
        $furtherBookingDetails[] = $allDetails;
    }
    
    
}


    //echo var_dump($furtherBookingDetails);

  $data = [
    'meetTime'=>$meetTime,
    'pickupTime'=>$pickupTime,
    'driverType'=>$driverType,
    'checkinDate'=>$newcheckinDate,
    'checkoutDate'=>$newcheckoutDate,
    'cartDetails'=>$cartDetails,
    'furtherBookingDetails'=>$furtherBookingDetails,
    'user'=>$user,
    'cartid'=>$cartid,
  ];
  

  $this->view('travelerDashboard/proceedWishList',$data);
}

//paymentwishlist
public function paymentwishlist($cartid,$servicePricesArray){

  $servicePricesArray = json_decode(urldecode($servicePricesArray), true);
  $user = $this->userModel->findUserDetail($_SESSION['user_id']);

  $driverType=$_POST['driverType'];
  $meetTime = $_POST['meetTime'];
  $pickupTime = $_POST['pickupTime'];
  $checkinDate = $_POST['checkinDate'];
  $checkoutDate = $_POST['checkoutDate'];
  $total=$_POST['totalAmount'];

  if($driverType=='withDriver'){
    $driver = 1;
  }else{
      $driver=0;
    };

  $cartDetails=$this->userModel->findCartDetailsByBookingId($cartid);

    $furtherBookingDetails = [];
foreach ($cartDetails as $cartDetail) {
    $allDetails = [];

    //find type
    if ($cartDetail->room_id != null) {
        $type = 3;
        $serviceId = $cartDetail->room_id;
    } else if ($cartDetail->vehicle_id != null) {
        $type = 4;
        $serviceId = $cartDetail->vehicle_id;
    } else if ($cartDetail->package_id != null) {
        $type = 5;
        $serviceId = $cartDetail->package_id;
    }
    
    //find availability
    // echo $serviceId ."".$type;
    $available = $this->userModel->checkAvailbility($type, $serviceId, $checkinDate, $checkoutDate);
  
    if ($available) {
        // if available, retrieve further details
        $allDetails = $this->userModel->findBookingDetailByServiceId($type, $serviceId);

        //echo var_dump($allDetails);
        $furtherBookingDetails[] = $allDetails;
    }
    
    
}



  $transactionData = [
    'user' => $user,
    'checkinDate' => $checkinDate,
    'checkoutDate' => $checkoutDate,
    'pickupTime' => $pickupTime ? $pickupTime : null,
    'price' => $total,
    'driver' => $driver,
    'meetTime' => $meetTime ? $meetTime : null,
    'cartid'=>$cartid,
    'furtherBookingDetails' => $furtherBookingDetails,
    'servicePricesArray' => $servicePricesArray,
    // Add any other relevant transaction details
];

  require __DIR__ . "/../libraries/stripe/vendor/autoload.php";
  $stripe_secret_key = "sk_test_51Ocov6EA71SQLGmwC6ccRw0MOKifZar2SWG5ln18XfHjkQN2zMp1wG9XOjVf2Q7mjMSEjrCsL1V8jGKQuYOCp8Un00rNzNhS2c";
  \Stripe\Stripe::setApiKey($stripe_secret_key);
  $checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
      'mode' => 'payment',
      'success_url' => "http://localhost/TravelEase/TravelerDashboard/paymentwishlistSuccessful",
      'line_items' => [[
          'quantity' => 1,
          'price_data' => [
              'currency' => 'lkr',
              'unit_amount' => $total * 100,
              'product_data' => [
                  'name' => 'Payment from WishList',
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

//paymentwishlistSuccessful
public function paymentwishlistSuccessful() {
  // Check if transaction data exists in the session
  if (isset($_SESSION['transaction_data'])) {
      // Retrieve transaction data from the session
      $transactionData = $_SESSION['transaction_data'];
      //echo $transactionData['furtherBookingDetails'];
      $this->userModel->addBookingfromCart($transactionData);
      $lastcartBooking = $this->userModel->getLastCartBooking();
      $temporyIds=$this->userModel->getTemportIdsByBookingId($lastcartBooking->booking_id);
      $servicePricesArray = $transactionData['servicePricesArray'];
    
      // Ensure both arrays have the same length
      if (count($temporyIds) === count($servicePricesArray)) {
        $count = count($temporyIds); // Get the length of the arrays
    
        // Iterate through each temporyId
        for ($i = 0; $i < $count; $i++) {
            $temporyId = $temporyIds[$i]->temporyid; // Assuming the ID property is 'id'
            $servicePrice = $servicePricesArray[$i]; // Get the corresponding service price
    
            // Call your function with the temporyId and corresponding service price
            $this->userModel->addCartPaymentDetails($temporyId, $servicePrice, $lastcartBooking->booking_id);
        }
    } else {
  // Handle error: Arrays are not of equal length
  // You
  }
      

      //Iterate over each booking detail in $transactionData['furtherBookingDetails']
      foreach ($transactionData['furtherBookingDetails'] as $bookingDetail) {
          $type = $bookingDetail->type; 
          $driver = isset($transactionData['driver']) ? $transactionData['driver'] : null; 
          if ($type == 3) {
         
             $this->userModel->addroomUnavailabilityfromCart($bookingDetail, $transactionData);
          } elseif ($type == 4) {
             $this->userModel->addVehicleBookingfromCart($lastcartBooking->booking_id,$bookingDetail,$transactionData,$driver);
             $this->userModel->addUnavailabilityVehiclesfromCart($transactionData,$bookingDetail);//vehicleAvailbilty
             
          }elseif($type==5){
           $this->userModel->addGuideBookingfromCart($lastcartBooking->booking_id,$transactionData);
            $this->userModel->addUnavailabilityGuidesfromCart($transactionData,$bookingDetail);//guideAvilbilty
          }
      }
      //remove from wishlist
      $this->userModel->removefromCartByBookingId($transactionData['cartid']);
      
  //     // Optionally, you can pass data to the view if needed
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


//cartpayment
public function cartpayment($bookingcartArrayString,$servicePricesArray, $checkinDate, $checkoutDate, $pickupTime=null,$meetTime=null) {
  $bookingcartArray = json_decode(urldecode($bookingcartArrayString), true);
  $servicePricesArray = json_decode(urldecode($servicePricesArray), true);
  // echo var_dump($servicePricesArray);

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
      'meetTime' => $meetTime ? $meetTime : null,
      'servicePricesArray'=>$servicePricesArray,
      // Add any other relevant transaction details
  ];

  // Create a Stripe Checkout session
  require __DIR__ . "/../libraries/stripe/vendor/autoload.php";
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
      $temporyIds=$this->userModel->getTemportIdsByBookingId($lastcartBooking->booking_id);
      $servicePricesArray = $transactionData['servicePricesArray'];
    
      // Ensure both arrays have the same length
      if (count($temporyIds) === count($servicePricesArray)) {
        $count = count($temporyIds); // Get the length of the arrays
    
        // Iterate through each temporyId
        for ($i = 0; $i < $count; $i++) {
            $temporyId = $temporyIds[$i]->temporyid; // Assuming the ID property is 'id'
            $servicePrice = $servicePricesArray[$i]; // Get the corresponding service price
    
            // Call your function with the temporyId and corresponding service price
            $this->userModel->addCartPaymentDetails($temporyId, $servicePrice, $lastcartBooking->booking_id);
        }
    } else {
  // Handle error: Arrays are not of equal length
  // You might want to log an error or handle this case appropriately
}
      
      

      //Iterate over each booking detail in $transactionData['furtherBookingDetails']
      foreach ($transactionData['furtherBookingDetails'] as $bookingDetail) {
          $type = $bookingDetail->type; 
          $driver = isset($transactionData['driver']) ? $transactionData['driver'] : null; 
          if ($type == 3) {
         
              $this->userModel->addroomUnavailabilityfromCart($bookingDetail, $transactionData);
          } elseif ($type == 4) {
              $this->userModel->addVehicleBookingfromCart($lastcartBooking->booking_id,$bookingDetail,$transactionData,$driver);
              $this->userModel->addUnavailabilityVehiclesfromCart($transactionData,$bookingDetail);//vehicleAvailbilty
             
          }elseif($type==5){
            $this->userModel->addGuideBookingfromCart($lastcartBooking->booking_id,$transactionData);
            $this->userModel->addUnavailabilityGuidesfromCart($transactionData,$bookingDetail);//guideAvilbilty
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

}

//////////////////

