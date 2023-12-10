<?php
class Hotels{

    public string $hotel;
    public string $roomType;

    private $db;

    public function __construct(){
        $this->db =new Database;
    }

    public function getHotel() {
        $this->db->query('SELECT * FROM hotel_rooms');
        $results = $this->db->resultSet();

        return $results;
    }

    public function hoteladdroomsedit($roomData) {
        $this->db->query ('INSERT INTO hotel_rooms 
        (roomType, numOfBeds, price, roomImages, roomDescription) VALUES (:roomType, :numOfBeds, :price, :roomImages, :roomDescription)');
        //bind values
        $this->db->bind(':roomType',$roomData['roomType']);
        $this->db->bind(':numOfBeds',$roomData['numOfBeds']);
        $this->db->bind(':price',$roomData['price']);
        $this->db->bind(':roomImages',$roomData['roomImages']);
        $this->db->bind(':roomDescription',$roomData['roomDescription']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findrooms($room_id){
        $this->db->query('SELECT * from hotel_rooms WHERE room_id = :room_id ');
        $this->db->bind(':room_id', $room_id);
        $roomData=$this->db->resultSet();
//        print_r($roomData);
        //check row
        if($this->db->rowCount()>0){
//            echo "hi";
//            print_r($roomData);
            return $roomData[0];
        }else{
            return null;
        }
    }


    public function hotelupdaterooms($roomData) {

        $this->db->query ('UPDATE hotel_rooms SET roomType = :roomType, numOfBeds = :numOfBeds, price = :price, roomDescription = :roomDescription WHERE room_id = :room_id');
        //bind values
        $this->db->bind(':room_id', $roomData['room_id']);
        $this->db->bind(':roomType',$roomData['roomType']);
        $this->db->bind(':numOfBeds',$roomData['numOfBeds']);
        $this->db->bind(':price',$roomData['price']);
        //$this->db->bind(':roomImages',$roomData['roomImages']);
        $this->db->bind(':roomDescription',$roomData['roomDescription']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleterooms($room_id){
        $this->db->query('DELETE FROM hotel_rooms WHERE room_id = :room_id');
        // Bind values
        $this->db->bind(':room_id', $room_id);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

}