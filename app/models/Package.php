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
    (name, type, duration, TransportProvider, hotel, Price, Location, Images) VALUES (:name, :type, :duration, :TransportProvider, :hotel, :Price, :Location, :Images)');
        //bind values
        $this->db->bind(':name',$packageData['PackageName']);
        $this->db->bind(':type',$packageData['PackageType']);
        $this->db->bind(':duration',$packageData['Duration']);
        $this->db->bind(':TransportProvider',$packageData['TransportProvider']);
        $this->db->bind(':hotel',$packageData['AccomadationProvider']);
        $this->db->bind(':Price',$packageData['PriceOfPackage']);
        $this->db->bind(':Location',$packageData['PriceOfPackage']);
        $this->db->bind(':Images',$packageData['PackageImages']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findpackages(){
        $this->db->query('SELECT * from packages');
        $packageData=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $packageData;
        }else{
            return null;
        }
    }


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
            return true;
        } else {
            return false;
        }
    }

}