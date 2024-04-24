<?php
class Hotels
{

    public string $hotel;
    public string $roomType;

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getHotel()
    {
        $this->db->query('SELECT * FROM hotel_rooms');
        $results = $this->db->resultSet();

        return $results;
    }

    public function getHotelRooms($hotel_id)
    {
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

    public function updateHotelInfo($userId, $hotelData)
    {
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
            $registrationNumber = 'TE-H' . str_pad($lastInsertedRoomId + 1, 2, '0', STR_PAD_LEFT);

            // Add the registration_number to the $roomData array
            $roomData['registration_number'] = $registrationNumber;

          // Insert the data into the hotel_rooms table
            $this->db->query('INSERT INTO hotel_rooms 
            (hotel_id, roomType, numOfBeds, numAdults, numChildren, price, roomSize, acAvailability, tvAvailability, wifiAvailability, smokingPolicy, petPolicy, balconyAvailability, privatePoolAvailability, hotTubAvailability, refrigeratorAvailability, hotShowerHeaterAvailability, washingMachineAvailability, kitchenAvailability, breakfastIncluded, lunchIncluded, dinnerIncluded, description, cancellationPolicy, registration_number, roomImages1, roomImages2, roomImages3, roomImages4) 
            VALUES (:hotel_id, :roomType, :numOfBeds, :numAdults, :numChildren, :price, :roomSize, :acAvailability, :tvAvailability, :wifiAvailability, :smokingPolicy, :petPolicy, :balconyAvailability, :privatePoolAvailability, :hotTubAvailability, :refrigeratorAvailability, :hotShowerHeaterAvailability, :washingMachineAvailability, :kitchenAvailability, :breakfastIncluded, :lunchIncluded, :dinnerIncluded, :description, :cancellationPolicy, :registration_number, :roomImages1, :roomImages2, :roomImages3, :roomImages4)');

            // Bind values
            $this->db->bind(':hotel_id', $roomData['hotel_id']);
            $this->db->bind(':roomType', $roomData['roomType']);
            $this->db->bind(':numOfBeds', $roomData['numOfBeds']);
            $this->db->bind(':numAdults', $roomData['numAdults']);
            $this->db->bind(':numChildren', $roomData['numChildren']);
            $this->db->bind(':price', $roomData['price']);
            $this->db->bind(':roomSize', $roomData['roomSize']);
            $this->db->bind(':acAvailability', $roomData['acAvailability']);
            $this->db->bind(':tvAvailability', $roomData['tvAvailability']);
            $this->db->bind(':wifiAvailability', $roomData['wifiAvailability']);
            $this->db->bind(':smokingPolicy', $roomData['smokingPolicy']);
            $this->db->bind(':petPolicy', $roomData['petPolicy']);
            $this->db->bind(':balconyAvailability', $roomData['balconyAvailability']);
            $this->db->bind(':privatePoolAvailability', $roomData['privatePoolAvailability']);
            $this->db->bind(':hotTubAvailability', $roomData['hotTubAvailability']);
            $this->db->bind(':refrigeratorAvailability', $roomData['refrigeratorAvailability']);
            $this->db->bind(':hotShowerHeaterAvailability', $roomData['hotShowerHeaterAvailability']);
            $this->db->bind(':washingMachineAvailability', $roomData['washingMachineAvailability']);
            $this->db->bind(':kitchenAvailability', $roomData['kitchenAvailability']);
            $this->db->bind(':breakfastIncluded', $roomData['breakfastIncluded']);
            $this->db->bind(':lunchIncluded', $roomData['lunchIncluded']);
            $this->db->bind(':dinnerIncluded', $roomData['dinnerIncluded']);
            $this->db->bind(':description', $roomData['description']);
            $this->db->bind(':cancellationPolicy', $roomData['cancellationPolicy']);
            $this->db->bind(':registration_number', $roomData['registration_number']);
            $this->db->bind(':roomImages1', $roomData['roomImages'][0] ?? '');
            $this->db->bind(':roomImages2', $roomData['roomImages'][1] ?? '');
            $this->db->bind(':roomImages3', $roomData['roomImages'][2] ?? '');
            $this->db->bind(':roomImages4', $roomData['roomImages'][3] ?? '');


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



    public function findrooms($room_id)
    {
        $this->db->query('SELECT * from hotel_rooms WHERE room_id = :room_id ');
        $this->db->bind(':room_id', $room_id);
        $roomData = $this->db->resultSet();
        //        print_r($roomData);
        //check row
        if ($this->db->rowCount() > 0) {
            //            echo "hi";
            //            print_r($roomData);
            return $roomData[0];
        } else {
            return null;
        }
    }


    public function hotelupdaterooms($roomData)
    {
        $this->db->query('UPDATE hotel_rooms SET 
        roomType = :roomType, 
        numOfBeds = :numOfBeds, 
        numAdults = :numAdults, 
        numChildren = :numChildren, 
        price = :price, 
        acAvailability = :acAvailability, 
        tvAvailability = :tvAvailability, 
        wifiAvailability = :wifiAvailability, 
        smokingPolicy = :smokingPolicy, 
        petPolicy = :petPolicy, 
        description = :description, 
        cancellationPolicy = :cancellationPolicy,
        roomSize = :roomSize,
        balconyAvailability = :balconyAvailability,
        privatePoolAvailability = :privatePoolAvailability,
        hotTubAvailability = :hotTubAvailability,
        refrigeratorAvailability = :refrigeratorAvailability,
        hotShowerHeaterAvailability = :hotShowerHeaterAvailability,
        washingMachineAvailability = :washingMachineAvailability,
        kitchenAvailability = :kitchenAvailability,
        breakfastIncluded = :breakfastIncluded,
        lunchIncluded = :lunchIncluded,
        dinnerIncluded = :dinnerIncluded, 
        roomImages1 = :roomImages1,
        roomImages2 = :roomImages2,
        roomImages3 = :roomImages3,
        roomImages4 = :roomImages4           
        WHERE room_id = :room_id');

        // Bind values
        $this->db->bind(':room_id', $roomData['room_id']);
        $this->db->bind(':roomType', $roomData['roomType']);
        $this->db->bind(':numOfBeds', $roomData['numOfBeds']);
        $this->db->bind(':numAdults', $roomData['numAdults']);
        $this->db->bind(':numChildren', $roomData['numChildren']);
        $this->db->bind(':price', $roomData['price']);
        $this->db->bind(':acAvailability', $roomData['acAvailability']);
        $this->db->bind(':tvAvailability', $roomData['tvAvailability']);
        $this->db->bind(':wifiAvailability', $roomData['wifiAvailability']);
        $this->db->bind(':smokingPolicy', $roomData['smokingPolicy']);
        $this->db->bind(':petPolicy', $roomData['petPolicy']);
        $this->db->bind(':description', $roomData['description']);
        $this->db->bind(':cancellationPolicy', $roomData['cancellationPolicy']);
        $this->db->bind(':roomSize', $roomData['roomSize']);
        $this->db->bind(':balconyAvailability', $roomData['balconyAvailability']);
        $this->db->bind(':privatePoolAvailability', $roomData['privatePoolAvailability']);
        $this->db->bind(':hotTubAvailability', $roomData['hotTubAvailability']);
        $this->db->bind(':refrigeratorAvailability', $roomData['refrigeratorAvailability']);
        $this->db->bind(':hotShowerHeaterAvailability', $roomData['hotShowerHeaterAvailability']);
        $this->db->bind(':washingMachineAvailability', $roomData['washingMachineAvailability']);
        $this->db->bind(':kitchenAvailability', $roomData['kitchenAvailability']);
        $this->db->bind(':breakfastIncluded', $roomData['breakfastIncluded']);
        $this->db->bind(':lunchIncluded', $roomData['lunchIncluded']);
        $this->db->bind(':dinnerIncluded', $roomData['dinnerIncluded']);
        $this->db->bind(':roomImages1', $roomData['roomImages'][0] ?? '');
        $this->db->bind(':roomImages2', $roomData['roomImages'][1] ?? '');
        $this->db->bind(':roomImages3', $roomData['roomImages'][2] ?? '');
        $this->db->bind(':roomImages4', $roomData['roomImages'][3] ?? '');

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function updateHotelSettings($userData)
    {
        // Update users table
        $this->db->query('UPDATE users SET 
    fname = :hotelName, 
    email = :email, 
    number = :phoneNumber       
    WHERE id = :user_id');

        // Bind values for users table
        $this->db->bind(':user_id', $userData['user_id']);
        $this->db->bind(':hotelName', $userData['hotelName']);
        $this->db->bind(':email', $userData['email']);
        $this->db->bind(':phoneNumber', $userData['phoneNumber']);

        // Execute users table update
        $this->db->execute();

        // Update hotels table
        $this->db->query('UPDATE hotel SET 
    hotel_type = :hotelType
    WHERE user_id = :user_id');

        // Bind values for hotels table
        $this->db->bind(':user_id', $userData['user_id']);
        $this->db->bind(':hotelType', $userData['hotelType']);

        // Execute hotels table update
        return $this->db->execute();
    }

    public function updateAdditionalDetails($hotelData) {
        // Update hotels table
        $this->db->query('UPDATE hotel SET 
        alt_phone_number = :altPhoneNumber,
        manager_name = :managerInfo,
        manager_phone_number = :managerPhoneNumber,
        addr=:addr,
        street_address = :street_address,
        city = :city,
        state_province = :state,
        check_in_time = :check_in_time,
        check_out_time = :check_out_time,
        website = :website,
        facebook = :facebook,
        twitter = :twitter,
        instagram = :instagram,
        bank_name = :bank_name,
        branch = :branch,
        card_holder_name = :card_holder_name,
        account_number = :account_number,
        additional_notes = :additionalNotes     
        WHERE user_id = :user_id');

        // Bind values for hotels table
        $this->db->bind(':user_id', $hotelData['user_id']);
        $this->db->bind(':altPhoneNumber', $hotelData['altPhoneNumber']);
        $this->db->bind(':managerInfo', $hotelData['managerInfo']);
        $this->db->bind(':managerPhoneNumber', $hotelData['managerPhoneNumber']);
        $this->db->bind(':addr', $hotelData['addr']);
        $this->db->bind(':street_address', $hotelData['street_address']);
        $this->db->bind(':city', $hotelData['city']);
        $this->db->bind(':state', $hotelData['state']);
        $this->db->bind(':check_in_time', $hotelData['check_in_time']);
        $this->db->bind(':check_out_time', $hotelData['check_out_time']);
        $this->db->bind(':website', $hotelData['website']);
        $this->db->bind(':facebook', $hotelData['facebook']);
        $this->db->bind(':twitter', $hotelData['twitter']);
        $this->db->bind(':instagram', $hotelData['instagram']);
        $this->db->bind(':bank_name', $hotelData['bank_name']);
        $this->db->bind(':branch', $hotelData['branch']);
        $this->db->bind(':card_holder_name', $hotelData['card_holder_name']);
        $this->db->bind(':account_number', $hotelData['account_number']);
        $this->db->bind(':additionalNotes', $hotelData['additionalNotes']);

        // Execute hotels table update
        return $this->db->execute();
    }

    public function getVerificationStatus($user_id) {
        $this->db->query('SELECT document, approval FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();

        if ($row) {
            if ($row->approval == 0 && $row->document === null) {
                return 0; // Documents not uploaded (status: 0)
            } elseif ($row->approval == 0 && $row->document !== null) {
                return 1; // Documents uploaded but not approved yet (status: 1)
            } elseif ($row->approval == 1 && $row->document !== null) {
                return 2; // Documents approved (status: 2)
            } elseif ($row->approval == 2 && $row->document !== null) {
                return 3; // Documents rejected (status: 3)
            }
        }

        return null; // Return null if user not found or unknown status
    }

    public function changePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':id', $userId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function checkRoomUsage($room_id)
    {
        // Check bookings table
        $this->db->query('SELECT * FROM bookings WHERE room_id = :room_id');
        $this->db->bind(':room_id', $room_id);
        $bookingsResult = $this->db->resultSet();

        // Check anycartbookings table
        $this->db->query('SELECT * FROM cartbookings WHERE room_id = :room_id');
        $this->db->bind(':room_id', $room_id);
        $cartBookingsResult = $this->db->resultSet();

        // If there are bookings in either table, return true indicating that the room is in use
        return (!empty($bookingsResult) || !empty($cartBookingsResult));
    }


    public function deactivateRoom($room_id)
    {
        $this->db->query('UPDATE hotel_rooms SET roomCondition = "deactivated" WHERE room_id = :room_id');
        $this->db->bind(':room_id', $room_id);

        if ($this->db->execute()) {
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
            return 0;
        }
    }

    public function getBookingsByHotel($hotel_id)
    {
        $this->db->query('SELECT b.*, u.fname, u.profile_picture,u.number, hr.roomType, hr.registration_number, p.payment_id, p.amount
                      FROM bookings b
                      JOIN users u ON b.user_id = u.id
                      LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                      LEFT JOIN payments p ON b.booking_id = p.booking_id
                      WHERE hr.hotel_id = :hotel_id 
                      AND b.bookingCondition != "cancelled"
                      AND b.startDate > CURDATE()');


        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }

    public function getCancelledBookings($hotel_id)
    {
        $this->db->query('SELECT b.*, u.fname, u.profile_picture,u.number, hr.roomType, hr.registration_number, p.payment_id, p.amount
                      FROM bookings b
                      JOIN users u ON b.user_id = u.id
                      LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                      LEFT JOIN payments p ON b.booking_id = p.booking_id
                      WHERE hr.hotel_id = :hotel_id AND b.bookingCondition ="cancelled"');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }

    public function getCompletedBookings($hotel_id)
    {
        $this->db->query('SELECT b.*, u.fname, u.profile_picture,u.number, hr.roomType, hr.registration_number, p.payment_id, p.amount
                      FROM bookings b
                      JOIN users u ON b.user_id = u.id
                      LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                      LEFT JOIN payments p ON b.booking_id = p.booking_id
                      WHERE hr.hotel_id = :hotel_id 
                      AND b.bookingCondition != "cancelled"
                      AND b.endDate < CURDATE()');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }



    public function getCartBookingsByHotel($hotel_id)
    {
        $this->db->query('SELECT cb.*, u.fname, u.profile_picture, hr.roomType, hr.registration_number, cp.amount, cp.payment_id
              FROM cartbookings cb
              JOIN users u ON cb.user_id = u.id
              LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
              LEFT JOIN cartpayments cp ON cb.booking_id = cp.booking_id AND cb.temporyid  = cp.tempory_id 
              WHERE hr.hotel_id = :hotel_id                                  
              AND cb.bookingCondition != "cancelled"
              AND cb.startDate > CURDATE()');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }

    public function getCancelledCartBookings($hotel_id)
    {
        $this->db->query('SELECT cb.*, u.fname, u.profile_picture, hr.roomType, hr.registration_number, cp.amount, cp.payment_id
              FROM cartbookings cb
              JOIN users u ON cb.user_id = u.id
              LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
              LEFT JOIN cartpayments cp ON cb.booking_id = cp.booking_id AND cb.temporyid  = cp.tempory_id 
              WHERE hr.hotel_id = :hotel_id AND cb.bookingCondition = "cancelled"');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }

    public function getCompletedCartBookings($hotel_id)
    {
        $this->db->query('SELECT cb.*, u.fname, u.profile_picture, hr.roomType, hr.registration_number, cp.amount, cp.payment_id
              FROM cartbookings cb
              JOIN users u ON cb.user_id = u.id
              LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
              LEFT JOIN cartpayments cp ON cb.booking_id = cp.booking_id AND cb.temporyid  = cp.tempory_id 
              WHERE hr.hotel_id = :hotel_id 
              AND cb.bookingCondition != "cancelled"
              AND cb.endDate < CURDATE()');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->resultSet();
    }




    public function getReviews($hotel_id)
    {
        // Prepare the SQL query
        $sql = 'SELECT r.*, u.fname AS user_fname, u.profile_picture AS user_profile_picture, 
            h.fname AS hotel_name, h.profile_picture AS hotel_profile_picture , hro.registration_number AS room_number
            FROM feedbacksnratings r
            JOIN bookings b ON r.booking_id = b.booking_id AND r.ftempory_id = b.temporyid
            JOIN users u ON r.user_id = u.id
            JOIN users h ON r.fservice_id = h.id
            LEFT JOIN hotel hr ON  r.fservice_id = hr.user_id
            LEFT JOIN hotel_rooms hro ON b.room_id = hro.room_id
            WHERE hr.hotel_id = :hotel_id';

        // Execute the query
        $this->db->query($sql);
        $this->db->bind(':hotel_id', $hotel_id);

        // Fetch and return the result set
        return $this->db->resultSet();
    }



    public function insertPdf($filename, $userId)
    {
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

    public function updateProfilePicture($userId, $filename)
    {
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

    public function getUserById($user_id)
    {
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


    public function insertRoomStatus($room_id, $startDate)
    {
        // Prepare and execute the SQL query to insert room availability
        $sql = "INSERT INTO room_availability (room_id, startDate) VALUES (:room_id, :startDate)";
        $this->db->query($sql);
        $this->db->bind(':room_id', $room_id);
        $this->db->bind(':startDate', $startDate);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Return true if the insertion was successful
        } else {
            return false; // Return false if the insertion failed
        }
    }

    public function deleteRoomStatus($room_id, $startDate)
    {
        // Prepare and execute the SQL query to delete room availability
        $sql = "DELETE FROM room_availability WHERE room_id = :room_id AND startDate = :startDate";
        $this->db->query($sql);
        $this->db->bind(':room_id', $room_id);
        $this->db->bind(':startDate', $startDate);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Return true if the deletion was successful
        } else {
            return false; // Return false if the deletion failed
        }
    }

    public function getActiveRooms($hotel_id){
        $this->db->query('SELECT * FROM hotel_rooms WHERE hotel_id = :hotel_id AND roomCondition = "activated"');
        $this->db->bind(':hotel_id', $hotel_id);
        $activeRooms = $this->db->resultSet();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $activeRooms;
        } else {
            return [];
        }
    }

    public function getUnavailableRooms($startDate)
    {
        $sql = "SELECT * FROM room_availability
                WHERE (startDate = :startDate OR endDate = :startDate) OR 
                (startDate <= :startDate AND endDate >= :startDate) ";

        $this->db->query($sql);
        $this->db->bind(':startDate', $startDate);

        // Execute the query
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            // Log or handle the exception
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function getBookingsCount($hotel_id)
    {
        $this->db->query('SELECT COUNT(b.booking_id) AS booking_count
                      FROM bookings b
                      JOIN users u ON b.user_id = u.id
                      LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                      WHERE hr.hotel_id = :hotel_id');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->single()->booking_count;
    }

    public function getGuestCount($hotel_id){
        $this->db->query('SELECT COUNT(DISTINCT b.user_id) AS user_count
                      FROM bookings b
                      JOIN users u ON b.user_id = u.id
                      LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                      WHERE hr.hotel_id = :hotel_id');

        $this->db->bind(':hotel_id', $hotel_id);

        return $this->db->single()->user_count;
    }

    public function getReviewCount($hotel_id){
        $sql = 'SELECT COUNT(*) AS review_count
            FROM `feedbacksnratings` r
            JOIN `bookings` b ON r.booking_id = b.booking_id
            JOIN `users` u ON r.user_id = u.id
            JOIN `users` h ON r.fservice_id = h.id
            LEFT JOIN `hotel` hr ON r.fservice_id = hr.user_id
            WHERE hr.hotel_id = :hotel_id';

        // Execute the query
        $this->db->query($sql);
        $this->db->bind(':hotel_id', $hotel_id);

        // Fetch the result
        $result = $this->db->single();

        // Return the review count
        return $result->review_count;

    }

    public function updateBookingStatus($booking_id)
    {
        // Prepare and execute the SQL query to update the booking status
        $sql = "UPDATE bookings SET bookingCondition = 'cancelled' WHERE booking_id = :booking_id";
        $this->db->query($sql);
        $this->db->bind(':booking_id', $booking_id);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCartBookingStatus($booking_id, $room_id)
    {
        // Prepare and execute the SQL query to update the booking status
        $sql = "UPDATE cartbookings SET bookingCondition = 'cancelled' WHERE booking_id = :booking_id AND room_id = :room_id";
        $this->db->query($sql);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':room_id', $room_id);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Return true if the update was successful
        } else {
            return false; // Return false if the update failed
        }
    }

    public function insertNotification($booking_id, $sender_id, $receiver_id, $notification_message)
    {
        // Prepare and execute the SQL query to insert notification
        $sql = "INSERT INTO notifications (booking_id, sender_id, receiver_id, notification) 
            VALUES (:booking_id, :sender_id, :receiver_id, :notification)";
        $this->db->query($sql);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $receiver_id);
        $this->db->bind(':notification', $notification_message);

        // Execute the query
        return $this->db->execute();
    }

    public function getNotifications($user_id)
    {
        // Prepare and execute the SQL query to get notifications
        $sql = "SELECT n.*, u.fname AS sender_name, u.profile_picture AS sender_profile_picture
        FROM notifications n
        JOIN users u ON n.sender_id = u.id
        WHERE n.receiver_id = :user_id AND n.markAsRead = 0
        ORDER BY n.notification_id DESC";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        // Execute the query
        return $this->db->resultSet();
    }


    public function markAsRead($notification_id) {
        $sql = "UPDATE notifications SET markAsRead = 1 WHERE notification_id = :notification_id";
        $this->db->query($sql);
        $this->db->bind(':notification_id', $notification_id);

        return $this->db->execute();
    }

    public function insertMessage(){
    }

   public function getFinalPayment($user_id){
        $this->db->query('SELECT * FROM final_payment
                             WHERE serviceProvider_id = :user_id ');

        $this->db->bind(':user_id', $user_id);
        $finalPayment = $this->db->resultSet();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $finalPayment;
        } else {
            return [];
        }
    }

    public function updateRefund($temporyid,$booking_id,$sender_id,$receiver_id,$cancelled_id,$amount,$currentDate){

        $sql = "INSERT INTO refunds (tempory_id, booking_id, serviceProvider_id,user_id,cancel_user_id,refund_amount,cancelled_date) 
                VALUES (:temporyid, :booking_id,:sender_id,:receiver_id,:cancelled_id, :amount, :currentDate)";

        $this->db->query($sql);

        $this->db->bind(':temporyid', $temporyid);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $receiver_id);
        $this->db->bind(':cancelled_id', $cancelled_id);
        $this->db->bind(':amount', $amount);
        $this->db->bind(':currentDate', $currentDate);

        // Execute the query
           return $this->db->execute();

    }

    public function updateAvailability($room_id, $startDate, $endDate){
        // Prepare the SQL query
        $sql = 'DELETE FROM room_availability 
            WHERE room_id = :room_id 
            AND startDate = :startDate 
            AND endDate = :endDate';

        // Execute the query
        $this->db->query($sql);
        $this->db->bind(':room_id', $room_id);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        // Execute the deletion
        return $this->db->execute();
    }




}
