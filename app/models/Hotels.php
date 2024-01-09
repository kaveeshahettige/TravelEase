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

    public function hoteladdroomsedit($roomData)
    {
        $this->db->query('INSERT INTO hotel_rooms 
    (roomType, numOfBeds, price, roomImages, acAvailability, tvAvailability, wifiAvailability, smokingPolicy, petPolicy, roomDescription, cancellationPolicy) 
    VALUES (:roomType, :numOfBeds, :price, :roomImages, :acAvailability, :tvAvailability, :wifiAvailability, :smokingPolicy, :petPolicy, :roomDescription, :cancellationPolicy)');

        // Bind values
        $this->db->bind(':roomType', $roomData['roomType']);
        $this->db->bind(':numOfBeds', $roomData['numOfBeds']);
        $this->db->bind(':price', $roomData['price']);
        $this->db->bind(':roomImages', $roomData['roomImages']);
        $this->db->bind(':acAvailability', $roomData['acAvailability']);
        $this->db->bind(':tvAvailability', $roomData['tvAvailability']);
        $this->db->bind(':wifiAvailability', $roomData['wifiAvailability']);
        $this->db->bind(':smokingPolicy', $roomData['smokingPolicy']);
        $this->db->bind(':petPolicy', $roomData['petPolicy']);
        $this->db->bind(':roomDescription', $roomData['roomDescription']);
        $this->db->bind(':cancellationPolicy', $roomData['cancellationPolicy']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
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


    public function hotelupdaterooms($roomData)
    {
        $this->db->query('UPDATE hotel_rooms SET 
        roomType = :roomType, 
        numOfBeds = :numOfBeds, 
        price = :price, 
        roomImages = :roomImages, 
        acAvailability = :acAvailability, 
        tvAvailability = :tvAvailability, 
        wifiAvailability = :wifiAvailability, 
        smokingPolicy = :smokingPolicy, 
        petPolicy = :petPolicy, 
        roomDescription = :roomDescription, 
        cancellationPolicy = :cancellationPolicy 
        WHERE room_id = :room_id');

        // Bind values
        $this->db->bind(':room_id', $roomData['room_id']);
        $this->db->bind(':roomType', $roomData['roomType']);
        $this->db->bind(':numOfBeds', $roomData['numOfBeds']);
        $this->db->bind(':price', $roomData['price']);
        $this->db->bind(':roomImages', $roomData['roomImages']);
        $this->db->bind(':acAvailability', $roomData['acAvailability']);
        $this->db->bind(':tvAvailability', $roomData['tvAvailability']);
        $this->db->bind(':wifiAvailability', $roomData['wifiAvailability']);
        $this->db->bind(':smokingPolicy', $roomData['smokingPolicy']);
        $this->db->bind(':petPolicy', $roomData['petPolicy']);
        $this->db->bind(':roomDescription', $roomData['roomDescription']);
        $this->db->bind(':cancellationPolicy', $roomData['cancellationPolicy']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
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

    public function getRoomCount() {
        $this->db->query('SELECT COUNT(*) as roomCount FROM hotel_rooms');
        $result = $this->db->single();
        return $result->roomCount;
    }

    public function getBookings() {
        $this->db->query('SELECT * FROM bookings'); // Change the query according to your database schema
        return $this->db->resultSet();
    }

    public function getReviews() {
        $this->db->query('SELECT reviews.*, users.fname FROM reviews JOIN users ON reviews.user_id = users.id');
        return $this->db->resultSet();
    }


}