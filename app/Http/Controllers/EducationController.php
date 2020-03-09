<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 4
 Module name: Education Moduke
 Authors: Roland Steinebrunner, Anthony Clayton
 Date: 2/23/2020
 Synopsis: handles all features reagarding changing a user's education
 Version#: 1
 References: N/A
  */
use App\Models\EducationModel;
use App\Services\Business\EducationService;
use Illuminate\Http\Request;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class EducationController extends Controller{
    
    public function deleteEducation(Request $request){
        //get the id
        $id = $request->input('id');
        //create new service
        $users = new EducationService();
        $result = $users->deleteEducation($id);
        if($result){
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        else{
            return view('managerError');
        }
    }
    public function addEducation(Request $request){
        
        $this->validateForm($request);
        //pull form data to make user
        $id = $request->input('id');
        $years = $request->input('years');
        $degree = $request->input('degree');
        $school = $request->input('school');
        $gpa = $request->input('gpa');
        
        //create new object
        $newEdu = new EducationModel(NULL, $years, $degree, $school,$gpa);
        //pass the person object to the security service
        $service = new EducationService();
        $result = $service->addEducation($newEdu, $id);
        if($result == "true"){
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        else {
            return view('profileDisplayError')->with("data","educationInsert");
        }
    }
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['years' => 'Required | numeric',
            'degree' => 'Required | Between: 5,60',
            'school' => 'Required | Between: 1,60',
            'gpa' => 'Required | Between:1,4'
           ];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
    
    
  
}
