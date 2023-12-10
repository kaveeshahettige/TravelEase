<?php


class Packages extends Controller{
    
//localhost/Packages/index
//
//    /**
//     * @var mixed
//     */
//    private $packagesModel;
    private $postModel;
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
          }
        $this->packageModel = $this->model('Package');
    }

    public function index()
    {
        $this->view('packages/index');
    }

    public function availability()
    {
        $this->view('packages/availability');
    }

    public function bookings()
    {
        $this->view('packages/bookings');
    }

    public function gallery()
    {
        $this->view('packages/gallery');
    }

    public function revenue()
    {
        $this->view('packages/revenue');
    }

    public function review()
    {
        $this->view('packages/review');
    }

    public function packages()
    {
        $this->view('packages/packages');
    }

    public function settings()
    {
        $this->view('packages/settings');
    }

    public function addpackages()
    {
        $packageData = $this->packageModel->getpackages();
        $data["packageData"] = $packageData;
        $this->view('packages/addpackages', $data);
    }
    public function packagesedit()
    {
        $this->view('packages/packagesedit');
    }

    public function packagespassword()
    {
        $this->view('packages/packagespassword');
    }

//    public function updatepackage()
//    {
//        $packageData = $this->packageModel->getpackages();
//        $data["packageData"] = $packageData;
//        $this->view('packages/updatepackage');
//    }

public function packagesaddpackages($package_id)
{
    $packageData = [
        'package_id' => $package_id,
    ];

    $this->view('packages/addpackages', $packageData);
}


public function addpackagesedit()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $packageData = [
            'PackageName' => trim($_POST['PackageName']),
            'PackageType' => trim($_POST['PackageType']),
            // 'Duration' => trim($_POST['Duration']),
            'TransportProvider' => trim($_POST['TransportProvider']),
            'AccomadationProvider' => trim($_POST['AccomadationProvider']),
            'PriceOfPackage' => trim($_POST['PriceOfPackage']),
            'Location' => trim($_POST['Location']),
            'PackageImages' => trim($_POST['PackageImages'][0]),
            'PackageDescription' => trim($_POST['PackageDescription']),
        ];


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

            if ($this->packageModel->packagesedit($packageData)) {
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

public function updatePackages($PackageID)
{
//        print_r($PackageID);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $packageData = [
            'PackageName' => trim($_POST['PackageName']),
            'PackageType' => trim($_POST['PackageType']),
            'Duration' => trim($_POST['Duration']),
//                'TransportProvider' => trim($_POST['TransportProvider']),
//                'AccomadationProvider' => trim($_POST['AccomadationProvider']),
            'PriceOfPackage' => trim($_POST['PriceOfPackage']),
//                'Location' => trim($_POST['Location']),
//                'PackageImages' => trim($_POST['PackageImages'][0]), // Assuming only one image is being stored in the database
            'PackageDescription' => trim($_POST['PackageDescription']),
            'PackageID' => $PackageID,
            'PackageName_err' => '',
            'PackageType_err' => '',
            'Duration_err' => '',
//                'TransportProvider_err' => '',
//                'AccomadationProvider_err' => '',
            'PriceOfPackage_err' => '',
//                'Location_err' => '',
//                'PackageImages_err' => '',
            'PackageDescription_err' => ''
        ];


        // Validate input fields here (similar to the method for rooms)

        if (empty($packageData['PackageName_err']) && empty($packageData['PackageType_err']) && empty($packageData['Duration_err']) && empty($packageData['PriceOfPackage_err']) &&  empty($packageData['PackageDescription_err'])) {
            if ($this->packageModel->updatePackages($packageData)) {
                flash('user_message', 'Package Updated');
                redirect('packages/addpackages');
            } else {
                die('Something went wrong');
            }
        } else {

            $this->view('packages/addpackages', $packageData); // Show the form with error messages
        }
    } else {
        $package = $this->packageModel->findpackages($PackageID);

        $packageData = [
            'PackageID' => $PackageID,
            'PackageName' => $package->name,
            'PackageType' => $package->type,
            'Duration' => $package->duration,
//                'TransportProvider' => $package->TransportProvider,
//                'AccomadationProvider' => $package->hotel,
            'PriceOfPackage' => $package->Price,
//                'Location' => $package->Location,
//                'PackageImages' => $package->PackageImages,
            'PackageDescription' => $package->description
        ];
//            var_dump($packageData);


        $this->view('packages/updatepackage', $packageData); // Show the update form
    }
}





public function deletepackages($PackageID)
{
    if ($this->packageModel->deletepackages($PackageID)) {
//            var_dump($package_id);
        flash('post_message', 'user Removed');
        redirect('Packages/addpackages');
    } else {
        die('Something went wrong');
    }
}
}