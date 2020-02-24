<?php
namespace App\Models;
/*
 * <!--
 Project name/Version: LaravelCLC Version: 3
 Module name: JobPostingModel
 Authors: Anthony Clayton
 Date: 2/20/2020
 Synopsis: Module provides the base model of the job instance
 Version#: 1
 References: N/A
 -->
 */

class JobPostingModel
{
   private $id = NULL;
   private $company;
   private $position;
   private $description;
   private $requirements;
   private $pay;
   private $postingDate;

   
   //constructor method
   public function __construct($id, $company, $position, $description, $requirements,$pay,$postingDate){
       
       $this->id = $id;
       $this->company = $company;
       $this->position = $position;
       $this->description = $description;
       $this->requirements = $requirements;
       $this->pay = $pay;
       $this->postingDate = $postingDate;
       
       
   }
   
    /**
     * @return mixed
     */
    public function getJobId()
    {
        return $this->jobId;
    }

/**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

/**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

/**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

/**
     * @return mixed
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

/**
     * @return mixed
     */
    public function getPay()
    {
        return $this->pay;
    }

/**
     * @return mixed
     */
    public function getPostingDate()
    {
        return $this->postingDate;
    }


   

   
   
    
}

