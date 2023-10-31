<?php

class LoggedTraveler extends Controller{
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
    }
    public function index(){
        $data=[];
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

    
}



