<?php

class Hotel extends Controller{

    private $postModel;
    public function __construct()
    {
        
    }

    public function index(){
        $this->view('hotel/index');
    }
    public function Calender(){
        $this->view('hotel/calender');
    }
    public function bookings(){
        $this->view('hotel/bookings');
        }
    public function gallery(){
        $this->view('hotel/gallery');
        }
    public function revenue(){
        $this->view('hotel/revenue');
            }
    public function reviews(){
        $this->view('hotel/reviews');
            }
    public function settings(){
        $this->view('hotel/settings');
              }
    public function addrooms(){
        $this->view('hotel/addrooms');
          } 
    public function addroomsedit(){
         $this->view('hotel/addroomsedit');
        }
    public function hoteledit(){
            $this->view('hotel/hoteledit');
                  }
    public function hotelpassword(){
         $this->view('hotel/hotelpassword');
                          }
    
    
}