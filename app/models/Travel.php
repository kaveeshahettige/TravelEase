<?php
class Travel{
   private $db;

    public function __construct(){
        $this->db=new Database;
    }

    public function getUserDetails($user_id){
        $this->db->query('SELECT * FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row;
    }

    public function getProfileImage($user_id){
        $this->db->query('SELECT profile_picture FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row;
    }
        
    public function addAgency($agency_name, $reg_number, $address, $description, $website, $facebook, $twitter, $instagram, $location, $user_id) {
        $this->db->query('INSERT INTO travelagency (agency_name, reg_number, address, description, website, facebook, twitter, instagram, city, user_id) VALUES (:agency_name, :reg_number, :address, :description, :website, :facebook, :twitter, :instagram, :location, :user_id)');
        $this->db->bind(':agency_name', $agency_name);
        $this->db->bind(':reg_number', $reg_number);
        $this->db->bind(':address', $address);
        $this->db->bind(':description', $description);
        $this->db->bind(':website', $website);
        $this->db->bind(':facebook', $facebook);
        $this->db->bind(':twitter', $twitter);
        $this->db->bind(':instagram', $instagram);
        $this->db->bind(':location', $location);
        $this->db->bind(':user_id', $user_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function addAgencyDetails($agencyDetails, $userId) {
        // Check if $agencyDetails is an array and not empty
        if (!empty($agencyDetails) && is_array($agencyDetails)) {
            // Build the query to insert agency details
            $query = "INSERT INTO travelagency (user_id, ";
            $values = "VALUES (:user_id, ";
            foreach ($agencyDetails as $field => $value) {
                $query .= "{$field}, ";
                $values .= ":{$field}, ";
            }
            $query = rtrim($query, ', ') . ")";
            $values = rtrim($values, ', ') . ")";
            $query .= $values;
    
            // Bind parameters and execute the query
            $this->db->query($query);
            $this->db->bind(':user_id', $userId);
            foreach ($agencyDetails as $field => $value) {
                $this->db->bind(":{$field}", $value);
            }
            return $this->db->execute();
        }
        return false;
    }
    
    

    public function changePassword($currentPassword, $newPassword, $userId) {
        // Get the current password from the database
        $this->db->query('SELECT password FROM users WHERE id = :id');
        $this->db->bind(':id', $userId);
        $row = $this->db->single();
        
        if ($row) {
            $hashedPassword = $row->password;
            
            // Verify the current password
            if (password_verify($currentPassword, $hashedPassword)) {
                // Hash the new password
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                // Update the password in the database
                $this->db->query('UPDATE users SET password = :password WHERE id = :id');
                $this->db->bind(':password', $newHashedPassword);
                $this->db->bind(':id', $userId);
                
                // Execute the query
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    
    
    public function editvehicleDetail($data){

        // var_dump($data);

        $this->db->query('SELECT * from vehicles where id=:id');
        $this->db->bind(':id',$data['vehicle_id']);



       
        if($this->db->rowCount()>0){
            $row = null;
            return $row;
        }else{
            return null;
        }
    }
   
    public function vehiclereg($data, $imageFiles, $agency_id) {
        // Save vehicle details to the database
        $this->db->query('INSERT INTO vehicles (agency_id, brand, model, plate_number, fuel_type, year, seating_capacity, ac_type,airbag,nav,tv,usb, description, vehi_img1, vehi_img2, vehi_img3, vehi_img4, insurance, registration, revenue) VALUES (:agency_id, :brand, :model, :plate_number, :fuel_type, :year, :seating_capacity, :ac_type,:airbag,:nav,:tv,:usb :description, :vehi_img1, :vehi_img2, :vehi_img3, :vehi_img4, :insurance, :registration, :revenue)');
        
        // Bind parameters
        $this->db->bind(':vehicle_type', $data['vehicle_type']);
        $this->db->bind(':agency_id', $agency_id);
        $this->db->bind(':vehicle_type', $data['vehicle_type']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':plate_number', $data['plate_number']);
        $this->db->bind(':fuel_type', $data['fuel_type']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':seating_capacity', $data['seating_capacity']);
        $this->db->bind(':number_of_doors', $data['number_of_doors']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind('ac_type', $data['ac_type']);
        $this->db->bind('airbag', $data['airbag']);
        $this->db->bind('nav', $data['nav']);
        $this->db->bind('tv', $data['tv']);
        $this->db->bind('usb', $data['usb']);
        $this->db->bind(':ac_type', $data['ac_type']);
        $this->db->bind(':airbag', $data['airbag']);
        $this->db->bind(':nav', $data['nav']);
        $this->db->bind(':tv', $data['tv']);
        $this->db->bind(':usb', $data['usb']);
        $this->db->bind(':pricing_option', $_POST['pricing_option']);
        $this->db->bind(':driver_name', $_POST['driver_name']);
        $this->db->bind(':driver_license_number', $_POST['driver_license_number']);
        $this->db->bind(':per_day_price_with_driver', $_POST['per_day_price_with_driver']);
        $this->db->bind(':daily_mileage_limit_with_driver', $_POST['daily_mileage_limit_with_driver']);
        $this->db->bind(':extra_mileage_charge_with_driver', $_POST['extra_mileage_charge_with_driver']);
        $this->db->bind(':per_day_price_without_driver', $_POST['per_day_price_without_driver']);
        $this->db->bind(':daily_mileage_limit_without_driver', $_POST['daily_mileage_limit_without_driver']);

        
    
        // Process and save images
        $imagePaths = $this->processAndSaveImages($agency_id, $imageFiles);
    
        // Bind image paths to database parameters
        $this->db->bind(':vehi_img1', isset($imagePaths[0]) ? $imagePaths[0] : null);
        $this->db->bind(':vehi_img2', isset($imagePaths[1]) ? $imagePaths[1] : null);
        $this->db->bind(':vehi_img3', isset($imagePaths[2]) ? $imagePaths[2] : null);
        $this->db->bind(':vehi_img4', isset($imagePaths[3]) ? $imagePaths[3] : null);
        $this->db->bind(':insurance', isset($imagePaths[4]) ? $imagePaths[4] : null);
        $this->db->bind(':registration', isset($imagePaths[5]) ? $imagePaths[5] : null);
    }
    
    
    public function processAndSaveImages($userId, $imageFiles) {
        $uploadDir = "public/images/driver/vehicles/";
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $imagePaths = [];
        
        foreach ($imageFiles as $key => $imageFile) {
            // Check if the file exists and is not empty
            if ($imageFile['error'] === UPLOAD_ERR_OK && !empty($imageFile['tmp_name'])) {
                // Generate unique filename to avoid overwriting
                $fileName = uniqid() . '_' . basename($imageFile['name']);
                $targetPath = $uploadDir . $fileName;
    
                // Move the uploaded file to the destination directory
                if (move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
                    // Add the path to the array
                    $imagePaths[$key] = $targetPath;
                } else {
                    // Handle upload failure
                    $imagePaths[$key] = null;
                }
            } else {
                // Handle empty or non-existent file
                $imagePaths[$key] = null;
            }
        }
        
        return $imagePaths;
    }
    

    
    

    public function vehicleDetails($agency_id) {
        $this->db->query('SELECT * FROM vehicles WHERE agency_id = :agency_id AND status = "1"');
        $this->db->bind(':agency_id', $agency_id);
        $data = $this->db->resultSet();
        $data = json_decode(json_encode($data), true);
    
        // Check row
        if($this->db->rowCount() > 0){
            return $data;
        } else {
            return null;
        }
    }

    public function updatevehicle($data) {
        $query = "UPDATE vehicles SET 
            image = :image,
            vehi_img2 = :vehi_img2,
            vehi_img3 = :vehi_img3,
            vehi_img4 = :vehi_img4,
            description = :description,
            priceperday = :priceperday,
            withDriverPerDay = :withDriverPerDay,
            nav = :nav,
            airbag = :airbag,
            tv = :tv,
            usb = :usb,
            ac_type = :ac_type
            WHERE vehicle_id = :vehicle_id";
        
        $this->db->query($query);
        
        $this->db->bind(':vehicle_id', $data['vehicle_id']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':vehi_img2', $data['vehi_img2']);
        $this->db->bind(':vehi_img3', $data['vehi_img3']);
        $this->db->bind(':vehi_img4', $data['vehi_img4']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':priceperday', $data['priceperday']);
        $this->db->bind(':withDriverPerDay', $data['withDriverPerDay']);
        $this->db->bind(':nav', $data['nav']);
        $this->db->bind(':airbag', $data['airbag']);
        $this->db->bind(':tv', $data['tv']);
        $this->db->bind(':usb', $data['usb']);
        $this->db->bind(':ac_type', $data['ac_type']);
        
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    public function vehicles($vehicle_id) {
        $this->db->query('SELECT * FROM vehicles WHERE vehicle_id = :vehicle_id AND status = "1"');
        $this->db->bind(':vehicle_id', $vehicle_id);
        $data = $this->db->single(); // Assuming you only fetch one vehicle
        return $data;
    }
    
    

    
    
    


      
      public function countVehicles(){
        $this->db->query('SELECT COUNT(*) AS count FROM vehicles');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
        
    }
    public function vehicleDelete($vehicle_id){
        $this->db->query('UPDATE vehicles SET status = 0 WHERE vehicle_id = :vehicle_id');
        // Bind values
        $this->db->bind(':vehicle_id', $vehicle_id);
      
        // Execute
        if($this->db->execute()){
            redirect('driver/vehicle');
        } else {
            return false;
        }
    }

    public function updateUserDocument($filename, $userId) {
        $query = "UPDATE users SET document = :filename WHERE id = :userId";
        $this->db->query($query);
        $this->db->bind(':filename', $filename);
        $this->db->bind(':userId', $userId);
    
        // Execute the query
        return $this->db->execute();
    }
    

    
 
        
     
        

        public function insertPdf($filename, $userId) {
            // Extract the file name from the full path
            $filenameOnly = basename($filename);
        
            $this->db->query('UPDATE users SET document = :filename WHERE id = :userId');
            $this->db->bind(':filename', $filenameOnly);
            $this->db->bind(':userId', $userId);
        
            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

 



        
    
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function getAgencyId($user_id) {
            $this->db->query('SELECT agency_id FROM travelagency WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single();
            
            if ($row) {
                return $row->agency_id;
            } else {
                return null;
            }
        }
        public function getPendingBookings($agencyId) {
            $sql = "(SELECT 
                       b.temporyid, b.booking_id, b.user_id, b.startDate, b.endDate, b.vehicle_id, b.bookingCondition, b.bookingDate, ta.agency_id
                    FROM 
                        bookings b
                    JOIN 
                        travelagency ta ON b.serviceProvider_id = ta.agency_id
                    WHERE 
                        ta.agency_id = :agency_id
                    AND 
                        b.bookingCondition = 'pending'
                    AND  
                        b.vehicle_id != 0)
                    UNION
                    (SELECT 
                    cb.temporyid, cb.booking_id AS booking_id, cb.user_id, cb.startDate, cb.endDate, cb.vehicle_id, cb.bookingCondition, cb.bookingDate, ta.agency_id
                    FROM 
                        cartbookings cb
                    JOIN 
                        travelagency ta ON cb.serviceProvider_id = ta.agency_id
                    WHERE 
                        ta.agency_id = :agency_id
                    AND 
                        cb.bookingCondition = 'pending'
                    AND  
                        cb.vehicle_id != 0)";
                        
            $this->db->query($sql);
            $this->db->bind(':agency_id', $agencyId);
            $this->db->execute();
            
            return $this->db->resultSet();
        }

        public function getCompletedBookings($agencyId) {
            $sql = "(SELECT 
                        b.booking_id, b.user_id, b.startDate, b.endDate, b.vehicle_id, b.bookingCondition, b.bookingDate, ta.agency_id
                    FROM 
                        bookings b
                    JOIN 
                        travelagency ta ON b.serviceProvider_id = ta.agency_id
                    WHERE 
                        ta.agency_id = :agency_id
                    AND 
                        b.bookingCondition = 'complete'
                    AND  
                        b.vehicle_id != 0)
                    UNION
                    (SELECT 
                        cb.temporyid AS booking_id, cb.user_id, cb.startDate, cb.endDate, cb.vehicle_id, cb.bookingCondition, cb.bookingDate, ta.agency_id
                    FROM 
                        cartbookings cb
                    JOIN 
                        travelagency ta ON cb.serviceProvider_id = ta.agency_id
                    WHERE 
                        ta.agency_id = :agency_id
                    AND 
                        cb.bookingCondition = 'complete'
                    AND  
                        cb.vehicle_id != 0)";
                        
            $this->db->query($sql);
            $this->db->bind(':agency_id', $agencyId);
            $this->db->execute();
            
            return $this->db->resultSet();
        }

     
        
        public function getPlateNumberForVehicle($vehicleId) {
            $sql = "SELECT plate_number FROM vehicles WHERE vehicle_id = :vehicle_id";
            $this->db->query($sql);
            $this->db->bind(':vehicle_id', $vehicleId);
            $this->db->execute();
        
            return $this->db->single(); // Fetch as an associative array
        }
        public function getTravelerDetails($userId) {
            $sql = "SELECT * FROM users WHERE id = :user_id";
            $this->db->query($sql);
            $this->db->bind(':user_id', $userId);
            $this->db->execute();
        
            return $this->db->single(); // Fetch as an associative array
        }
        
        public function getVehicleBookingDetails($bookingId) {
            $sql = "SELECT start_time, withDriver, Pickup_Location, End_Location FROM vehicle_bookings WHERE booking_id = :booking_id";
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
        
            return $this->db->single(); // Fetch as an associative array
        }
        public function getPaymentAmountForBooking($bookingId) {
            $sql = "SELECT amount FROM payments WHERE booking_id = :booking_id 
                    UNION ALL 
                    SELECT amount FROM cartpayments WHERE booking_id = :booking_id";
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
        
            // Fetch all rows as an associative array
            $rows = $this->db->resultSet();
        
            $paymentAmounts = [];
            foreach ($rows as $row) {
                $paymentAmounts[] = $row->amount;
            }
        
            return $paymentAmounts;
        }
        

        public function getFeedbacks($bookingId){
            $sql = "SELECT * FROM feedbacksnratings WHERE booking_id = :booking_id";
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
                    
            return $this->db->resultSet(); // Fetch all rows
        }
        public function updateBookingCondition($bookingId, $tempId) {
            if ($tempId == 0) {
                $sql = "UPDATE bookings SET bookingCondition = 'cancelled' WHERE booking_id = :bookingId";
            } else {
                $sql = "UPDATE cartbookings SET bookingCondition = 'cancelled' WHERE booking_id = :bookingId AND temporyid = :tempId";
            }
        
            // Execute the query
            if ($this->db->execute()) {
                return true; // Successfully updated booking condition
            } else {
                return false; // Failed to update booking condition
            }
        }
        
        
        
        
        

        
        
        
        
        
        
        
        
        
     ///////////////////////////////////////////////////////////////////////////////////////////////  

    
        
        public function getNotifications($userId){
            $sql = "SELECT n.*,u.* FROM notifications n 
            JOIN users u ON n.sender_id = u.id 
            WHERE n.receiver_id = :user_id";
            
            $this->db->query($sql);
            $this->db->bind(':user_id', $userId);
            $this->db->execute();
            
            return $this->db->resultSet();
        }

        //getNotificationCount
        public function getNotificationCount($userId){
            $sql = "SELECT COUNT(*) AS count FROM notifications WHERE receiver_id = :user_id";
            $this->db->query($sql);
            $this->db->bind(':user_id', $userId);
            $this->db->execute();
            
            $row = $this->db->single();
            return $row->count;
        }
        
        
        
        
        
        
        

        public function getAgencyDetails($userId) {
            $query = "SELECT * FROM travelagency WHERE user_id = :user_id";
            $this->db->query($query);
            $this->db->bind(':user_id', $userId);
            $row = $this->db->single();
            return $row ? $row : []; // Return an empty array if no agency details are found
        }
        

   

        public function getUserById($user_id)
        {
            $this->db->query('SELECT * FROM users WHERE id = :user_id');
            $this->db->bind(':user_id', $user_id);
    
            return $this->db->single();
        }

        public function getDiverByUserId($user_id)
        {
            $this->db->query('SELECT * FROM travelagency WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user_id);
    
            return $this->db->single();
        }

        public function getAgencyIdByUserId($user_id)
        {
            $this->db->query('SELECT agency_id FROM travelagency WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user_id);
    
            $row = $this->db->single();
    
            if ($this->db->rowCount() > 0) {
                return $row->agency_id;
            } else {
                return null;
            }
        }


        public function getUnavailableDatesForVehicles($vehicleIds,$date)
        {
            // Prepare the list of vehicle IDs for the IN clause
            $vehicleIdList = implode(',', $vehicleIds);
        
            // SQL query to fetch vehicle IDs and their corresponding unavailable dates
            $query = "SELECT vehicle_id, startDate, endDate FROM vehicle_availability 
                      WHERE vehicle_id IN ($vehicleIdList) AND startDate <= :date AND endDate >= :date";
        
            $this->db->query($query);
            $this->db->bind(':date', $date);
        
            // Execute the query and fetch the results
            return $this->db->resultSet();
        }
         
        public function getVehicleCount($agencyId){
            $this->db->query('SELECT COUNT(*) AS count FROM vehicles WHERE agency_id = :agency_id');
            $this->db->bind(':agency_id', $agencyId);
            $row = $this->db->single();
            return $row->count;
        }

        
        
        



        public function insertUnavailableDate($vehicle_id, $date) {
            $query = "INSERT INTO vehicle_availability (vehicle_id, startDate) VALUES (:vehicle_id, :startDate)";
            $this->db->query($query);
            $this->db->bind(':vehicle_id', $vehicle_id);
            $this->db->bind(':startDate', $date);
            
            // Execute the query
            return $this->db->execute();
        }
        
        
        public function removeUnavailableDate($vehicle_id, $date) {
            $query = "DELETE FROM vehicle_availability WHERE vehicle_id = :vehicle_id AND startDate = :startDate";
            $this->db->query($query);
            $this->db->bind(':vehicle_id', $vehicle_id);
            $this->db->bind(':startDate', $date);
            
            // Execute the query
            return $this->db->execute();
        }
        
        

        public function getAgencyvehicles($agency_id)
        {
            $this->db->query('SELECT * FROM vehicles WHERE agency_id = :agency_id');
            $this->db->bind(':agency_id', $agency_id);
            $vehicleData = $this->db->resultSet();
    
            // Check row
            if ($this->db->rowCount() > 0) {
                return $vehicleData;
            } else {
                return [];
            }
        }

        public function getUnavailableVehicles($date)
        {
            $sql = "SELECT * FROM vehicle_availability WHERE date = :date";
            $this->db->query($sql);
            $this->db->bind(':date', $date);
    
            // Execute the query
            try {
                return $this->db->resultSet();
            } catch (Exception $e) {
                // Log or handle the exception
                echo 'Error: ' . $e->getMessage();
                return [];
            }
        }
    


 
        
        public function getVehicleBookingDetail($bookingId) {
            $sql = "SELECT * FROM vehicle_bookings WHERE trip_id = :booking_id";
        
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
        
            return $this->db->resultSet(); // Assuming multiple vehicle bookings can be associated with one booking
        }

        public function updateUserDetails($data) {
            $query = "UPDATE users SET fname = :fname, lname = :lname, email = :email, number = :number WHERE id = :id";
            $this->db->query($query);
        
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':number', $data['number']);
        
            // Execute the query
            return $this->db->execute();
        }
        
        public function updateAgencyDetails($data) {
            $query = "UPDATE travelagency SET agency_name = :agency_name, reg_number = :reg_number, address = :address, city = :city, description = :description, website = :website, facebook = :facebook, twitter = :twitter, instagram = :instagram WHERE agency_id = :agency_id";
            $this->db->query($query);
        
            $this->db->bind(':agency_id', $data['agency_id']);
            $this->db->bind(':agency_name', $data['agency_name']);
            $this->db->bind(':reg_number', $data['reg_number']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':city', $data['city']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':website', $data['website']);
            $this->db->bind(':facebook', $data['facebook']);
            $this->db->bind(':twitter', $data['twitter']);
            $this->db->bind(':instagram', $data['instagram']);
        
            // Execute the query
            return $this->db->execute();
        }

        // TravelsModel.php

// TravelsModel.php

public function verifyPassword($user_id, $password){
    $query = 'SELECT password FROM users WHERE id = :id';
    $this->db->query($query);
    $this->db->bind(':id', $user_id);
    $row = $this->db->single();

    if ($row) {
        $hashed_password = $row->password; // Use object notation to access the property
        return password_verify($password, $hashed_password);
    } else {
        return false; // User ID not found
    }
}


public function updatePassword($user_id, $new_password){
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $query = 'UPDATE users SET password = :password WHERE id = :id';
    $this->db->query($query);
    $this->db->bind(':password', $hashed_password);
    $this->db->bind(':id', $user_id);

    return $this->db->execute();
}

        
        
        
        
        
        
     
public function saveVehicle($data) {
    $query = "INSERT INTO vehicles (agency_id, brand, model, plate_number, fuel_type, year, priceperday, seating_capacity, ac_type, description, vehicle_type, number_of_doors, nav, airbag, tv, usb, withDriverPerDay, image, vehi_img2, vehi_img3, vehi_img4, insurance, registration, revenue, status) VALUES (:agency_id, :brand, :model, :plate_number, :fuel_type, :year, :priceperday, :seating_capacity, :ac_type, :description, :vehicle_type, :number_of_doors, :nav, :airbag, :tv, :usb, :withDriverPerDay, :image, :vehi_img2, :vehi_img3, :vehi_img4, :insurance, :registration, :revenue, 1)";

    $this->db->query($query);
    $this->db->bind(':agency_id', $data['agency_id']);
    $this->db->bind(':brand', $data['brand']);
    $this->db->bind(':model', $data['model']);
    $this->db->bind(':plate_number', $data['plate_number']);
    $this->db->bind(':fuel_type', $data['fuel_type']);
    $this->db->bind(':year', $data['year']);
    $this->db->bind(':priceperday', $data['priceperday']);
    $this->db->bind(':seating_capacity', $data['seating_capacity']);
    $this->db->bind(':ac_type', $data['ac_type']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':vehicle_type', $data['vehicle_type']);
    $this->db->bind(':number_of_doors', $data['number_of_doors']);
    $this->db->bind(':nav', $data['nav']);
    $this->db->bind(':airbag', $data['airbag']);
    $this->db->bind(':tv', $data['tv']);
    $this->db->bind(':usb', $data['usb']);
    $this->db->bind(':withDriverPerDay', $data['withDriverPerDay']);
    $this->db->bind(':image', $data['image']);
    $this->db->bind(':vehi_img2', $data['vehi_img2']);
    $this->db->bind(':vehi_img3', $data['vehi_img3']);
    $this->db->bind(':vehi_img4', $data['vehi_img4']);
    $this->db->bind(':insurance', $data['insurance']);
    $this->db->bind(':registration', $data['registration']);
    $this->db->bind(':revenue', $data['revenue']);

    // Execute the query
    return $this->db->execute();
}

       
    
        
        
        
        
        
        
    
}