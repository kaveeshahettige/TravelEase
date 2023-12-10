<?php

class Hotel extends Controller{

    private $postModel;
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->hotelsModel = $this->model('Hotels');
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
        $roomData = $this->hotelsModel->getHotel();
        $data["roomData"] = $roomData;
//        print_r($data);
        $this->view('hotel/addrooms', $data);

    }
    public function addroomsedit(){
        $roomData = $this->hotelsModel->getHotel();
        $data["roomData"] = $roomData;
        $this->view('hotel/addroomsedit');
    }

//    public function updateroom(){
//        $roomData = $this->hotelsModel->getHotel();
//        $data["roomData"] = $roomData;
//        $this->view('hotel/updateroom');
//    }
    public function hoteledit(){
        $this->view('hotel/hoteledit');
    }
    public function hotelpassword(){
        $this->view('hotel/hotelpassword');
    }

    public function hoteladdrooms($room_id){
        $roomData= [
            'room_id'=>$room_id,
        ];

        $this->view('hotel/addrooms',$roomData);
    }


    public function hoteladdroomsedit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            print_r($_POST);
//            die;

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $roomData = [
                'roomType' => trim($_POST['roomType']),
                'numOfBeds' => trim($_POST['numOfBeds']),
                'price' => trim($_POST['price']),
                'roomImages' => trim($_POST['roomImages'][0]),
                'roomDescription' => trim($_POST['roomDescription']),
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'price_err' => '',
                'roomImages_err' => '',
                'roomDescription_err' => '',
            ];

            //validate roomType
            if(empty($roomData['roomType'])){
                $roomData['roomType_err']='Please choose Room Type';
            }

            //validate numOfBeds
            if(empty($roomData['numOfBeds'])){
                $roomData['numOfBeds_err']='Please enter Number of Beds';
            }

            //validate price
            if(empty($roomData['price'])){
                $roomData['price']='Please Enter Price ';
            }

            //validate room images
            if(empty($roomData['roomImages'])){
                $roomData['roomImages_err']='Please Enter Images';
            }

            //validate Description
            if(empty($roomData['roomDescription'])){
                $roomData['roomDescription_err']='Please choose Room Description';
            }



            //make sure errors are empty
            if(empty($roomData['roomType_err'])
                && empty($roomData['numOfBeds_err'])
                && empty($roomData['price_err'])
                && empty($roomData['roomImages_err'])
                && empty($RoomData['roomDescription']) ) {

//                print_r($roomData);

                if($this->hotelsModel->hoteladdroomsedit($roomData)){
                    flash('register_success','You are registered and can login');
                    redirect('hotel/addrooms');

                }else{
                    die('Something went wrong');
                }


//                die;

            }else{
                $this->view('hotel/addroomsedit', $roomData);
            }
        }
        else{

            $roomData = [
                'roomType' => '',
                'numOfBeds' => '',
                'price' => '',
                'roomImages' => '',
                'roomDescription' => '',
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'price_err' => '',
                'roomImages_err' => '',
                'roomDescription_err' => '',
            ];
//             var_dump($roomData);

            $this->view('hotel/addroomsedit', ['roomData'=>$roomData]);
        }
    }



    public function hotelupdaterooms($room_id)
    {
//        print_r($room_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $roomData = [
                'roomType' => trim($_POST['roomType']),
                'numOfBeds' => trim($_POST['numOfBeds']),
                'price' => trim($_POST['price']),
//                'roomImages' => trim($_POST['roomImages']),
                'roomDescription' => trim($_POST['roomDescription']),
                'room_id' => $room_id,
                'roomType_err' => '',
                'numOfBeds_err' => '',
                'price_err' => '',
                'roomImages_err' => '',
                'roomDescription_err' => '',
            ];


            // //validateroomType
            // if(empty($roomData['roomType'])){
            //     $roomData['roomType_err']='Please choose Room Type';
            // }

            // //validate numofBeds
            // if(empty($roomData['numOfBeds'])){
            //     $roomData['numOfBeds_err']='Please enter Number of Beds';
            // }

            // //validate price
            // if(empty($roomData['price'])){
            //     $roomData['price']='Please Enter Price ';
            // }

            // //validate room images
            // if(empty($roomData['roomImages'])){
            //     $roomData['roomImages_err']='Please Enter Images';
            // }

            // //validate Description
            // if(empty($roomData['roomDescription'])){
            //     $roomData['roomDescription_err']='Please choose Room Description';
            // }
//            echo "<pre>";
//            print_r($roomData);
//            exit();

            //make sure errors are empty
            if(empty($roomData['roomType_err'])&& empty($roomData['numOfBeds_err']) && empty($roomData['price_err']) && empty($roomData['roomImages_err']) && empty($RoomData['roomDescription_err']) ) {

                if($this->hotelsModel->hotelupdaterooms($roomData)){
                    flash('user_message', 'user Updated');
                    redirect('hotel/addrooms');

                }else{
                    die('Something went wrong');
                }

            }else{
                var_dump("Case");
                exit();
                $this->view('hotel/addrooms', $roomData);
            }
        }
        else{
            $hotels=$this->hotelsModel->findrooms($room_id);

            $roomData = [
                'room_id'=>$room_id,
                'roomType' =>$hotels->roomType,
                'numOfBeds' =>$hotels->numOfBeds,
                'price' => $hotels->price,
//                'roomImages' => $hotels->roomImages,
                'roomDescription' => $hotels->roomDescription,
            ];


            $this->view('hotel/updateroom',$roomData);
        }
    }

    public function deleterooms($room_id){
//        echo $room_id;
//        die;
        if($this->hotelsModel->deleterooms($room_id)){
            flash('post_message', 'Room Removed');
            redirect('hotel/addrooms');
        } else {
            die('Something went wrong');
        }
    }
}