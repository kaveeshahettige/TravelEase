<?php
class User{
   private $db;

    public function __construct(){
        $this->db=new Database;
    }

    public function getUsers(){
        $this->db->query('SELECT * FROM users');
        $results=$this->db->resultSet();

        return $results;
    }

    public function register($data){
        $this->db->query('INSERT INTO users (fname,lname,email,password,number) VALUES (:fname,:lname,:email,:password,:number)');
        //bind values
        $this->db->bind(':fname',$data['fname']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':lname',$data['lname']);
        $this->db->bind(':number',$data['number']);
        $this->db->bind(':password',$data['password']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function managerregister($data){
        $this->db->query('INSERT INTO users (fname,email,password,number,type) VALUES (:name,:email,:password,:number,:type)');
        
        //bind values
        //bind values
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':number',$data['number']);
        $this->db->bind(':type','2');
        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function login($email,$password){
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email',$email);

        $row=$this->db->single();

        $hashed_password=$row->password;
        if(password_verify($password,$hashed_password)){
            return $row;
        }else{
            return false;
        }
    }

    //find by user email
    public function findUserByEmail($email){
        $this->db->query('SELECT * from users WHERE email=:email');
        $this->db->bind(':email',$email);

        $row=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function findUserDetail($id){
        $this->db->query('SELECT * from users where id=:id');
        $this->db->bind(':id',$id);

        $row=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return $row;
        }else{
            return null;
        }
    }

    public function updateUser($data){
        $this->db->query('UPDATE users SET fname = :fname, lname = :lname,email = :email,number = :number WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':number', $data['number']);
  
        // Execute
        if($this->db->execute()){
        //add a function to rlaod site
          return true;
        } else {
          return false;
        }
      }

      public function deleteUser($id){
        $this->db->query('DELETE FROM users WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

      ////////////
      public function findmanagerDetail(){
        $this->db->query("SELECT * from users where type='2'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    public function deleteManager($id){
        $this->db->query('DELETE FROM users WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
  
        // Execute
        if($this->db->execute()){
            redirect('admin/addbusinessmanager');
        } else {
          return false;
        }
      }

      public function updatemanager($data){
        $this->db->query('UPDATE users SET fname = :name,email = :email,number = :number WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['fname']);  
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':number', $data['number']);
  
        // Execute
        if($this->db->execute()){
        //add a function to rlaod site
          return true;
        } else {
          return false;
        }
      }

      public function noOfManagers(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 2');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    public function noOfTravelers(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 1');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    public function noOfHotels(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 3');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    public function noOfAgencies(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 4');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    public function noOfPackages(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 5');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    public function getadmindata(){
        $this->db->query("SELECT * from users where type='0'");
        $data=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    //findTravelerDetail
    public function findTravelerDetail(){
        $this->db->query("SELECT * from users where type='1'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    //findHotelDetail
    public function findHotelDetail(){
        $this->db->query("SELECT * from users where type='3'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    //findHotelDetail
    public function findAgencyDetail(){
        $this->db->query("SELECT * from users where type='4'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    //findHotelDetail
    public function findPackageDetail(){
        $this->db->query("SELECT * from users where type='5'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    // registerTransportuser
    public function registerTransportuser($data){
        $this->db->query('INSERT INTO users (fname,lname,email,password,number,type) VALUES (:fname,:lname,:email,:password,:number,:type)');
        
            
        //bind values
        $this->db->bind(':fname',$data['fname']);
        $this->db->bind(':lname',$data['lname']);
        $this->db->bind(':number',$data['number']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':type','4');
        
        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
///////////////// tranposrt add

public function registerTransport($data){
    $this->db->query('INSERT INTO travelagency (agency_name,reg_number,address,user_id) VALUES (:name,:number,:address,:id)');

    
    //bind values
    //bind values
    $this->db->bind(':name',$data['agencyname']);
    $this->db->bind(':number',$data['address']);
    $this->db->bind(':address',$data['renumber']);
    $this->db->bind(':id',$data['user_id']);
    //execute
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}
public function registerHotel($data){
    $this->db->query('INSERT INTO users (fname,email,password,number,type) VALUES (:fname,:email,:password,:number,:type)');

    
    //bind values
    //bind values
    $this->db->bind(':fname',$data['fname']);
    $this->db->bind(':number',$data['number']);
    $this->db->bind(':email',$data['email']);
    $this->db->bind(':password',$data['password']);
    
    $this->db->bind(':type','3');
    //execute
    if($this->db->execute()){
        $user_id = $this->db->lastInsertId();
         var_dump($data);
         $this->db->query('INSERT INTO hotel (user_id, hotel_type, description, `add`, no_rooms) VALUES (:id, :hoteltype, :description, :address, :norooms)');

         $this->db->bind(':hoteltype', $data['hoteltype']);
         $this->db->bind(':description', $data['description']);
         $this->db->bind(':address', $data['address']); // Change the binding to :address
         $this->db->bind(':norooms', $data['norooms']);
         $this->db->bind(':id', $user_id);
         

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }else{
        return false;
    }
}


/////////////
public function registerPackageProvider($data){
    $this->db->query('INSERT INTO users (fname,email,password,number,type) VALUES (:fname,:email,:password,:number,:type)');

    
    //bind values
    //bind values
    $this->db->bind(':fname',$data['fname']);
    $this->db->bind(':number',$data['number']);
    $this->db->bind(':email',$data['email']);
    $this->db->bind(':password',$data['password']);
    
    $this->db->bind(':type','5');
    //execute
    if($this->db->execute()){
        $user_id = $this->db->lastInsertId();
         var_dump($data);
         $this->db->query('INSERT INTO packageprovider (user_id,address, package_type, description) VALUES (:id,:address, :package_type, :description)');

         $this->db->bind(':package_type', $data['packageType']);
         $this->db->bind(':description', $data['description']);
         $this->db->bind(':address', $data['address']); // Change the binding to :address
         $this->db->bind(':id', $user_id);
         

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }else{
        return false;
    }
}

public function updatePicture($data){
    
    $this->db->query('UPDATE users SET profile_picture = :profilepicture WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':profilepicture', $data['picture']);
    var_dump($data['picture']);
    // Execute
    if($this->db->execute()){
      return true;
    } else {
      return false;
    }
  }

  public function updateProPicture($data){
    
    $this->db->query('UPDATE users SET profile_picture = :profilepicture WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':profilepicture', $data['picture']);
    // Execute
    if($this->db->execute()){
      return true;
    } else {
      return false;
    }
  }

  public function updatePassword($data){
    $this->db->query('UPDATE users SET password = :password WHERE id=:id');
    // Bind values
    $this->db->bind(':id', $data['id']); 
    $this->db->bind(':password', $data['hashed-password']);  
    
    // Execute
    if($this->db->execute()){
    //add a function to rlaod site
      return true;
    } else {
      return false;
    }
  }


    public function findBookingAvailable($id){

        $this->db->query('SELECT bookings.*, users.*
        FROM bookings
        INNER JOIN users ON bookings.serviceProvider_id = users.id
        WHERE bookings.user_id = :id
        AND bookings.bookingCondition != "cancelled"
        AND bookings.enddate > CURDATE();
        
        ');
        $this->db->bind(':id',$id);
    
        ///////////////////////
//this should change as set of data not a single

        //////////
        //resultSet()
        $data=$this->db->resultSet();
    
        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    //   findBookingDetail
    public function findBookingDetail($type,$id){
        if($type=='3'){
            $this->db->query('SELECT * from hotel where user_id=:id');
            $this->db->bind(':id',$id);
        
            $data=$this->db->single();
        
            //check row
            if($this->db->rowCount()>0){
                return $data;
            }else{
                return null;
            }
        }
        else if($type=='4'){
            $this->db->query('SELECT * from travelagency where user_id=:id');
            $this->db->bind(':id',$id);
        
            $data=$this->db->single();
        
            //check row
            if($this->db->rowCount()>0){
                return $data;
            }else{
                return null;
            }
        }
        else if($type=='5'){
            $this->db->query('SELECT * from packageprovider where user_id=:id');
            $this->db->bind(':id',$id);
        
            $data=$this->db->single();
        
            //check row
            if($this->db->rowCount()>0){
                return $data;
            }else{
                return null;
            }
        }
    }

    //   findBookingFurtherDetail
    public function findBookingFurtherDetail($booking){
        if($booking->type=='3'){
            $this->db->query('SELECT * from hotel_rooms where room_id=:id');
            $this->db->bind(':id',$booking->room_id);
        
            $data=$this->db->single();
        
            //check row
            if($this->db->rowCount()>0){
                return $data;
            }else{
                return null;
            }
        }
        else if($booking->type=='4'){
            $this->db->query('SELECT * from vehicles where vehicle_id=:id');
            $this->db->bind(':id',$booking->vehicle_id);
        
            $data=$this->db->single();
        
            //check row
            if($this->db->rowCount()>0){
                return $data;
            }else{
                return null;
            }
        }
        else if($booking->type=='5'){
            $this->db->query('SELECT * from packages where package_id=:id');
            $this->db->bind(':id',$booking->package_id);
        
            $data=$this->db->single();
        
            //check row
            if($this->db->rowCount()>0){
                return $data;
            }else{
                return null;
            }
        }
    }


    // getRandomServiceProviders
    public function getRandomServiceProviders(){
                                        //4,5 should be removed and approval should be added
        $this->db->query('SELECT * FROM users WHERE type NOT IN (0,1,2,4,5) /*AND approval = 1*/ ORDER BY RAND() LIMIT 6');
    
    
        $data=$this->db->resultSet();
    
        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    //checkCancellationEligibility($booking->id)
    public function checkCancellationEligibility($id){
        $this->db->query('SELECT * FROM bookings WHERE booking_id = :id');
$this->db->bind(':id', $id);
$booking = $this->db->single();
$today = date("Y-m-d");
$bookingDate = $booking->bookingDate; // Change to use the correct attribute name
$diff = strtotime($today) - strtotime($bookingDate); // Change the order of substraction
$days = round($diff / 86400); // Use round without abs to allow negative values
if ($days > 7) { // Change the condition to check if $days is greater than 7
    return "Unavailable";
} else {
    return "Available";
}

    }

    //findMyBooking
    public function findMyBooking($id){
        $this->db->query('SELECT bookings.*, users.*
        FROM bookings
        LEFT JOIN users ON bookings.serviceProvider_id = users.id
        WHERE bookings.user_id = :id;');
        $this->db->bind(':id',$id);

        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    //countMyBooking
    public function countMyBooking($id){
        $this->db->query('SELECT COUNT(*) AS count FROM bookings WHERE user_id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    //findBooking($Bid)
    public function findBooking($Bid){
        $this->db->query('SELECT bookings.*, users.*
        FROM bookings
        INNER JOIN users ON bookings.serviceProvider_id = users.id
        WHERE bookings.booking_id = :id;');
        $this->db->bind(':id', $Bid);
        $booking = $this->db->single();
        if($this->db->rowcount()>0){
            return $booking;
         }
         else{
            return false;
        }
    }
    
//findRooms
public function findRooms($id){
    $this->db->query('SELECT * FROM hotel_rooms WHERE hotel_id = :id');
    $this->db->bind(':id', $id);
    $rooms = $this->db->resultSet();
    if($this->db->rowcount()>0){
        return $rooms;
     }
     else{
        return false;
    }
}
//find services by service id
public function findBookingDetailByServiceid($type,$id){
    
    if($type=='3'){
        $this->db->query('SELECT hotel_rooms.*, users.*
        FROM hotel_rooms
        JOIN hotel ON hotel_rooms.hotel_id = hotel.hotel_id
        JOIN users ON hotel.user_id = users.id
        WHERE hotel_rooms.room_id = :id;
        ');
        $this->db->bind(':id',$id);
    
        $data=$this->db->single();
    
        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    else if($type=='4'){
        $this->db->query('SELECT vehicles.*, users.*
        FROM vehicles
        JOIN travelagency ON vehicles.agency_id = travelagency.agency_id
        JOIN users ON travelagency.user_id = users.id
        WHERE vehicles.vehicle_id = :id
        ');

        $this->db->bind(':id',$id);
    
        $data=$this->db->single();
    
        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    else if($type=='5'){
        $this->db->query('SELECT * from packages where package_id=:id');
        $this->db->bind(':id',$id);
    
        $data=$this->db->single();
    
        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
}

//addBooking($transactionData);
public function addBooking($transactionData){
    $currentDate = date('Y-m-d');  //this is a dummy
//need more changes
    if($transactionData['furtherBookingDetails']->type==3){
    $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, room_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :room_id)');
    $this->db->bind(':user_id', $transactionData['user']->id);
    $this->db->bind(':serviceProvider_id', $transactionData['furtherBookingDetails']->id);   
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);
    $this->db->bind(':room_id', $transactionData['furtherBookingDetails']->room_id);

    }elseif($transactionData['furtherBookingDetails']->type==4){
        $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, vehicle_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :vehicle_id)');
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $transactionData['furtherBookingDetails']->id);   
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':vehicle_id', $transactionData['furtherBookingDetails']->vehicle_id);

    }elseif($transactionData->type==5){
        $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, package_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :package_id)');
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $transactionData['furtherBookingDetails']->id);   
        $this->db->bind(':startDate', $currentDate);
        $this->db->bind(':endDate', $currentDate);
        $this->db->bind(':package_id', $transactionData['furtherBookingDetails']->package_id);
    }
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}

// //
public function addBookingfrohbmCart($furtherbookingdetail,$transactionData){
    $currentDate = date('Y-m-d');  //this is a dummy
//need more changes
    if($furtherbookingdetail->type==3){
    $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, room_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :room_id)');
    $this->db->bind(':user_id', $transactionData['user']->id);
    $this->db->bind(':serviceProvider_id', $furtherbookingdetail->id);   
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);
    $this->db->bind(':room_id', $furtherbookingdetail->room_id);

    }elseif($furtherbookingdetail->type==4){
        $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, vehicle_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :vehicle_id)');
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $furtherbookingdetail->id);   
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':vehicle_id', $furtherbookingdetail->vehicle_id);

    }elseif($furtherbookingdetail->type==5){
        $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, package_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :package_id)');
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $furtherbookingdetail->id);   
        $this->db->bind(':startDate', $currentDate);
        $this->db->bind(':endDate', $currentDate);
        $this->db->bind(':package_id', $furtherbookingdetail->package_id);
    }
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}

//addBookingfromCart($transactionData)
public function addBookingfromCart($transactionData){
    $currentDate = date('Y-m-d');  //this is a dummy
//need more changes

// Generate a unique booking ID
$booking_id = uniqid('booking_');

// Iterate over each booking detail and insert it with the same booking ID
foreach ($transactionData['furtherBookingDetails'] as $bookingDetail) {
    if ($bookingDetail->type == 3) {
        $this->db->query('INSERT INTO cartbookings (booking_id, user_id, serviceProvider_id, startDate, endDate, room_id) VALUES (:booking_id, :user_id, :serviceProvider_id, :startDate, :endDate, :room_id)');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $bookingDetail->id);
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':room_id', $bookingDetail->room_id);
    } elseif ($bookingDetail->type == 4) {
        $this->db->query('INSERT INTO cartbookings (booking_id, user_id, serviceProvider_id, startDate, endDate, vehicle_id) VALUES (:booking_id, :user_id, :serviceProvider_id, :startDate, :endDate, :vehicle_id)');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $bookingDetail->id);
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':vehicle_id', $bookingDetail->vehicle_id);
    } elseif ($bookingDetail->type == 5) {
        $this->db->query('INSERT INTO cartbookings (booking_id, user_id, serviceProvider_id, startDate, endDate, package_id) VALUES (:booking_id, :user_id, :serviceProvider_id, :startDate, :endDate, :package_id)');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $bookingDetail->id);
        $this->db->bind(':startDate', $currentDate);
        $this->db->bind(':endDate', $currentDate);
        $this->db->bind(':package_id', $bookingDetail->package_id);
    }
    
    // Execute the query for the current iteration
    if (!$this->db->execute()) {
        // Handle the case where the query fails
        return false;
    }
}

// If all queries are executed successfully, return true
return true;


    
}


//addPaymentDetails($transactionData);
public function addPaymentDetails($transactionData,$booking_id){
        $this->db->query('INSERT INTO payments (booking_id, amount) VALUES (:booking_id, :amount)');
        $this->db->bind(':booking_id',$booking_id);
        $this->db->bind(':amount', $transactionData['furtherBookingDetails']->price);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
       
}
//

public function addCartPaymentDetails($transactionData,$booking_id){
    $this->db->query('INSERT INTO cartpayments (booking_id, amount) VALUES (:booking_id, :amount)');
    $this->db->bind(':booking_id',$booking_id);
    $this->db->bind(':amount', $transactionData['price']);

    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
   
}
//
//
// public function addCartPaymentDetails($transactionData,$booking_id){
//     $this->db->query('INSERT INTO payments (booking_id, amount) VALUES (:booking_id, :amount)');
//     $this->db->bind(':booking_id',$booking_id);
//     $this->db->bind(':amount', $transactionData['furtherBookingDetails']['price']);

//     if($this->db->execute()){
//         return true;
//     }else{
//         return false;
//     }
   
// }
//addPaymentDetailsVehicles
public function addPaymentDetailsVehicles($transactionData,$booking_id,$price){
    $this->db->query('INSERT INTO payments (booking_id, amount) VALUES (:booking_id, :amount)');
    $this->db->bind(':booking_id',$booking_id);
    $this->db->bind(':amount', $price);

    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
   
}

//getLastBooking
public function getLastBooking(){
    $this->db->query('SELECT * FROM bookings ORDER BY booking_id DESC LIMIT 1');
    $booking = $this->db->single();
    if($this->db->rowcount()>0){
        return $booking;
     }
     else{
        return false;
    }
}

//lastcartBooking
public function getLastCartBooking(){
    $this->db->query('SELECT * FROM cartbookings ORDER BY id DESC LIMIT 1');
    $booking = $this->db->single();
    if($this->db->rowcount()>0){
        return $booking;
     }
     else{
        return false;
    }
}
    
//findAvailableRooms($checkinDate, $checkoutDate)
public function findAvailableRooms($checkinDate, $checkoutDate,$hotelid){
    // sid should e added
    $this->db->query('SELECT *
    FROM hotel_rooms
    WHERE room_id NOT IN (
        SELECT room_id
        FROM bookings
        WHERE startDate <= :checkoutDate
        AND endDate >= :checkinDate
    )
    AND hotel_id = :hotelid;
    
    
');

    $this->db->bind(':checkinDate', $checkinDate);
    $this->db->bind(':checkoutDate', $checkoutDate);
    $this->db->bind(':hotelid', $hotelid);
    $rooms = $this->db->resultSet();
    if($this->db->rowcount()>0){
        return $rooms;
     }
     else{
        return false;
    }
}


//addUnavailabilty
public function addUnavailabilty($transactionData){
    $this->db->query('INSERT INTO room_availability (room_id, startDate,endDate) VALUES (:room_id, :startDate,:endDate)');
    $this->db->bind(':room_id',$transactionData['furtherBookingDetails']->room_id);
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);

    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
   
}

//addroomUnavailabilityfromCart
public function addroomUnavailabilityfromCart($furtherbookingdetail,$transactionData){
    $this->db->query('INSERT INTO room_availability (room_id, startDate,endDate) VALUES (:room_id, :startDate,:endDate)');
    $this->db->bind(':room_id',$furtherbookingdetail->room_id);
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);

    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
   
}




// Inside your User model class

// public function storeCheckoutSessionId($checkoutSessionId, $userId)
// {
//     $this->db->query('UPDATE users SET checkout_session_id = :checkoutSessionId WHERE id = :userId');
//     $this->db->bind(':checkoutSessionId', $checkoutSessionId);
//     $this->db->bind(':userId', $userId);

//     return $this->db->execute();
// }

// public function getCheckoutSessionId($userId)
// {
//     $this->db->query('SELECT checkout_session_id FROM users WHERE id = :userId');
//     $this->db->bind(':userId', $userId);

//     return $this->db->single()->checkout_session_id;
// }

// public function clearCheckoutSessionId($userId)
// {
//     $this->db->query('UPDATE users SET checkout_session_id = NULL WHERE id = :userId');
//     $this->db->bind(':userId', $userId);

//     return $this->db->execute();
// }

//cancelBooking($booking_id)
public function cancelBooking($booking_id){
    $this->db->query('UPDATE bookings SET bookingCondition = :condition WHERE booking_id = :booking_id');
    $this->db->bind(':condition', 'cancelled');
    $this->db->bind(':booking_id', $booking_id);

    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}

//findPlaces($location)
public function findPlaces($location) {
    $this->db->query('SELECT places.*
    FROM places
    INNER JOIN cities ON places.city_id = cities.id
    WHERE cities.city LIKE :location');

    

    $this->db->bind(':location', '%' . $location . '%');

    $result = $this->db->resultSet();

    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }
}

//findCitydetails($location)
public function findCitydetails($location) {
    $this->db->query('SELECT * FROM cities WHERE city LIKE :location');
    $this->db->bind(':location', '%' . $location . '%');
    $result = $this->db->single();
    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }
}

//findHotels($location);
//have to rewrite
public function findHotels($location) {

    $this->db->query('SELECT * FROM hotel
    JOIN users ON hotel.user_id = users.id
    WHERE hotel.city LIKE :location;
    ');
    $this->db->bind(':location', '%' . $location . '%');
    $result = $this->db->resultSet();
    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }

}

//getAllHotels
public function getAllHotels() {
    $this->db->query('SELECT * FROM hotel
    JOIN users ON hotel.user_id = users.id
    ');
    $result = $this->db->resultSet();
    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }
}

//getRandomHotels
public function getRandomHotels(){
$this->db->query('SELECT h.*,u.* 
FROM users u
JOIN hotel h ON u.id = h.user_id
WHERE u.type NOT IN (0, 1, 2, 4, 5) /*AND u.approval = 1*/
ORDER BY RAND() 
LIMIT 6;
');   
$data=$this->db->resultSet();

//check row
if($this->db->rowCount()>0){
    return $data;
}else{
    return null;
}
}

//getRatings
public function getRatings($hotel_id) {
    // Query to calculate the average rating for the given hotel ID
    $this->db->query('
        SELECT AVG(r.rating) AS rating
        FROM feedbacksnratings r
        JOIN bookings b ON r.booking_id = b.booking_id
        WHERE b.serviceProvider_id = :hotel_id
    ');
    // $this->db->query('
    //     SELECT AVG(rating) AS rating
    //     FROM feedbacksnratings
    //     WHERE booking_id IN (SELECT booking_id FROM bookings WHERE room_id = :hotel_id)
    // ');

    // Bind hotel_id parameter
    $this->db->bind(':hotel_id', $hotel_id);

    // Execute the query and fetch the result
    $result = $this->db->single();

    // Return the result
    return $result;
}
//getRatingsOfRooms($room_id)
public function getRatingsOfRooms($room_id) {
    // Query to calculate the average rating for the given hotel ID
    $this->db->query('
        SELECT AVG(r.rating) AS rating
        FROM feedbacksnratings r
        JOIN bookings b ON r.booking_id = b.booking_id
        WHERE b.room_id = :room_id
    ');

    // Bind hotel_id parameter
    $this->db->bind(':room_id', $room_id);

    // Execute the query and fetch the result
    $result = $this->db->single();

    // Return the result
    return $result;
}

//getRatingsOfVehicles($vehicle->vehicle_id);
public function getRatingsOfVehicles($vehicle_id) {
    // Query to calculate the average rating for the given hotel ID
    $this->db->query('
        SELECT AVG(r.rating) AS rating
        FROM feedbacksnratings r
        JOIN bookings b ON r.booking_id = b.booking_id
        WHERE b.vehicle_id = :vehicle_id
    ');

    // Bind hotel_id parameter
    $this->db->bind(':vehicle_id', $vehicle_id);

    // Execute the query and fetch the result
    $result = $this->db->single();

    // Return the result
    return $result;
}

//findFeedbacks
public function findFeedbacks($sId) {
    // Query to fetch all feedbacks for the given hotel ID
    $this->db->query('
        SELECT f.*, u.*
        FROM feedbacksnratings f
        JOIN users u ON f.user_id = u.id
        JOIN bookings b ON f.booking_id = b.booking_id
        WHERE b.serviceProvider_id = :sId
    ');

    // Bind hotel_id parameter
    $this->db->bind(':sId', $sId);

    // Execute the query and fetch the result
    $result = $this->db->resultSet();

    // Return the result
    return $result;
}


//getRandomAgencies
public function getRandomAgencies(){
    $this->db->query('SELECT t.*,u.* 
FROM users u
JOIN travelagency t ON u.id = t.user_id
WHERE u.type NOT IN (0, 1, 2, 3, 5) /*AND u.approval = 1*/
ORDER BY RAND() 
LIMIT 6;
');   
$data=$this->db->resultSet();

//check row
if($this->db->rowCount()>0){
    return $data;
}else{
    return null;
}

}

//findNoOfVehicles($id)
public function findNoOfVehicles($id){
    $this->db->query('SELECT COUNT(*) AS count FROM vehicles WHERE agency_id = :id');
    $this->db->bind(':id', $id);
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->count;
     }
     else{
        return false;
    }
}


//findVehicles($bookingDetails->agency_id)
public function findVehicles($id){
    $this->db->query('SELECT * FROM vehicles WHERE agency_id = :id');
    $this->db->bind(':id', $id);
    $result = $this->db->resultSet();
    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }
}

//findAvailableVehicles($pickupDate, $pickupTime, $dropoffDate, $dropoffTime, $agencyId);
public function findAvailableVehicles($pickupDate, $dropoffDate, $agencyId) {
    $this->db->query('SELECT * FROM vehicles
    WHERE vehicle_id NOT IN (
        SELECT vehicle_id
        FROM vehicle_bookings
        WHERE start_date <= :dropoffDate
        AND end_date >= :pickupDate
    )
    AND agency_id = :agencyId;
    ');
    $this->db->bind(':pickupDate', $pickupDate);
    $this->db->bind(':dropoffDate', $dropoffDate);
    $this->db->bind(':agencyId', $agencyId);
    $result = $this->db->resultSet();
    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }
}

//addVehicleBooking
public function addVehicleBooking($transactionData,$driver) {
    // Convert the pickup time to the correct format (if needed)
    $pickupTime = date('H:i:s', strtotime($transactionData['pickupTime']));

    // Prepare and execute the SQL query
    $this->db->query('INSERT INTO vehicle_bookings(vehicle_id, start_date, end_date, start_time,withDriver) VALUES (:vehicle_id, :start_date, :end_date, :start_time, :withDriver)');
    $this->db->bind(':vehicle_id', $transactionData['furtherBookingDetails']->vehicle_id);  
    $this->db->bind(':start_date', $transactionData['checkinDate']);
    $this->db->bind(':end_date', $transactionData['checkoutDate']);
    $this->db->bind(':start_time', $pickupTime);
    $this->db->bind(':withDriver', $driver);

    // Execute the query
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

//addVehicleBookingfromCart
public function addVehicleBookingfromCart($furtherbookingdetail,$transactionData,$driver) {
    // Convert the pickup time to the correct format (if needed)
    $pickupTime = date('H:i:s', strtotime($transactionData['pickupTime']));

    // Prepare and execute the SQL query
    $this->db->query('INSERT INTO vehicle_bookings(vehicle_id, start_date, end_date, start_time,withDriver) VALUES (:vehicle_id, :start_date, :end_date, :start_time, :withDriver)');
    $this->db->bind(':vehicle_id', $furtherbookingdetail->vehicle_id);  
    $this->db->bind(':start_date', $transactionData['checkinDate']);
    $this->db->bind(':end_date', $transactionData['checkoutDate']);
    $this->db->bind(':start_time', $pickupTime);
    $this->db->bind(':withDriver', $driver);

    // Execute the query
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

//fetchPriceByDriverTypeAndVehicleId($driverType, $vehicleId)
public function fetchPriceByDriverTypeAndVehicleId($vehicleId) {
    $this->db->query('SELECT * FROM vehicles WHERE vehicle_id = :vehicleId');
    $this->db->bind(':vehicleId', $vehicleId);
    $result = $this->db->single();
    // $price = $result->withDriverPerDay;
    if ($this->db->rowCount() > 0) {
        return  $result;;
    } else {
        return false;
    }
}


//addUnavailability for hotels
public function addUnavailability($transactionData){
    $this->db->query('INSERT INTO room_availability(room_id, startDate, endDate) VALUES (:room_id, :startDate, :endDate)');
    $this->db->bind(':room_id', $transactionData['furtherBookingDetails']->room_id);
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}

//findVehicles($location, $checkinDate, $checkoutDate)
public function findVehiclesByLocation($location, $checkinDate, $checkoutDate) {
    $this->db->query('
    SELECT * 
    FROM vehicles
    JOIN travelagency ON vehicles.agency_id = travelagency.agency_id
    JOIN users ON travelagency.user_id = users.id
    WHERE (travelagency.city LIKE :location OR travelagency.city = \'All Island\')
    AND vehicle_id NOT IN (
        SELECT vehicle_id
        FROM vehicle_bookings
        WHERE start_date <= :checkoutDate
        AND end_date >= :checkinDate
    );
');

    $this->db->bind(':location', '%' . $location . '%');
    $this->db->bind(':checkinDate', $checkinDate);
    $this->db->bind(':checkoutDate', $checkoutDate);
    $result = $this->db->resultSet();
    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }
}

//findVehiclePrice($Bid) from payments
public function findVehiclePrice($Bid){
    $this->db->query('SELECT amount FROM payments WHERE booking_id = :id');
    $this->db->bind(':id', $Bid);
    $amount = $this->db->single();
    if ($this->db->rowCount() > 0) {
        return $amount;
    } else {
        return false;
    }

}

//findDriverAvilability($Bid)
public function findDriverAvilability($Bid){
    $this->db->query('
    SELECT 
    vb.*
FROM 
    vehicle_bookings AS vb
JOIN 
    bookings AS b ON b.vehicle_id = vb.vehicle_id
WHERE 
    b.booking_id = :Bid
    AND b.startDate = vb.start_date
    AND b.endDate = vb.end_date;

    ');
    $this->db->bind(':Bid', $Bid); // Corrected binding parameter
    $driver = $this->db->single();
    if ($this->db->rowCount() > 0) {
        return $driver;
    } else {
        return false;
    }
}

//countUpcomingTrips($id)
public function countUpcomingTrips($id){
    $this->db->query('SELECT COUNT(*) AS count FROM bookings WHERE user_id = :id AND startDate > CURDATE()');
    $this->db->bind(':id', $id);
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->count;
     }
     else{
        return false;
    }
}

//monthlyPayment($id)
public function monthlyPayment($id){
    $this->db->query('SELECT SUM(amount) AS total FROM payments WHERE booking_id IN (SELECT booking_id FROM bookings WHERE user_id = :id AND MONTH(startDate) = MONTH(CURDATE()) AND YEAR(startDate) = YEAR(CURDATE()))');
    $this->db->bind(':id', $id);
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->total;
     }
     else{
        return false;
    }
}

//countPayment($id)
public function countPayment($id){
    $this->db->query('SELECT COUNT(*) AS count FROM payments WHERE booking_id IN (SELECT booking_id FROM bookings WHERE user_id = :id)');
    $this->db->bind(':id', $id);
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->count;
     }
     else{
        return false;
    }
}

//findPayment($id)
public function findPayment($id){
    $this->db->query('SELECT * FROM payments JOIN bookings ON payments.booking_id = bookings.booking_id
    WHERE bookings.user_id = :id');
    $this->db->bind(':id', $id);
    $payments = $this->db->resultSet();
     if($this->db->rowcount()>0){
        return $payments;
     }
     else{
        return false;
    }
}

//getRandomPackages()
public function getRandomPackages(){
    $this->db->query('SELECT p.*,u.* 
    FROM users u
    JOIN guides p ON u.id = p.user_id
    WHERE u.type NOT IN (0, 1, 2, 3, 4) /*AND u.approval = 1*/
    ORDER BY RAND() 
    LIMIT 6;
    ');   
    $data=$this->db->resultSet();
    
    //check row
    if($this->db->rowCount()>0){
        return $data;
    }else{
        return null;
    }
    
    }

    //findPackages($location)
//     public function findPackages($location) {
//         $this->db->query('SELECT * FROM packages
//         JOIN packageprovider ON packages.provider_id = packageprovider.provider_id
//         JOIN users ON packageprovider.user_id = users.id
//         WHERE (packageprovider.city LIKE :location OR packageprovider.city = \'All Island\');
//         ');
//         $this->db->bind(':location', '%' . $location . '%');
//         $result = $this->db->resultSet();
//         if ($this->db->rowCount() > 0) {
//             return $result;
//         } else {
//             return false;
//         }
//     }

//     //findPackagePrice($Bid) from payments
//     public function findPackagePrice($Bid){
//         $this->db->query('SELECT amount FROM payments WHERE booking_id = :id');
//         $this->db->bind(':id', $Bid);
//         $amount = $this->db->single();
//         if ($this->db->rowCount() > 0) {
//             return $amount;
//         } else {
//             return false;
//         }
    
//     }

//     //findPackageDetails($id)
//     public function findPackageDetails($id){
//         $this->db->query('SELECT * FROM packages WHERE package_id = :id');
//         $this->db->bind(':id', $id);
//         $result = $this->db->single();
//         if ($this->db->rowCount() > 0) {
//             return $result;
//         } else {
//             return false;
//         }
//     }

//     //findPackageProvider($id)
//     public function findPackageProvider($id){
//         $this->db->query('SELECT * FROM packageprovider WHERE user_id = :id');
//         $this->db->bind(':id', $id);

// }

///

//findAvailableHotelRooms($location, $checkinDate, $checkoutDate)
public function findAvailableHotelRooms($location, $checkinDate, $checkoutDate) {
    // Define the SQL query with placeholders
    $query = '
    SELECT * 
    FROM hotel_rooms
    JOIN hotel ON hotel_rooms.hotel_id = hotel.hotel_id
    JOIN users ON hotel.user_id = users.id
    WHERE (hotel.city LIKE :location)
    AND room_id NOT IN (
        SELECT room_id
        FROM room_availability
        WHERE startDate <= :checkoutDate
        AND endDate >= :checkinDate
    )';
    
    // Prepare and execute the SQL query
    $this->db->query($query);
    
    // Bind parameters
    $this->db->bind(':location', '%' . $location . '%'); // Use LIKE for partial match
    $this->db->bind(':checkinDate', $checkinDate);
    $this->db->bind(':checkoutDate', $checkoutDate);
    
    // Execute the query and fetch the results
    $result = $this->db->resultSet();
    
    // Check if there are any results
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}


//findAvailableVehicles($location, $checkinDate, $checkoutDate)
public function findAvailableVehiclesByLocation($location, $checkinDate, $checkoutDate) {
    $this->db->query('
    SELECT * 
    FROM vehicles
    JOIN travelagency ON vehicles.agency_id = travelagency.agency_id
    JOIN users ON travelagency.user_id = users.id
    WHERE (travelagency.city LIKE :location)
    AND vehicle_id NOT IN (
        SELECT vehicle_id
        FROM vehicle_bookings
        WHERE start_date <= :checkoutDate
        AND end_date >= :checkinDate
    );
');
    
        $this->db->bind(':location', '%' . $location . '%');
        $this->db->bind(':checkinDate', $checkinDate);
        $this->db->bind(':checkoutDate', $checkoutDate);
        $result = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //findVehiclePriceForDates($vehicle->vehicle_id)
    public function findVehiclePrices($vehicleId) {
        $this->db->query('SELECT * FROM vehicles WHERE vehicle_id = :vehicleId');
        $this->db->bind(':vehicleId', $vehicleId);
        $vehicle = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return $vehicle;
        } else {
            return false;
        }
    }

    //countPreviousTrips($id)
    public function countPreviousTrips($id){
        $this->db->query('SELECT COUNT(*) AS count FROM bookings WHERE user_id = :id AND endDate < CURDATE()');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    
    //findPreviousTrips($id)
    public function findPreviousTrips($id){
        $this->db->query('SELECT 
        bookings.*, 
        users.*, 
        hotel_rooms.description AS hotel_description,  -- Alias for description from hotel_rooms
        vehicles.description AS vehicle_description   -- Alias for description from vehicles
    FROM 
        bookings
    INNER JOIN 
        users ON bookings.serviceProvider_id = users.id
    LEFT JOIN 
        hotel_rooms ON bookings.room_id IS NOT NULL AND bookings.room_id = hotel_rooms.room_id
    LEFT JOIN 
        vehicles ON bookings.vehicle_id IS NOT NULL AND bookings.vehicle_id = vehicles.vehicle_id
    WHERE 
        bookings.user_id = :id
        AND bookings.endDate < CURDATE();    
        ');
        $this->db->bind(':id', $id);
        $result = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //submitFeedback($feedback,$rating,$serviceId)
    public function submitFeedback($user_id,$feedback,$rating,$bookingId){
        $this->db->query('INSERT INTO feedbacksnratings (user_id,booking_id,feedback,rating) VALUES (:user_id,:bookingId,:feedback, :rating)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':feedback', $feedback);
        $this->db->bind(':rating', $rating);
        $this->db->bind(':bookingId', $bookingId);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


}

