<?php

class Driver extends Controller{

    private $postModel;
    public function __construct(){
        if(!isLoggedIn()){
          redirect('users/login');
        }
      }

    public function index(){
        $this->view('driver/index');
    }
    public function Calender(){
        $this->view('driver/calender');
    }
    public function bookings(){
        $this->view('driver/bookings');
        }
    public function earings(){
        $this->view('driver/earings');
        }
    public function notification(){
        $this->view('driver/notification');
            }
    public function reviews(){
        $this->view('driver/reviews');
            }
    public function settings(){
        $this->view('driver/settings');
                }
    public function vehicle(){
        $this->view('driver/vehicle');
                    }
}