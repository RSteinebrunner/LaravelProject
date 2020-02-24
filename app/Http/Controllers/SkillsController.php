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
use App\Services\Business\SkillsSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class SkillsController extends Controller{
    
    public function showAllSkills(Request $request){
        //get the user id
        $id = Session::get('User')->getId();
        //creat new skill service
        $users = new SkillsSecurityService();
        //get the result from the service
        $result = $users->findAllSkills($id);
        //return the view with the data
        return view('showPortfolio')->with('result',$result);
    }
    
    //used to delete skills
    public function deleteSkills(Request $request){
        //get the id
        $id = $request->input('id');
        //create new skills service
        $users = new SkillsSecurityService();
        $result = $users->deleteSkills($id);
        if($result){
            return redirect()->route('showPortfolio');
        }
        else{
            return view('managerError');
        }
    }
    
    public function addSkill(Request $request){
        //pull form data to make user
        $userId = $request->input('user');
        $skill = $request->input('years');

        //create new object
        $newSkill = new SkillsModel(NULL, $skill);
        //pass the person object to the security service
        $service = new SkillsSecurityService();
        $result = $service->addSkills($newSkill, $userId);
        $data = $service->findAllSkills($userId);
        if($result == "true"){
            return view('showPortfolio')->with("result",$data);
        }
        return view('registerFailure')->with("result",$result);
    }
    
    
    
  
}
