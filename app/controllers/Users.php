<?php

class Users extends Controller{
    public function __construct(){
      $this->userModel=$this->model('User');
    }
    
    public function register(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process form
            
            //sanitize data
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            //init data
            $data=[
                'fname'=>trim($_POST['fname']),
                'lname'=>trim($_POST['lname']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'number'=>trim($_POST['number']),
                'fname_err'=>'',
                'lname_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
                'number_err'=>'',

            ];
            //validate fname
            if(empty($data['fname'])){
                $data['fname_err']='Please enter first name';      
            }
            //validate lname
            if(empty($data['lname'])){
                $data['lname_err']='Please enter last name';      
            }
            //validate email
            if(empty($data['email'])){
                $data['email_err']='Please enter email';      
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='Email is already taken'; 
                }
            }
            //validate password
            if(empty($data['password'])){
                $data['password_err']='Please enter password';      
            }elseif(strlen($data['password'])<6){
                $data['password_err']='Password must be atleast 6 characters'; 
            }

             //validate confirm password
             if(empty($data['confirm_password'])){
                $data['confirm_password_err']='Please confirm password';      
            }else{
                if($data['password']!=$data['confirm_password']){
                    $data['confirm_password_err']='password not matching';
                }
            }

            //validate email
            if(empty($data['number'])){
                $data['number_err']='Please enter number';      
            }elseif(strlen($data['number'])<10){
                $data['number_err']='Invalid phone number'; 
            }

            //make sure errors are empty
            if(empty($data['fname_err']) && empty($data['lname_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['number_err']) ){
                //validate

                //hash password
                $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

                //regsiter user
                if($this->userModel->register($data)){
                    flash('register_success','You are registered and can login');
                    redirect('users/login');
                }else{
                    die('Something went wrong');
                }

            }else{
                $this->view('users/register',$data);
            }

            

        }else{
            
            //init data
            $data=[
                'fname'=>'',
                'lname'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'number'=>'',
                'fname_err'=>'',
                'lname_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
                'number_err'=>'',

            ];
            $this->view('users/register',$data);
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process form
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            //init data
            $data=[
                
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>'',

            ];
             //validate email
             if(empty($data['email'])){
                $data['email_err']='Please enter email';      
            }
             //validate password
            if(empty($data['password'])){
                $data['password_err']='Please enter password';      
            }

            //check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                //user found
            }else{
                $data['email_err']='No user found';
            }
            
            //make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                //validate
                //chek and set logged in user
                $loggedInUser=$this->userModel->login($data['email'],$data['password']);

                if($loggedInUser){
                    //create session
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err']='Password incorrect';
                    $this->view('users/login',$data);
                }
            }else{
                $this->view('users/login',$data);
            }
        }else{
            //init data
            $data=[
                'email'=>'',
                'password'=>'',
                'email_err'=>'',
                'password_err'=>'',

            ];
            $this->view('users/login',$data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id']=$user->id;
        $_SESSION['user_email']=$user->email;
        $_SESSION['user_fname']=$user->fname;
        $_SESSION['user_lname']=$user->lname;
        $_SESSION['user_number']=$user->number;
        //redirect('registeredLandPage');
        if($user->type==1){
            redirect('LoggedTraveler/index');
        }else if($user->type==0){
            redirect('Admin/index');
        }else if($user->type==2){
            redirect('Businessmanager/index');
        }else if($user->type==3){
            redirect('hotel/index');
        }else if($user->type==4){
            redirect('driver/index');
        }else if($user->type==5){
            redirect('packages/index');
        }
        
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_fname']);
        unset($_SESSION['user_number']);
        session_destroy();
        redirect('landpage');
    }


    ///////////////////////////
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Sanitize POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
            'fname' => trim($_POST['fname']),
            'lname' => trim($_POST['lname']),
            'email' => trim($_POST['email']),
            'number' => trim($_POST['number']),
            'id' => $_SESSION['user_id'],
            'card_holder_name' => trim($_POST['cardholdername']),
            'account_number' => trim($_POST['accountnumber']),
            'fname_err'=>'',
            'lname_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'number_err'=>'',
            
          ];
  
          // Validate data
         //validate fname
         if(empty($data['fname'])){
            $data['fname_err']='Please enter first name';      
        }
        //validate lname
        if(empty($data['lname'])){
            $data['lname_err']='Please enter last name';      
        }
        //validate email
        if(empty($data['email'])){
            $data['email_err']='Please enter email';      
         }//else{
        //     if($this->userModel->findUserByEmail($data['email'])){
        //         $data['email_err']='Email is already taken'; 
        //     }
        // }
        //validate email
        if(empty($data['number'])){
            $data['number_err']='Please enter number';      
        }elseif(strlen($data['number'])!=10){
            $data['number_err']='Invalid phone number'; 
        }
  
          // Make sure no errors
          if(empty($data['fname_err']) && empty($data['lname_err'])&& empty($data['email_err'])&& empty($data['number_err'])){
            // Validated
            //-----------------------
            if($this->userModel->updateUser($data)){
              flash('user_message', 'user Updated');
              redirect('TravelerDashboard/settings/$id');
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('travelerDashboard/editInfo', $data);
          }
  
        } else {
        $user=$this->userModel->findUserDetail($id);

          $data = [
            'id' => '$id',
            'email'=>$user->email,
            'lname' => $user->lname,
            'fname' => $user->fname,
            'number' => $user->number,
            'card_holder_name' => $user->card_holder_name,
            'account_number' => $user->account_number,
            'profile_picture' => $user->profile_picture,
          ];
    
          $this->view('travelerDashboard/editinfo', $data);
        }
      }

      public function delete($id){
        
  
          if($this->userModel->deleteUser($id)){
            flash('post_message', 'user Removed');
            redirect('Landpage');
          } else {
            die('Something went wrong');
          }
        } 
      //////////////////////////////

      public function managerregister(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process form
            
            //sanitize data
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            //init data
            $data=[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'number'=>trim($_POST['number']),
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
                'number_err'=>'',

            ];
            //validate fname
            if(empty($data['name'])){
                $data['name_err']='Please enter first name';      
            }
            //validate email
            if(empty($data['email'])){
                $data['email_err']='Please enter email';      
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='Email is already taken'; 
                }
            }
            //validate password
            if(empty($data['password'])){
                $data['password_err']='Please enter password';      
            }elseif(strlen($data['password'])<6){
                $data['password_err']='Password must be atleast 6 characters'; 
            }

             //validate confirm password
             if(empty($data['confirm_password'])){
                $data['confirm_password_err']='Please confirm password';      
            }else{
                if($data['password']!=$data['confirm_password']){
                    $data['confirm_password_err']='password not matching';
                }
            }

            //validate email
            if(empty($data['number'])){
                $data['number_err']='Please enter number';      
            }elseif(strlen($data['number'])<10){
                $data['number_err']='Invalid phone number'; 
            }

            //make sure errors are empty
            if(empty($data['name_err'])&& empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['number_err']) ){
                //validate

                //hash password
                $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

                //regsiter user
   
                if($this->userModel->managerregister($data)){
                    flash('register_success','You are registered and can login');
                    redirect('admin/addbusinessmanager');
                    
                }else{
                    die('Something went wrong');
                }

            }else{
                $this->view('admin/businessmanageraddform',$data);
            }

            

        }else{
            
            //init data
            $data=[
                'name'=>'',
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
            var_dump($data);

            $this->view('admin/businessmanageraddform',$data);
        }
    }
    public function deleteManager($id){
        $user=$this->userModel->deleteManager($id);
      }

    //////////
    public function businessmanageredit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Sanitize POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'number' => trim($_POST['number']),
            'id' => $id,
            'name_err'=>'',
            'name_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'number_err'=>'',
            
          ];
  
        //   Validate data
        //  validate fname
         if(empty($data['name'])){
            $data['name_err']='Please enter first name';      
        }
        //validate lname
        // if(empty($data['lname'])){
        //     $data['lname_err']='Please enter last name';      
        // }
        //validate email
        if(empty($data['email'])){
            $data['email_err']='Please enter email';      
         }//else{
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err']='Email is already taken'; 
            }
        }
        // validate email
        if(empty($data['number'])){
            $data['number_err']='Please enter number';      
        }elseif(strlen($data['number'])!=10){
            $data['number_err']='Invalid phone number'; 
        }
  
          // Make sure no errors
          if(empty($data['name_err'])&& empty($data['email_err'])&& empty($data['number_err'])){
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
  
        }
        
        /////////////transport reg/////////////
// transportReg1
public function transportReg1(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //process form
        
        //sanitize data
        $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        //init data
        $data=[
            'fname'=>trim($_POST['fname']),
            'lname'=>trim($_POST['lname']),
            'email'=>trim($_POST['email']),
            'password'=>trim($_POST['password']),
            'confirm_password'=>trim($_POST['confirm_password']),
            'number'=>trim($_POST['number']),
            'fname_err'=>'',
            'lname_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'',
            'number_err'=>'',

        ];
        //validate fname
        if(empty($data['fname'])){
            $data['fname_err']='Please enter first name';      
        }
        //validate lname
        // if(empty($data['lname'])){
        //     $data['lname_err']='Please enter last name';      
        // }
        //validate email
        if(empty($data['email'])){
            $data['email_err']='Please enter email';      
        }else{
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err']='Email is already taken'; 
            }
        }
        //validate password
        if(empty($data['password'])){
            $data['password_err']='Please enter password';      
        }elseif(strlen($data['password'])<6){
            $data['password_err']='Password must be atleast 6 characters'; 
        }

         //validate confirm password
         if(empty($data['confirm_password'])){
            $data['confirm_password_err']='Please confirm password';      
        }else{
            if($data['password']!=$data['confirm_password']){
                $data['confirm_password_err']='password not matching';
            }
        }

        //validate email
        if(empty($data['number'])){
            $data['number_err']='Please enter number';      
        }elseif(strlen($data['number'])<10){
            $data['number_err']='Invalid phone number'; 
        }

        //make sure errors are empty
        if(empty($data['fname_err'])&& empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['number_err']) ){
            //validate

            //hash password
            $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

            //regsiter user
            $userid=$this->userModel->registerTransportuser($data);
            if($userid){
                
                flash('register_success','You are registered and can login');
                redirect('users/transportReg2/'.$userid);
            }else{
                die('Something went wrong');
            }

        }else{
            $this->view('users/transportReg1',$data);
        }

        

    }else{
        
        //init data
        $data=[
            'fname'=>'',
            'lname'=>'',
            'email'=>'',
            'password'=>'',
            'confirm_password'=>'',
            'number'=>'',
            'fname_err'=>'',
            'lname_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'',
            'number_err'=>'',

        ];
        $this->view('users/transportReg1',$data);
    }
}

//////////transportreg2
public function transportReg2($id){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //process form
        
        //sanitize data
        $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        //init data
        $data=[
            'agencyname'=>trim($_POST['agencyname']),
            'address'=>trim($_POST['address']),
            
            'renumber'=>trim($_POST['renumber']),
            
            'agencyname_err'=>'',
            'address_err'=>'',
            
            'renumber_err'=>'',
            'user_id'=>$id,
           

        ];
        //validate fname
        if(empty($data['agencyname'])){
            $data['agencyname_err']='Please enter agency name';      
        }
        if(empty($data['address'])){
            $data['address_err']='Please enter address';      
        }
        if(empty($data['renumber'])){
            $data['renumber_err']='Please enter register number';      
        }
        //make sure errors are empty
        if(empty($data['agencyname_err'])&& empty($data['address_err'])){
            //validate

            //regsiter user
            if($this->userModel->registerTransport($data)){
                flash('register_success','You are registered and can login');
                redirect('users/login');
            }else{
                die('Something went wrong');
            }

        }else{
            $this->view('users/transportReg2',$data);
        }

        

    }else{
        
        //init data
        $data=[
            'agencyname'=>'',
            'address'=>'',
            'renumber'=>'',
            
            'agencyname_err'=>'',
            'address_err'=>'',
            
            'renumber_err'=>'',

        ];
        $this->view('users/transportReg2',$data);
    }
}


public function hotelreg(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //process form
        
        //sanitize data
        $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        //init data
        $data=[
            'fname'=>trim($_POST['hotelName']),
            'hoteltype'=>trim($_POST['hotelType']),
            'address'=>trim($_POST['address']),
            'email'=>trim($_POST['email']),
            // 'description'=>trim($_POST['description']),  
            'password'=>trim($_POST['password']),
            'number'=>trim($_POST['number']),
            // 'norooms'=>trim($_POST['allocatedRooms']),
            'confirm_password'=>trim($_POST['confirm_password']),
            'fname_err'=>'',
            'address_err'=>'',
            'email_err'=>'',
            // 'description_err'=>'',
            'password_err'=>'',
            'number_err'=>'',
            // 'norooms_err'=>'',
            'confirm_password_err'=>'',
            

        ];
        // validate fname
        if(empty($data['fname'])){
            $data['fname_err']='Please enter first name';      
        }
        //validate email
        if(empty($data['email'])){
            $data['email_err']='Please enter email';      
        }else{
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err']='Email is already taken'; 
            }
        }
        //validate password
        if(empty($data['password'])){
            $data['password_err']='Please enter password';      
        }elseif(strlen($data['password'])<6){
            $data['password_err']='Password must be atleast 6 characters'; 
        }

         //validate confirm password
         if(empty($data['confirm_password'])){
            $data['confirm_password_err']='Please confirm password';      
        }else{
            if($data['password']!=$data['confirm_password']){
                $data['confirm_password_err']='password not matching';
            }
        }

        //validate email
        if(empty($data['number'])){
            $data['number_err']='Please enter number';      
        }elseif(strlen($data['number'])<10){
            $data['number_err']='Invalid phone number'; 
        }

        //make sure errors are empty
        if(empty($data['fname_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['number_err']) ){
            //validate

            //hash password
            $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

            //regsiter user
            if($this->userModel->registerHotel($data)){
                flash('register_success','You are registered and can login');
                redirect('users/login');
            }else{
                die('Something went wrong');
            }

        }else{
            $this->view('users/hotelreg',$data);
        }

        

    }else{
        
        //init data
        $data=[
            'fname'=>'',
            'lname'=>'',
            'email'=>'',
            'password'=>'',
            'confirm_password'=>'',
            'number'=>'',
            'fname_err'=>'',
            'lname_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'',
            'number_err'=>'',

        ];
        $this->view('users/hotelreg',$data);
    }
}

public function packagereg(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //process form
        
        //sanitize data
        $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        //init data
        $data=[
            'fname'=>trim($_POST['packageOwnerName']),
            'packageType'=>trim($_POST['packageType']),
            'address'=>trim($_POST['address']),
            'email'=>trim($_POST['email']),
            'description'=>trim($_POST['description']),  
            'password'=>trim($_POST['password']),
            'number'=>trim($_POST['number']),
            'confirm_password'=>trim($_POST['confirm_password']),
            'fname_err'=>'',
            'address_err'=>'',
            'email_err'=>'',
            'description_err'=>'',
            'password_err'=>'',
            'number_err'=>'',
            'packageType_err'=>'',
            'confirm_password_err'=>'',
            

        ];
        //validate fname
        // if(empty($data['fname'])){
        //     $data['fname_err']='Please enter first name';      
        // }
        // //validate email
        // if(empty($data['email'])){
        //     $data['email_err']='Please enter email';      
        // }else{
        //     if($this->userModel->findUserByEmail($data['email'])){
        //         $data['email_err']='Email is already taken'; 
        //     }
        // }
        // //validate password
        // if(empty($data['password'])){
        //     $data['password_err']='Please enter password';      
        // }elseif(strlen($data['password'])<6){
        //     $data['password_err']='Password must be atleast 6 characters'; 
        // }

        //  //validate confirm password
        //  if(empty($data['confirm_password'])){
        //     $data['confirm_password_err']='Please confirm password';      
        // }else{
        //     if($data['password']!=$data['confirm_password']){
        //         $data['confirm_password_err']='password not matching';
        //     }
        // }

        // //validate email
        // if(empty($data['number'])){
        //     $data['number_err']='Please enter number';      
        // }elseif(strlen($data['number'])<10){
        //     $data['number_err']='Invalid phone number'; 
        // }

        //make sure errors are empty
        if(empty($data['fname_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['number_err']) ){
            //validate

            //hash password
            $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

            //regsiter user
            if($this->userModel->registerPackageProvider($data)){
                flash('register_success','You are registered and can login');
                redirect('users/login');
            }else{
                die('Something went wrong');
            }

        }else{
            $this->view('users/packagereg',$data);
        }

        

    }else{
        
        //init data
        $data=[
            'fname'=>'',
            'lname'=>'',
            'email'=>'',
            'password'=>'',
            'confirm_password'=>'',
            'number'=>'',
            'fname_err'=>'',
            'lname_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'',
            'number_err'=>'',

        ];
        $this->view('users/packagereg',$data);
    }
}

public function transportRegNew(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //process form
        
        //sanitize data
        $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        //init data
        $data=[
            'fname'=>trim($_POST['fname']),
            
            'email'=>trim($_POST['email']),
            'password'=>trim($_POST['password']),
            'confirm_password'=>trim($_POST['confirm_password']),
            'number'=>trim($_POST['number']),
            'fname_err'=>'',
           
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'',
            'number_err'=>'',

        ];
        //validate fname
        if(empty($data['fname'])){
            $data['fname_err']='Please enter first name';      
        }
        //validate lname
       
        //validate email
        if(empty($data['email'])){
            $data['email_err']='Please enter email';      
        }else{
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err']='Email is already taken'; 
            }
        }
        //validate password
        if(empty($data['password'])){
            $data['password_err']='Please enter password';      
        }elseif(strlen($data['password'])<6){
            $data['password_err']='Password must be atleast 6 characters'; 
        }

         //validate confirm password
         if(empty($data['confirm_password'])){
            $data['confirm_password_err']='Please confirm password';      
        }else{
            if($data['password']!=$data['confirm_password']){
                $data['confirm_password_err']='password not matching';
            }
        }

        //validate number
        if(empty($data['number'])){
            $data['number_err']='Please enter number';      
        }elseif(strlen($data['number'])<10){
            $data['number_err']='Invalid phone number'; 
        }

        //make sure errors are empty
        if(empty($data['fname_err'])  && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['number_err']) ){
            //validate

            //hash password
            $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

            //regsiter user
            if($this->userModel->registerTransportuser($data)){
                // flash('register_success','You are registered and can login');
                redirect('users/login');
            }else{
                die('Something went wrong');
            }

        }else{
            $this->view('users/transportRegNew',$data);
        }

        

    }else{
        
        //init data
        $data=[
            'fname'=>'',
            
            'email'=>'',
            'password'=>'',
            'confirm_password'=>'',
            'number'=>'',
            'fname_err'=>'',
            'lname_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'',
            'number_err'=>'',

        ];
        $this->view('users/transportRegNew',$data);
    }
}


      }  
    



    
      
      
     


