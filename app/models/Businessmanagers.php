<?php

class Businessmanagers
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getBookings()
    {
        $this->db->query('SELECT bookings.*, 
                             user1.fname AS user_fname, 
                             user1.type AS user_type, 
                             user1.profile_picture AS user_profile_picture, 
                             user2.fname AS provider_fname, 
                             user2.type AS provider_type, 
                             payments.payment_id 
                      FROM bookings 
                      JOIN users AS user1 ON bookings.user_id = user1.id 
                      JOIN users AS user2 ON bookings.serviceProvider_id = user2.id 
                      JOIN payments ON bookings.booking_id = payments.booking_id');
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