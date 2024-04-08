<?php
class Travel{
   private $db;

    public function __construct(){
        $this->db=new Database;
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
    // public function vehiclereg($data, $imageFiles, $agency_id) {
    //     // Save vehicle details to the database
    //     $this->db->query('INSERT INTO vehicles (agency_id, brand, model, plate_number, fuel_type, year, seating_capacity, ac_type, description, vehi_img1, vehi_img2, vehi_img3, vehi_img4, insurance, registration, revenue) VALUES (:agency_id, :brand, :model, :plate_number, :fuel_type, :year, :seating_capacity, :ac_type, :description, :vehi_img1, :vehi_img2, :vehi_img3, :vehi_img4, :insurance, :registration, :revenue)');
        
    //     // Bind parameters
    //     $this->db->bind(':agency_id', $agency_id);
    //     $this->db->bind(':brand', $data['brand']);
    //     $this->db->bind(':model', $data['model']);
    //     $this->db->bind(':plate_number', $data['plate_number']);
    //     $this->db->bind(':fuel_type', $data['fuel_type']);
    //     $this->db->bind(':year', $data['year']);
    //     $this->db->bind(':seating_capacity', $data['seating_capacity']);
    //     $this->db->bind(':ac_type', $data['ac_type']);
    //     $this->db->bind(':description', $data['description']);
    
    //     // Process and save images
    //     $imagePaths = $this->processAndSaveImages($agency_id, $imageFiles);
    
    //     // Bind image paths to database parameters
    //     $this->db->bind(':vehi_img1', isset($imagePaths[0]) ? $imagePaths[0] : null);
    //     $this->db->bind(':vehi_img2', isset($imagePaths[1]) ? $imagePaths[1] : null);
    //     $this->db->bind(':vehi_img3', isset($imagePaths[2]) ? $imagePaths[2] : null);
    //     $this->db->bind(':vehi_img4', isset($imagePaths[3]) ? $imagePaths[3] : null);
    //     $this->db->bind(':insurance', isset($imagePaths[4]) ? $imagePaths[4] : null);
    //     $this->db->bind(':registration', isset($imagePaths[5]) ? $imagePaths[5] : null);
    //     $this->db->bind(':revenue', isset($imagePaths[6]) ? $imagePaths[6] : null);
    
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
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
    

    
    

    // public function getAgencyId($user_id) {
    //     $this->db->query('SELECT agency_id FROM travelagency WHERE user_id = :user_id');
    //     $this->db->bind(':user_id', $user_id);
    //     $row = $this->db->single();
        
    //     if ($row) {
    //         return $row->agency_id;
    //     } else {
    //         return null;
    //     }
    // }
    
    
    
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
    
    
    

    public function updatevehicle($data){
        // var_dump($data);
        $this->db->query('UPDATE vehicles SET seating_capacity = :seating_capacity, ac_type = :ac_type , description = :description WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['vehicle_id']);
        
        $this->db->bind(':seating_capacity', $data['seating_capacity']);
        $this->db->bind(':ac_type', $data['ac_type']);
        $this->db->bind(':description', $data['description']);
  
        // Execute
        if($this->db->execute()){
            redirect('driver/vehicle');
        //add a function to rlaod site
          return true;
        } else {
          return false;
}
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
    public function vehicleDelete($id){
        $this->db->query('UPDATE vehicles SET status = 0 WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
      
        // Execute
        if($this->db->execute()){
            redirect('driver/vehicle');
        } else {
            return false;
        }
    }

        // public function getPendingBookings($user_id){
        //     $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "pending"');
        //     $this->db->bind(':user_id', $user_id);
        //     $results = $this->db->resultSet();
        //     return $results;
        // }
        
        public function getReviews($user_id) {
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "completed" AND comments != ""');
            $this->db->bind(':user_id', $user_id);
            $results = $this->db->resultSet();
            return $results;
        }
         
        public function getPayments($user_id) {
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "completed"');
            $this->db->bind(':user_id', $user_id);
            $results = $this->db->resultSet();
            return $results;
        }
        
        public function getTotalPayments($user_id) {
            $this->db->query('SELECT SUM(earnings) AS total_earnings FROM vehicle_bookings WHERE agency_id = :user_id AND status = "completed"');
            $this->db->bind(':user_id', $user_id);
            $result = $this->db->single();
            return $result->total_earnings;
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

 // Update the booking status
 public function updateBookingStatus($bookingId, $action) {
    $status = '';

    // Determine the status based on the action
    switch ($action) {
        case 'accepted':
            $status = 'accepted';
            break;
        case 'decline':
            $status = 'declined';
            break;
        case 'complete':
            $status = 'completed';
            break;
        // Add more cases if needed
    }

    // Update the status in the database
    $this->db->query('UPDATE vehicle_bookings SET status = :status WHERE trip_id = :trip_id');
    $this->db->bind(':status', $status);
    $this->db->bind(':trip_id', $bookingId);

    // Execute the query
    return $this->db->execute();
}



        
 

        
        

       

// public function getPendingVehicleBookingsSorted($column, $order, $user_id) {
//     // Validate $column to prevent SQL injection (you may use a whitelist approach)
//     $allowedColumns = ['trip_id', 'start_date', 'end_date', 'pickup_location', 'dropoff_location', 'passenger_count'];
//     if (!in_array($column, $allowedColumns)) {
//         $column = 'trip_id'; // Default to trip_id if an invalid column is provided
//     }

//     // Validate $order to prevent SQL injection (you may use a whitelist approach)
//     $allowedOrders = ['asc', 'desc'];
//     if (!in_array($order, $allowedOrders)) {
//         $order = 'asc'; // Default to asc if an invalid order is provided
//     }

//     $query = "
//         SELECT vb.*
//         FROM vehicle_bookings vb
//         INNER JOIN bookings b ON vb.trip_id = b.booking_id
//         WHERE b.serviceProvider_id = :user_id
//         AND b.bookingCondition = 'pending'
//         ORDER BY $column $order
//     ";

//     $this->db->query($query);
//     $this->db->bind(':user_id', $user_id);
//     return $this->db->resultSet();
// }



        // public function getAcceptedBookingsSorted($column,$order,$user_id) {
        //     // Validate $column to prevent SQL injection (you may use a whitelist approach)
        //     $allowedColumns = ['trip_id', 'start_date', 'end_date', 'pickup_location', 'dropoff_location', 'passenger_count', 'earnings'];
        //     if (!in_array($column, $allowedColumns)) {
        //         $column = 'trip_id'; // Default to trip_id if an invalid column is provided
        //     }

        //     // Validate $order to prevent SQL injection (you may use a whitelist approach)
        //     $allowedOrders = ['asc', 'desc'];
        //     if (!in_array($order, $allowedOrders)) {
        //         $order = 'asc'; // Default to asc if an invalid order is provided
        //     }
        //     $this->db->query("SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = 'accepted' ORDER BY $column $order");
        //     $this->db->bind(':user_id', $user_id);
        //     return $this->db->resultSet();
        // }

        // public function getCompletedBookingsSorted($column,$order,$user_id) {
        //     // Validate $column to prevent SQL injection (you may use a whitelist approach)
        //     $allowedColumns = ['trip_id', 'start_date', 'end_date', 'pickup_location', 'dropoff_location', 'passenger_count', 'earnings','comments','rating'];
        //     if (!in_array($column, $allowedColumns)) {
        //         $column = 'trip_id'; // Default to trip_id if an invalid column is provided
        //     }

        //     // Validate $order to prevent SQL injection (you may use a whitelist approach)
        //     $allowedOrders = ['asc', 'desc'];
        //     if (!in_array($order, $allowedOrders)) {
        //         $order = 'asc'; // Default to asc if an invalid order is provided
        //     }
        //     $this->db->query("SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = 'completed' ORDER BY $column $order");
        //     $this->db->bind(':user_id', $user_id);
        //     return $this->db->resultSet();
        // }
        // 
        
        public function getUserIdByEmail($email) {
            $this->db->query('SELECT id FROM users WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();
        
            return $row ? $row->id : null;
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
                        b.booking_id, b.user_id, b.startDate, b.endDate, b.vehicle_id, b.bookingCondition, b.bookingDate, ta.agency_id
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
                        cb.id AS booking_id, cb.user_id, cb.startDate, cb.endDate, cb.vehicle_id, cb.bookingCondition, cb.bookingDate, ta.agency_id
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
        
        public function getPlateNumberForVehicle($vehicleId) {
            $sql = "SELECT plate_number FROM vehicles WHERE vehicle_id = :vehicle_id";
            $this->db->query($sql);
            $this->db->bind(':vehicle_id', $vehicleId);
            $this->db->execute();
        
            return $this->db->single(PDO::FETCH_ASSOC); // Fetch as an associative array
        }
        public function getTravelerDetails($userId) {
            $sql = "SELECT fname, lname, number FROM users WHERE id = :user_id";
            $this->db->query($sql);
            $this->db->bind(':user_id', $userId);
            $this->db->execute();
        
            return $this->db->single(PDO::FETCH_ASSOC); // Fetch as an associative array
        }
        
        public function getVehicleBookingDetails($bookingId) {
            $sql = "SELECT start_time, withDriver, Pickup_Location, End_Location FROM vehicle_bookings WHERE booking_id = :booking_id";
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
        
            return $this->db->single(PDO::FETCH_ASSOC); // Fetch as an associative array
        }
        public function getPaymentAmountForBooking($bookingId) {
            $sql = "SELECT amount FROM payments WHERE booking_id = :booking_id";
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
        
        
        

        
        
        
        
        
        
        
        
        
     ///////////////////////////////////////////////////////////////////////////////////////////////  

        public function getBookedUserDetails($agencyId) {
            // Get booking details with the same serviceProvider_id and agency_id
            $query = "SELECT b.user_id FROM bookings b JOIN travelagency ta ON b.serviceProvider_id = ta.agency_id WHERE ta.agency_id = :agency_id";
            $this->db->query($query);
            $this->db->bind(':agency_id', $agencyId);
            $bookingRow = $this->db->single();
            
            if ($bookingRow) {
                // Get user details based on the user_id from bookings
                $queryUser = "SELECT * FROM users WHERE id = :user_id";
                $this->db->query($queryUser);
                $this->db->bind(':user_id', $bookingRow->user_id);
                $userRow = $this->db->single();
                return $userRow ? $userRow : null;
            } else {
                return null; // No booking found for the agency
            }
        }
        
        
        
        
        
        
        
        
        

        public function getAgencyDetails($userId) {
            $query = "SELECT * FROM travelagency WHERE user_id = :user_id";
            $this->db->query($query);
            $this->db->bind(':user_id', $userId);
            $row = $this->db->single();
            return $row ? $row : []; // Return an empty array if no agency details are found
        }
        

        public function getPendingBookingDetailsForAgency($agencyId) {
            $sql = "SELECT 
                        b.*, ta.agency_id
                    FROM 
                        bookings b
                    JOIN 
                        travelagency ta ON b.serviceProvider_id = ta.agency_id
                    WHERE 
                        ta.agency_id = :agency_id
                    AND 
                        b.bookingCondition = 'pending'
                    AND  
                        b.vehicle_id != 0";
                    
            $this->db->query($sql);
            $this->db->bind(':agency_id', $agencyId);
            $this->db->execute();
                    
            return $this->db->resultSet();
        }

        public function getacceptedBookingDetailsForAgency($agencyId) {
            $sql = "SELECT 
                        b.*, ta.agency_id
                    FROM 
                        bookings b
                    JOIN 
                        travelagency ta ON b.serviceProvider_id = ta.agency_id
                    WHERE 
                        ta.agency_id = :agency_id
                    AND 
                        b.bookingCondition = 'accepted'
                    AND  
                        b.vehicle_id != 0";
                    
            $this->db->query($sql);
            $this->db->bind(':agency_id', $agencyId);
            $this->db->execute();
                    
            return $this->db->resultSet();
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


        public function getUnavailableDatesForVehicles($vehicleIds, $date)
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
        

        
        
        



        public function insertUnavailableDate($vehicleId, $startDate, $endDate) {
            $query = "INSERT INTO vehicle_availability (vehicle_id, startDate, endDate) VALUES (:vehicleId, :startDate, :endDate)";
            $this->db->query($query);
            $this->db->bind(':vehicleId', $vehicleId);
            $this->db->bind(':startDate', $startDate);
            $this->db->bind(':endDate', $endDate);
        
            // Execute the query
            return $this->db->execute();
        }
        
        public function deleteUnavailableDate($vehicleId, $startDate, $endDate) {
            $query = "DELETE FROM vehicle_availability WHERE vehicle_id = :vehicleId AND startDate = :startDate AND endDate = :endDate";
            $this->db->query($query);
            $this->db->bind(':vehicleId', $vehicleId);
            $this->db->bind(':startDate', $startDate);
            $this->db->bind(':endDate', $endDate);
        
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
    

        public function getcompletedBookingDetailsForAgency($agencyId) {
            $sql = "SELECT 
                        b.*, ta.agency_id
                    FROM 
                        bookings b
                    JOIN 
                        travelagency ta ON b.serviceProvider_id = ta.agency_id
                    WHERE 
                        ta.agency_id = :agency_id
                    AND 
                        b.bookingCondition = 'complete'
                    AND  
                        b.vehicle_id != 0";
                    
            $this->db->query($sql);
            $this->db->bind(':agency_id', $agencyId);
            $this->db->execute();
                    
            return $this->db->resultSet();
        }
        

        public function getBookedTravellerDetails($bookingId) {
            $sql = "SELECT u.*
                    FROM bookings b
                    JOIN users u ON b.user_id = u.id
                    WHERE b.serviceProvider_id = :userId";
        
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
        
            return $this->db->single(); // Assuming each booking is associated with only one user
        }
        public function getMoreBookingDetails($bookingId) {
            $sql = "SELECT vb.*, b.*
                    FROM vehicle_bookings vb
                    JOIN bookings b ON vb.trip_id = b.booking_id
                    WHERE vb.trip_id = :booking_id";
        
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
        
            return $this->db->single(); // Assuming each booking matches only one trip in vehicle_bookings
        }
        
        public function getVehicleBookingDetail($bookingId) {
            $sql = "SELECT * FROM vehicle_bookings WHERE trip_id = :booking_id";
        
            $this->db->query($sql);
            $this->db->bind(':booking_id', $bookingId);
            $this->db->execute();
        
            return $this->db->resultSet(); // Assuming multiple vehicle bookings can be associated with one booking
        }
        
        
        
        
        // public function getPendingBookingDetailsForAgency($agencyId) {
        //     $sql = "SELECT 
        //                 b.booking_id,
        //                 b.startDate,
        //                 b.endDate,
        //                 b.vehicle_id,
        //                 v.brand,
        //                 v.model,
        //                 b.vehicle_id AS plate_number,
        //                 v.fuel_type,
        //                 v.year,
        //                 p.amount
        //             FROM 
        //                 bookings b
        //             JOIN 
        //                 travelagency ta ON b.serviceProvider_id = ta.agency_id
        //             JOIN 
        //                 vehicle_bookings vb ON b.booking_id = vb.trip_id
        //             JOIN 
        //                 vehicles v ON vb.vehicle_id = v.vehicle_id
        //             LEFT JOIN 
        //                 payments p ON vb.trip_id = p.booking_id
        //             WHERE 
        //                 ta.agency_id = :agency_id
        //             AND 
        //                 b.bookingCondition = 'pending'";
        
        //     $this->db->query($sql);
        //     $this->db->bind(':agency_id', $agencyId);
        //     $this->db->execute();
        
        //     return $this->db->resultSet();
        // }
        

        // public function getPendingBookingDetailsForAgency($user_id) {
        //     $sql = "SELECT 
        //                 vb.trip_id AS booking_id,
        //                 vb.start_date AS startDate,
        //                 vb.end_date AS endDate,
        //                 vb.vehicle_id,
        //                 v.brand,
        //                 v.model,
        //                 vb.vehicle_id AS plate_number,
        //                 v.fuel_type,
        //                 v.year,
        //                 p.amount
        //             FROM 
        //                 users u
        //             JOIN 
        //                 travelagency ta ON u.id = ta.user_id
        //             JOIN 
        //                 bookings b ON ta.agency_id = b.serviceProvider_id
        //             JOIN 
        //                 vehicle_bookings vb ON b.booking_id = vb.trip_id
        //             JOIN 
        //                 vehicles v ON vb.vehicle_id = v.vehicle_id
        //             LEFT JOIN 
        //                 payments p ON vb.trip_id = p.booking_id
        //             WHERE 
        //                 u.id = :user_id
        //             AND 
        //                 b.bookingCondition = 'pending'";
        
        //     $this->db->query($sql);
        //     $this->db->bind(':user_id', $user_id);
        //     $this->db->execute();
        
        //     return $this->db->bookingSet();
        // }
        public function addVehicle($data) {
            $this->db->query('INSERT INTO vehicles (agency_id, brand, model, plate_number, fuel_type, year, priceperday, seating_capacity, ac_type, description, image, vehi_img2, vehi_img3, vehi_img4, insurance, registration, revenue, status, withDriverPerDay, pricing_option, driver_name, driver_license_number, per_day_price_with_driver, daily_mileage_limit_with_driver, extra_mileage_charge_with_driver, per_day_price_without_driver, daily_mileage_limit_without_driver, extra_mileage_charge_without_driver, vehicle_type, number_of_doors, nav, airbag, tv, usb, driver_license_image) VALUES (:agency_id, :brand, :model, :plate_number, :fuel_type, :year, :priceperday, :seating_capacity, :ac_type, :description, :image, :vehi_img2, :vehi_img3, :vehi_img4, :insurance, :registration, :revenue, :status, :withDriverPerDay, :pricing_option, :driver_name, :driver_license_number, :per_day_price_with_driver, :daily_mileage_limit_with_driver, :extra_mileage_charge_with_driver, :per_day_price_without_driver, :daily_mileage_limit_without_driver, :extra_mileage_charge_without_driver, :vehicle_type, :number_of_doors, :nav, :airbag, :tv, :usb, :driver_license_image)');
            // Bind values
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
            $this->db->bind(':image', $data['image']);
            $this->db->bind(':vehi_img2', $data['vehi_img2']);
            $this->db->bind(':vehi_img3', $data['vehi_img3']);
            $this->db->bind(':vehi_img4', $data['vehi_img4']);
            $this->db->bind(':insurance', $data['insurance']);
            $this->db->bind(':registration', $data['registration']);
            $this->db->bind(':revenue', $data['revenue']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':withDriverPerDay', $data['withDriverPerDay']);
            $this->db->bind(':pricing_option', $data['pricing_option']);
            $this->db->bind(':driver_name', $data['driver_name']);
            $this->db->bind(':driver_license_number', $data['driver_license_number']);
            $this->db->bind(':per_day_price_with_driver', $data['per_day_price_with_driver']);
            $this->db->bind(':daily_mileage_limit_with_driver', $data['daily_mileage_limit_with_driver']);
            $this->db->bind(':extra_mileage_charge_with_driver', $data['extra_mileage_charge_with_driver']);
            $this->db->bind(':per_day_price_without_driver', $data['per_day_price_without_driver']);
            $this->db->bind(':daily_mileage_limit_without_driver', $data['daily_mileage_limit_without_driver']);
            $this->db->bind(':extra_mileage_charge_without_driver', $data['extra_mileage_charge_without_driver']);
            $this->db->bind(':vehicle_type', $data['vehicle_type']);
            $this->db->bind(':number_of_doors', $data['number_of_doors']);
            $this->db->bind(':nav', $data['nav']);
            $this->db->bind(':airbag', $data['airbag']);
            $this->db->bind(':tv', $data['tv']);
            $this->db->bind(':usb', $data['usb']);
            $this->db->bind(':driver_license_image', $data['driver_license_image']);
    
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 
        
        // public function getAgencyDetails($userId) {
        //     $this->db->where('user_id', $userId);
        //     $row = $this->db->get('travelagency')->row_array();
        //     return $row ? $row : []; // Return an empty array if no agency details are found
        // }
        
    
        // public function getPendingBookings($userId) {
        //     $this->db->select('*');
        //     $this->db->from('bookings');
        //     $this->db->join('travelagency', 'bookings.serviceProvider_id = travelagency.agency_id');
        //     $this->db->where('travelagency.user_id', $userId);
        //     $this->db->where('bookings.bookingCondition', 'pending');
        //     return $this->db->get()->result_array();
        // }
    
        // public function getVehicleDetails($userId) {
        //     $this->db->select('*');
        //     $this->db->from('vehicles');
        //     $this->db->join('vehicle_bookings', 'vehicles.vehicle_id = vehicle_bookings.vehicle_id');
        //     $this->db->where('vehicle_bookings.agency_id', $userId);
        //     return $this->db->get()->result_array();
        // }
        
        
        
        
        
        
        
    
}