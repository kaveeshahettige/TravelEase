<?php

class Businessmanager extends Controller{

    private $postModel;
    public function __construct()
    {
        
    }

    public function index(){
        $this->view('businessmanager/index');
    }
    public function addpackage(){
        $this->view('businessmanager/addpackage');
    }
    public function bookings(){
        $this->view('businessmanager/bookings');
    }
    public function businessmanageredit(){
        $this->view('businessmanager/businessmanageredit');
    }
    public function businessmanagerpassword(){
        $this->view('businessmanager/businessmanagerpassword');
    }
    public function financialmanagement(){
        $this->view('businessmanager/financialmanagement');
    }
    public function packageedit(){
        $this->view('businessmanager/packageedit');
    }
    public function packages(){
        $this->view('businessmanager/packages');
    }   public function reports(){
        $this->view('businessmanager/reports');
    }
    public function settings(){
        $this->view('businessmanager/settings');
    }
    

}
