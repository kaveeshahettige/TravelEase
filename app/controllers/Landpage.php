<?php

class Landpage extends Controller{
    public function __construct(){
     
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
      
      $this->view('landpage/searchpage');
    }   
    public function termsofuse(){
      $this->view('landpage/termsofuse');
    }  
}



