<?php 
namespace App\Http\Models;


class UserModel{
    
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    public $age;
    public $email;
    public $role = null;
    
    public function __construct($fname,$lname,$uname,$pswd,$age,$email){
        $this->firstName = $fname;
        $this->lastName = $lname;
        $this->username = $uname;
        $this->password= $pswd;
        $this->age = $age;
        $this->email = $email;
    }
}
?>