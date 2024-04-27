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

    //   public function deleteUser($id){
    //     $this->db->query('DELETE FROM users WHERE id = :id');
    //     // Bind values
    //     $this->db->bind(':id', $id);
  
    //     // Execute
    //     if($this->db->execute()){
    //       return true;
    //     } else {
    //       return false;
    //     }
    //   }

    //deactivateUser
    public function deactivateUser($id){
        $this->db->query('UPDATE users SET profile_status = 0 WHERE id = :id');
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
        $this->db->query('INSERT INTO users (fname,email,password,number,type) VALUES (:fname,:email,:password,:number,:type)');
        
            
        //bind values
        $this->db->bind(':fname',$data['fname']);
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
         $this->db->query('INSERT INTO hotel (user_id, hotel_type, `addr`) VALUES (:id, :hoteltype, :address)');

         $this->db->bind(':hoteltype', $data['hoteltype']);
        //  $this->db->bind(':description', $data['description']);
         $this->db->bind(':address', $data['address']); // Change the binding to :address
        //  $this->db->bind(':norooms', $data['norooms']);
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
        AND bookings.startDate > CURDATE()

        UNION ALL

        SELECT cartbookings.*, users.*
        FROM cartbookings
        INNER JOIN users ON cartbookings.serviceProvider_id = users.id
        WHERE cartbookings.user_id = :id
        AND cartbookings.bookingCondition != "cancelled"
        AND cartbookings.startDate > CURDATE();
        
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
            $this->db->query('SELECT * from guides where user_id=:id');
            $this->db->bind(':id',$id);
        
            $data=$this->db->single();
        
            //check row
            if($this->db->rowCount()>0){
                return $data;
            }else{
                return null;
            }
            return true;
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
            $this->db->query('SELECT * from guides where user_id=:id');
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
        $this->db->query('SELECT * FROM users WHERE type NOT IN (0,1,2,4,5) AND approval = 1 AND profile_status=1 ORDER BY RAND() LIMIT 6');
    
    
        $data=$this->db->resultSet();
    
        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    //checkCancellationEligibility($booking->id)
    public function checkCancellationEligibility($id) {
    $this->db->query('SELECT * FROM bookings WHERE booking_id = :id
    UNION
    SELECT * FROM cartbookings WHERE booking_id = :id
    ');
    $this->db->bind(':id', $id);
    $booking = $this->db->single();

    // Get today's date
    $today = date("Y-m-d");

    // Get the start date of the booking
    $start = $booking->startDate;

    // Get the booking date
    $bookingDate = $booking->bookingDate;

    // Calculate the difference in days between today and the start date of the booking
    $diffStart = strtotime($start) - strtotime($today);
    $daysStart = round($diffStart / 86400); // Convert seconds to days

    // Calculate the difference in days between the booking date and the start date of the booking
    $diffBooking = strtotime($today) - strtotime($bookingDate);
    $daysBooking = round($diffBooking / 86400); // Convert seconds to days

    // Check both conditions
    if ($daysStart > 3 && $daysBooking < 7) {
        return "Available";
    } else {
        return "Unavailable";
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
    //
    //findMyUpcomingBooking
    public function findMyUpcomingBooking($id){
        $this->db->query('
            SELECT bookings.*, users.*
            FROM bookings
            LEFT JOIN users ON bookings.serviceProvider_id = users.id
            WHERE bookings.user_id = :id
            AND DATE(bookings.startDate) > CURDATE()
            AND bookings.bookingCondition != "cancelled"
    
            UNION ALL
    
            SELECT cartbookings.*, users.*
            FROM cartbookings
            LEFT JOIN users ON cartbookings.serviceProvider_id = users.id
            WHERE cartbookings.user_id = :id
            AND DATE(cartbookings.startDate) > CURDATE()
            AND cartbookings.bookingCondition != "cancelled"
        ');
        $this->db->bind(':id', $id);
        $data = $this->db->resultSet();
    
        // Check if any rows are returned
        if (!empty($data)) {
            return $data;
        } else {
            return null;
        }
    }
    
    //findMyUpcomingCartBooking
    //countMyBooking
    public function countMyBooking($id){
        $this->db->query('SELECT COUNT(*) AS count
        FROM (
            SELECT booking_id, user_id, bookingCondition, bookingDate
            FROM bookings
            WHERE user_id = :id
                AND bookingCondition != "cancelled"
                AND MONTH(bookingDate) = MONTH(CURRENT_DATE())
                AND YEAR(bookingDate) = YEAR(CURRENT_DATE())
        
            UNION ALL
        
            SELECT booking_id, user_id, bookingCondition, bookingDate
            FROM cartbookings
            WHERE user_id = :id
                AND bookingCondition != "cancelled"
                AND MONTH(bookingDate) = MONTH(CURRENT_DATE())
                AND YEAR(bookingDate) = YEAR(CURRENT_DATE())
        ) AS all_bookings;
        
        ');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    //
    //countMyUpcomingBooking
    public function countMyUpcomingBooking($id){
        $this->db->query('
            SELECT COUNT(*) AS count FROM (
                SELECT * FROM bookings WHERE user_id = :id AND DATE(startDate) > CURDATE()  AND bookingCondition != "cancelled"
                UNION ALL
                SELECT * FROM cartbookings WHERE user_id = :id AND DATE(startDate) > CURDATE()  AND bookingCondition != "cancelled"
            ) AS combined_bookings');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        if($this->db->rowCount() > 0){
            return $row->count;
        } else {
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
    public function findCartBooking($Bid, $Tid){
        $this->db->query('SELECT cartbookings.*, users.*
            FROM cartbookings
            INNER JOIN users ON cartbookings.serviceProvider_id = users.id
            WHERE cartbookings.booking_id = :id AND cartbookings.temporyid = :tid;');
        $this->db->bind(':id', $Bid);
        $this->db->bind(':tid', $Tid);
        $booking = $this->db->single();
        if($this->db->rowcount() > 0){
            return $booking;
        } else {
            return false;
        }
    }
    
//findRooms
public function findRooms($id){
    $this->db->query('SELECT * FROM hotel_rooms WHERE hotel_id = :id AND roomCondition="activated"');
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
        $this->db->query('SELECT guides.*,users.*
FROM guides
JOIN users ON users.id = guides.user_id
WHERE guides.user_id = :id;
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

    }elseif($transactionData['furtherBookingDetails']->type==5){
        $this->db->query('INSERT INTO bookings (user_id, serviceProvider_id, startDate, endDate, package_id) VALUES (:user_id, :serviceProvider_id, :startDate, :endDate, :package_id)');
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $transactionData['furtherBookingDetails']->id);   
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate',$transactionData['checkoutDate']);
        $this->db->bind(':package_id', $transactionData['furtherBookingDetails']->id);
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
        $this->db->bind(':serviceProvider_id', $furtherbookingdetail->user_id);   
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':package_id', $furtherbookingdetail->user_id);
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
$booking_id = uniqid('', true);

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
        $this->db->bind(':serviceProvider_id', $bookingDetail->user_id);
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':package_id', $bookingDetail->user_id);
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

//getTemportIdsByBookingId($lastcartBooking)
public function getTemportIdsByBookingId($lastcartBooking){
    $this->db->query('SELECT temporyid FROM cartbookings WHERE booking_id = :id');
    $this->db->bind(':id', $lastcartBooking);
    $data = $this->db->resultSet();
    if($this->db->rowcount()>0){
        return $data;
     }
     else{
        return false;
    }
}

//addtoCartTable
public function addtoCartTable($transactionData){
    $currentDate = date('Y-m-d');  //this is a dummy

    $cartbooking_id = uniqid('', true);

// Iterate over each booking detail and insert it with the same booking ID
foreach ($transactionData['furtherBookingDetails'] as $bookingDetail) {
    if ($bookingDetail->type == 3) {
        $this->db->query('INSERT INTO cart (cartbooking_id,user_id, serviceProvider_id, startDate, endDate, room_id) VALUES (:cartbooking_id,:user_id, :serviceProvider_id, :startDate, :endDate, :room_id)');
       
        $this->db->bind(':cartbooking_id', $cartbooking_id);
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $bookingDetail->id);
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':room_id', $bookingDetail->room_id);
    } elseif ($bookingDetail->type == 4) {
        $this->db->query('INSERT INTO cart (cartbooking_id,user_id, serviceProvider_id, startDate, endDate, vehicle_id,withDriver,pickupTime) VALUES (:cartbooking_id,:user_id, :serviceProvider_id, :startDate, :endDate, :vehicle_id,:withDriver,:pickupTime)');
        
        $this->db->bind(':cartbooking_id', $cartbooking_id);
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $bookingDetail->id);
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':vehicle_id', $bookingDetail->vehicle_id);
        $this->db->bind(':withDriver', $transactionData['driver']);
        $this->db->bind(':pickupTime', $transactionData['pickupTime']);

    } elseif ($bookingDetail->type == 5) {
        $this->db->query('INSERT INTO cart (cartbooking_id,user_id, serviceProvider_id, startDate, endDate, package_id,meetTime) VALUES (:cartbooking_id,:user_id, :serviceProvider_id, :startDate, :endDate, :package_id,:meetTime)');
        
        $this->db->bind(':cartbooking_id', $cartbooking_id);
        $this->db->bind(':user_id', $transactionData['user']->id);
        $this->db->bind(':serviceProvider_id', $bookingDetail->user_id);
        $this->db->bind(':startDate', $transactionData['checkinDate']);
        $this->db->bind(':endDate', $transactionData['checkoutDate']);
        $this->db->bind(':package_id', $bookingDetail->user_id);
        $this->db->bind(':meetTime', $transactionData['meetTime']);
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

//findCartDetails($id)
public function findCartDetails($id){
    $this->db->query('SELECT cart.*, users.*
    FROM cart
    LEFT JOIN users ON cart.serviceProvider_id = users.id
    WHERE cart.user_id = :id ');
    
    $this->db->bind(':id',$id);

    $data=$this->db->resultSet();

    //check row
    if($this->db->rowCount()>0){
        return $data;
    }else{
        return null;
    }
}

// //findCartDetailsGrouping($id)
// public function findCartDetailsGrouping($id){
//     $this->db->query('SELECT cart.*, users.fname, users.lname
//                       FROM cart
//                       LEFT JOIN users ON cart.serviceProvider_id = users.id
//                       WHERE cart.user_id = :id
//                       ');

//     $this->db->bind(':id', $id);

//     $data = $this->db->resultSet();

//     // Check if rows were returned
//     if (!empty($data)) {
//         return $data;
//     } else {
//         return null;
//     }
// }



//countCart($id)
public function countCart($id){
    //detinct number of cartbooking_id
    $this->db->query('SELECT COUNT(DISTINCT cartbooking_id) AS count
    FROM cart
    WHERE user_id = :id;');
    $this->db->bind(':id', $id);
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->count;
     }
     else{
        return false;
    }
}


//countCartItems($id)
public function countCartItems($id){
    $this->db->query('SELECT COUNT(*) AS count
    FROM cart
    WHERE user_id = :id;');
    $this->db->bind(':id', $id);
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->count;
     }
     else{
        return false;
    }
}

//removefromCart($cartbooking_id)
public function removefromCart($cartbooking_id){
    $this->db->query('DELETE FROM cart WHERE cartbooking_id = :cartbooking_id');
    $this->db->bind(':cartbooking_id', $cartbooking_id);
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
        $this->db->bind(':amount', $transactionData['total']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
       
}
//

public function addCartPaymentDetails($temporyId, $servicePrice,$booking_id){
    $this->db->query('INSERT INTO cartpayments (tempory_id,booking_id, amount) VALUES (:tempory_id,:booking_id, :amount)');
    $this->db->bind(':tempory_id',$temporyId);
    $this->db->bind(':booking_id',$booking_id);
    $this->db->bind(':amount',$servicePrice);

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
    $this->db->query('SELECT * FROM cartbookings ORDER BY temporyid DESC LIMIT 1');
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
        FROM room_availability
        WHERE startDate <= :checkoutDate
        AND (endDate >= :checkinDate OR endDate IS NULL)
    )
    AND hotel_id = :hotelid
    AND roomCondition=:condition  
');

    $this->db->bind(':checkinDate', $checkinDate);
    $this->db->bind(':checkoutDate', $checkoutDate);
    $this->db->bind(':hotelid', $hotelid);
    $this->db->bind(':condition', 'activated');
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

//cancelCartBooking($temporyid,$booking_id)
public function cancelCartBooking($temporyid,$booking_id){
    $this->db->query('UPDATE cartbookings SET bookingCondition = :condition WHERE temporyid = :temporyid AND booking_id = :booking_id');    
    $this->db->bind(':condition', 'cancelled');
    $this->db->bind(':temporyid', $temporyid);
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
//findLocations
public function findLocations($location) {
    $this->db->query('SELECT city FROM cities WHERE city LIKE :location');
    $this->db->bind(':location', '%' . $location . '%');
    $results = $this->db->resultSet();
    return $results;
}


//findHotels($location);
//have to rewrite
public function findHotels($location) {

    $this->db->query('SELECT *
    FROM hotel
    JOIN users ON hotel.user_id = users.id
    WHERE (hotel.city LIKE :location OR hotel.addr LIKE :location)
    AND users.approval = 1 AND users.profile_status=1');
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
WHERE u.type NOT IN (0, 1, 2, 4, 5) AND u.approval = 1 AND u.profile_status=1
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
    FROM (
        SELECT  rating
        FROM feedbacksnratings
        JOIN bookings ON feedbacksnratings.booking_id = bookings.booking_id
        WHERE bookings.serviceProvider_id = :hotel_id
    
        UNION ALL
    
        SELECT  rating
        FROM feedbacksnratings
        JOIN cartbookings ON feedbacksnratings.ftempory_id = cartbookings.temporyid
        WHERE cartbookings.serviceProvider_id = :hotel_id
    ) AS r;
    
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
    SELECT AVG(rating) AS rating
    FROM (
        SELECT r.rating
        FROM feedbacksnratings r
        JOIN bookings b ON r.booking_id = b.booking_id
        WHERE b.room_id = :room_id

        UNION ALL

        SELECT cr.rating
        FROM feedbacksnratings cr
        JOIN cartbookings cb ON cr.ftempory_id = cb.temporyid
        WHERE cb.room_id = :room_id
    ) AS combined_ratings;      
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

        SELECT AVG(rating) AS rating
    FROM (
        SELECT r.rating
        FROM feedbacksnratings r
        JOIN bookings b ON r.booking_id = b.booking_id
        WHERE b.vehicle_id = :vehicle_id

        UNION ALL

        SELECT cr.rating
        FROM feedbacksnratings cr
        JOIN cartbookings cb ON cr.ftempory_id = cb.temporyid
        WHERE cb.vehicle_id = :vehicle_id
    ) AS combined_ratings;  
    ');

    // Bind hotel_id parameter
    $this->db->bind(':vehicle_id', $vehicle_id);

    // Execute the query and fetch the result
    $result = $this->db->single();
    

    // Return the result
    return $result;
}

//getRatingsOfGuides($guide->user_id);
public function getRatingsOfGuides($guide_id) {
    // Query to calculate the average rating for the given hotel ID
    $this->db->query('
    SELECT AVG(rating) AS rating
    FROM (
        SELECT r.rating
        FROM feedbacksnratings r
        JOIN bookings b ON r.booking_id = b.booking_id
        WHERE b.package_id = :guide_id

        UNION ALL

        SELECT cr.rating
        FROM feedbacksnratings cr
        JOIN cartbookings cb ON cr.ftempory_id = cb.temporyid
        WHERE cb.package_id = :guide_id
    ) AS combined_ratings;  
    ');

    // Bind hotel_id parameter
    $this->db->bind(':guide_id', $guide_id);

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
    FROM (
        SELECT feedbacksnratings.*
        FROM feedbacksnratings
        JOIN bookings ON feedbacksnratings.booking_id = bookings.booking_id
        WHERE bookings.serviceProvider_id = :sId
    
        UNION ALL
    
        SELECT feedbacksnratings.*
        FROM feedbacksnratings
        JOIN cartbookings ON feedbacksnratings.ftempory_id = cartbookings.temporyid
        WHERE cartbookings.serviceProvider_id = :sId
    ) AS f
    JOIN users u ON f.user_id = u.id;
    
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
WHERE u.type NOT IN (0, 1, 2, 3, 5) AND u.approval = 1 AND u.profile_status=1
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
        FROM vehicle_availability
        WHERE startDate <= :dropoffDate
        AND (endDate >= :pickupDate OR endDate IS NULL)
    )
    AND agency_id = :agencyId
    AND vehicleCondition=:condition;
    
    ');
    $this->db->bind(':pickupDate', $pickupDate);
    $this->db->bind(':dropoffDate', $dropoffDate);
    $this->db->bind(':agencyId', $agencyId);
    $this->db->bind(':condition', 'activated');
    $result = $this->db->resultSet();
    if ($this->db->rowCount() > 0) {
        return $result;
    } else {
        return false;
    }
}

//addVehicleBooking
public function addVehicleBooking($booking_id,$transactionData,$driver) {
    // Convert the pickup time to the correct format (if needed)
    $pickupTime = date('H:i:s', strtotime($transactionData['pickupTime']));

    // Prepare and execute the SQL query
    $this->db->query('INSERT INTO vehicle_bookings(booking_id,vehicle_id, start_date, end_date, start_time,withDriver) VALUES (:booking_id,:vehicle_id, :start_date, :end_date, :start_time, :withDriver)');
    $this->db->bind(':booking_id', $booking_id);
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
public function addVehicleBookingfromCart($lastcartBooking,$furtherbookingdetail,$transactionData,$driver) {
    // Convert the pickup time to the correct format (if needed)
    $pickupTime = date('H:i:s', strtotime($transactionData['pickupTime']));

    // Prepare and execute the SQL query
    $this->db->query('INSERT INTO vehicle_bookings(booking_id,vehicle_id, start_date, end_date, start_time,withDriver) VALUES (:booking_id,:vehicle_id, :start_date, :end_date, :start_time, :withDriver)');
   $this->db->bind(':booking_id', $lastcartBooking);
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

//addUnavailabilityVehicles
public function addUnavailabilityVehicles($transactionData){
    $this->db->query('INSERT INTO vehicle_availability(vehicle_id, startDate, endDate) VALUES (:vehicle_id, :startDate, :endDate)');
    $this->db->bind(':vehicle_id', $transactionData['furtherBookingDetails']->vehicle_id);
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}

//addUnavailabilityVehiclesfromCart
public function addUnavailabilityVehiclesfromCart($transactionData,$bookingDetail){
    $this->db->query('INSERT INTO vehicle_availability(vehicle_id, startDate, endDate) VALUES (:vehicle_id, :startDate, :endDate)');
    $this->db->bind(':vehicle_id',$bookingDetail->vehicle_id);
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}

//addUnavailabilityGuides
public function addUnavailabilityGuides($transactionData){
    $this->db->query('INSERT INTO guide_availability(user_id, startDate, endDate) VALUES (:user_id, :startDate, :endDate)');
    $this->db->bind(':user_id', $transactionData['serviceid']);
    $this->db->bind(':startDate', $transactionData['checkinDate']);
    $this->db->bind(':endDate', $transactionData['checkoutDate']);
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}


//
public function addUnavailabilityGuidesfromCart($transactionData,$bookingDetail){
    $this->db->query('INSERT INTO guide_availability(user_id, startDate, endDate) VALUES (:user_id, :startDate, :endDate)');
    $this->db->bind(':user_id', $bookingDetail->user_id);
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
        FROM vehicle_availability
        WHERE startDate <= :checkoutDate
        AND (endDate >= :checkinDate OR endDate IS NULL)
    )
    AND vehicles.vehicleCondition = :vehicleCondition
    AND users.profile_status = 1 AND users.approval = 1;

');

    $this->db->bind(':location', '%' . $location . '%');
    $this->db->bind(':checkinDate', $checkinDate);
    $this->db->bind(':checkoutDate', $checkoutDate);
    $this->db->bind(':vehicleCondition', 'activated');
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
//findCartVehiclePrice
public function findCartVehiclePrice($Bid){
    $this->db->query('SELECT amount FROM cartpayments WHERE booking_id = :id');
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
public function findDriverAvilabilityCart($Bid){
    $this->db->query('
    SELECT 
    vb.*
FROM 
    vehicle_bookings AS vb
JOIN 
    cartbookings AS b ON b.vehicle_id = vb.vehicle_id
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
    $this->db->query('SELECT COUNT(*) AS count FROM (
        SELECT booking_id FROM payments WHERE booking_id IN (SELECT booking_id FROM bookings WHERE user_id = :id AND bookingCondition!=:condition)
        UNION ALL
        SELECT booking_id FROM cartpayments WHERE booking_id IN (SELECT booking_id FROM cartbookings WHERE user_id = :id AND bookingCondition!=:condition)
    ) AS combined_payments;
    ');
    $this->db->bind(':id', $id);
    $this->db->bind(':condition', 'cancelled');
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->count;
     }
     else{
        return false;
    }
}
//countPaymentMonthly
public function countPaymentMonthly($id){
    $this->db->query('SELECT COUNT(*) AS count 
    FROM (
        SELECT booking_id
        FROM payments 
        WHERE booking_id IN (
            SELECT booking_id 
            FROM bookings 
            WHERE user_id = :id AND bookingCondition!=:condition
        )
        AND MONTH(payment_date) = MONTH(CURDATE()) 
        AND YEAR(payment_date) = YEAR(CURDATE())
    
        UNION ALL
    
        SELECT booking_id
        FROM cartpayments 
        WHERE booking_id IN (
            SELECT booking_id 
            FROM cartbookings 
            WHERE user_id = :id AND bookingCondition!=:condition
        )
        AND MONTH(payment_date) = MONTH(CURDATE()) 
        AND YEAR(payment_date) = YEAR(CURDATE())
    ) AS all_payments;
    
    ');
    $this->db->bind(':id', $id);
    $this->db->bind(':condition', 'cancelled');
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->count;
     }
     else{
        return false;
    }
}
//amountPaymentMonthly
public function amountPaymentMonthly($id){
    $this->db->query('SELECT SUM(amount) AS total 
    FROM (
        SELECT amount
        FROM payments 
        WHERE booking_id IN (
            SELECT booking_id 
            FROM bookings 
            WHERE user_id = :id AND bookingCondition!=:condition
        )
        AND MONTH(payment_date) = MONTH(CURDATE()) 
        AND YEAR(payment_date) = YEAR(CURDATE())
    
        UNION ALL
    
        SELECT amount
        FROM cartpayments 
        WHERE booking_id IN (
            SELECT booking_id 
            FROM cartbookings 
            WHERE user_id = :id  AND bookingCondition!=:condition
        )
        AND MONTH(payment_date) = MONTH(CURDATE()) 
        AND YEAR(payment_date) = YEAR(CURDATE())
    ) AS all_payments;
    
    ');
    $this->db->bind(':id', $id);
    $this->db->bind(':condition', 'cancelled');
    $row = $this->db->single();
     if($this->db->rowcount()>0){
        return $row->total;
     }
     else{
        return false;
    }
}

//findPayment($id)
public function findPayment($id){
    $this->db->query('
    SELECT 
    payments.amount, 
    payments.payment_date, 
    bookings.booking_id, 
    users.fname
FROM 
    payments
JOIN 
    bookings ON payments.booking_id = bookings.booking_id
JOIN 
    users ON bookings.serviceProvider_id = users.id
WHERE 
    bookings.user_id = :id AND bookings.bookingCondition!=:condition
    AND MONTH(payments.payment_date) = MONTH(CURDATE()) 
    AND YEAR(payments.payment_date) = YEAR(CURDATE())

UNION ALL

SELECT 
    cartpayments.amount,
    cartpayments.payment_date, 
    cartbookings.booking_id, 
    users.fname
FROM 
    cartpayments
JOIN 
    cartbookings ON cartpayments.booking_id = cartbookings.booking_id
JOIN 
    users ON cartbookings.serviceProvider_id = users.id
WHERE 
    cartbookings.user_id = :id AND cartbookings.bookingCondition!=:condition
    AND MONTH(cartpayments.payment_date) = MONTH(CURDATE()) 
    AND YEAR(cartpayments.payment_date) = YEAR(CURDATE());

');

    $this->db->bind(':id', $id);
    $this->db->bind(':condition', 'cancelled');
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
    WHERE u.type NOT IN (0, 1, 2, 3, 4) AND u.approval = 1 AND u.profile_status=1
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
    WHERE (hotel.city LIKE :location OR hotel.addr LIKE :location)
    AND room_id NOT IN (
        SELECT room_id
        FROM room_availability
        WHERE startDate <= :checkoutDate
        AND (endDate >= :checkinDate OR endDate IS  NULL)
    )
    AND hotel_rooms.roomCondition = :roomCondition
    AND users.profile_status = 1';
    // Prepare and execute the SQL query
    $this->db->query($query);
    
    // Bind parameters
    $this->db->bind(':location', '%' . $location . '%'); // Use LIKE for partial match
    $this->db->bind(':checkinDate', $checkinDate);
    $this->db->bind(':checkoutDate', $checkoutDate);
    $this->db->bind(':roomCondition', 'activated'); 
    
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
    WHERE (travelagency.city LIKE :location OR travelagency.city = \'All Island\')
    AND vehicle_id NOT IN (
        SELECT vehicle_id
        FROM vehicle_availability
        WHERE startDate <= :checkoutDate
        AND (endDate >= :checkinDate OR endDate IS NULL)
    )
    AND vehicles.vehicleCondition = :vehicleCondition
    AND users.profile_status = 1 AND users.approval = 1;
');
    
        $this->db->bind(':location', '%' . $location . '%');
        $this->db->bind(':checkinDate', $checkinDate);
        $this->db->bind(':checkoutDate', $checkoutDate);
        $this->db->bind(':vehicleCondition', 'activated');
        $result = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //findAvailableGuidesByLocation($location, $checkinDate, $checkoutDate)
    public function findAvailableGuidesByLocation($location, $checkinDate, $checkoutDate) {

        $this->db->query('
        SELECT * 
        FROM guides
        JOIN users ON guides.user_id = users.id
        WHERE (guides.city LIKE :location OR guides.sites LIKE :location)
        AND user_id NOT IN (
            SELECT user_id
            FROM guide_availability
            WHERE startDate <= :checkoutDate
            AND (endDate >= :checkinDate OR endDate IS NULL)
        )
        AND users.profile_status = 1 AND users.approval = 1;
    ');
        
            $this->db->bind(':location', '%' . $location . '%');
            $this->db->bind(':checkinDate', $checkinDate);
            $this->db->bind(':checkoutDate', $checkoutDate);
            $this->db->bind(':vehicleCondition', 'activated');
            $result = $this->db->resultSet();
            if ($this->db->rowCount() > 0) {
                return $result;
            } else {
                return false;
            }
        }
    //findGuidesByLocation($location)
    public function findGuidesByLocation($location) {
        $this->db->query('SELECT * FROM guides
        JOIN users ON guides.user_id = users.id
        WHERE (guides.city LIKE :location OR guides.sites LIKE :location)
        AND users.profile_status = 1 AND users.approval = 1;
        ');
        $this->db->bind(':location', '%' . $location . '%');
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
        $this->db->query('SELECT COUNT(*) AS count
        FROM (
            SELECT booking_id, endDate
            FROM bookings
            WHERE user_id = :id AND endDate < CURDATE() AND bookingCondition != :bookingCondition
            UNION ALL
            SELECT booking_id, endDate
            FROM cartbookings
            WHERE user_id = :id AND endDate < CURDATE() AND bookingCondition != :bookingCondition
        ) AS combined_bookings;
        ');
        $this->db->bind(':id', $id);
        $this->db->bind(':bookingCondition', 'cancelled');

        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    
    //findPreviousTrips($id)
    public function findPreviousTrips($id) {
        $this->db->query('
        SELECT 
        bookings.*, 
        users.*, 
        hotel_rooms.description AS hotel_description,  -- Alias for description from hotel_rooms
        vehicles.description AS vehicle_description,   -- Alias for description from vehicles
        guides.description AS guide_description        -- Alias for description from guides
    FROM 
        bookings
    INNER JOIN 
        users ON bookings.serviceProvider_id = users.id
    LEFT JOIN 
        hotel_rooms ON bookings.room_id IS NOT NULL AND bookings.room_id = hotel_rooms.room_id
    LEFT JOIN 
        vehicles ON bookings.vehicle_id IS NOT NULL AND bookings.vehicle_id = vehicles.vehicle_id
    LEFT JOIN 
        guides ON bookings.package_id IS NOT NULL AND bookings.package_id = guides.user_id
    WHERE 
        bookings.user_id = :id
        AND bookings.endDate < CURDATE()
        AND bookings.bookingCondition != :bookingCondition
    
    UNION ALL
    
    SELECT 
        cartbookings.*, 
        users.*, 
        hotel_rooms.description AS hotel_description,  -- No hotel description for cart bookings
        vehicles.description AS vehicle_description,  -- No vehicle description for cart bookings
        guides.description AS guide_description       -- No guide description for cart bookings
    FROM 
        cartbookings
    INNER JOIN 
        users ON cartbookings.serviceProvider_id = users.id
    LEFT JOIN 
        hotel_rooms ON cartbookings.room_id IS NOT NULL AND cartbookings.room_id = hotel_rooms.room_id
    LEFT JOIN 
        vehicles ON cartbookings.vehicle_id IS NOT NULL AND cartbookings.vehicle_id = vehicles.vehicle_id
    LEFT JOIN 
        guides ON cartbookings.package_id IS NOT NULL AND cartbookings.package_id = guides.user_id
    WHERE 
        cartbookings.user_id = :id
        AND cartbookings.endDate < CURDATE()
        AND cartbookings.bookingCondition != :bookingCondition
        
    ORDER BY 
        endDate DESC; -- Order by endDate in descending order
    
        ');
        $this->db->bind(':id', $id);
        $this->db->bind(':bookingCondition', 'cancelled');
        $result = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }
    


    //submitFeedback($feedback,$rating,$serviceId)
    public function submitFeedback($user_id,$feedback,$rating,$bookingId,$serviceProvider_id,$temporyid){
        $this->db->query('INSERT INTO feedbacksnratings (user_id,booking_id,fservice_id,ftempory_id,feedback,rating) VALUES (:user_id,:bookingId,:fservice_id,:ftempory_id,:feedback, :rating)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':feedback', $feedback);
        $this->db->bind(':rating', $rating);
        $this->db->bind(':bookingId', $bookingId);
        $this->db->bind(':fservice_id', $serviceProvider_id);
        $this->db->bind(':ftempory_id', $temporyid);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //checkFeedbackProvided
    public function checkFeedbackProvided($bookingId,$temporyid) {
        // Query to check if feedback has been provided for the given booking ID
        $this->db->query('SELECT COUNT(*) AS feedback_count FROM feedbacksnratings WHERE booking_id = :booking_id AND ftempory_id = :temporyid');
        $this->db->bind(':booking_id', $bookingId);
        $this->db->bind(':temporyid', $temporyid);
        $result = $this->db->single();
    
        // If there are any feedback entries for the booking ID, return true (feedback provided)
        return $result->feedback_count > 0;
    }

    //countFeedbacks
    public function countFeedbacks($user_id){
        $this->db->query('SELECT COUNT(*) AS count FROM feedbacksnratings WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    //countNotifications
    public function countNotifications($user_id){
        $this->db->query('SELECT COUNT(*) AS count
        FROM notifications
        WHERE receiver_id = :user_id
        AND nDate >= DATE_SUB(NOW(), INTERVAL 30 DAY);');

        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    //findNotifications
    public function findNotifications($user_id){
        $this->db->query('SELECT n.*, u.*
        FROM notifications n
        JOIN users u ON n.sender_id = u.id
        -- JOIN bookings b ON n.booking_id = b.booking_id
        WHERE n.receiver_id = :user_id
        AND markAsRead = 0
        AND n.nDate >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        ORDER BY n.nDate DESC;');

        $this->db->bind(':user_id', $user_id);
        $result = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }
    //countUnreadNotifications
    public function countUnreadNotifications($user_id){
        $this->db->query('SELECT COUNT(*) AS count
        FROM notifications
        WHERE receiver_id = :user_id
        AND markAsRead = 0;');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    //findPreviousFeedbacks
    public function findPreviousFeedbacks(){
        $this->db->query('SELECT * FROM feedbacksnratings');

       // $this->db->bind(':user_id', $user_id);
        $result = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //findBookingDetails($booking_id);
    public function findBookingDetails($booking_id){
        $this->db->query('SELECT u.*,b.*
        FROM bookings b
        JOIN users u ON b.serviceProvider_id = u.id
        WHERE b.booking_id = :booking_id;
        ');
        $this->db->bind(':booking_id', $booking_id);
        $result = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //findCartBookingDetails($booking_id);
    public function findCartBookingDetails($booking_id,$temporyid){
        $this->db->query('SELECT u.*, b.*
        FROM cartbookings b
        JOIN users u ON b.serviceProvider_id = u.id
        WHERE b.booking_id = :booking_id
        AND b.temporyid = :temporyid;        
        ');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':temporyid', $temporyid);
        $result = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //sendBookingCancellationNotification($bookingDetails->serviceProvider_id,$booking_id)
    public function sendBookingCancellationNotification($id,$serviceProvider_id,$booking_id,$notification){
        $this->db->query('INSERT INTO notifications (booking_id,sender_id,receiver_id, notification) VALUES (:booking_id,:sender_id, :receiver_id, :notification)');
        
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':sender_id', $id);
        $this->db->bind(':receiver_id', $serviceProvider_id);
        $this->db->bind(':notification', $notification);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //findBusinessManagers
    public function findBusinessManagers(){
        $this->db->query('SELECT * FROM users WHERE type = 2');
        $result = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //sendBookingCancellationNotificationtoBM($id,$booking_id,$message)
    public function sendBookingCancellationNotificationtoBM($id,$booking_id,$message,$BMs){
        $success = true; // Assume success

foreach ($BMs as $BM) {
    $this->db->query('INSERT INTO notifications (booking_id,sender_id,receiver_id, notification) VALUES (:booking_id,:sender_id, :receiver_id, :notification)');
    
    $this->db->bind(':booking_id', $booking_id);
    $this->db->bind(':sender_id', $id);
    $this->db->bind(':receiver_id', $BM->id);
    $this->db->bind(':notification', $message);

    if (!$this->db->execute()) {
        $success = false; // Set success to false if any insertion fails
    }
}

return $success; // Return success status after the loop

    }

    //makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail); 
    public function makeAvailibility($temporyid,$booking_id,$bookingDetails,$bookingFurtherDetail){
        if($bookingDetails->type==4){
            $this->db->query('DELETE FROM vehicle_availability WHERE vehicle_id = :vehicle_id AND startDate = :startDate AND endDate = :endDate');
            $this->db->bind(':vehicle_id', $bookingFurtherDetail->vehicle_id);
            $this->db->bind(':startDate', $bookingDetails->startDate);
            $this->db->bind(':endDate', $bookingDetails->endDate);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }else if($bookingDetails->type==3){
            $this->db->query('DELETE FROM room_availability WHERE room_id = :room_id AND startDate = :startDate AND endDate = :endDate');
            $this->db->bind(':room_id', $bookingFurtherDetail->room_id);
            $this->db->bind(':startDate', $bookingDetails->startDate);
            $this->db->bind(':endDate', $bookingDetails->endDate);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }else if($bookingDetails->type==5){
            $this->db->query('DELETE FROM guide_availability WHERE user_id = :user_id AND startDate = :startDate AND endDate = :endDate');
            $this->db->bind(':user_id', $bookingFurtherDetail->user_id);
            $this->db->bind(':startDate', $bookingDetails->startDate);
            $this->db->bind(':endDate', $bookingDetails->endDate);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        
    }
}


    //markAsRead($notification_id);
    public function markAsRead($notification_id){
        $this->db->query('UPDATE notifications SET markAsRead = 1 WHERE notification_id = :notification_id');
        $this->db->bind(':notification_id', $notification_id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    //checkGuideAvailability
    // public function checkGuideAvailabilityForBookings($guide_id, $startDate, $endDate){
    //     $this->db->query('
    //         SELECT * FROM guide_bookings 
    //         LEFT JOIN bookings ON guide_bookings.booking_id = bookings.booking_id
    //         WHERE bookings.serviceProvider_id = :guide_id 
    //         AND bookings.startDate <= :endDate 
    //         AND bookings.endDate >= :startDate
    //     ');
    
    //     $this->db->bind(':guide_id', $guide_id);
    //     $this->db->bind(':startDate', $startDate);
    //     $this->db->bind(':endDate', $endDate);
    
    //     $bookings = $this->db->resultSet();
    
    //     // Check if any bookings were found
    //     if(empty($bookings)){
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function checkGuideAvailabilityForCartBookings($guide_id, $startDate, $endDate){
    //     $this->db->query('
    //         SELECT * FROM guide_bookings 
    //         LEFT JOIN cartbookings ON guide_bookings.booking_id = cartbookings.booking_id
    //         WHERE cartbookings.serviceProvider_id = :guide_id 
    //         AND cartbookings.startDate <= :endDate 
    //         AND cartbookings.endDate >= :startDate
    //     ');
    
    //     $this->db->bind(':guide_id', $guide_id);
    //     $this->db->bind(':startDate', $startDate);
    //     $this->db->bind(':endDate', $endDate);
    
    //     $cartBookings = $this->db->resultSet();
    
    //     // Check if any cart bookings were found
    //     if(empty($cartBookings)){
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    //
    // SELECT *
    // FROM hotel_rooms
    // WHERE room_id NOT IN (
    //     SELECT room_id
    //     FROM room_availability
    //     WHERE startDate <= :checkoutDate
    //     AND endDate >= :checkinDate
    // )
    // AND hotel_id = :hotelid;

    //checkGuideAvailability($guide_id, $startDate, $endDate)
    public function checkGuideAvailability($guide_id, $startDate, $endDate) {
        $this->db->query('SELECT * FROM guide_availability 
                          WHERE user_id = :guide_id 
                          AND startDate <= :endDate 
                          AND endDate >= :startDate');
                
        $this->db->bind(':guide_id', $guide_id);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
            
        $result = $this->db->resultSet();
        
        // Check if any overlapping bookings found
        if (!empty($result)) {
            return false; // Guide is not available
        } else {
            return true; // Guide is available
        }
    }
    
       
    //addToGuideBookings(($transactionData)
    public function addToGuideBookings($transactionData,$lastbooking_id){
        $this->db->query('INSERT INTO guide_bookings (booking_id, meetTime) VALUES (:booking_id, :meetTime)');
        $this->db->bind(':booking_id', $lastbooking_id);
        $this->db->bind(':meetTime', $transactionData['meetTime']);
    
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    //addGuideBookingfromCart($lastcartBooking->booking_id,$transactionData)
    public function addGuideBookingfromCart($lastcartBooking_id,$transactionData){
        $this->db->query('INSERT INTO guide_bookings (booking_id, meetTime) VALUES (:booking_id, :meetTime)');
        $this->db->bind(':booking_id', $lastcartBooking_id);
        $this->db->bind(':meetTime', $transactionData['meetTime']);
    
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    

    //findServiceProviderInCart($cart->cartbooking_id)
    public function findServiceProviderInCart($cartid,$cartbooking_id){
        $this->db->query('SELECT u.fname AS serviceProvider_name
        FROM cart cb
        LEFT JOIN users u ON u.id = cb.serviceProvider_id
        WHERE cb.cartbooking_id = :cartbooking_id AND cb.cart_id = :cartid');

        $this->db->bind(':cartbooking_id', $cartbooking_id);
        $this->db->bind(':cartid', $cartid);
        $result = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }
    //findCartDetails(cartbooking_id)
    public function findCartDetailsByBookingId($cartbooking_id){
        $this->db->query('SELECT users.type, cart.*
                          FROM cart 
                          JOIN users ON cart.serviceProvider_id = users.id
                          WHERE cart.cartbooking_id = :cartbooking_id');
        $this->db->bind(':cartbooking_id', $cartbooking_id);
        $result = $this->db->resultSet(); // Use resultSet() to fetch multiple rows
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    // //findCartDetailsByCartId
    // public function findCartDetailsByCartId($cart_id){
    //     $this->db->query('SELECT users.type, cart.*
    //                       FROM cart 
    //                       JOIN users ON cart.serviceProvider_id = users.id
    //                       WHERE cart.cart_id = :cart_id');
    //     $this->db->bind(':cart_id', $cart_id);
    //     $result = $this->db->resultSet(); // Use resultSet() to fetch multiple rows
    //     if (!empty($result)) {
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }

    //removefromCart($cart_id)
    public function removefromCartByCartId($cart_id){
        $this->db->query('DELETE FROM cart WHERE cart_id = :cart_id');
        $this->db->bind(':cart_id', $cart_id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //checkAvailbility($cartDetail->type, $serviceId,$cartDetail->startDate,$cartDetail->endDate)
    public function checkAvailbility($type, $serviceId,$startDate,$endDate){
        if($type==3){
            $this->db->query('SELECT * FROM room_availability WHERE room_id = :serviceId AND startDate <= :endDate AND (endDate >= :startDate OR endDate IS NULL)');
            $this->db->bind(':serviceId', $serviceId);
            $this->db->bind(':startDate', $startDate);
            $this->db->bind(':endDate', $endDate);
            $result = $this->db->resultSet();
        
            // Check if any overlapping bookings found
            if (!empty($result)) {
                return false; // Guide is not available
            } else {
                return true; // Guide is available
            }
        }else if($type==4){
            $this->db->query('SELECT * FROM vehicle_availability WHERE vehicle_id = :serviceId AND startDate <= :endDate AND (endDate >= :startDate OR endDate IS NULL)');
            $this->db->bind(':serviceId', $serviceId);
            $this->db->bind(':startDate', $startDate);
            $this->db->bind(':endDate', $endDate);
            $result = $this->db->resultSet();
        
            // Check if any overlapping bookings found
            if (!empty($result)) {
                return false; // Guide is not available
            } else {
                return true; // Guide is available
            }
        }else if($type==5){
        $this->db->query('SELECT * FROM guide_availability WHERE user_id = :serviceId AND startDate <= :endDate AND (endDate >= :startDate OR endDate IS NULL)');
        
        $this->db->bind(':serviceId', $serviceId);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
       $result = $this->db->resultSet();
        
        // Check if any overlapping bookings found
        if (!empty($result)) {
            return false; // Guide is not available
        } else {
            return true; // Guide is available
        }
    }
}

    
    
}

