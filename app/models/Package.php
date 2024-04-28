<?php
class Package{
    private $db;

    public function __construct(){
        $this->db =new Database;
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

    public function insertStatus($user_id,$startDate){

        $sql = "INSERT into guide_availability (user_id,startDate,endDate) VALUES (:user_id,:startDate,:startDate)";
        $this->db->query($sql);
        $this->db->bind(':user_id',$user_id);
        $this->db->bind(':startDate',$startDate);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteStatus($user_id, $startDate)
    {
        $sql = "DELETE FROM guide_availability WHERE user_id = :user_id AND startDate = :startDate";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':startDate', $startDate);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Return true if the deletion was successful
        } else {
            return false; // Return false if the deletion failed
        }
    }

    public function getAvailability($user_id, $startDate) {
        $sql = "SELECT * FROM guide_availability 
            WHERE user_id = :user_id 
            AND (:startDate = startDate OR :startDate = endDate)
            OR (:startDate >= startDate AND :startDate <= endDate)";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':startDate', $startDate);

        $this->db->execute();
        $rowCount = $this->db->rowCount();

        return $rowCount > 0;
    }


    public function getUserInfo($user_id)
    {
        $sql = "SELECT * FROM users WHERE id = :user_id";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        $this->db->execute();

        return $this->db->single();
    }



    public function getBookings($user_id){
        $sql = "SELECT b.*, u.fname, u.profile_picture, g.meetTime, p.amount
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            LEFT JOIN guide_bookings g ON b.booking_id = g.booking_id
            LEFT JOIN payments p ON b.booking_id = p.booking_id
            WHERE b.package_id = :user_id
            AND b.endDate >= CURDATE()
            AND b.bookingCondition != 'cancelled'
            ";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }

    public function getCancelledBookings($user_id){
        $sql = "SELECT b.*, u.fname, u.profile_picture, g.meetTime
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            LEFT JOIN guide_bookings g ON b.booking_id = g.booking_id
            WHERE b.package_id = :user_id
            AND b.bookingCondition = 'cancelled'
            ";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }

    public function getCompleteBookings($user_id){
        $sql = "SELECT b.*, u.fname, u.profile_picture, g.meetTime
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            LEFT JOIN guide_bookings g ON b.booking_id = g.booking_id
            WHERE b.package_id = :user_id
            AND b.endDate < CURDATE()
            AND b.bookingCondition != 'cancelled'
            ";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }


    public function getCartBookings($user_id){
        $sql = "SELECT cb.*, u.fname, u.profile_picture, g.meetTime, p.amount
            FROM cartbookings cb
            JOIN users u ON cb.user_id = u.id
            LEFT JOIN guide_bookings g ON cb.booking_id = g.booking_id
            LEFT JOIN cartpayments p ON cb.booking_id = p.booking_id AND cb.temporyid = p.tempory_id
            WHERE cb.package_id = :user_id
            AND cb.endDate >= CURDATE()
            AND cb.bookingCondition = 'cancelled'";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }

    public function getCancelledCartBookings($user_id){
        $sql = "SELECT cb.*, u.fname, u.profile_picture, g.meetTime
            FROM cartbookings cb
            JOIN users u ON cb.user_id = u.id
            LEFT JOIN guide_bookings g ON cb.booking_id = g.booking_id
            WHERE cb.package_id = :user_id
            AND cb.bookingCondition = 'cancelled'";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }

    public function getCompleteCartBookings($user_id){
        $sql = "SELECT cb.*, u.fname, u.profile_picture, g.meetTime
            FROM cartbookings cb
            JOIN users u ON cb.user_id = u.id
            LEFT JOIN guide_bookings g ON cb.booking_id = g.booking_id
            WHERE cb.package_id = :user_id
            AND cb.endDate < CURDATE()
            AND cb.bookingCondition != 'cancelled'";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }



    public function getReviews($user_id){
        $sql = "SELECT r.*, u.fname, u.profile_picture
            FROM feedbacksnratings r
            JOIN users u ON r.user_id = u.id
            WHERE r.fservice_id = :user_id";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }


    public function updateGuideDetails($guideData)
    {
        // Convert languages to a comma-separated string
        $languages = implode(', ', $guideData['languages']);

        // Update guide table
        $this->db->query('UPDATE guides SET 
        description = :description,
        address = :address,
        city = :city,
        province = :province,
        facebook = :facebook,
        instagram = :instagram,
        pricePerDay = :pricePerDay,
        category = :category,
        languages = :languages,
        GuideRegNumber = :GuideRegNumber,
        LisenceExpDate = :LisenceExpDate,
        sites = :sites
        WHERE user_id = :user_id');

        // Bind values for guide table
        $this->db->bind(':user_id', $guideData['user_id']);
        $this->db->bind(':description', $guideData['description']);
        $this->db->bind(':address', $guideData['address']);
        $this->db->bind(':city', $guideData['city']);
        $this->db->bind(':province', $guideData['province']);
        $this->db->bind(':facebook', $guideData['facebook']);
        $this->db->bind(':instagram', $guideData['instagram']);
        $this->db->bind(':pricePerDay', $guideData['pricePerDay']);
        $this->db->bind(':category', $guideData['category']);
        $this->db->bind(':languages', $languages);
        $this->db->bind(':GuideRegNumber', $guideData['GuideRegNumber']);
        $this->db->bind(':LisenceExpDate', $guideData['LisenceExpDate']);
        $this->db->bind(':sites', $guideData['sites']);

        // Execute guide table update
        return $this->db->execute();
    }

    public function getGuideDetails($user_id)
    {
        $this->db->query('SELECT * FROM guides WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);

        return $this->db->single();
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

    public function updateCartBookingStatus($booking_id, $package_id)
    {
        // Prepare and execute the SQL query to update the booking status
        $sql = "UPDATE cartbookings SET bookingCondition = 'cancelled' WHERE booking_id = :booking_id AND package_id = :package_id";
        $this->db->query($sql);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':package_id', $package_id);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Return true if the update was successful
        } else {
            return false; // Return false if the update failed
        }

    }

    public function insertNotification($booking_id, $sender_id, $receiver_id, $notification_message)
    {
        $sql = "INSERT INTO notifications (booking_id, sender_id, receiver_id, notification) VALUES (:booking_id, :sender_id, :receiver_id, :notification_message)";
        $this->db->query($sql);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $receiver_id);
        $this->db->bind(':notification_message', $notification_message);

        return $this->db->execute();
    }

    public function notifyUsersWithType2($booking_id, $sender_id, $notification_message){

        $sql = "SELECT id FROM users WHERE type = 2";
        $this->db->query($sql);
        $users = $this->db->resultSet();

        foreach ($users as $user){
            $this->insertNotification($booking_id, $sender_id, $user->id, $notification_message);
        }
    }




    public function updateRefund($temporyid,$booking_id,$sender_id,$receiver_id,$cancelled_id,$amount,$currentDate){

        $sql = "INSERT INTO refunds (tempory_id,booking_id,serviceProvider_id,user_id,cancel_user_id,refund_amount,cancelled_date) 
                VALUES (:temporyid,:booking_id, :sender_id, :receiver_id, :cancelled_id, :amount, :currentDate)";

        $this->db->query($sql);

        $this->db->bind(':temporyid', $temporyid);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $receiver_id);
        $this->db->bind(':cancelled_id', $cancelled_id);
        $this->db->bind(':amount', $amount);
        $this->db->bind(':currentDate', $currentDate);

        return $this->db->execute();
    }

    public function insertNotification2($booking_id, $sender_id, $receiver_id, $notification_message){
        $sql = "INSERT INTO notifications (booking_id, sender_id, receiver_id, notification) VALUES (:booking_id, :sender_id, :receiver_id, :notification_message)";
        $this->db->query($sql);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $receiver_id); // Use the provided receiver_id
        $this->db->bind(':notification_message', $notification_message);

        return $this->db->execute();
    }


    public function getNotifications($user_id)
    {
        $sql = "SELECT n.*, u.fname, u.profile_picture
            FROM notifications n
            JOIN users u ON n.sender_id = u.id
            WHERE n.receiver_id = :user_id AND n.markAsRead = 0
            ORDER BY n.nDate DESC";

        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }

    public function markNotificationAsRead($notification_id)
    {
        $sql = "UPDATE notifications SET markAsRead = 1 WHERE notification_id = :notification_id";
        $this->db->query($sql);
        $this->db->bind(':notification_id', $notification_id);

        return $this->db->execute();
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


    public function getBookingCount($user_id){

        $this->db->query('SELECT COUNT(*) as count FROM bookings 
                         WHERE package_id = :user_id
                         AND bookingCondition != "cancelled"');

        $this->db->bind(':user_id', $user_id);

        $result = $this->db->single();
        return $result->count;
    }

    public function getCartBookingCount($user_id){

        $this->db->query('SELECT COUNT(*) as count FROM cartbookings 
                         WHERE package_id = :user_id
                         AND bookingCondition != "cancelled"');

        $this->db->bind(':user_id', $user_id);

        $result = $this->db->single();
        return $result->count;
    }

    public function getTotalRevenue($user_id){
        $this->db->query('SELECT SUM(paidAmount) as total FROM final_payment
                         WHERE serviceProvider_id  = :user_id');

        $this->db->bind(':user_id', $user_id);

        $result = $this->db->single();
        return $result->total;
    }

    public function getGuestCount($user_id){
        $this->db->query('SELECT COUNT(DISTINCT b.user_id) AS user_count
                      FROM bookings b
                      WHERE b.serviceProvider_id = :user_id AND bookingCondition != "cancelled" ');

        $this->db->bind(':user_id', $user_id);

        return $this->db->single()->user_count;
    }


}