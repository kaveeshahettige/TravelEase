<?php
class Package{
    private $db;

    public function __construct(){
        $this->db =new Database;
    }

    public function getPackages() {
        $this->db->query('SELECT * FROM packages');
        $results = $this->db->resultSet();
        return $results;
    }

    public function packagesedit($packageData) {
        $this->db->query ('INSERT INTO packages 
    (name, type, TransportProvider, hotel, Price, Location, Images, description) VALUES (:name, :type, :TransportProvider, :hotel, :Price, :Location, :Images, :PackageDescription)');
        //bind values
        $this->db->bind(':name',$packageData['PackageName']);
        $this->db->bind(':type',$packageData['PackageType']);
        // $this->db->bind(':duration',$packageData['Duration']);
        $this->db->bind(':TransportProvider',$packageData['TransportProvider']);
        $this->db->bind(':hotel',$packageData['AccomadationProvider']);
        $this->db->bind(':Price',$packageData['PriceOfPackage']);
        $this->db->bind(':Location',$packageData['PriceOfPackage']);
        $this->db->bind(':Images',$packageData['PackageImages']);
        $this->db->bind(':PackageDescription',$packageData['PackageDescription']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findpackages($PackageID){
        $this->db->query('SELECT * from packages WHERE PackageID = :PackageID');
        $this->db->bind(':PackageID', $PackageID);
        $packageData=$this->db->resultSet();
//                print_r($packageData);
        //check row
        if($this->db->rowCount()>0){
            return $packageData[0];
        }else{
            return null;
        }
    }


    public function updatePackages($packageData) {
        $this->db->query('UPDATE packages 
                      SET name = :PackageName, 
                          type = :PackageType, 
                          duration = :Duration,  
                          Price= :PriceOfPackage, 
                          description = :PackageDescription 
                      WHERE PackageID = :PackageID');

        // Bind values
        $this->db->bind(':PackageID', $packageData['PackageID']);
        $this->db->bind(':PackageName', $packageData['PackageName']);
        $this->db->bind(':PackageType', $packageData['PackageType']);
        $this->db->bind(':Duration', $packageData['Duration']);
//        $this->db->bind(':TransportProvider', $packageData['TransportProvider']);
//        $this->db->bind(':AccomadationProvider', $packageData['AccomadationProvider']);
        $this->db->bind(':PriceOfPackage', $packageData['PriceOfPackage']);
//        $this->db->bind(':Location', $packageData['Location']);
//        $this->db->bind(':PackageImages', $packageData['PackageImages']);
        $this->db->bind(':PackageDescription', $packageData['PackageDescription']);


        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deletepackages($PackageID) {
        $this->db->query('DELETE FROM packages WHERE PackageID = :PackageID');
        // Bind values
        $this->db->bind(':PackageID', $PackageID);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
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

        $sql = "INSERT into guide_availability (user_id,startDate) VALUES (:user_id,:startDate)";
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

    public function getAvailability($user_id,$startDate){

        $sql = "SELECT * from guide_availability WHERE user_id = :user_id AND startDate = :startDate";
        $this->db->query($sql);
        $this->db->bind(':user_id',$user_id);
        $this->db->bind(':startDate',$startDate);

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
        $sql = "SELECT * FROM bookings WHERE user_id = :user_id";
        $this->db->query($sql);
    }

    public function getCartBookings($user_id){
        $sql = "SELECT * FROM cartbookings WHERE user_id = :user_id";
        $this->db->query($sql);
    }

    public function getReviews($user_id){
        $sql = "SELECT * FROM reviews WHERE user_id = :user_id";
        $this->db->query($sql);
    }
}