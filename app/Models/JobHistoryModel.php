<?php 
namespace App\Models;
/*
 * <!--  
Project name/Version: LaravelCLC Version: 3
Module name: JobHistory Module
Authors: Jack Sidrak
Date: 1/23/2020
Synopsis: Module provides the base model of the JobHistory instance 
Version#: 1
References: N/A
-->
 */
//JobHistory model class outlines all user data
class JobHistoryModel{    
    private $Id = null;
    private $userID;
    private $company;
    private $position;
    private $startDate;
    private $endDate;
    private $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
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
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    //constructor method 
    public function __construct($ID,$USERID,$COMPANY,$POSITION,$STARTDATE,$ENDDATE,$DESCRIPTION){
        $this->id = $ID;
        $this->userID = $USERID;
        $this->company= $COMPANY;
        $this->position = $POSITION;
        $this->startDate = $STARTDATE;
        $this->endDate = $ENDDATE;
        $this->description = $DESCRIPTION;
    }
    
    
    
}
?>