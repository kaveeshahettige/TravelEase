<?php

class Landpage extends Controller{
    public function __construct(){
      $this->userModel=$this->model('User');
    }
    public function index(){
      $this->view('landpage/index');
    }
    public function hotel(){
      $this->view('landpage/hotel');
    }
    public function transport(){
      $this->view('landpage/transport');
    }
    public function package(){
      $this->view('landpage/package');
    }  
    public function plantrip(){
      $this->view('landpage/plantrip');
    }
    public function searchPage(){
      $location = $_GET['location'];
      $city=$this->userModel->findCitydetails($location);
      $places = $this->userModel->findPlaces($location);
      //have to write queries to find hotels
      $hotels = $this->userModel->findHotels($location);
      if($places == false){
          // No matching places found, show an alert
          echo '<script>alert("No matching places found for the given location.");</script>';
          echo '<script>window.location.href = "http://localhost/TravelEase/Landpage";</script>';
      } else {
          $data = [
              'places' => $places,
              'city' => $city,
              'hotels' => $hotels
          ];
          $this->view('landpage/searchpage', $data);
      }
  }
  
    public function termsofuse(){
      $this->view('landpage/termsofuse');
    }  
}



