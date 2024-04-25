<?php

class Businessmanagers
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
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

    public function getProfilePicture($userId)
    {

        $this->db->query('SELECT profile_picture FROM users WHERE id = :userId');
        $this->db->bind(':userId', $_SESSION['user_id']);

        $result = $this->db->single();

        return $result;
    }

    public function updateSettings($userData)
    {
        // Update users table
        $this->db->query('UPDATE users SET 
        fname = :name, 
        lname = :last_name,
        email = :email, 
        number = :phone_number       
        WHERE id = :user_id');

        // Bind values for users table
        $this->db->bind(':user_id', $userData['user_id']);
        $this->db->bind(':name', $userData['name']);
        $this->db->bind(':last_name', $userData['last_name']);
        $this->db->bind(':email', $userData['email']);
        $this->db->bind(':phone_number', $userData['phone_number']);

        // Execute users table update
        $this->db->execute();
    }


    public function getBookingsFromBookingsTable()
    {
        $this->db->query('SELECT b.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            p.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number)
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM bookings b
                        LEFT JOIN users u ON b.user_id = u.id
                        LEFT JOIN users u2 ON b.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                        LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON b.package_id = g.guide_id
                        LEFT JOIN payments p ON b.booking_id = p.booking_id                   
                        WHERE b.bookingCondition != "cancelled"
                        AND b.endDate >= CURDATE()');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getRejectedBookings()
    {
        $this->db->query('SELECT b.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            p.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number)
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM bookings b
                        LEFT JOIN users u ON b.user_id = u.id
                        LEFT JOIN users u2 ON b.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                        LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON b.package_id = g.guide_id
                        LEFT JOIN payments p ON b.booking_id = p.booking_id                   
                        WHERE b.bookingCondition = "cancelled"');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getCompletedBookings()
    {
        $this->db->query('SELECT b.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            p.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number)
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM bookings b
                        LEFT JOIN users u ON b.user_id = u.id
                        LEFT JOIN users u2 ON b.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                        LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON b.package_id = g.guide_id
                        LEFT JOIN payments p ON b.booking_id = p.booking_id                   
                        WHERE b.bookingCondition != "cancelled"
                        AND b.endDate < CURDATE()');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getBookingsFromCartBookingsTable()
    {
        $this->db->query('SELECT cb.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            cp.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN 
                                        CASE
                                            WHEN vb.withDriver = 1 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", With Driver")
                                            ELSE CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", Without Driver")
                                        END
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM cartbookings cb
                        LEFT JOIN users u ON cb.user_id = u.id
                        LEFT JOIN users u2 ON cb.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
                        LEFT JOIN vehicles v ON cb.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON cb.package_id = g.guide_id
                        LEFT JOIN cartpayments cp ON cb.booking_id = cp.booking_id   
                        LEFT JOIN vehicle_bookings vb ON cb.booking_id = vb.booking_id
                        WHERE cb.bookingCondition != "cancelled"
                        AND cb.endDate >= CURDATE()');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getRejectedCartBookings()
    {
        $this->db->query('SELECT cb.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            cp.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN 
                                        CASE
                                            WHEN vb.withDriver = 1 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", With Driver")
                                            ELSE CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", Without Driver")
                                        END
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM cartbookings cb
                        LEFT JOIN users u ON cb.user_id = u.id
                        LEFT JOIN users u2 ON cb.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
                        LEFT JOIN vehicles v ON cb.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON cb.package_id = g.guide_id
                        LEFT JOIN cartpayments cp ON cb.booking_id = cp.booking_id   
                        LEFT JOIN vehicle_bookings vb ON cb.booking_id = vb.booking_id
                        WHERE cb.bookingCondition = "cancelled"');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getCompletedCartBookings()
    {
        $this->db->query('SELECT cb.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            cp.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN 
                                        CASE
                                            WHEN vb.withDriver = 1 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", With Driver")
                                            ELSE CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", Without Driver")
                                        END
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM cartbookings cb
                        LEFT JOIN users u ON cb.user_id = u.id
                        LEFT JOIN users u2 ON cb.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
                        LEFT JOIN vehicles v ON cb.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON cb.package_id = g.guide_id
                        LEFT JOIN cartpayments cp ON cb.booking_id = cp.booking_id   
                        LEFT JOIN vehicle_bookings vb ON cb.booking_id = vb.booking_id
                        WHERE cb.bookingCondition != "cancelled"
                        AND cb.endDate < CURDATE()');

        $results = $this->db->resultSet();

        return $results;
    }

    public function insertFinalPayment($serviceProvider_id, $paidDate, $paidAmount,$income, $file_path)
    {
        $query = 'INSERT INTO final_payment (serviceProvider_id, paidDate, paidAmount,income,invoice) 
              VALUES (:serviceProvider_id, :paidDate, :paidAmount,:income, :file_path)';

        $this->db->query($query);
        $this->db->bind(':serviceProvider_id', $serviceProvider_id);
        $this->db->bind(':paidDate', $paidDate);
        $this->db->bind(':paidAmount', $paidAmount);
        $this->db->bind(':income', $income);
        $this->db->bind(':file_path', $file_path);

        $this->db->execute();
    }

    public function updateBookingCondition($serviceProvider_id)
    {
        $query = 'UPDATE bookings SET bookingCondition = "Paid" 
                  WHERE serviceProvider_id = :serviceProvider_id 
                  AND bookings.bookingCondition != "cancelled" AND bookings.bookingCondition != "Paid"
                  AND bookings.endDate < CURDATE()';

        $this->db->query($query);
        $this->db->bind(':serviceProvider_id', $serviceProvider_id);

        $this->db->execute();

    }

    public function updateCartBookingCondition($serviceProvider_id)
    {
        $query = 'UPDATE cartbookings SET bookingCondition = "Paid" 
                  WHERE serviceProvider_id = :serviceProvider_id 
                  AND cartbookings.bookingCondition != "cancelled" AND cartbookings.bookingCondition != "Paid"
                  AND cartbookings.endDate < CURDATE()';

        $this->db->query($query);
        $this->db->bind(':serviceProvider_id', $serviceProvider_id);

        $this->db->execute();
    }


    public function insertInvoice($service_provider_id, $total_amount, $final_amount, $invoice_date, $file_path)
    {
        $query = 'INSERT INTO invoices (service_provider_id, total_amount, final_amount, invoice_date, file_path) 
              VALUES (:service_provider_id, :total_amount, :final_amount, :invoice_date, :file_path)';

        $this->db->query($query);
        $this->db->bind(':service_provider_id', $service_provider_id);
        $this->db->bind(':total_amount', $total_amount);
        $this->db->bind(':final_amount', $final_amount);
        $this->db->bind(':invoice_date', $invoice_date);
        $this->db->bind(':file_path', $file_path);

        $this->db->execute();
    }

    public function getBookingCount()
    {

        $this->db->query('SELECT COUNT(*) AS booking_count FROM bookings');
        $result = $this->db->single();
        return $result;
    }


    public function getCartBookingCount()
    {

        $this->db->query('SELECT COUNT(*) AS cart_booking_count FROM cartbookings');
        $result = $this->db->single();
        return $result;
    }

    public function getBookingFinancialDetails()
    {
        $this->db->query('
        SELECT 
            b.*, 
            p.amount AS payment_amount, 
            p.payment_date,
            u.fname AS serviceprovider_name,
            u.profile_picture AS profile_picture,
            CASE 
                WHEN u.type = 3 THEN h.account_number
                WHEN u.type = 4 THEN t.account_number
                WHEN u.type = 5 THEN g.account_number
                ELSE "Unknown"
            END AS account_number,
            CASE
                WHEN u.type = 3 THEN "Hotel"
                WHEN u.type = 4 THEN "Travel Agency"
                WHEN u.type = 5 THEN "Tour Guide"
                ELSE "Unknown"
            END AS service_type
        FROM 
            bookings b
        JOIN payments p ON b.booking_id = p.booking_id
        JOIN users u ON b.serviceProvider_id = u.id   
        LEFT JOIN hotel h ON u.type = 3 AND u.id = h.user_id
        LEFT JOIN travelagency t ON u.type = 4 AND u.id = t.user_id
        LEFT JOIN guides g ON u.type = 5 AND u.id = g.user_id 
        WHERE 
         b.bookingCondition != "cancelled" AND b.bookingCondition != "Paid"
         AND b.endDate < CURDATE()
        ORDER BY 
            b.bookingDate DESC;
    '); // Ordering by booking_date in descending order

        $results = $this->db->resultSet();

        return $results;
    }


    public function getCartBookingFinancialDetails()
    {
        $this->db->query('
        SELECT 
            cb.*, 
            cp.amount AS payment_amount, 
            cp.payment_date,
            u.fname AS serviceprovider_name,
            u.profile_picture AS profile_picture,
            CASE 
                WHEN u.type = 3 THEN h.account_number
                WHEN u.type = 4 THEN t.account_number
                WHEN u.type = 5 THEN g.account_number
                ELSE "Unknown"
            END AS account_number,
            CASE
                WHEN u.type = 3 THEN "Hotel"
                WHEN u.type = 4 THEN "Travel Agency"
                WHEN u.type = 5 THEN "Tour Guide"
                ELSE "Unknown"
            END AS service_type
        FROM 
            cartbookings cb
        JOIN cartpayments cp ON cb.booking_id = cp.booking_id AND cb.temporyid = cp.tempory_id
        JOIN users u ON cb.serviceProvider_id = u.id
        LEFT JOIN hotel h ON u.type = 3 AND u.id = h.user_id
        LEFT JOIN travelagency t ON u.type = 4 AND u.id = t.user_id
        LEFT JOIN guides g ON u.type = 5 AND u.id = g.user_id
        WHERE 
            cb.bookingCondition != "cancelled" AND cb.bookingCondition != "Paid"
            AND cb.endDate < CURDATE()
        ORDER BY 
            cb.bookingDate DESC
    '); // Ordering by booking_date in descending order

        $results = $this->db->resultSet();

        return $results;
    }


    public function getRefunds()
    {
        $sql = 'SELECT refunds.*, 
            users_user.fname AS user_fname, 
            providers_user.fname AS provider_fname,
            cancel_users.fname AS cancel_user_fname
            FROM refunds
            LEFT JOIN users AS users_user ON refunds.user_id = users_user.id
            LEFT JOIN users AS providers_user ON refunds.serviceProvider_id = providers_user.id
            LEFT JOIN users AS cancel_users ON refunds.cancel_user_id = cancel_users.id
            WHERE refunds.refund_status = "0"';


        $this->db->query($sql);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getCompletedRefunds()
    {
        $sql = 'SELECT refunds.*, 
            users_user.fname AS user_fname, 
            providers_user.fname AS provider_fname,
            cancel_users.fname AS cancel_user_fname
            FROM refunds
            LEFT JOIN users AS users_user ON refunds.user_id = users_user.id
            LEFT JOIN users AS providers_user ON refunds.serviceProvider_id = providers_user.id
            LEFT JOIN users AS cancel_users ON refunds.cancel_user_id = cancel_users.id
            WHERE refunds.refund_status = "1"';


        $this->db->query($sql);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getBookingDetails($serviceProvider_id){
        $this->db->query('SELECT "Booking" AS booking_type, b.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            p.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number)
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM bookings b
                        LEFT JOIN users u ON b.user_id = u.id
                        LEFT JOIN users u2 ON b.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON b.room_id = hr.room_id
                        LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON b.package_id = g.guide_id
                        LEFT JOIN payments p ON b.booking_id = p.booking_id                   
                        WHERE b.serviceProvider_id = :serviceProvider_id 
                        AND b.bookingCondition != "cancelled" AND b.bookingCondition != "Paid"
                        AND b.endDate < CURDATE()');

        $this->db->bind(':serviceProvider_id', $serviceProvider_id);

        $results = $this->db->resultSet();

        return $results;

    }

    public function getCartBookingDetails($serviceProvider_id){
        $this->db->query('SELECT "CartBooking" AS booking_type, cb.*, u.fname AS traveler_name, u2.fname AS serviceprovider_name, 
                            CASE 
                                WHEN u2.type = 3 THEN "Hotel"
                                WHEN u2.type = 4 THEN "Travel Agency"
                                WHEN u2.type = 5 THEN "Tour Guide"
                                ELSE "Unknown"
                            END AS service_type,
                            cp.amount AS payment_amount,
                            CONCAT(
                                CASE
                                    WHEN u2.type = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                                    WHEN u2.type = 4 THEN 
                                        CASE
                                            WHEN vb.withDriver = 1 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", With Driver")
                                            ELSE CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", Without Driver")
                                        END
                                    WHEN u2.type = 5 THEN "Package Details"
                                    ELSE "Unknown"
                                END
                            ) AS service_detail
                        FROM cartbookings cb
                        LEFT JOIN users u ON cb.user_id = u.id
                        LEFT JOIN users u2 ON cb.serviceProvider_id = u2.id
                        LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
                        LEFT JOIN vehicles v ON cb.vehicle_id = v.vehicle_id
                        LEFT JOIN guides g ON cb.package_id = g.guide_id
                        LEFT JOIN cartpayments cp ON cb.booking_id = cp.booking_id   
                        LEFT JOIN vehicle_bookings vb ON cb.booking_id = vb.booking_id
                        WHERE cb.serviceProvider_id = :serviceProvider_id 
                        AND cb.bookingCondition != "cancelled" AND cb.bookingCondition != "Paid"
                        AND cb.endDate < CURDATE()');

        $this->db->bind(':serviceProvider_id', $serviceProvider_id);

        $results = $this->db->resultSet();

        return $results;
    }

    public function getNotifications($reciever_id)
    {
        // Prepare and execute the SQL query to get notifications
        $sql = "SELECT n.*, u.fname AS sender_name, u.profile_picture AS sender_profile_picture
        FROM notifications n
        JOIN users u ON n.sender_id = u.id
        WHERE n.receiver_id = :reciever_id AND n.markAsRead = 0
        ORDER BY n.notification_id DESC";
        $this->db->query($sql);
        $this->db->bind(':reciever_id', $reciever_id);

        // Execute the query
        return $this->db->resultSet();
    }


    public function markAsRead($notification_id) {
        $sql = "UPDATE notifications SET markAsRead = 1 WHERE notification_id = :notification_id";
        $this->db->query($sql);
        $this->db->bind(':notification_id', $notification_id);

        return $this->db->execute();
    }

    public function confirmRefund($refund_id, $booking_id, $refund_date)
    {
        $sql = "UPDATE refunds SET refund_status = 1, refund_date = :refund_date 
            WHERE refund_id = :refund_id AND booking_id = :booking_id";
        $this->db->query($sql);
        $this->db->bind(':refund_id', $refund_id);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':refund_date', $refund_date);

        return $this->db->execute();
    }

    public function InsertNotification($sender_id, $businessmanagerID, $notification_message)
    {
        // Prepare and execute the SQL query to insert notification
        $sql = "INSERT INTO notifications (sender_id, receiver_id, notification) 
            VALUES (:sender_id, :receiver_id, :notification)";
        $this->db->query($sql);
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $businessmanagerID); // Replace $receiver_id with $businessmanagerID
        $this->db->bind(':notification', $notification_message);

        // Execute the query
        return $this->db->execute();
    }

    // Model method to get bookings count
    public function getBookingsCount()
    {
        $this->db->query('SELECT COUNT(*) AS booking_count
                      FROM bookings
                      WHERE bookingCondition != "cancelled"');

        return $this->db->single()->booking_count;
    }

// Model method to get cart bookings count
    public function getCartCount()
    {
        $this->db->query('SELECT COUNT(*) AS cart_count
                      FROM cartbookings
                      WHERE bookingCondition != "cancelled"');

        return $this->db->single()->cart_count;
    }

    public function getOngoingBookingsCount()
    {
        $this->db->query('SELECT COUNT(*) AS booking_count
                      FROM bookings
                      WHERE bookingCondition != "cancelled"  AND startDate > CURDATE()');

        return $this->db->single()->booking_count;
    }


    public function getOngoingCartCount()
    {
        $this->db->query('SELECT COUNT(*) AS cart_count
                      FROM cartbookings
                      WHERE bookingCondition != "cancelled"  AND startDate > CURDATE()');

        return $this->db->single()->cart_count;
    }

    public function getGuestCount()
    {
        $this->db->query('SELECT COUNT(DISTINCT b.user_id) AS user_count
                      FROM bookings b
                      WHERE b.bookingCondition != "cancelled"');

        return $this->db->single()->user_count;
    }

    public function getCartGuestCount()
    {
        $this->db->query('SELECT COUNT(DISTINCT cb.user_id) AS user_count
                      FROM cartbookings cb
                      WHERE cb.bookingCondition != "cancelled"');

        return $this->db->single()->user_count;
    }

    public function basicInfo($user_id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function getBookingReportData($startDate, $endDate){
        $this->db->query('SELECT u.fname AS service_name, 
                            CASE u.type 
                                WHEN 3 THEN "Hotel" 
                                WHEN 4 THEN "Transport Provider" 
                                WHEN 5 THEN "Tour Guide" 
                                ELSE "Unknown" 
                            END AS service_type,
                            p.amount AS total_revenue
                      FROM bookings b
                      JOIN payments p ON b.booking_id = p.booking_id
                      JOIN users u ON b.serviceProvider_id = u.id
                      WHERE b.bookingCondition != "cancelled" 
                      AND b.endDate < CURDATE()
                      AND b.startDate >= :startDate 
                      AND b.endDate <= :endDate');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->resultSet();
    }

    public function getCartBookingReportData($startDate, $endDate){
        $this->db->query('SELECT u.fname AS service_name, 
                            CASE u.type 
                                WHEN 3 THEN "Hotel" 
                                WHEN 4 THEN "Transport Provider" 
                                WHEN 5 THEN "Tour Guide" 
                                ELSE "Unknown" 
                            END AS service_type,
                            cp.amount AS total_revenue
                      FROM cartbookings cb
                      JOIN cartpayments cp ON cb.booking_id = cp.booking_id
                      JOIN users u ON cb.serviceProvider_id = u.id
                      WHERE cb.bookingCondition != "cancelled" 
                      AND cb.endDate < CURDATE()
                      AND cb.startDate >= :startDate 
                      AND cb.endDate <= :endDate ');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->resultSet();
    }


    public function getGuestReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS booking_count, u.fname AS Guest_Name,u.id as User_ID
              FROM bookings b
              LEFT JOIN users u ON b.user_id = u.id
              WHERE b.bookingCondition != "cancelled" 
              AND b.endDate < CURDATE()
              AND b.startDate >= :startDate 
              AND b.endDate <= :endDate 
              GROUP BY b.user_id
              ORDER BY booking_count DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->resultSet();
    }

    public function getCartGuestReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS booking_count, u.fname AS Guest_Name,u.id as User_ID
              FROM cartbookings cb
              LEFT JOIN users u ON cb.user_id = u.id
              WHERE cb.bookingCondition != "cancelled" 
              AND cb.endDate < CURDATE()
              AND cb.startDate >= :startDate 
              AND cb.endDate <= :endDate 
              GROUP BY cb.user_id
              ORDER BY booking_count DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->resultSet();
    }


    public function getBookingHotelReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS hotel_count, u.fname AS hotel_name,,u.id as User_ID
                      FROM bookings b
                      LEFT JOIN users u ON b.serviceProvider_id = u.id
                      WHERE b.bookingCondition != "cancelled" 
                      AND b.endDate < CURDATE()
                      AND b.bookingDate BETWEEN :startDate AND :endDate
                      AND b.serviceProvider_id IN (SELECT id FROM users WHERE type = 3)
                      ORDER BY COUNT(*) DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->single();
    }

    public function getCartHotelReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS hotel_count, u.fname AS hotel_name
                      FROM cartbookings cb
                      LEFT JOIN users u ON cb.serviceProvider_id = u.id
                      WHERE cb.bookingCondition != "cancelled" 
                      AND cb.endDate < CURDATE()
                      AND cb.bookingDate BETWEEN :startDate AND :endDate
                      AND cb.serviceProvider_id IN (SELECT id FROM users WHERE type = 3)
                      ORDER BY COUNT(*) DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->single();
    }

    public function getBookingTransportReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS travel_agency_count, u.fname AS travel_agency_name
                      FROM bookings b
                      LEFT JOIN users u ON b.serviceProvider_id = u.id
                      WHERE b.bookingCondition != "cancelled" 
                      AND b.endDate < CURDATE()
                      AND b.bookingDate BETWEEN :startDate AND :endDate
                      AND b.serviceProvider_id IN (SELECT id FROM users WHERE type = 4)
                      ORDER BY COUNT(*) DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->single();
    }

    public function getCartTransportReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS travel_agency_count, u.fname AS travel_agency_name
                      FROM cartbookings cb
                      LEFT JOIN users u ON cb.serviceProvider_id = u.id
                      WHERE cb.bookingCondition != "cancelled" 
                      AND cb.endDate < CURDATE()
                      AND cb.bookingDate BETWEEN :startDate AND :endDate
                      AND cb.serviceProvider_id IN (SELECT id FROM users WHERE type = 4)
                      ORDER BY COUNT(*) DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->single();
    }

    public function getBookingGuideReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS guide_count, u.fname AS guide_name
                      FROM bookings b
                      LEFT JOIN users u ON b.serviceProvider_id = u.id
                      WHERE b.bookingCondition != "cancelled" 
                      AND b.endDate < CURDATE()
                      AND b.bookingDate BETWEEN :startDate AND :endDate
                      AND b.serviceProvider_id IN (SELECT id FROM users WHERE type = 5)
                      ORDER BY COUNT(*) DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->single();
    }

    public function getCartGuideReportData($startDate, $endDate){
        $this->db->query('SELECT COUNT(*) AS guide_count, u.fname AS guide_name
                      FROM cartbookings cb
                      LEFT JOIN users u ON cb.serviceProvider_id = u.id
                      WHERE cb.bookingCondition != "cancelled" 
                      AND cb.endDate < CURDATE()
                      AND cb.bookingDate BETWEEN :startDate AND :endDate
                      AND cb.serviceProvider_id IN (SELECT id FROM users WHERE type = 5)
                      ORDER BY COUNT(*) DESC');

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);

        return $this->db->single();
    }


}