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





    public function getPackages()
    {
        $this->db->query('SELECT * FROM packages');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTransactions()
    {
        $this->db->query('SELECT p.*, 
                            u.fname AS service_provider_name, 
                            u.profile_picture, 
                            u.bank_account_no AS account_number, 
                            b.endDate AS date,
                            CASE 
                                WHEN fp.payment_id IS NOT NULL THEN "Paid"
                                ELSE "Pending"
                            END AS payment_status
                     FROM payments p
                     INNER JOIN bookings b ON p.booking_id = b.booking_id
                     INNER JOIN users u ON b.serviceProvider_id = u.id
                     LEFT JOIN final_payment fp ON p.payment_id = fp.payment_id');
        $results = $this->db->resultSet();
        return $results;
    }

    public function generateReport($serviceType, $reportType, $startDate, $endDate)
    {
        $bookingsReport = $this->getBookingsReport($serviceType, $startDate, $endDate);
        $transactionsReport = $this->getTransactionsReport($serviceType, $startDate, $endDate);
        $reportData = array_merge($bookingsReport, $transactionsReport);
        return $reportData;
    }

    private function getBookingsReport($serviceType, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM bookings 
                      WHERE service_type = :serviceType 
                      AND date BETWEEN :startDate AND :endDate');
        $this->db->bind(':serviceType', $serviceType);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }

    private function getTransactionsReport($serviceType, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM transactions 
                      WHERE service_type = :serviceType 
                      AND date BETWEEN :startDate AND :endDate');
        $this->db->bind(':serviceType', $serviceType);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }






}