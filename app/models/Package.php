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


}