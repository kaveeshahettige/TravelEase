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

    public function vehiclereg($data){
        {
            $this->db->query('INSERT INTO vehicles (brand, model, plate_number, fuel_type, year,seating_capacity,ac_type,ins_number, ins_name, start_date, end_date,user_id) VALUES (:brand, :model, :plate_number, :fuel_type, :year,:seating_capacity,:ac_type, :ins_number, :ins_name, :start_date, :end_date,:user_id) ');
    
            $this->db->bind(':brand', $data['brand']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':plate_number', $data['plate_number']);
            $this->db->bind(':fuel_type', $data['fuel_type']);
            $this->db->bind(':year', $data['year']);
            $this->db->bind(':seating_capacity', $data['seating_capacity']);
            $this->db->bind(':ac_type', $data['ac_type']);
            $this->db->bind(':user_id', $data['user_id']);

            // $this->db->bind(':veh_photo', $data['veh_photo']);
            $this->db->bind(':ins_number', $data['ins_number']);
            $this->db->bind(':ins_name', $data['ins_name']);
            $this->db->bind(':start_date', $data['start_date']);
            $this->db->bind(':end_date', $data['end_date']);
           
            // $this->db->bind(':ins_photo', $data['ins_photo']);
            // $this->db->bind(':reg_photo', $data['reg_photo']);
    
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
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
        $this->db->query('UPDATE vehicles SET seating_capacity = :seating_capacity, ac_type = :ac_type WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['vehicle_id']);
        
        $this->db->bind(':seating_capacity', $data['seating_capacity']);
        $this->db->bind(':ac_type', $data['ac_type']);
  
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

      
        public function getPendingBookings($user_id) {
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "pending"');
            $this->db->bind(':user_id', $user_id);
            $results = $this->db->resultSet();
            return $results;
        }
        

        public function acceptedbookings($user_id){
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "accepted"');
            $this->db->bind(':user_id', $user_id);
            $results = $this->db->resultSet();
            return $results;
        }

        public function completedbookings($user_id){
            $this->db->query('SELECT * FROM vehicle_bookings WHERE agency_id = :user_id AND status = "completed"');
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
        
        
        


        
        
    
}

