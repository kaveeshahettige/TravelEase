<?php
class Travel{
   private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function addAgency($agency_name, $reg_number, $address, $description, $location, $user_id) {
        $this->db->query('INSERT INTO travelagency (agency_name, reg_number, address, description, location, user_id) VALUES (:agency_name, :reg_number, :address, :description, :location, :user_id)');
        $this->db->bind(':agency_name', $agency_name);
        $this->db->bind(':reg_number', $reg_number);
        $this->db->bind(':address', $address);
        $this->db->bind(':description', $description);
        $this->db->bind(':location', $location);
        $this->db->bind(':user_id', $user_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
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
        $this->db->bind(':agency_id', $agency_id);
        $this->db->bind(':vehicle_type', $data['vehicle_type']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':plate_number', $data['plate_number']);
        $this->db->bind(':fuel_type', $data['fuel_type']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':seating_capacity', $data['seating_capacity']);
        $this->db->bind(':ac_type', $data['ac_type']);
        $this->db->bind(':airbag', $data['airbag']);
        $this->db->bind(':nav', $data['nav']);
        $this->db->bind(':tv', $data['tv']);
        $this->db->bind(':usb', $data['usb']);
        $this->db->bind(':description', $data['description']);
        
    
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
    

      
 
                

        // public function acceptedbookings($user_id){
        //     $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "accepted"');
        //     $this->db->bind(':user_id', $user_id);
        //     $results = $this->db->resultSet();
        //     return $results;
        // }

        // public function completedbookings($user_id){
        //     $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "completed"');
        //     $this->db->bind(':user_id', $user_id);
        //     $results = $this->db->resultSet();
        //     return $results;
        // }

        public function getPendingBookings($user_id){
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "pending"');
            $this->db->bind(':user_id', $user_id);
            $results = $this->db->resultSet();
            return $results;
        }
        
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



        
 

        
        

       

        public function getPendingBookingsSorted($column,$order,$user_id) {
            // Validate $column to prevent SQL injection (you may use a whitelist approach)
            $allowedColumns = ['trip_id', 'start_date', 'end_date', 'pickup_location', 'dropoff_location', 'passenger_count'];
            if (!in_array($column, $allowedColumns)) {
                $column = 'trip_id'; // Default to trip_id if an invalid column is provided
            }

            // Validate $order to prevent SQL injection (you may use a whitelist approach)
            $allowedOrders = ['asc', 'desc'];
            if (!in_array($order, $allowedOrders)) {
                $order = 'asc'; // Default to asc if an invalid order is provided
            }

         // $this->db->query("SELECT * FROM vehicle_bookings  WHERE status = 'pending' ORDER BY $column $order");
         $this->db->query("SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = 'pending' ORDER BY $column $order");
         $this->db->bind(':user_id', $user_id);
         return $this->db->resultSet();
        }

        public function getAcceptedBookingsSorted($column,$order,$user_id) {
            // Validate $column to prevent SQL injection (you may use a whitelist approach)
            $allowedColumns = ['trip_id', 'start_date', 'end_date', 'pickup_location', 'dropoff_location', 'passenger_count', 'earnings'];
            if (!in_array($column, $allowedColumns)) {
                $column = 'trip_id'; // Default to trip_id if an invalid column is provided
            }

            // Validate $order to prevent SQL injection (you may use a whitelist approach)
            $allowedOrders = ['asc', 'desc'];
            if (!in_array($order, $allowedOrders)) {
                $order = 'asc'; // Default to asc if an invalid order is provided
            }
            $this->db->query("SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = 'accepted' ORDER BY $column $order");
            $this->db->bind(':user_id', $user_id);
            return $this->db->resultSet();
        }

        public function getCompletedBookingsSorted($column,$order,$user_id) {
            // Validate $column to prevent SQL injection (you may use a whitelist approach)
            $allowedColumns = ['trip_id', 'start_date', 'end_date', 'pickup_location', 'dropoff_location', 'passenger_count', 'earnings','comments','rating'];
            if (!in_array($column, $allowedColumns)) {
                $column = 'trip_id'; // Default to trip_id if an invalid column is provided
            }

            // Validate $order to prevent SQL injection (you may use a whitelist approach)
            $allowedOrders = ['asc', 'desc'];
            if (!in_array($order, $allowedOrders)) {
                $order = 'asc'; // Default to asc if an invalid order is provided
            }
            $this->db->query("SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = 'completed' ORDER BY $column $order");
            $this->db->bind(':user_id', $user_id);
            return $this->db->resultSet();
        }
       

        
        
    
}

