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

    public function getHotelRooms($hotel_id) {
        $this->db->query('SELECT * FROM hotel_rooms WHERE hotel_id = :hotel_id');
        $this->db->bind(':hotel_id', $hotel_id);
        $roomData = $this->db->resultSet();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $roomData;
        } else {
            return [];
        }
    }



    public function updateHotelInfo($userId, $hotelData) {
        $this->db->query('UPDATE hotel SET 
        hotel_name = :hotelName, 
        hotel_type = :hotelType, 
        email = :email, 
        phone_number = :phoneNumber, 
        alt_phone_number = :altPhoneNumber, 
        manager_name = :managerName, 
        manager_phone_number = :managerPhoneNumber, 
        address = :address, 
        city = :city, 
        province = :province, 
        website = :website, 
        facebook = :facebook, 
        twitter = :twitter, 
        instagram = :instagram, 
        additional_notes = :additionalNotes 
        WHERE user_id = :userId');

        // Bind values
        $this->db->bind(':userId', $userId);
        $this->db->bind(':hotelName', $hotelData['hotelName']);
        $this->db->bind(':hotelType', $hotelData['hotelType']);
        $this->db->bind(':email', $hotelData['email']);
        $this->db->bind(':phoneNumber', $hotelData['phoneNumber']);
        $this->db->bind(':altPhoneNumber', $hotelData['altPhoneNumber']);
        $this->db->bind(':managerName', $hotelData['managerName']);
        $this->db->bind(':managerPhoneNumber', $hotelData['managerPhoneNumber']);
        $this->db->bind(':address', $hotelData['address']);
        $this->db->bind(':city', $hotelData['city']);
        $this->db->bind(':province', $hotelData['province']);
        $this->db->bind(':website', $hotelData['website']);
        $this->db->bind(':facebook', $hotelData['facebook']);
        $this->db->bind(':twitter', $hotelData['twitter']);
        $this->db->bind(':instagram', $hotelData['instagram']);
        $this->db->bind(':additionalNotes', $hotelData['additionalNotes']);

        // Execute
        return $this->db->execute();
    }

    public function getHotelIdByUserId($user_id)
    {
        $this->db->query('SELECT hotel_id FROM hotel WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row->hotel_id;
        } else {
            return null;
        }
    }


    public function hoteladdroomsedit($roomData)
    {
        // Get the last inserted room_id
        $this->db->query('SELECT MAX(room_id) AS max_room_id FROM hotel_rooms');
        $result = $this->db->single();

        if ($result) {
            $lastInsertedRoomId = $result->max_room_id;

            // Generate the registration_number
            $registrationNumber = 'TE-H' . str_pad($lastInsertedRoomId+1, 2, '0', STR_PAD_LEFT);

            // Add the registration_number to the $roomData array
            $roomData['registration_number'] = $registrationNumber;

            // Insert the data into the hotel_rooms table
            $this->db->query('INSERT INTO hotel_rooms 
        (hotel_id, roomType, numOfBeds, price, roomImages, acAvailability, tvAvailability, wifiAvailability, smokingPolicy, petPolicy, roomDescription, cancellationPolicy, registration_number) 
        VALUES (:hotel_id, :roomType, :numOfBeds, :price, :roomImages, :acAvailability, :tvAvailability, :wifiAvailability, :smokingPolicy, :petPolicy, :roomDescription, :cancellationPolicy, :registration_number)');

            // Bind values
            $this->db->bind(':hotel_id', $roomData['hotel_id']);
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
            $this->db->bind(':registration_number', $roomData['registration_number']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
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


    public function getRoomCount($hotel_id)
    {
        $this->db->query('SELECT COUNT(*) as roomCount FROM hotel_rooms WHERE hotel_id = :hotel_id');
        $this->db->bind(':hotel_id', $hotel_id);

        $result = $this->db->single();

        if ($result) {
            return $result->roomCount;
        } else {
            // Handle the case where the query doesn't return a result
            return 0;
        }
    }

    public function getBookingsByHotel($hotel_id) {
        $this->db->query('SELECT b.*, u.fname, u.profile_picture, hr.roomType 
                      FROM bookings b
                      JOIN users u ON b.user_id = u.id
                      LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                      WHERE hr.hotel_id = :hotel_id');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }

    public function getReviews($hotel_id) {
        $this->db->query('SELECT r.*, u.fname, u.profile_picture
                          FROM `reviews` r
                          JOIN users u ON r.user_id = u.id
                          WHERE r.`hotel_id` = :hotel_id');
        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }



    public function insertPdf($filename, $userId) {
        $this->db->query('UPDATE users SET document = :filename WHERE id = :userId');
        $this->db->bind(':filename', $filename);
        $this->db->bind(':userId', $userId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfilePicture($userId, $filename) {
        $this->db->query('UPDATE users SET profile_picture = :filename WHERE id = :userId');
        $this->db->bind(':filename', $filename);
        $this->db->bind(':userId', $userId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($user_id) {
        $this->db->query('SELECT * FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);

        return $this->db->single();
    }

    public function getHotelByUserId($user_id)
    {
        $this->db->query('SELECT * FROM hotel WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);

        return $this->db->single();
    }





}