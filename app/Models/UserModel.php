<?php 
namespace App\Models;
/*
 * <!--  
Project name/Version: LaravelCLC Version: 6
Module name: UserModel
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: Module provides the base model of the user instance 
Version#: 1
References: N/A
-->
 */
//user model class outlines all user data
class UserModel implements \JsonSerializable{    
    private $userId = null;
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $picture;
    private $age;
    private $gender;
    private $address;
    private $hometown;
    private $email;
    private $phoneNumber;
    private $role = null;
    private $isSuspended = null;
    
  
    public function getId(){
        return $this->userId;
    }
    public function getFirstName(){
        return $this->firstName;
    }
    
    public function getLastName(){
        return $this->lastName;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getPassword(){
        return $this->password;
    }
    public function getPicture(){
        return $this->picture;
    }
    public function getAge(){
        return $this->age;
    }
    public function getGender(){
        return $this->gender;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getHometown(){
        return $this->hometown;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    public function getRole(){
        return $this->role;
    }
    public function getStatus(){
        return $this->isSuspended;
    }
    
    public function toString(){
        return " User Id: ". $this->userId." | Username: ". $this->username." | Password: ". $this->password." | firstName: ". $this->firstName." | lastName: ". $this->lastName." | age: ". $this->age." | gender: ". $this->gender." | address: ". $this->address." | hometown: ". $this->hometown." | email: ". $this->email." | phonenumber: ". $this->phoneNumber." | role: ". $this->role." | isSuspnded: ". $this->isSuspended;
    }
    //constructor method 
    public function __construct($id,$uname,$pswd,$fname,$lname,$pic,$age,$gender,$address,$hometown,$email,$phoneNum,$role,$suspended){
        $this->userId = $id;
        $this->username = $uname;
        $this->password= $pswd;
        $this->firstName = $fname;
        $this->lastName = $lname;
        $this->picture = $pic;
        $this->age = $age;
        $this->gender = $gender;
        $this->address = $address;
        $this->hometown = $hometown;
        $this->email = $email;
        $this->phoneNumber = $phoneNum;
        $this->role = $role;
        $this->isSuspended = $suspended;
    }
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
?>