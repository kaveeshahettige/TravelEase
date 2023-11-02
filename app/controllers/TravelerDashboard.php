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

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
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
      ];
        $this->view('travelerDashboard/settings',$data);
    }
    public function editInfo(){
      
      $this->view('travelerDashboard/editInfo');
    }
    

    
}



