<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 6
 Module name: Skill Module
 Authors: Roland Steinebrunner, Jack Setrak
 Date: 03/09/2020
 Synopsis: Module provides all methods needed for user skills, and return views when requested
 Version#: 2
 References: N/A
  */
use App\Models\SkillsModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Services\Business\SkillsService;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class SkillsController extends Controller{
    /**
     * Function used to delete a user skill
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteSkills(Request $request){
        try{
        //get the id
        $id = $request->input('id');
        //create new skills service
        $users = new SkillsService();
        //result will return a skill service delete method that takes in the ID
        $result = $users->deleteSkills($id);
        if($result){
            //if result comes back as true then delete was successful and user will re-directed to showPortfolio page to see the new changes
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        else{
            //reutrn to error page stating a specific error message
            return view('managerError');
        }
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * Function used to add skills to user portfolio
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addSkill(Request $request){
        try{
        //pull form data to make user
        $userId = $request->input('id');
        $skill = $request->input('skill');

        //create new object
        $newSkill = new SkillsModel(NULL,$userId, $skill);
        //pass the person object to the security service
        $service = new SkillsService();
        //result will return a skill service add method that takes in a skill model      
        $result = $service->addSkill($newSkill);
        if($result){
            //if result comes back as true then delete was successful and user will re-directed to showPortfolio page to see the new changes        
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        //if result comes back as false then reutrn to error page stating a specific error message
        return view('managerError')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    
    
  
}
