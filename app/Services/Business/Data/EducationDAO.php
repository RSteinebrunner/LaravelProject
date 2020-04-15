<?php
namespace App\Services\Business\Data;
use App\Models\EducationModel;
use Illuminate\Support\Facades\Log;

/*
 Project name/Version: LaravelCLC Version: 6
 Module name: education Module
 Authors:Anthony Clayton, Roland Steinebrunner
 Date: 2/25/2020
 Synopsis: Module connects to the database and provides information for the education of the user
 Version#: 2
 References: N/A
 */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class EducationDAO{
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    /**
     * delete the education model in the database
     * @param int $id
     * @return boolean
     */
    public function delete($id){
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "DELETE FROM `education` WHERE `id` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                return true;
            }
            return false;
        }
        
    }
  
    
    
    /**
     * Find all the education for the  user id provided
     * @param int $id
     * @return \App\Models\EducationModel[]|array
     */
    public function findAllEducation($id){
        //see if the connection failed
        Log::info("Entering EducationDAO.findAllEducation()");
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `education` WHERE `userId` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            $counter = 0;
            $counter2 = 0;
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //check to see  how many educations are in the array
                    
                    //if the array reaches 4 elements, add the array to the final returned array
                    if($counter==4){
                        //add array of educations to submitted array
                        $array[$counter2]=$edus;
                        //reset the educations array
                        $edus = array();
                        //reset counters
                        $counter = 0;
                        $counter2++;
                    }
                    //take each entry and add it to an array for up to 4 entries
                    if($counter<4)
                    {
                        //new model is made
                        $edu = new EducationModel($row['id'],$row['yearsAttended'], $row['degree'], $row['school'],$row['gpa']);
                        Log::info($edu->toString());
                        //add new model to proper place in array
                        $edus[$counter] = $edu;
                        $counter++;
                    }
               
                    Log::info(" Values", array("counter" => $counter));
                }
                //when there is no more rows, if the counter is not at 4 it will not add the remaining rows to the array, so this must be done outside the loop
                if($counter>0)
                {
                    $array[]=$edus;

                }

                
                //return the final array
                if(isset($array)){
                    Log::info("Final Array ", $array);
                    return $array;
                }
                //return empty array if there was no data
                $empty=array();
                return $empty;
            }
            
        }
        
    }
    /**
     * Create a new education entry to the database
     * @param EducationModel $edu
     * @param int $id
     * @return string
     */
    public function create(EducationModel $edu, $id){
        
        //get all variables from education model
        $years =$edu->getEducationYears();
        $degree = $edu->getDegree();
        $school = $edu->getSchool();
        $gpa = $edu->getGPA();
        
        
        //connect to database
        if ($this->conn->connect_error){
            return "connect";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `education` (`id`, `yearsAttended`, `degree`, `school`, `userId`, `gpa`) VALUES (NULL, '$years', '$degree', '$school', '$id','$gpa')";
            if (mysqli_query($this->conn, $sql_statement)) {
                //echo "New education created successfully";
                return true;
            }
        }
        
        
        
    }
    
    
    
   

         
         
    
}