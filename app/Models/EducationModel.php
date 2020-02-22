<?php
namespace App\Models;
/*
 * <!--
 Project name/Version: LaravelCLC Version: 1
 Module name: EducationModel
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/15/2020
 Synopsis: Module provides the base model of the education instance
 Version#: 1
 References: N/A
 -->
 */

class EducationModel
{
   private $educationId = NULL;
   private $educationYears;
   private $degree;
   private $school;
/**
     * @return mixed
     */
    public function getEducationId()
    {
        return $this->educationId;
    }

/**
     * @return mixed
     */
    public function getEducationYears()
    {
        return $this->educationYears;
    }

/**
     * @return mixed
     */
    public function getDegree()
    {
        return $this->degree;
    }

/**
     * @return mixed
     */
    public function getSchool()
    {
        return $this->school;
    }

    //constructor method
    public function __construct($id, $years, $degree, $school){
        
        $this->educationId = $id;
        $this->educationYears = $years;
        $this->degree = $degree;
        $this->school= $school;
        
    }

   
   
    
}

