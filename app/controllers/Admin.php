    <?php

    class Admin extends Controller{

        private $postModel;
        public function __construct()
        {
            
        }

        public function index(){
            $this->view('admin/index');
        }
        
        public function request(){
            $this->view('admin/request');
        }
        public function hotel(){
            $this->view('admin/hotel');
        }
        public function agency(){
            $this->view('admin/agency');
        }
        public function package(){
            $this->view('admin/package');
        }
        public function settings(){
            $this->view('admin/settings');
        }

    }
