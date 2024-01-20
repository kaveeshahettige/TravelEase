<?php
class AdminM{
   private $db;

    public function __construct(){
        $this->db=new Database;
    }


    public function findUserDetail($id){
        $this->db->query('SELECT * from users where id=:id');
        $this->db->bind(':id',$id);

        $row=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return $row;
        }else{
            return null;
        }
    }
    ////////////
    public function findmanagerDetail(){
        $this->db->query("SELECT * from users where type='2'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

      public function updatemanager($data){
        $this->db->query('UPDATE users SET fname = :name,email = :email,number = :number WHERE id=:id');
        // Bind values
        $this->db->bind(':id', $data['id'], PDO::PARAM_INT);
        $this->db->bind(':name', $data['fname']);  
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':number', $data['number']);
  
        // Execute
        if($this->db->execute()){
        //add a function to rlaod site
          return true;
        } else {
          return false;
        }
      }

      public function noOfManagers(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 2');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    public function noOfTravelers(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 1');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }

    public function noOfHotels(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 3 and approval=1');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    public function noOfAgencies(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 4 and approval=1');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    public function noOfPackages(){
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE type = 5 and approval=1');
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    //noOfRequests
    public function noOfRequests(){
      
      $this->db->query("SELECT COUNT(*) AS count FROM users WHERE approval = 0 AND type NOT IN (0, 1, 2)");
        $row = $this->db->single();
         if($this->db->rowcount()>0){
            return $row->count;
         }
         else{
            return false;
        }
    }
    public function getadmindata(){
        $this->db->query("SELECT * from users where type='0'");
        $data=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    //findTravelerDetail
    public function findTravelerDetail(){
        $this->db->query("SELECT * from users where type='1'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    //findHotelDetail
    public function findHotelDetail(){
        $this->db->query("SELECT * from users where type='3' and approval='1'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }
    //findAgencyDetail
    public function findAgencyDetail(){
        $this->db->query("SELECT * from users where type='4' and approval='1'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    //findPackageDetail
    public function findPackageDetail(){
        $this->db->query("SELECT * from users where type='5' and approval='1'");
        $data=$this->db->resultSet();

        //check row
        if($this->db->rowCount()>0){
            return $data;
        }else{
            return null;
        }
    }

    
   
//findRequestDetail
public function findRequestDetail(){
    $this->db->query("SELECT * FROM users WHERE approval = '0' AND type NOT IN ('0', '1','2')");
    $data=$this->db->resultSet();

    //check row
    if($this->db->rowCount()>0){
        return $data;
    }else{
        return null;
    }
}

public function deleteTraveler($id){
    $this->db->query('DELETE FROM users WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if($this->db->execute()){
        redirect('admin/traveler');
    } else {
      return false;
    }
  }
 
  public function deleteHotel($id){
    $this->db->query('DELETE FROM users WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if($this->db->execute()){
        redirect('admin/hotel');
    } else {
      return false;
    }
  }

  public function deleteAgency($id){
    $this->db->query('DELETE FROM users WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if($this->db->execute()){
        redirect('admin/agency');
    } else {
      return false;
    }
  }
  
//   deleteGuide
  public function deleteGuide($id){
    $this->db->query('DELETE FROM users WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if($this->db->execute()){
        redirect('admin/package');
    } else {
      return false;
    }
  }

  //updateAdmin

  public function updateAdmin($data){
    $this->db->query('UPDATE users SET fname = :name,email = :email,number = :number WHERE id=:id');
    // Bind values
    $this->db->bind(':id', $data['id']); 
    $this->db->bind(':name', $data['name']);  
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':number', $data['number']);

    // Execute
    if($this->db->execute()){
    //add a function to rlaod site
      return true;
    } else {
      return false;
    }
  }

  //getpassword
    public function getpassword($id){
        $this->db->query('SELECT password FROM users WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
    
        $row = $this->db->single();
        if($this->db->rowCount()>0){
            return $row;
        }else{
            return null;
        }
    }

    //updatePassword
    public function updatePassword($data){
        $this->db->query('UPDATE users SET password = :password WHERE id=:id');
        // Bind values
        $this->db->bind(':id', $data['id']); 
        $this->db->bind(':password', $data['hashed-password']);  
        
        // Execute
        if($this->db->execute()){
        //add a function to rlaod site
          return true;
        } else {
          return false;
        }
      }

    //   public function findUserDetail($id){
    //     $this->db->query('SELECT * from users where id=:id');
    //     $this->db->bind(':id',$id);

    //     $row=$this->db->single();

    //     //check row
    //     if($this->db->rowCount()>0){
    //         return $row;
    //     }else{
    //         return null;
    //     }
    // }

    public function viewDocument($id){
        $this->db->query('SELECT document from requests where id=:id');
        $this->db->bind(':id',$id);

        $row=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return $row;
        }else{
            return null;
        }

    }
    // acceptUser set 1
    public function acceptUser($id){
        $this->db->query('UPDATE users SET approval = 1 WHERE id=:id');
        // Bind values
        $this->db->bind(':id', $id); 
        
        // Execute
        if($this->db->execute()){
        //add a function to rlaod site
          return true;
        } else {
          return false;
        }
      }
//declineUser set 2
      public function declineUser($id){
        $this->db->query('UPDATE users SET approval = 2 WHERE id=:id');
        // Bind values
        $this->db->bind(':id', $id); 
        
        // Execute
        if($this->db->execute()){
        //add a function to rlaod site
          return true;
        } else {
          return false;
        }
      }

    }