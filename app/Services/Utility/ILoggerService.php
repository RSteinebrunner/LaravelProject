<?php
namespace App\Services\Utility;
/*
 Project name/Version: LaravelCLC Version: 6
 Module name: Logger Module
 Authors: Anthony Clayton
 Date: 04/05/2020
 Synopsis: Service class that just hold the fucntions for when using Log
 Version#: 1
 References: N/A
 */
interface ILoggerService
{
   
    public function debug($message,$data);
    public function info($message,$data);
    public function warning($message,$data);
    public function error($message,$data);
    
    
    
    
}

