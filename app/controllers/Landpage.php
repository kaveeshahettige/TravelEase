<?php

class Landpage extends Controller{
    public function __construct(){
      $this->userModel=$this->model('User');
    }
    public function index(){
     // $id = $_SESSION['user_id'];
    //$user = $this->userModel->findUserDetail($id);
    //$bookings = $this->userModel->findBookingAvailable($id);
    // $serviceProvider = $booking ? $this->userModel->findUserDetail($booking->serviceProvider_id) : null;
    // Ensure $bookings is an array
    // if (!is_array($bookings)) {
    //   $bookings = []; // Initialize $bookings as an empty array
    // }
    // $bookingDetailsArray = [];
    // foreach ($bookings as $booking) {
    //   //this is from room, vehicle, or package tables
    //   $furtherbookingDetails = $bookings ? $this->userModel->findBookingFurtherDetail($booking) : null;
    //   $mainbookingDetails = $booking ? $this->userModel->findBookingDetail($booking->type, $booking->serviceProvider_id) : null;



    //   $bookingDetailsArray[] = [
    //     'furtherBookingDetails' => $furtherbookingDetails,
    //     'mainbookingDetails' => $mainbookingDetails,
    //     'bookingIDs' => $booking->booking_id,
    //     'temporyIDs' => $booking->temporyid,
    //     'serviceProviderID' => $booking->serviceProvider_id,
    //     'serviceProviderName' => $booking->fname,
    //     'type' => $booking->type,

    //   ];
    // }



    ///////////////////////////random service providers/////////////////////////////////////
    $randomServiceProviders = $this->userModel->getRandomServiceProviders();
    $service1Name = $this->userModel->findUserDetail($randomServiceProviders[0]->id);
    $service1Details = $this->userModel->findBookingDetail($randomServiceProviders[0]->type, $randomServiceProviders[0]->id);
    $service2Name = $this->userModel->findUserDetail($randomServiceProviders[1]->id);
    $service2Details = $this->userModel->findBookingDetail($randomServiceProviders[1]->type, $randomServiceProviders[1]->id);
    $service3Name = $this->userModel->findUserDetail($randomServiceProviders[2]->id);
    $service3Details = $this->userModel->findBookingDetail($randomServiceProviders[2]->type, $randomServiceProviders[2]->id);
    $service1Ratings = $this->userModel->getRatings($randomServiceProviders[0]->id);
    $service2Ratings = $this->userModel->getRatings($randomServiceProviders[1]->id);
    $service3Ratings = $this->userModel->getRatings($randomServiceProviders[2]->id);



    $data = [
      //'id' => $id, // Remove the single quotes
      // 'email' => $user ? $user->email : null,
      // 'lname' => $user ? $user->lname : null,
      // 'fname' => $user ? $user->fname : null,
      // 'number' => $user ? $user->number : null,
      // 'profile_picture' => $user ? $user->profile_picture : null,
      // 'serviceProviderID' => $booking ? $booking->serviceProvider_id : null,

      // 'bookingDetails' => $bookingDetails,

      // 'picture' => $bookingDetails ? $bookingDetails->picture : null,
      'randomServiceProvider1Location' => $service1Details ? $service1Details->city : null,
      'randomServiceProvider1Id' => $service1Details ? $service1Details->user_id : null,
      'randomServiceProvider1Name' => $service1Name ? $service1Name->fname . ' ' . $service1Name->lname : null,
      'randomServiceProvider2Location' => $service2Details ? $service2Details->city : null,
      'randomServiceProvider2Id' => $service2Details ? $service2Details->user_id : null,
      'randomServiceProvider2Name' => $service2Name ? $service2Name->fname . ' ' . $service2Name->lname : null,
      'randomServiceProvider3Location' => $service3Details ? $service3Details->city : null,
      'randomServiceProvider3Id' => $service3Details ? $service3Details->user_id : null,
      'randomServiceProvider3Name' => $service3Name ? $service3Name->fname . ' ' . $service3Name->lname : null,
      'service1Ratings' => $service1Ratings ? $service1Ratings : null,
      'service2Ratings' => $service2Ratings ? $service2Ratings : null,
      'service3Ratings' => $service3Ratings ? $service3Ratings : null,
      'service1pp' => $service1Name ? $service1Name->profile_picture : null,
      'service2pp' => $service2Name ? $service2Name->profile_picture : null,
      'service3pp' => $service3Name ? $service3Name->profile_picture : null,

      //'service1Name'=>$service1Name,

      //'bookingDetailsArray' => $bookingDetailsArray,
      //'randomServiceProvider1Name'=>$service1Details ? $service1Details->fname . ' ' . $service1Details->lname : null,

    ];

      $this->view('landpage/index',$data);
    }
    public function hotel(){
      $hotels = $this->userModel->getRandomHotels();
    //$ratings = $this->userModel->getRatings($hotels->id);

    // Initialize an empty array to store ratings for each hotel
    $ratings = [];

    // Iterate through each hotel
    if ($hotels != null) {
      foreach ($hotels as $hotel) {
        // Fetch ratings for the current hotel
        $hotelRatings = $this->userModel->getRatings($hotel->user_id);

        // Store ratings in the ratings array with hotel id as key
        $ratings[$hotel->hotel_id] = $hotelRatings;
      }

      // Iterate through each hotel again to add ratings to the hotel data
      foreach ($hotels as &$hotel) {
        // Add ratings to the hotel data
        $hotel->ratings = isset($ratings[$hotel->hotel_id]) ? $ratings[$hotel->hotel_id] : null;
      }
    }

    $data = [
      //'profile_picture' => $user ? $user->profile_picture : null, // Add the profile picture to the data array
      'hotels' => $hotels,
    ];
      $this->view('landpage/hotel',$data);
    }
    public function transport(){
      $agencies = $this->userModel->getRandomAgencies();
    // Initialize an empty array to store ratings for each hotel
    $ratings = [];

    // Iterate through each hotel
    if ($agencies != null) {
      foreach ($agencies as $agency) {
        // Fetch ratings for the current hotel
        $agencyRatings = $this->userModel->getRatings($agency->user_id);

        // Store ratings in the ratings array with hotel id as key
        $ratings[$agency->agency_id] = $agencyRatings;
      }

      // Iterate through each hotel again to add ratings to the hotel data
      foreach ($agencies as $agency) {
        // Add ratings to the hotel data
        $agency->ratings = isset($ratings[$agency->agency_id]) ? $ratings[$agency->agency_id] : null;
      }
    }


    $data = [
      'agencies' => $agencies,
    ];
      $this->view('landpage/transport',$data);
    }
    public function package(){
      $guides = $this->userModel->getRandomPackages();

      $gratings = [];
  
      if (is_array($guides)) {
        // Iterate through each hotel
        foreach ($guides as $guide) {
          // Fetch ratings for the current hotel
          $guideRatings = $this->userModel->getRatingsOfGuides($guide->user_id);
  
          // Store ratings in the ratings array with hotel id as key
          $gratings[$guide->user_id] = $guideRatings;
        }
      }
  
      if (is_array($guides)) {
        // Iterate through each hotel again to add ratings to the vehcle data
        foreach ($guides as &$guide) {
          // Add ratings to the vehicle data
          $guide->gratings = isset($gratings[$guide->user_id]) ? $gratings[$guide->user_id] : null;
        }
      }
  
      $data = [
        'packages' => $guides,
      ];
      $this->view('landpage/package',$data);
    }  

    //searchVehicles
    public function searchVehicles()
  {
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Perform the search operation
      $location = $_POST['location'];
      $checkinDate = $_POST['pickupdate'];
      $checkinTime = $_POST['pickuptime'];
      $checkoutDate = $_POST['dropoffdate'];
      //$user = $this->userModel->findUserDetail($_SESSION['user_id']);
      $vehicles = $this->userModel->findVehiclesByLocation($location, $checkinDate, $checkoutDate);
      //vehicle raings
      $vratings = [];
      if ($vehicles != null) {
        foreach ($vehicles as $vehicle) {
          // Fetch ratings for the current vehicle
          $vehicleRatings = $this->userModel->getRatingsOfVehicles($vehicle->vehicle_id);

          // Store ratings in the ratings array with vehicle id as key
          $vratings[$vehicle->vehicle_id] = $vehicleRatings;
        }

        // Iterate through each vehicle again to add ratings to the vehicle data
        if (is_array($vehicles)) {
          // Iterate through each hotel again to add ratings to the vehcle data
          foreach ($vehicles as &$vehicle) {
            // Add ratings to the vehicle data
            $vehicle->vratings = isset($vratings[$vehicle->vehicle_id]) ? $vratings[$vehicle->vehicle_id] : null;
          }
        }
      }

      // Pass the search results to the view and load it
      $data = [
        'vehicles' => $vehicles,
        //'profile_picture' => $user ? $user->profile_picture : null,
        'location' => $location,
        'checkinDate' => $checkinDate,
        'checkinTime' => $checkinTime,
        'checkoutDate' => $checkoutDate,
      ];
      $this->view('Landpage/searchVehicles', $data);
      exit; // Ensure that script execution stops after loading the view
    } else {
      // If the request method is not POST, redirect to a different URL
      header('Location: /TravelEase/Landpage'); // Redirect to the main page or another appropriate URL
      exit; // Ensure that script execution stops after the redirect
    }
  }

  //////////////

  public function searchHotels()
  {
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Perform the search operation
      $location = $_POST['location'];
      //$user = $this->userModel->findUserDetail($_SESSION['user_id']);
      $hotels = $this->userModel->findHotels($location);

      // Initialize an empty array to store ratings for each hotel
      $ratings = [];

      // Iterate through each hotel
      if ($hotels != null) {
        foreach ($hotels as $hotel) {
          // Fetch ratings for the current hotel
          $hotelRatings = $this->userModel->getRatings($hotel->user_id);

          // Store ratings in the ratings array with hotel id as key
          $ratings[$hotel->hotel_id] = $hotelRatings;
        }

        // Iterate through each hotel again to add ratings to the hotel data
        foreach ($hotels as &$hotel) {
          // Add ratings to the hotel data
          $hotel->ratings = isset($ratings[$hotel->hotel_id]) ? $ratings[$hotel->hotel_id] : null;
        }
      }


      // Pass the search results to the view and load it
      $data = [
        'hotels' => $hotels,
        //'profile_picture' => $user ? $user->profile_picture : null,
        'location' => $location,
      ];
      $this->view('Landpage/hotel', $data);
      exit; // Ensure that script execution stops after loading the view
    } else {
      // If the request method is not POST, redirect to a different URL
      header('Location: /TravelEase/loggedTraveler'); // Redirect to the main page or another appropriate URL
      exit; // Ensure that script execution stops after the redirect
    }
  }
//////////////////
public function searchGuides()
{
  // Check if the request method is POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform the search operation
    $location = $_POST['location'];
    //$user = $this->userModel->findUserDetail($_SESSION['user_id']);
    $guides = $this->userModel->findGuidesByLocation($location);

    $gratings = [];

    if (is_array($guides)) {
      // Iterate through each hotel
      foreach ($guides as $guide) {
        // Fetch ratings for the current hotel
        $guideRatings = $this->userModel->getRatingsOfGuides($guide->user_id);

        // Store ratings in the ratings array with hotel id as key
        $gratings[$guide->user_id] = $guideRatings;
      }
    }

    if (is_array($guides)) {
      // Iterate through each hotel again to add ratings to the vehcle data
      foreach ($guides as &$guide) {
        // Add ratings to the vehicle data
        $guide->gratings = isset($gratings[$guide->user_id]) ? $gratings[$guide->user_id] : null;
      }
    }

    // Pass the search results to the view and load it
    $data = [
      //'profile_picture' => $user ? $user->profile_picture : null,
      'packages' => $guides,
      'location' => $location,
    ];
    $this->view('Landpage/package', $data);
    exit; // Ensure that script execution stops after loading the view
  } else {
    // If the request method is not POST, redirect to a different URL
    header('Location: /TravelEase/loggedTraveler'); // Redirect to the main page or another appropriate URL
    exit; // Ensure that script execution stops after the redirect
  }
}

////////////////
    public function plantrip(){
      $this->view('landpage/plantrip');
    }
    public function searchPage(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Perform the search operation
        $location = $_POST['location'];
        ///$checkinDate = $_POST['checkinDate'];
        //$checkoutDate = $_POST['checkoutDate'];
        // $checkinDate = date('Y-m-d', strtotime($checkinDate));
        // $checkoutDate = date('Y-m-d', strtotime($checkoutDate));
  
        $city = $this->userModel->findCitydetails($location);
        $places = $this->userModel->findPlaces($location);
        if (!$city && !$places) {
          // Echo the HTML for the modal
          echo "
          <div id='myModali' class='modali' style='display: block;'>
              <div class='modali-content'>
                  <span class='closei'>&times;</span>
                  <h2>No Matching Locations Found</h2>
                  <p>We couldn't find any locations matching your search.</p>
                  <p>Please try again or contact support for assistance.</p>
              </div>
          </div>";
  
          // Include modal JavaScript and CSS
          echo "<script src='" . URLROOT . "js/loggedTraveler/script.js'></script>";
          echo "<link rel='stylesheet' type='text/css' href='" . URLROOT . "css/loggedTraveler/style.css'>";
  
          // JavaScript to handle modal close and redirection
          echo "
          <script>
              // Function to close the modal
              function closeModal() {
                  var modal = document.getElementById('myModali');
                  if (modal) {
                      modal.style.display = 'none';
                  }
              }
      
              // When the user clicks on the close button, close the modal
              var closeButton = document.querySelector('.closei');
              if (closeButton) {
                  closeButton.addEventListener('click', function() {
                      closeModal();
                      window.location.href = '/TravelEase/loggedTraveler/index';
                  });
              }
      
              // Redirect to index after a delay
              setTimeout(function() {
                  window.location.href = '/TravelEase/loggedTraveler/index';
              }, 5000); // Adjust the delay as needed
          </script>";
  
          exit;
        } else {
          //$user = $this->userModel->findUserDetail($_SESSION['user_id']);
          $hotels = $this->userModel->findHotelRooms($location);
          $vehicles = $this->userModel->findVehiclesByLocationGiven($location);
          //$packages = $this->userModel->findPackages($location);
          $guides = $this->userModel->findGuidesByLocation($location);
  
  
          $vehiclePrices = []; // Array to hold prices for each vehicle
  
          // Check if $hotels is iterable (array or object)
          if (is_iterable($hotels)) {
            // Initialize an empty array to store ratings for each hotel
            $ratings = [];
  
            // Iterate through each hotel
            foreach ($hotels as $hotel) {
              // Fetch ratings for the current hotel
              $roomRatings = $this->userModel->getRatingsOfRooms($hotel->room_id);
  
              // Store ratings in the ratings array with hotel id as key
              $ratings[$hotel->room_id] = $roomRatings;
            }
  
            // Iterate through each hotel again to add ratings to the hotel data
            foreach ($hotels as &$hotel) {
              // Add ratings to the hotel data
              $hotel->ratings = isset($ratings[$hotel->room_id]) ? $ratings[$hotel->room_id] : null;
            }
          } else {
            // Handle the case where $hotels is not iterable
            // For example, display a message indicating no hotels are available
            //echo "No hotels available.";
          }
  
          ////////////////
          // Check if $vehicles is iterable (array or object)
          if (is_iterable($vehicles)) {
            // Initialize an empty array to store vehicle ratings
            $vratings = [];
  
            // Iterate through each vehicle
            foreach ($vehicles as $vehicle) {
              // Fetch ratings for the current vehicle
              $vehicleRatings = $this->userModel->getRatingsOfVehicles($vehicle->vehicle_id);
  
              // Store ratings in the ratings array with vehicle id as key
              $vratings[$vehicle->vehicle_id] = $vehicleRatings;
            }
  
            // Iterate through each vehicle again to add ratings to the vehicle data
            foreach ($vehicles as &$vehicle) {
              // Add ratings to the vehicle data
              $vehicle->vratings = isset($vratings[$vehicle->vehicle_id]) ? $vratings[$vehicle->vehicle_id] : null;
            }
          } else {
            // Handle the case where $vehicles is not iterable
            // For example, display a message indicating no vehicles are available
            //echo "No vehicles available.";
          }
  
          ////
          // Check if $vehicles is iterable (array or object)
          if (is_iterable($guides)) {
            // Initialize an empty array to store vehicle ratings
            $gratings = [];
  
            if (is_array($guides)) {
              // Iterate through each hotel
              foreach ($guides as $guide) {
                // Fetch ratings for the current hotel
                $guideRatings = $this->userModel->getRatingsOfGuides($guide->user_id);
  
                // Store ratings in the ratings array with hotel id as key
                $gratings[$guide->user_id] = $guideRatings;
              }
            }
  
            if (is_array($guides)) {
              // Iterate through each hotel again to add ratings to the vehcle data
              foreach ($guides as &$guide) {
                // Add ratings to the vehicle data
                $guide->gratings = isset($gratings[$guide->user_id]) ? $gratings[$guide->user_id] : null;
              }
            }
          } else {
            // Handle the case where $vehicles is not iterable
            // For example, display a message indicating no vehicles are available
            //echo "No vehicles available.";
          }
  
          /////////////
  
          if ($vehicles) {
            foreach ($vehicles as $vehicle) {
              // Assuming you have a method to find prices for a specific vehicle and dates
              $prices = $this->userModel->findVehiclePrices($vehicle->vehicle_id);
              //prices per data gap
              //$numDays = (strtotime($checkoutDate) - strtotime($checkinDate)) / (60 * 60 * 24) + 1;
              //$totalPrice = $prices->priceperday * $numDays;
  
              // Add prices to the vehiclePrices array
              $vehiclePrices[$vehicle->vehicle_id] = $prices; // Assuming vehicle_id is unique
            }
          } else {
            // echo "No vehicles available";
          }
  
  
          // Pass the search results to the view and load it
          $data = [
            'places' => $places,
            'city' => $city,
            'hotelrooms' => $hotels,
            // 'agencies' => $agencies,
            // 'packages' => $packages,
            'vehiclePrices' => $vehiclePrices,
            'vehicles' => $vehicles,
            //'profile_picture' => $user ? $user->profile_picture : null,
            'location' => $location,
            //'checkinDate' => $checkinDate,
            //'checkoutDate' => $checkoutDate,
            'guides' => $guides,
          ];
          $this->view('Landpage/searchPage', $data);
          exit; // Ensure that script execution stops after loading the view
  
        }
      } else {
        // If the request method is not POST, redirect to a different URL
        header('Location: /TravelEase'); // Redirect to the main page or another appropriate URL
        exit; // Ensure that script execution stops after the redirect
      }
      }
  
  
    public function termsofuse(){
      $this->view('landpage/termsofuse');
    }  

    public function tripfurtherdetail($Sid)
  {

    $servicProvider = $this->userModel->findUserDetail($Sid);
    //$user = $this->userModel->findUserDetail($_SESSION['user_id']);
    //main booking details from service provider table(hotel,travelagncy,package tables)
    $bookingDetails = $servicProvider ? $this->userModel->findBookingDetail($servicProvider->type, $Sid) : null;
    $feedbacks = $servicProvider ? $this->userModel->findFeedbacks($Sid) : null;
    if ($servicProvider->type == 3) {
      $rooms = $bookingDetails ? $this->userModel->findRooms($bookingDetails->hotel_id) : null;
      $vehicles = null;
      $NoVehicles = 0;
    } else if ($servicProvider->type == 4) {
      $rooms = null;
      $NoVehicles = $bookingDetails ? $this->userModel->findNoOfVehicles($bookingDetails->agency_id) : null;
      $vehicles = $bookingDetails ? $this->userModel->findVehicles($bookingDetails->agency_id) : null;
    } else if ($servicProvider->type == 5) {
      $rooms = null;
      $NoVehicles = 0;
      $vehicles = null;
      //$packages=$bookingDetails?$this->userModel->findPackages($bookingDetails->) : null
    }

    $data = [
      'email' => $servicProvider ? $servicProvider->email : null,
      'serviceProviderName' => $servicProvider ? $servicProvider->fname . ' ' . $servicProvider->lname : null,
      //'profile_picture' => $user ? $user->profile_picture : null,
      'serviceProvideNumber' => $servicProvider ? $servicProvider->number : null,
      'service_image' => $servicProvider ? $servicProvider->profile_picture : null,
      'type' => $servicProvider ? $servicProvider->type : null,
      'bookingDetails' => $bookingDetails,
      'rooms' => $rooms ? $rooms : null,
      'NoVehicles' => $NoVehicles ? $NoVehicles : 0,
      'vehicles' => $vehicles ? $vehicles : null,
      'feedbacks' => $feedbacks ? $feedbacks : null,
    ];
    $this->view('Landpage/tripfurtherdetail', $data);
  }

}



