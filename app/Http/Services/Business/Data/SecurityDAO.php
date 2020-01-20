<?php
namespace App\Http\Services\Business\Data;

use App\Http\Models\UserModel;
use \mysqli;

class SecurityDAO{
    
    public function findUser($username, $password)
    {
        //establic connectionto the database
        $conn = new mysqli("localhost","root","root","laraveldb");
        if ($conn->connect_error)
        {
            echo "Failed to get databse connection!";
        }
        else
        {
           // echo "Got databse connection!";
            //search database credentials for user'
            $sql_statement = "SELECT * FROM `credential` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
            $result = mysqli_query($conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    return true;
                }
            }
        }
        //if found return true, else false
        
    }
    public function makeUser(UserModel $user)
    {
        //get all variables
         $firstName = $user->firstName;
         $lastName = $user->lastName;
         $username = $user->username;
         $password = $user->password;
         $age = $user->age;
         $email = $user->email;
         $role = null;
         $checkCounter = 0;
         //connect to database
         $conn = new mysqli("localhost","root","root","laraveldb");
         if ($conn->connect_error)
         {
             echo "Failed to get databse connection!";
         }
         else
         {
             //echo "Got databse connection!";


             //add user
             $sql_statement_user = "INSERT INTO `user` (`firstName`,`lastName`,`age`,`email`) VALUES ('$firstName', '$lastName', '$age', '$email')"; 
             if (mysqli_query($conn, $sql_statement_user)) {
                 //echo "New user created successfully";
                 $checkCounter++;
             } else {
                 echo "Error: " . $sql_statement_user . "<br>" . mysqli_error($conn);
             }
             
             
             $sql_statement1 = "SELECT * FROM `user`";
             
             //get latest id
             //unfortunatly we do not know another way to create items in two tables bound by a foreign key another way
             //We will ask you about this in out class because Gordon did not teach this to us and it seems rather importatant
             $result = mysqli_query($conn,$sql_statement1);
             $lastId = 0;
             if($result)
             {
                 while($row = mysqli_fetch_assoc($result))
                 {

                     $lastId =  $row['userId'];
    
                 }
                // echo $lastId;
             }
             else{
                 echo "Error with sql " . mysqli_error($conn);
             }
               
             //add credentials
             $sql_statement_credential = "INSERT INTO `credential` (`userId`,`username`,`password`) VALUES ('$lastId', '$username', '$password')";
             if (mysqli_query($conn, $sql_statement_credential)) {
                // echo "New credential created successfully";
                 $checkCounter++;
             } else {
                 echo "Error: " . $sql_statement_credential . "<br>" . mysqli_error($conn);
             }
         }
         if($checkCounter == 2){
             return true;
         }
         return false;
         

         
         
    }
}