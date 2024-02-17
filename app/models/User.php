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
        $this->db->query('SELECT * from vehicles where vehicle_id=:id');
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

    }elseif($transactionData->type==4){
        $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, vehicle_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :vehicle_id)');
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $transactionData['furtherBookingDetails']->id);   
        $this->db->bind(':startDate', $currentDate);
        $this->db->bind(':endDate', $currentDate);
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
}

