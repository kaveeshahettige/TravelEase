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



        // $row=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return $row;
        }else{
            return null;
        }
    }

    public function vehiclereg($data){
        {
            $this->db->query('INSERT INTO vehicles (brand, model, plate_number, fuel_type, year, ins_number, ins_name, start_date, end_date) VALUES (:brand, :model, :plate_number, :fuel_type, :year, :ins_number, :ins_name, :start_date, :end_date)');
    
            $this->db->bind(':brand', $data['brand']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':plate_number', $data['plate_number']);
            $this->db->bind(':fuel_type', $data['fuel_type']);
            $this->db->bind(':year', $data['year']);
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

    public function vehicleDetails(){
        $this->db->query('SELECT * from vehicles');

         $data=$this->db->resultSet();
         $data = json_decode(json_encode($data), true);

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    public function updatevehicle($data){
        // var_dump($data);
        $this->db->query('UPDATE vehicles SET brand = :brand, model = :model,year = :year,fuel_type = :fuel_type WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['vehicle_id']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':fuel_type', $data['fuel_type']);
  
        // Execute
        if($this->db->execute()){
            redirect('driver/vehicle');
        //add a function to rlaod site
          return true;
        } else {
          return false;
        }
      }
      
}

