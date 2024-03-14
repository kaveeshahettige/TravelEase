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
      $noOfUpcomingTrips=$this->userModel->countUpcomingTrips($id);
      $monthlyPayment=$this->userModel->monthlyPayment($id);

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
        'noOfBooking'=>$noOfBooking,
        'noOfUpcomingTrips'=>$noOfUpcomingTrips,
        'monthlyPayment'=>$monthlyPayment,
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
      $mybooking=$this->userModel->findMyBooking($id);
      $noOfBooking=$this->userModel->countMyBooking($id);
    

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
      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
        'noofPayments'=>$noofPayments,
        'payments'=>$payments,
        
      ];

      $this->view('travelerDashboard/payments',$data);
    }

    //notifications
    public function notifications($id){
      $this->view('travelerDashboard/notifications');
    }

    //previous trips
    public function previoustrips($id){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);
      $noOfPreviousTrips=$this->userModel->countPreviousTrips($id);
      $previousTrips=$this->userModel->findPreviousTrips($id);
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
    $serviceId = $_POST["bookingId"];

   $submit=$this->userModel->submitFeedback($id,$feedback,$rating,$serviceId);
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
}

