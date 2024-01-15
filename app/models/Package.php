<?php
class Package{
    private $db;

    public function __construct(){
        $this->db =new Database;
    }

    public function getPackages() {
        $this->db->query('SELECT * FROM packages');
        $results = $this->db->resultSet();
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
        return $results;
    }

    public function packagesedit($packageData) {
        $this->db->query ('INSERT INTO packages 
<<<<<<< Updated upstream
    (name, type, duration, TransportProvider, hotel, Price, Location, Images) VALUES (:name, :type, :duration, :TransportProvider, :hotel, :Price, :Location, :Images)');
        //bind values
        $this->db->bind(':name',$packageData['PackageName']);
        $this->db->bind(':type',$packageData['PackageType']);
        $this->db->bind(':duration',$packageData['Duration']);
=======
    (name, type, TransportProvider, hotel, Price, Location, Images, description) VALUES (:name, :type, :TransportProvider, :hotel, :Price, :Location, :Images, :PackageDescription)');
        //bind values
        $this->db->bind(':name',$packageData['PackageName']);
        $this->db->bind(':type',$packageData['PackageType']);
        // $this->db->bind(':duration',$packageData['Duration']);
>>>>>>> Stashed changes
        $this->db->bind(':TransportProvider',$packageData['TransportProvider']);
        $this->db->bind(':hotel',$packageData['AccomadationProvider']);
        $this->db->bind(':Price',$packageData['PriceOfPackage']);
        $this->db->bind(':Location',$packageData['PriceOfPackage']);
        $this->db->bind(':Images',$packageData['PackageImages']);
<<<<<<< Updated upstream
=======
        $this->db->bind(':PackageDescription',$packageData['PackageDescription']);
>>>>>>> Stashed changes

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

<<<<<<< Updated upstream
    public function findpackages(){
        $this->db->query('SELECT * from packages');
        $packageData=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $packageData;
=======
    public function findpackages($PackageID){
        $this->db->query('SELECT * from packages WHERE PackageID = :PackageID');
        $this->db->bind(':PackageID', $PackageID);
        $packageData=$this->db->resultSet();
//                print_r($packageData);
        //check row
        if($this->db->rowCount()>0){
            return $packageData[0];
>>>>>>> Stashed changes
        }else{
            return null;
        }
    }


<<<<<<< Updated upstream
    public function hotelupdatepackages($packageData) {
        $this->db->query ('UPDATE hotel_packages SET packageType = :packageType, numofbeds = :numOfBeds, price = :price, packageImages = :packageImages, packageDescription = :packageDescription WHERE package_id = :package_id');
        //bind values
        $this->db->bind(':packageType',$packageData['packageType']);
        $this->db->bind(':numOfBeds',$packageData['numOfBeds']);
        $this->db->bind(':price',$packageData['price']);
        $this->db->bind(':packageImages',$packageData['packageImages']);
        $this->db->bind(':packageDescription',$packageData['packageDescription']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deletepackages($package_id){
        $this->db->query('DELETE FROM hotel_packages WHERE package_id = :package_id');
        // Bind values
        $this->db->bind(':package_id', $package_id);

        // Execute
        if($this->db->execute()){
=======
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
>>>>>>> Stashed changes
            return true;
        } else {
            return false;
        }
    }

<<<<<<< Updated upstream
=======

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


>>>>>>> Stashed changes
}