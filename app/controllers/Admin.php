    <?php

    class Admin extends Controller{

        private $postModel;
        
        public function __construct(){
            if(!isLoggedIn()){
              redirect('users/login');
            }
            $this->userModel=$this->model('User');
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
            $no=$this->userModel->noOfManagers();
            $admindetail=$this->userModel->getadmindata();
            $data=[
                'no'=>$no,
                'id' => $admindetail->id,
                'email'=>$admindetail->email,
                'lname' => $admindetail->lname,
                'fname' => $admindetail->fname,
                'number' => $admindetail->number,

            ];
            $this->view('admin/settings',$data);
        }
        public function addbusinessmanager(){

            $data=$this->userModel->findmanagerDetail();
            $this->view('admin/addbusinessmanager',$data);
        }
        public function adminedit(){
            $this->view('admin/adminedit');
        }
        public function adminpassword(){
            $this->view('admin/adminpassword');
        }
        public function businessmanageredit($id){
            $data=[
                'id'=>$id,

            ];
            $this->view('admin/businessmanageredit',$data);
        }
        public function businessmanageraddform(){

            $data=[
                'name'=>'',
                'name_err'=>'',
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

            $this->view('admin/businessmanageraddform',$data);
        }
        


    }
