<?php
class User{
   private $db;

    public function __construct(){
        $this->db=new Database;
    }

    public function getUsers(){
        $this->db->query('SELECT * FROM users');
        $results=$this->db->resultSet();

        return $results;
    }

    public function register($data){
        $this->db->query('INSERT INTO users (fname,lname,email,password,number) VALUES (:fname,:lname,:email,:password,:number)');
        //bind values
        $this->db->bind(':fname',$data['fname']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':lname',$data['lname']);
        $this->db->bind(':number',$data['number']);
        $this->db->bind(':password',$data['password']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function login($email,$password){
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email',$email);

        $row=$this->db->single();

        $hashed_password=$row->password;
        if(password_verify($password,$hashed_password)){
            return $row;
        }else{
            return false;
        }
    }
    //find by user email
    public function findUserByEmail($email){
        $this->db->query('SELECT * from users WHERE email=:email');
        $this->db->bind(':email',$email);

        $row=$this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
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

    public function updateUser($data){
        $this->db->query('UPDATE users SET fname = :fname, lname = :lname,email = :email,number = :number WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
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

      public function deleteUser($id){
        $this->db->query('DELETE FROM users WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }



}