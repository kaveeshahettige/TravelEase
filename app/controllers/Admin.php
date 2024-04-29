<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Admin extends Controller{

    private $userModel; // Changed from $postModel to $userModel

    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->userModel = $this->model('AdminM'); // Changed from $postModel to $userModel
    }

        public function index(){
          $admindetail=$this->userModel->getadmindata();
          $id= $_SESSION['user_id'];
            $user=$this->userModel->findUserDetail($id);
          $not=$this->userModel->noOfTravelers();
          $noh=$this->userModel->noOfHotels();
          $noa=$this->userModel->noOfAgencies();
          $nop=$this->userModel->noOfpackages();
          $nore=$this->userModel->noOfRequests();
          $nob=$this->userModel->noOfBookings();
          $nocb=$this->userModel->noOfCompleteBookings();

          // var_dump($nocb);
          // var_dump($nob);

          $data = [
            'fname'=>$admindetail->fname,
            'not'=>$not,
            'noh'=>$noh, 
            'noa'=>$noa,
            'nop'=>$nop,
            'nore'=>$nore, 
            'nob'=>$nob, 
            'nocb'=>$nocb, 
          ];
            $this->view('admin/index',$data);
        }
        
        public function request(){
          $admindetail=$this->userModel->getadmindata();
          $hotelRequests=$this->userModel->findHotelRequests();
          
          $nore=$this->userModel->noOfRequests();
          // var_dump($hotelRequests);
          $data = [
              'fname'=>$admindetail->fname,
              'hotelRequests'=>$hotelRequests,
             
              'nore'=>$nore,
              // 'document'=>$document,
          ];
          $this->view('admin/request',$data);
      }

      public function agencyrequest(){
        $admindetail=$this->userModel->getadmindata();
        $agencyRequests=$this->userModel->findAgencyRequests();
        $nore=$this->userModel->noOfRequests();
        // var_dump($hotelRequests);
        $data = [
            'fname'=>$admindetail->fname,
            'agencyRequests'=>$agencyRequests,
            'nore'=>$nore,
            // 'document'=>$document,
        ];

        // var_dump($agencyRequests);
        $this->view('admin/agencyrequest',$data);
    }

    public function guiderequests(){
      $admindetail=$this->userModel->getadmindata();
      $guideRequests=$this->userModel->findGuideRequests();
      $nore=$this->userModel->noOfRequests();
      // var_dump($hotelRequests);
      $data = [
          'fname'=>$admindetail->fname,
          'guideRequests'=>$guideRequests,
          'nore'=>$nore,
          // 'document'=>$document,
      ];
      $this->view('admin/guiderequests',$data);
  }
      
      

        public function hotel(){
          $admindetail = $this->userModel->getadmindata();
          $no = $this->userModel->noOfHotels(); 
          // $hoteluserId = $this->userModel->gethotelUserID(); // Assuming this returns an array of stdClass objects
          $hotel = $this->userModel->findHotelDetail();


          $hoteldetails = $this->userModel->getHotel();

          // var_dump($hoteldetails);


      
          $data = [
              'no' => $no,
              // 'hotel' => $hotel,
              'fname' => $admindetail->fname,
              'hoteldetails'=>$hoteldetails,
          ];
      
          $this->view('admin/hotel', $data);
      }
      
     
    
                

            
            
    public function deleteHotel() {


        
      $hotelId = $_POST['hotel_id'];
      
      $success = $this->userModel->updateProfileStatus($hotelId);
      
      if ($success) {
        redirect('admin/hotel');
          // Redirect or show success message
      } else {
        redirect('admin/hotel');
          // Handle deletion failure
      }
  
}
    
        public function agency(){
          $admindetail=$this->userModel->getadmindata();
          $no=$this->userModel->noOfAgencies();
          $agency=$this->userModel->findAgencyDetail();

          // $userId = 5;
          // $ongoingBookings = $this->userModel->checkOngoingBooking($userId);

          // var_dump($ongoingBookings);

          // var_dump($agency);
          $data = [
            'no'=>$no,
            'agency'=>$agency,
            // 'lname' => $traveler->lname,
             'fname' => $admindetail->fname,
            // 'number' => $user->number,   
          ];
            $this->view('admin/agency',$data);
        }
        public function package(){
          $admindetail=$this->userModel->getadmindata();
          $no=$this->userModel->noOfpackages();
          $guide=$this->userModel->getGuide();
          $data = [
            'no'=>$no,
            'guide'=>$guide,
            // 'lname' => $traveler->lname,
            'fname' => $admindetail->fname,
            // 'number' => $user->number,   
          ];
            $this->view('admin/package',$data);
        }
        public function settings(){

          // $userId = $_POST['id'];
          // var_dump($userId);
          // $ongoingBookings = $this->userModel->checkOngoingBooking($userId);
      
          // var_dump($ongoingBookings);


            $no=$this->userModel->noOfManagers();
            $admindetail=$this->userModel->getadmindata();
            $data=[
                
                'no'=>$no,
                'id' => $admindetail->id,
                'email'=>$admindetail->email,
                'lname' => $admindetail->lname,
                'fname' => $admindetail->fname,
                'number' => $admindetail->number,

            ];
            $this->view('admin/settings',$data);
        }
        public function addbusinessmanager(){
          $admindetail=$this->userModel->getadmindata();
            $manager=$this->userModel->findmanagerDetail();
            $data=[
              'manager'=>$manager,
              'fname'=>$admindetail->fname,
            ];
            $this->view('admin/addbusinessmanager',$data);
        }
        public function adminedit(){
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
              'name' => trim($_POST['name']),
              'email' => trim($_POST['email']),
              'number' => trim($_POST['phone-number']),
              'id' => $_SESSION['user_id'],
              'name_err'=>'',
              'email_err'=>'',
              'number_err'=>'',
              
            ];
    
            // Validate data
           //validate fname
          //  if(empty($data['fname'])){
          //     $data['fname_err']='Please enter first name';      
          // }
          // //validate email
          // if(empty($data['email'])){
          //     $data['email_err']='Please enter email';      
          //  }//else{
          //     if($this->userModel->findUserByEmail($data['email'])){
          //         $data['email_err']='Email is already taken'; 
          //     }
          // }
          //validate email
          // if(empty($data['number'])){
          //     $data['number_err']='Please enter number';      
          // }else
          if(strlen($data['number'])!=10){
              $data['number_err']='Invalid phone number'; 
          }
    
            // Make sure no errors
            if(empty($data['number_err'])){
              // Validated
              //-----------------------
              if($this->userModel->updateAdmin($data)){
                flash('user_message', 'user Updated');
                redirect('admin/settings');
              } else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
              $this->view('admin/adminedit', $data);
            }
    
          } else {
          $admindetail=$this->userModel->getadmindata();
            $data=[
                
                // 'id' => $_SESSION['user_id'],
                'id' => $admindetail->id,
                'email'=>$admindetail->email,
                'lname' => $admindetail->lname,
                'fname' => $admindetail->fname,
                'number' => $admindetail->number,

            ];
            $this->view('admin/adminedit',$data);
          }
          
          
        }
        public function adminpassword(){
          $admindetail=$this->userModel->getadmindata();
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
              
            ];
            
            //get current password
            //$currentpassword=$this->userModel->getpassword($data['id']);
            $userData = $this->userModel->getpassword($data['id']);
            $currentPasswordHash = $userData->password;;
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
                redirect('admin/settings');
              } else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
              $this->view('admin/adminpassword', $data);
            }
    
          }
          $data=[
            'fname'=>$admindetail->fname,
            'current-password' => '',
              'new-password' => '',
              'confirm-password' => '',
              'id' => '',
              'current-password_err'=>'',
              'new-password_err'=>'',
              'confirm-password_err'=>'',
          ];
            $this->view('admin/adminpassword',$data);
        }
        public function businessmanageredit($id){
          $admindetail=$this->userModel->getadmindata();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                $data = [
                  'fname' => trim($_POST['fname']),
                  'email' => trim($_POST['email']),
                  'number' => trim($_POST['number']),
                  'id' => $id,
                  'fname_err'=>'',
                  'email_err'=>'',
                  'number_err'=>'',
                  
                ];
        
                // Validate data
               //validate fname
              //  if(empty($data['fname'])){
              //     $data['fname_err']='Please enter first name';      
              // }
              // //validate email
              // if(empty($data['email'])){
              //     $data['email_err']='Please enter email';      
              //  }//else{
              //     if($this->userModel->findUserByEmail($data['email'])){
              //         $data['email_err']='Email is already taken'; 
              //     }
              // }
              //validate email
              // if(empty($data['number'])){
              //     $data['number_err']='Please enter number';      
              // }else
              if(strlen($data['number'])!=10){
                  $data['number_err']='Invalid phone number'; 
              }
        
                // Make sure no errors
                if(empty($data['number_err'])){
                  // Validated
                  //-----------------------
                  if($this->userModel->updatemanager($data)){
                    flash('user_message', 'user Updated');
                    redirect('admin/addbusinessmanager');
                  } else {
                    die('Something went wrong');
                  }
                } else {
                  // Load view with errors
                  $this->view('admin/businessmanageredit/'.$id, $data);
                }
        
              } else {
              $user=$this->userModel->findUserDetail($id);
      
                $data = [
                  'afname'=>$admindetail->fname,
                  'id' => $id,
                  'email'=>$user->email,
                  'lname' => $user->lname,
                  'fname' => $user->fname,
                  'number' => $user->number,
                ];
          
                $this->view('admin/businessmanageredit', $data);
              }
            // $data=[
            //     'id'=>$id,

            // ];
            // $this->view('admin/businessmanageredit',$data);
        }
        public function businessmanageraddform(){
          $admindetail=$this->userModel->getadmindata();
            $data=[
                'name'=>'',
                'name_err'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'number'=>'',
                // 'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
                'number_err'=>'',

            ];

            $this->view('admin/businessmanageraddform',$data);
        }
        public function traveler(){
    
          $admindetail=$this->userModel->getadmindata();
            $no=$this->userModel->noOfTravelers();
            $traveler=$this->userModel->findTravelerDetail();

            

            // var_dump($admindetail);

            $data = [
              'no'=>$no,
              'traveler'=>$traveler,

              // 'lname' => $traveler->lname,
             'fname' => $admindetail->fname,
              // 'number' => $user->number,   
            ];
            $this->view('admin/traveler',$data); 

        }
      //   public function deleteTraveler() {
      //     $userId = $_POST['id'];
      //     // $ongoingBookings = $this->userModel->checkOngoingBooking($userId);
      
      //     if ($ongoingBookings == 0) {
      //         $success = $this->userModel->updateProfileStatus($userId);
      
      //         if ($success) {
      //             // Redirect to a success page or show a success message
      //             echo json_encode(['success' => true]);
      //             exit; // Stop further execution
      //         } else {
      //             // Handle deletion failure
      //             echo json_encode(['success' => false, 'error' => 'Failed to delete traveler']);
      //             exit; // Stop further execution
      //         }
      //     } else {
      //         // Handle case where ongoing bookings exist (optional)
      //         echo json_encode(['success' => false, 'error' => 'Cannot delete traveler with ongoing bookings']);
      //         exit; // Stop further execution
      //     }
      
      //     // Only update profile status if ongoing bookings are 0
      // }
      
      public function deleteTraveler() {
        $userId = $_POST['id'];
        // $ongoingBookings = $this->userModel->checkOngoingBooking($userId);
        $success = $this->userModel->updateProfileStatus($userId);

    
        if ($success) {
            redirect('admin/traveler');
            // Redirect or show success message
        } else {
            redirect('admin/traveler');
            // Handle deletion failure
        }
    
    //     // Only update profile status if ongoing bookings are 0
    }
      
        public function deleteAgency($id){
          $user=$this->userModel->deleteAgency($id);
        }
        public function deleteGuide($id){
          $user=$this->userModel->deleteGuide($id);
        }
        public function adminDelete($id){
          // $user=$this->userModel->deleteGuide($id);
        }
        public function viewDocument($id){
          $document=$this->userModel->viewDocument($id);
          $data=[
            'document'=>$document,
          ];
         return $data;

        }
        function getDocumentName($id) {
          // Implement your database query to get the document name based on the user ID
          $documentName=$this->userModel->viewDocument($id);
          // For example, $documentName = ...;
          return $documentName;
      }

      public function acceptUser($id){
        $user=$this->userModel->findUserDetail($id);

        if($document=$this->userModel->acceptUser($id)){
          //send email accept
          require  __DIR__."./../libraries/phpma/vendor/autoload.php";

          

          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->SMTPAuth = true;
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $mail->Username = '2021is046@stu.ucsc.cmb.ac.lk';
          $mail->Password = '200036202687';
          $mail->setFrom('2021is046@stu.ucsc.cmb.ac.lk', 'TravelEase');//our
          $mail->addAddress($user->email, 'kaveesha');//sender
          $mail->Subject = 'TravelEase Confirmation';
          $mail->isHTML(true);
          $mail->Body='<p>We are pleased to inform you that your document has been approved by TravelEase. </p>
          You are now authorized to provide your service. <br>
    
          
          Thank you for choosing TravelEase! <br> If you have any further questions or require assistance, feel free to contact us
           <br>
           
           ';
          $mail->send();

          echo '<script>alert("Confirmation email sent.");</script>';
          redirect('admin/request');
          
        }
        
        $data=[];
      }

      public function declineUser($id){
        $user=$this->userModel->findUserDetail($id);
        if($document=$this->userModel->declineUser($id)){
          //send email decline
          require  __DIR__."./../libraries/phpma/vendor/autoload.php";
          
          

          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->SMTPAuth = true;
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $mail->Username = '2021is046@stu.ucsc.cmb.ac.lk';
          $mail->Password = '200036202687';
          $mail->setFrom('2021is046@stu.ucsc.cmb.ac.lk', 'TravelEase');//our
          $mail->addAddress($user->email, 'kaveesha');//sender
          $mail->Subject = 'TravelEase Confirmation';
          $mail->isHTML(true);
          $mail->Body='<p>We are pleased to inform you that your document has been rejected by TravelEase. </p>
          You are not authorized to provide your service. <br>
          <p>please resubmit your document to get approved</p>
    
          
          Thank you for choosing TravelEase! <br> If you have any further questions or require assistance, feel free to contact us
           <br>
           
           ';
          $mail->send();

          echo '<script>alert("Confirmation email sent.");</script>';
          redirect('admin/request');
        }
        $data=[];
      }

    }
