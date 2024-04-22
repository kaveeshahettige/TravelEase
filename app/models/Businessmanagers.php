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

    public function getProfilePicture($userId){

        $this->db->query('SELECT profile_picture FROM users WHERE id = :userId');
        $this->db->bind(':userId', $_SESSION['user_id']);

        $result = $this->db->single();

        return $result;
    }


    public function getBookingsFromBookingsTable()
    {
        $this->db->query('SELECT bookings.*, 
                 users.fname AS guest_name,
                 users.profile_picture AS user_profile_picture,
                 providers.fname AS provider_name,
                 providers.type AS provider_type,
                 CASE
                     WHEN EXISTS (SELECT 1 FROM payments WHERE payments.booking_id = bookings.booking_id) THEN "Paid"
                     ELSE "Unpaid"
                 END AS payment_status
          FROM bookings 
          LEFT JOIN users ON bookings.user_id = users.id
          LEFT JOIN users AS providers ON bookings.serviceProvider_id = providers.id
          ORDER BY bookings.bookingDate DESC'); // Ordering by booking_date in descending order

        $results = $this->db->resultSet();
        return $results;
    }

    public function getBookingsFromCartBookingsTable()
    {
        $this->db->query('SELECT cartbookings.*, 
                 users.fname AS guest_name,
                 users.profile_picture AS user_profile_picture,
                 providers.fname AS provider_name,
                 providers.type AS provider_type,
                 CASE
                     WHEN EXISTS (SELECT 1 FROM cartpayments WHERE cartpayments.booking_id = cartbookings.booking_id) THEN "Paid"
                     ELSE "Unpaid"
                 END AS payment_status
          FROM cartbookings 
          LEFT JOIN users ON cartbookings.user_id = users.id
          LEFT JOIN users AS providers ON cartbookings.serviceProvider_id = providers.id
          ORDER BY cartbookings.bookingDate DESC'); // Ordering by booking_date in descending order

        $results = $this->db->resultSet();

        return $results;
    }

    public function getCombinedTransactions()
    {
        $transactionsQuery = '
    SELECT
        serviceProvider_id,
        service_provider_name,
        service_type,
        SUM(total_amount) AS total_amount,
        GROUP_CONCAT(booking_ids) AS booking_ids,
        account_number
    FROM (
        SELECT
            u.id AS serviceProvider_id,
            u.fname AS service_provider_name,
            CASE
                WHEN u.type = 3 THEN "Hotel"
                WHEN u.type = 4 THEN "Travel Agency"
                WHEN u.type = 5 THEN "Tour Guide"
                ELSE "Unknown"
            END AS service_type,
            SUM(p.amount) AS total_amount,
            GROUP_CONCAT(p.booking_id) AS booking_ids,
            CASE
                WHEN u.type = 3 THEN h.account_number
                WHEN u.type = 4 THEN t.account_number
                WHEN u.type = 5 THEN g.account_number
                ELSE NULL
            END AS account_number
        FROM payments p
        INNER JOIN bookings b ON p.booking_id = b.booking_id
        INNER JOIN users u ON b.serviceProvider_id = u.id
        LEFT JOIN hotel h ON u.type = 3 AND u.id = h.user_id
        LEFT JOIN travelagency t ON u.type = 4 AND u.id = t.user_id
        LEFT JOIN guides g ON u.type = 5 AND u.id = g.user_id
        WHERE b.bookingCondition = "completed"
        GROUP BY u.id

        UNION

        SELECT
            cb.serviceProvider_id,
            u.fname AS service_provider_name,
            CASE
                WHEN u.type = 3 THEN "Hotel"
                WHEN u.type = 4 THEN "Travel Agency"
                WHEN u.type = 5 THEN "Tour Guide"
                ELSE "Unknown"
            END AS service_type,
            SUM(
                CASE
                    WHEN u.type = 3 THEN hr.price * DATEDIFF(cb.endDate, cb.startDate)
                    WHEN u.type = 4 THEN
                        CASE
                            WHEN vb.withDriver = 1 THEN (v.priceperday + v.withDriverPerDay) * (DATEDIFF(cb.endDate, cb.startDate) + 1)
                            ELSE v.priceperday * (DATEDIFF(cb.endDate, cb.startDate) + 1)
                        END
                    WHEN u.type = 5 THEN g.pricePerDay * (DATEDIFF(cb.endDate, cb.startDate) + 1)
                    ELSE 0
                END
            ) AS total_amount,
            GROUP_CONCAT(cb.booking_id) AS booking_ids,
            CASE
                WHEN u.type = 3 THEN h.account_number
                WHEN u.type = 4 THEN t.account_number
                WHEN u.type = 5 THEN gg.account_number
                ELSE NULL
            END AS account_number
        FROM cartbookings cb
        INNER JOIN users u ON cb.serviceProvider_id = u.id
        LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
        LEFT JOIN vehicles v ON cb.vehicle_id = v.vehicle_id
        LEFT JOIN vehicle_bookings vb ON cb.booking_id = vb.booking_id
        LEFT JOIN guides g ON cb.package_id = g.guide_id
        LEFT JOIN hotel h ON u.type = 3 AND u.id = h.user_id
        LEFT JOIN travelagency t ON u.type = 4 AND u.id = t.user_id
        LEFT JOIN guides gg ON u.type = 5 AND u.id = gg.user_id
        WHERE cb.bookingCondition = "completed"
        GROUP BY cb.serviceProvider_id
    ) AS combined_results
    GROUP BY serviceProvider_id
    ORDER BY serviceProvider_id';

        $this->db->query($transactionsQuery);
        $results = $this->db->resultSet();

        return $results;
    }


//    public function getTransactionsFromPayments() {
//        $this->db->query("
//            SELECT
//                u.id AS serviceProvider_id,
//                u.fname AS service_provider_name,
//                CASE
//                    WHEN u.type = 3 THEN 'Hotel'
//                    WHEN u.type = 4 THEN 'Travel Agency'
//                    WHEN u.type = 5 THEN 'Tour Guide'
//                    ELSE 'Unknown'
//                END AS service_type,
//                SUM(p.amount) AS total_amount,
//                GROUP_CONCAT(p.booking_id) AS booking_ids,
//                CASE
//                    WHEN u.type = 3 THEN h.account_number
//                    WHEN u.type = 4 THEN t.account_number
//                    WHEN u.type = 5 THEN g.account_number
//                    ELSE NULL
//                END AS account_number
//            FROM payments p
//            INNER JOIN bookings b ON p.booking_id = b.booking_id
//            INNER JOIN users u ON b.serviceProvider_id = u.id
//            LEFT JOIN hotel h ON u.type = 3 AND u.id = h.user_id
//            LEFT JOIN travelagency t ON u.type = 4 AND u.id = t.user_id
//            LEFT JOIN guides g ON u.type = 5 AND u.id = g.user_id
//            WHERE b.bookingCondition = 'completed'
//            GROUP BY u.id
//        ");
//
//        return $this->db->resultSet();
//    }
//
//    public function getTransactionsFromCartBookings() {
//        $this->db->query("
//            SELECT
//                cb.serviceProvider_id,
//                u.fname AS service_provider_name,
//                CASE
//                    WHEN u.type = 3 THEN 'Hotel'
//                    WHEN u.type = 4 THEN 'Travel Agency'
//                    WHEN u.type = 5 THEN 'Tour Guide'
//                    ELSE 'Unknown'
//                END AS service_type,
//                SUM(
//                    CASE
//                        WHEN u.type = 3 THEN hr.price * DATEDIFF(cb.endDate, cb.startDate)
//                        WHEN u.type = 4 THEN
//                            CASE
//                                WHEN vb.withDriver = 1 THEN (v.priceperday + v.withDriverPerDay) * (DATEDIFF(cb.endDate, cb.startDate) + 1)
//                                ELSE v.priceperday * (DATEDIFF(cb.endDate, cb.startDate) + 1)
//                            END
//                        WHEN u.type = 5 THEN g.pricePerDay * (DATEDIFF(cb.endDate, cb.startDate) + 1)
//                        ELSE 0
//                    END
//                ) AS total_amount,
//                GROUP_CONCAT(cb.booking_id) AS booking_ids,
//                CASE
//                    WHEN u.type = 3 THEN h.account_number
//                    WHEN u.type = 4 THEN t.account_number
//                    WHEN u.type = 5 THEN gg.account_number
//                    ELSE NULL
//                END AS account_number
//            FROM cartbookings cb
//            INNER JOIN users u ON cb.serviceProvider_id = u.id
//            LEFT JOIN hotel_rooms hr ON cb.room_id = hr.room_id
//            LEFT JOIN vehicles v ON cb.vehicle_id = v.vehicle_id
//            LEFT JOIN vehicle_bookings vb ON cb.booking_id = vb.booking_id
//            LEFT JOIN guides g ON cb.package_id = g.guide_id
//            LEFT JOIN hotel h ON u.type = 3 AND u.id = h.user_id
//            LEFT JOIN travelagency t ON u.type = 4 AND u.id = t.user_id
//            LEFT JOIN guides gg ON u.type = 5 AND u.id = gg.user_id
//            WHERE cb.bookingCondition = 'completed'
//            GROUP BY cb.serviceProvider_id
//        ");
//
//        return $this->db->resultSet();
//    }
//
//    public function getCombinedTransactions() {
//        // Fetch transactions from payments
//        $transactionsFromPayments = $this->getTransactionsFromPayments();
//
//        // Fetch transactions from cart bookings
//        $transactionsFromCartBookings = $this->getTransactionsFromCartBookings();
//
//        // Merge transaction data from both sources
//        $combinedTransactions = array_merge($transactionsFromPayments, $transactionsFromCartBookings);
//
//        // Group transactions by serviceProvider_id
//        $groupedTransactions = [];
//        foreach ($combinedTransactions as $transaction) {
//            $serviceProviderId = $transaction->serviceProvider_id;
//            if (!isset($groupedTransactions[$serviceProviderId])) {
//                $groupedTransactions[$serviceProviderId] = [
//                    'serviceProvider_id' => $serviceProviderId,
//                    'service_provider_name' => $transaction->service_provider_name,
//                    'service_type' => $transaction->service_type,
//                    'total_amount' => 0,
//                    'booking_ids' => [],
//                    'account_number' => $transaction->account_number
//                ];
//            }
//
//            $groupedTransactions[$serviceProviderId]['total_amount'] += $transaction->total_amount;
//            $groupedTransactions[$serviceProviderId]['booking_ids'][] = $transaction->booking_ids;
//        }
//
//        // Convert grouped transactions array to indexed array
//        $finalTransactions = array_values($groupedTransactions);
//
//        return $finalTransactions;
//    }

    public function getBookingDetails($serviceProvider_id)
    {
        // Fetch user type and service provider name based on the serviceProvider_id
        $this->db->query('
        SELECT u.type, u.fname AS serviceProvider_name
        FROM users u
        WHERE id = :serviceProvider_id
    ');
        $this->db->bind(':serviceProvider_id', $serviceProvider_id);
        $userData = $this->db->single();

        // Check if the user data is retrieved
        if (!$userData) {
            return []; // Return empty array if user data is not found
        }

        // Access the 'type' and 'serviceProvider_name' properties of the stdClass object
        $userType = $userData->type;
        $serviceProviderName = $userData->serviceProvider_name;

        // Use the retrieved user type and service provider name in the main query
        $this->db->query('
        SELECT 
            CAST("Booking" AS CHAR) AS booking_type,
            CAST(u.fname AS CHAR) AS traveler_name,
            CAST(b.bookingDate AS CHAR) AS booking_date,
            CAST(b.startDate AS CHAR) AS checkin_date,
            CAST(b.endDate AS CHAR) AS checkout_date,
            CASE 
                WHEN :userType = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                WHEN :userType = 4 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number)
                WHEN :userType = 5 THEN "Package Details"
                ELSE "Unknown"
            END AS service_detail,
            CAST(p.amount AS DECIMAL(10,2)) AS amount,
            :serviceProviderName AS service_provider_name
        FROM 
            bookings b
        INNER JOIN 
            users u ON b.user_id = u.id         
        LEFT JOIN 
            payments p ON b.booking_id = p.booking_id
        LEFT JOIN 
            hotel_rooms hr ON b.room_id = hr.room_id AND :userType = 3
        LEFT JOIN 
            vehicles v ON b.vehicle_id = v.vehicle_id AND :userType = 4
        WHERE 
            b.serviceProvider_id = :serviceProvider_id
            AND b.bookingCondition = "completed" -- Added condition here
        UNION ALL
        SELECT 
            CAST("CartBooking" AS CHAR) AS booking_type,
            CAST(u.fname AS CHAR) AS traveler_name,
            CAST(cb.bookingDate AS CHAR) AS booking_date,
            CAST(cb.startDate AS CHAR) AS checkin_date,
            CAST(cb.endDate AS CHAR) AS checkout_date,
            CASE 
                WHEN :userType = 3 THEN CONCAT("Room Type: ", hr.roomType, ", Registration Number: ", hr.registration_number)
                WHEN :userType = 4 THEN 
                    CASE
                        WHEN vb.withDriver = 1 THEN CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", With Driver")
                        ELSE CONCAT("Model: ", v.model, ", Brand: ", v.brand, ", Plate Number: ", v.plate_number, ", Without Driver")
                    END
                WHEN :userType = 5 THEN "Package Details"
                ELSE "Unknown"
            END AS service_detail,
            CAST(
                CASE
                    WHEN :userType = 3 THEN hr.price * DATEDIFF(cb.endDate, cb.startDate)
                    WHEN :userType = 4 THEN 
                        CASE
                            WHEN vb.withDriver = 1 THEN (v.priceperday + v.withDriverPerDay) * (DATEDIFF(cb.endDate, cb.startDate) + 1)
                            ELSE v.priceperday * (DATEDIFF(cb.endDate, cb.startDate) + 1)
                        END
                    WHEN :userType = 5 THEN g.pricePerDay * (DATEDIFF(cb.endDate, cb.startDate) + 1)
                    ELSE 0
                END AS DECIMAL(10,2)
            ) AS amount,
            :serviceProviderName AS service_provider_name
        FROM 
            cartbookings cb
        INNER JOIN 
            users u ON cb.user_id = u.id      
        LEFT JOIN 
            cartpayments cp ON cb.booking_id = cp.booking_id        
        LEFT JOIN 
            hotel_rooms hr ON cb.room_id = hr.room_id 
        LEFT JOIN 
            vehicles v ON cb.vehicle_id = v.vehicle_id 
        LEFT JOIN 
            guides g ON cb.package_id = g.guide_id 
        LEFT JOIN 
            vehicle_bookings vb ON cb.booking_id = vb.booking_id 
        WHERE 
            cb.serviceProvider_id = :serviceProvider_id
            AND cb.bookingCondition = "completed" -- Added condition here
    ');

        $this->db->bind(':serviceProvider_id', $serviceProvider_id);
        $this->db->bind(':userType', $userType);
        $this->db->bind(':serviceProviderName', $serviceProviderName);

        $results = $this->db->resultSet();

        return $results;
    }


    public function insertFinalPayment($serviceProvider_id, $paidDate, $paidAmount, $file_path) {
        $query = 'INSERT INTO final_payment (serviceProvider_id, paidDate, paidAmount, invoice) 
              VALUES (:serviceProvider_id, :paidDate, :paidAmount, :file_path)';

        $this->db->query($query);
        $this->db->bind(':serviceProvider_id', $serviceProvider_id);
        $this->db->bind(':paidDate', $paidDate);
        $this->db->bind(':paidAmount', $paidAmount);
        $this->db->bind(':file_path', $file_path);

        $this->db->execute();
    }

    public function updateBookingCondition($serviceProvider_id) {
        $query = 'UPDATE bookings SET bookingCondition = "Paid" 
                  WHERE serviceProvider_id = :serviceProvider_id AND bookingCondition = "completed"';

        $this->db->query($query);
        $this->db->bind(':serviceProvider_id', $serviceProvider_id);

        $this->db->execute();

    }

    public function updateCartBookingCondition($serviceProvider_id) {
        $query = 'UPDATE cartbookings SET bookingCondition = "Paid" 
              WHERE serviceProvider_id = :serviceProvider_id AND bookingCondition = "completed"';

        $this->db->query($query);
        $this->db->bind(':serviceProvider_id', $serviceProvider_id);

        $this->db->execute();
    }





    public function insertInvoice($service_provider_id, $total_amount, $final_amount, $invoice_date, $file_path) {
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

    public function getBookingCount(){

        $this->db->query('SELECT COUNT(*) AS booking_count FROM bookings');
        $result = $this->db->single();
        return $result;
    }


    public function getCartBookingCount(){

        $this->db->query('SELECT COUNT(*) AS cart_booking_count FROM cartbookings');
        $result = $this->db->single();
        return $result;
    }

}