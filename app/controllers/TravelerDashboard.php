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

    foreach ($previousTrips as $trip) {
      // Check if feedback has been provided for this booking
      $feedbackProvided = $this->userModel->checkFeedbackProvided($trip->booking_id, $trip->temporyid);
      
      // Store the feedback status (1 if feedback provided, 0 otherwise)
      $feedbackStatus[$trip->booking_id . '_' . $trip->temporyid] = $feedbackProvided ? 1 : 0;
  }
  
  // Store the feedback status array in the $previousTrips array
  foreach ($previousTrips as $key => $trip) {
      $previousTrips[$key]->feedback_provided = $feedbackStatus[$trip->booking_id . '_' . $trip->temporyid];
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
}

//cart
public function cart($id){
  $id= $_SESSION['user_id'];
  $user=$this->userModel->findUserDetail($id);
  $cartDetails=$this->userModel->findCartDetails($id);
  $noofCarts=$this->userModel->countCart($id);
  $noofCartItems=$this->userModel->countCartItems($id);

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
    
  ];
  $this->view('travelerDashboard/cart',$data);
}


}

