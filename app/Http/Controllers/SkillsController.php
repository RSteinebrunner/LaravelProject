<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Skill Module
 Authors: Roland Steinebrunner, Jack Sidrak
 Date: 2/23/2020
 Synopsis: Module provides all methods needed for user skills, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\SkillsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Business\SkillsService;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class SkillsController extends Controller{
    //used to delete skills
    public function deleteSkills(Request $request){
        //get the id
        $id = $request->input('id');
        //create new skills service
        $users = new SkillsService();
        $result = $users->deleteSkills($id);
        if($result){
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        else{
            return view('managerError');
        }
    }
    
    public function addSkill(Request $request){
        //pull form data to make user
        $userId = $request->input('id');
        $skill = $request->input('skill');

        //create new object
        $newSkill = new SkillsModel(NULL,$userId, $skill);
        //pass the person object to the security service
        $service = new SkillsService();
        $result = $service->addSkill($newSkill);
        $data = $service->findAllSkills($userId);
        if($result == "true"){
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        return view('registerFailure')->with("result",$result);
    }
    
    
    
  
}
