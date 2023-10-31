<?php

class Users extends Controller{
    public function __construct(){
      $this->userModel=$this->model('User');
    }
    //  public function index(){
    //    //$this->view('landpagehotel/index');
    //    echo 'hoo';
    // }
    
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
        redirect('LoggedTraveler/index');
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
        }else{
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err']='Email is already taken'; 
            }
        }
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
              redirect('TravelerDashboard');
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
      
  
    

    
}



