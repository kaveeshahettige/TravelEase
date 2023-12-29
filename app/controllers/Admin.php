    <?php

    class Admin extends Controller{
    

        private $postModel;
        
        public function __construct(){
            if(!isLoggedIn()){
              redirect('users/login');
            }
            $this->userModel=$this->model('AdminM');
          }

        public function index(){
          $not=$this->userModel->noOfTravelers();
          $noh=$this->userModel->noOfHotels();
          $noa=$this->userModel->noOfAgencies();
          $nop=$this->userModel->noOfpackages();
          $nore=$this->userModel->noOfRequests();

          $data = [
            'not'=>$not,
            'noh'=>$noh, 
            'noa'=>$noa,
            'nop'=>$nop,
            'nore'=>$nore,   
          ];
            $this->view('admin/index',$data);
        }
        
        public function request(){
          $requests=$this->userModel->findRequestDetail();
          $nore=$this->userModel->noOfRequests();
          $data = [
            'requests'=>$requests,
            'nore'=>$nore,
          ];
            $this->view('admin/request',$data);
        }
        public function hotel(){
            $no=$this->userModel->noOfHotels(); 
            $hotel=$this->userModel->findHotelDetail();
            $data = [
              'no'=>$no,
              'hotel'=>$hotel,
              
              // 'lname' => $traveler->lname,
              // 'fname' => $traveler->fname,
              // 'number' => $user->number,   
            ];
            $this->view('admin/hotel',$data);
        }
        public function agency(){
          $no=$this->userModel->noOfAgencies();
          $agency=$this->userModel->findAgencyDetail();
          $data = [
            'no'=>$no,
            'agency'=>$agency,
            // 'lname' => $traveler->lname,
            // 'fname' => $traveler->fname,
            // 'number' => $user->number,   
          ];
            $this->view('admin/agency',$data);
        }
        public function package(){
          $no=$this->userModel->noOfpackages();
          $package=$this->userModel->findPackageDetail();
          $data = [
            'no'=>$no,
            'package'=>$package,
            // 'lname' => $traveler->lname,
            // 'fname' => $traveler->fname,
            // 'number' => $user->number,   
          ];
            $this->view('admin/package',$data);
        }
        public function settings(){
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

            $data=$this->userModel->findmanagerDetail();
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
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                $data = [
                  'fname' => trim($_POST['fname']),
                  'email' => trim($_POST['email']),
                  'number' => trim($_POST['number']),
                  'id' => $_SESSION['user_id'],
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
                  'id' => '$id',
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

            $data=[
                'name'=>'',
                'name_err'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'number'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
                'number_err'=>'',

            ];

            $this->view('admin/businessmanageraddform',$data);
        }
        public function traveler(){
            $no=$this->userModel->noOfTravelers();
            $traveler=$this->userModel->findTravelerDetail();
            $data = [
              'no'=>$no,
              'traveler'=>$traveler,
              // 'lname' => $traveler->lname,
              // 'fname' => $traveler->fname,
              // 'number' => $user->number,   
            ];
            $this->view('admin/traveler',$data); 

        }
        public function deleteTraveler($id){
          $user=$this->userModel->deleteTraveler($id);
        }
        public function deleteHotel($id){
          $user=$this->userModel->deleteHotel($id);
        }
        public function deleteAgency($id){
          $user=$this->userModel->deleteAgency($id);
        }
        public function deleteGuide($id){
          $user=$this->userModel->deleteGuide($id);
        }

    }
