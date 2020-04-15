<?php
namespace App\Services\Business\Data;
use App\Models\JobHistoryModel;
use Illuminate\Support\Facades\Log;

/*
 Project name/Version: LaravelCLC Version: 6
 Module name: JobHistory Module
 Authors: Jack Sidrak, Roland Steinebrunner
 Date: 2/25/2020
 Synopsis: Module connects to the database and provides information for the JobHistory of the user
 Version#: 2
 References: N/A
 */

//JobHistory DAO class that creates or findes user depending on which method is requested from JobHistory Service
class JobHistoryDAO{
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function delete($id){
        if ($this->conn->connect_error){
            return "false";        
        }else{
            $sql_statement = "DELETE FROM `jobhistory` WHERE `id` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                return true;
            }
            return false;
        }        
    }    
    
    //find all JobHistory in the database
    public function findAllJobHistory($id){
        //see if the connection failed
        Log::info("Entering JobHistoryDAO.findAllJobHistory()");
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `jobhistory` WHERE `userId` = '$id'";
            $counter = 0;
            $counter2 = 0;
            $result = mysqli_query($this->conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //if the array reaches 3 elements, add the array to the final returned array(this creates a new row in the view
                    if($counter==3){
                        //add array of educations to submitted array
                        $array[$counter2]=$skills;
                        //reset the educations array
                        $skills = array();
                        //reset counters
                        $counter = 0;
                        $counter2++;
                    }
                    //take each entry and add it to an array for up to 4 entries
                    if($counter<3)
                    {
                        //new model is made
                        $skill = new JobHistoryModel($row['id'],$row['userId'],$row['company'],$row['position'],$row['startDate'],$row['endDate'],$row['description']);
                        //add the model to the array for this row
                        $skills[$counter] = $skill;
                        $counter++;
                    }
                }
                if($counter>0)
                {
                    $array[]=$skills;
                    
                }
                if(isset($array))
                    return $array;
                //return if empty
                $empty=array();
                return $empty;
            }            
        }       
    }
    
    //creates JobHistory when requested 
    public function create(JobHistoryModel $JobHistory){
        
        //get all variables from JobHistory model      
        $userId =$JobHistory->getUserID();
        $company =$JobHistory->getCompany();
        $position =$JobHistory->getPosition();
        $startDate =$JobHistory->getStartDate();
        $endDate =$JobHistory->getEndDate();
        $description =$JobHistory->getDescription();
        
        //connect to database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
            return "connection";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `jobhistory` (`id`, `userId`, `company`, `position`, `startDate`, `endDate`, `description`) VALUES (NULL, '$userId', '$company', '$position', '$startDate', '$endDate', '$description')";
            if (mysqli_query($this->conn, $sql_statement)) {
                return true;
            }
        }
        return false;
        
        
        
    }
    
    
    
   

         
         
    
}