<?php

class Packages extends Controller
{

    /**
     * @var mixed
     */
    private $packagesModel;

    public function __construct()
    {
        $this->packagesModel = $this->model('Package');
    }

    public function index()
    {
        $this->view('packages/index');
    }
//
//    public function Calender()
//    {
//        $this->view('packages/calender');
//    }
//
//    public function bookings()
//    {
//        $this->view('packages/bookings');
//    }
//
//    public function gallery()
//    {
//        $this->view('packages/gallery');
//    }
//
//    public function revenue()
//    {
//        $this->view('packages/revenue');
//    }
//
//    public function reviews()
//    {
//        $this->view('packages/reviews');
//    }
//
//    public function settings()
//    {
//        $this->view('packages/settings');
//    }
//
//    public function addpackages()
//    {
//        $packageData = $this->packagesModel->getpackages();
//        $data["packageData"] = $packageData;
//        $this->view('packages/addpackages', $data);
//    }
//
////    public function addpackagesedit()
////    {
////        $this->view('packages/addpackagesedit');
////    }
//
//    public function packagesedit()
//    {
//        $this->view('packages/packagesedit');
//    }
//
//    public function packagespassword()
//    {
//        $this->view('packages/packagespassword');
//    }
//
//    public function packagesaddpackages($package_id)
//    {
//        $packageData = [
//            'package_id' => $package_id,
//        ];
//
//        $this->view('packages/addpackages', $packageData);
//    }


    public function addpackagesedit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $packageData = [
                'PackageName' => trim($_POST['PackageName']),
                'PackageType' => trim($_POST['PackageType']),
                'Duration' => trim($_POST['Duration']),
                'TransportProvider' => trim($_POST['TransportProvider']),
                'AccomadationProvider' => trim($_POST['AccomadationProvider']),
                'PriceOfPackage' => trim($_POST['PriceOfPackage']),
                'Location' => trim($_POST['Location']),
                'PackageImages' => trim($_POST['PackageImages'][0]),
            ];

            var_dump($packageData);

            //validate packageType
            if (empty($packageData['PackageName'])) {
                $packageData['packageType_err'] = 'Please choose package Type';
            }
            
            if (empty($packageData['PackageType'])) {
                $packageData['packageType_err'] = 'Please choose package Type';
            }

            //validate numOfBeds
            if (empty($packageData['Duration'])) {
                $packageData['numOfBeds_err'] = 'Please enter Number of Beds';
            }

            //validate price
            if (empty($packageData['TransportProvider'])) {
                $packageData['price'] = 'Please Enter Price ';
            }

            //validate package images
            if (empty($packageData['AccomadationProvider'])) {
                $packageData['AccomadationProvider'] = 'Please Enter Images';
            }

            //validate Description
            if (empty($packageData['Price'])) {
                $packageData['Price'] = 'Please choose package Description';
            }

            if (empty($packageData['Location'])) {
                $packageData['Location'] = 'Please choose package Description';
            }

            if (empty($packageData['PackageImages'])) {
                $packageData['PackageImages'] = 'Please choose package Description';
            }

            //make sure errors are empty
            if (true) {

//                print_r($packageData);

                if ($this->packagesModel->packagesedit($packageData)) {
                    flash('register_success', 'You are registered and can login');
                    redirect('packages/addpackages');

                } else {
                    die('Something went wrong');
                }


//                die;

            } else {
                $this->view('packages/addpackagesedit', $packageData);
            }
        } else {

            $packageData = [
                'PackageName' => '',
                'PackageType' => '',
                'Duration' => '',
                'TransportProvider' => '',
                'AccomadationProvider' => '',
                'Price' => '',
                'Location' => '',
                'PackageImages' => '',
            ];

            $this->view('packages/addpackagesedit', ['packageData' => $packageData]);
        }
    }

//    public function packagesupdatepackages()
//    {
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//
//            $packageData = [
//                'packageType' => trim($_POST['packageType']),
//                'numOfBeds' => trim($_POST['numOfBeds']),
//                'price' => trim($_POST['price']),
//                'packageImages' => trim($_POST['packageImages']),
//                'packageDescription' => trim($_POST['packageDescription']),
//                'packageType_err' => '',
//                'numOfBeds_err' => '',
//                'price_err' => '',
//                'packageImages_err' => '',
//                'packageDescription_err' => '',
//            ];
//
//            // //validatepackageType
//            // if(empty($packageData['packageType'])){
//            //     $packageData['packageType_err']='Please choose package Type';
//            // }
//
//            // //validate numofBeds
//            // if(empty($packageData['numOfBeds'])){
//            //     $packageData['numOfBeds_err']='Please enter Number of Beds';
//            // }
//
//            // //validate price
//            // if(empty($packageData['price'])){
//            //     $packageData['price']='Please Enter Price ';
//            // }
//
//            // //validate package images
//            // if(empty($packageData['packageImages'])){
//            //     $packageData['packageImages_err']='Please Enter Images';
//            // }
//
//            // //validate Description
//            // if(empty($packageData['packageDescription'])){
//            //     $packageData['packageDescription_err']='Please choose package Description';
//            // }
//
//            //make sure errors are empty
//            if (empty($packageData['packageType_err']) && empty($packageData['numOfBeds_err']) && empty($packageData['price']) && empty($packageData['packageImages_err']) && empty($packageData['packageDescription'])) {
//
//                if ($this->packagesModel->packagesupdatepackages($packageData)) {
//                    flash('user_message', 'user Updated');
//                    redirect('packages/addpackages');
//
//                } else {
//                    die('Something went wrong');
//                }
//
//            } else {
//                $this->view('packages/addpackages', $packageData);
//            }
//        } else {
//
//            $packageData = [
//                'rood_id' => '$package_id',
////                'packageType' => $packages->packageType,
////                'numOfBeds' => $packages->numOfBeds,
////                'price' => $packages->price,
////                'packageImages' => $packages->packageImages,
////                'packageDescription' => $packages->packageDescription,
//            ];
//
//
//            $this->view('hotel/addpackagesedit', ['packageData' => $packageData]);
//        }
//    }

    public function deletepackages($package_id)
    {
//        echo $package_id;
//        die;
        if ($this->hotelsModel->deletepackages($package_id)) {
            flash('post_message', 'user Removed');
            redirect('hotel/addpackages');
        } else {
            die('Something went wrong');
        }
    }
}