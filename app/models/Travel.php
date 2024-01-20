<?php
class Travel{
   private $db;

    public function __construct(){
        $this->db=new Database;
    }

    
    public function editvehicleDetail($data){

        var_dump($data);

        $this->db->query('SELECT * from vehicles where id=:id');
        $this->db->bind(':id',$data['vehicle_id']);



       
        if($this->db->rowCount()>0){
            return $row;
        }else{
            return null;
        }
    }

    public function vehiclereg($data, $imageFiles) {
        // Save vehicle details to the database
        $this->db->query('INSERT INTO vehicles (user_id, brand, model, plate_number, fuel_type, year, seating_capacity, ac_type, description, vehi_img1, vehi_img2, vehi_img3, vehi_img4, insurance, registration, revenue) VALUES (:user_id, :brand, :model, :plate_number, :fuel_type, :year, :seating_capacity, :ac_type, :description, :vehi_img1, :vehi_img2, :vehi_img3, :vehi_img4, :insurance, :registration, :revenue)');
        
        // Bind parameters
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':plate_number', $data['plate_number']);
        $this->db->bind(':fuel_type', $data['fuel_type']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':seating_capacity', $data['seating_capacity']);
        $this->db->bind(':ac_type', $data['ac_type']);
        $this->db->bind(':description', $data['description']);
    
        // Process and save images
        $imagePaths = $this->processAndSaveImages($data['user_id'], $imageFiles);
    
        // Bind image paths to database parameters
        $this->db->bind(':vehi_img1', $imagePaths[0]);
        $this->db->bind(':vehi_img2', $imagePaths[1]);
        $this->db->bind(':vehi_img3', $imagePaths[2]);
        $this->db->bind(':vehi_img4', $imagePaths[3]);
        $this->db->bind(':insurance', $imagePaths[4]);
        $this->db->bind(':registration', $imagePaths[5]);
        $this->db->bind(':revenue', $imagePaths[6]);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    private function processAndSaveImages($userId, $imageFiles) {
        $imagePaths = [];
        
        $uploadDir = __DIR__ . "/../public/uploads/vehicle_doc/";
        
        $fileTypes = [
            'vehi_img1' => 'Vehicle Photo 1',
            'vehi_img2' => 'Vehicle Photo 2',
            'vehi_img3' => 'Vehicle Photo 3',
            'vehi_img4' => 'Vehicle Photo 4',
            'insurance' => 'Insurance Photo',
            'registration' => 'Registation card Photo',
            'revenue' => 'Revenue License Photo',
        ];
    
        foreach ($fileTypes as $key => $label) {
            if (isset($imageFiles[$key]) && $imageFiles[$key]['error'] === UPLOAD_ERR_OK) {
                $originalName = $imageFiles[$key]['name'];
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $newFileName = "{$userId}_{$key}_{$originalName}";
    
                // Construct the destination path correctly
                $destination = $uploadDir . $newFileName;
    
                // Add a numeric suffix if the file already exists
                $j = 1;
                while (file_exists($destination)) {
                    $newFileName = "{$userId}_{$key}_{$j}_{$originalName}";
                    $destination = $uploadDir . $newFileName;
                    $j++;
                }
    
                // Correctly concatenate paths and move the uploaded file
                if (move_uploaded_file($imageFiles[$key]['tmp_name'], $destination)) {
                    $imagePaths[] = $newFileName;
                } else {
                    // Handle error if file move fails
                    $imagePaths[] = ''; // Add an empty string as a placeholder for the failed image
                }
            } else {
                // Add an empty string as a placeholder for missing images
                $imagePaths[] = '';
            }
        }
    
        return $imagePaths;
    }
    

    public function vehicleDetails($user_id) {
        $this->db->query('SELECT * FROM vehicles WHERE user_id=:user_id');
        $this->db->bind(':user_id', $user_id);  
        $data = $this->db->resultSet();
        $data = json_decode(json_encode($data), true);
    
        // Check row
        if($this->db->rowCount()>0){
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
    public function vehicledelete($id){
        $this->db->query('DELETE FROM vehicles WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
  
        // Execute
        if($this->db->execute()){
            redirect('driver/vehicle');
        } else {
          return false;
        }
}

      
 
                

        public function acceptedbookings($user_id){
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "accepted"');
            $this->db->bind(':user_id', $user_id);
            $results = $this->db->resultSet();
        }
        // public function acceptedbookings($user_id){
        //     $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "accepted"');
        //     $this->db->bind(':user_id', $user_id);
        //     $results = $this->db->resultSet();
        //     return $results;
        // }

        public function completedbookings($user_id){
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "completed"');
            $this->db->bind(':user_id', $user_id);
            $results = $this->db->resultSet();
            return $results;
        }
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

        public function updateBookingStatus($bookingId, $status) {
            // Validate $status to prevent SQL injection (you may use a whitelist approach)
            $allowedStatus = ['accepted', 'decline'];
            if (!in_array($status, $allowedStatus)) {
                $status = 'pending'; // Default to pending if an invalid status is provided
            }
        
            // Debugging statements
            var_dump($bookingId); // Check the value of bookingId
            var_dump($status);    // Check the value of status
        
            // Update the booking status
            $this->db->query("UPDATE vehicle_bookings SET status = :status WHERE trip_id = :trip_id");
            $this->db->bind(':trip_id', $bookingId); // Use $bookingId instead of $trip_id
            $this->db->bind(':status', $status);
        
            // Execute the query
            return $this->db->execute();
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



        
 

        
        

        public function getPendingBookingsDateSorted($column, $order) {
       

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
    
            $this->db->query("SELECT * FROM vehicle_bookings WHERE status = 'pending' ORDER BY $column $order");
            return $this->db->resultSet();

         // $this->db->query("SELECT * FROM vehicle_bookings  WHERE status = 'pending' ORDER BY $column $order");
         $this->db->query("SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = 'pending' ORDER BY $column $order");
         $this->db->bind(':user_id', $user_id);
         return $this->db->resultSet();
        }
        

        public function getPendingBookingsSorted($column,$order) {
        public function getAcceptedBookingsSorted($column,$order,$user_id) {
            // Validate $column to prevent SQL injection (you may use a whitelist approach)
            $allowedColumns = ['trip_id', 'start_date', 'end_date', 'pickup_location', 'dropoff_location', 'passenger_count'];
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

