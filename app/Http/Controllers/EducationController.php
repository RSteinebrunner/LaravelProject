<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 5
 Module name: Education Moduke
 Authors: Roland Steinebrunner, Anthony Clayton, Jack Setrak
 Date: 03/09/2020
 Synopsis: handles all features reagarding changing a user's education
 Version#: 2
 References: N/A
  */
use App\Models\EducationModel;
use App\Services\Business\EducationService;
use Illuminate\Http\Request;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class EducationController extends Controller{
    
    /**
     * Function used to delete an education
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteEducation(Request $request){
        //get the id
        $id = $request->input('id');
        //create new service
        $users = new EducationService();
        $result = $users->deleteEducation($id);
        if($result){
            $portfolio = new PortfolioController();
            //return user to showportfolio page if result comes back as true
            return $portfolio->showPortfolio();
        }
        else{
            //otherwise take user back to error page
            return view('managerError');
        }
    }
    
    /**
     * Function to add an education to a user's portfolio
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addEducation(Request $request){
        //validate information recieved from form
        $this->validateForm($request);
        //pull form data to make user
        $id = $request->input('id');
        $years = $request->input('years');
        $degree = $request->input('degree');
        $school = $request->input('school');
        $gpa = $request->input('gpa');
        
        //create new object
        $newEdu = new EducationModel(NULL, $years, $degree, $school,$gpa);
        //pass the person object to the education service
        $service = new EducationService();
        //pass information into called method from education service
        $result = $service->addEducation($newEdu, $id);
        if($result == "true"){
            $portfolio = new PortfolioController();
            //return user to portfolio if result comes back as true
            return $portfolio->showPortfolio();
        }
        else {
            return view('profileDisplayError')->with("data","educationInsert");
        }
    }

    /**
     * Function that will validate information recieved from form
     * @param Request $request
     */
    private function validateForm(Request $request){
        // Setup Data Validation Rules for Education Form
        $rules = ['years' => 'Required | numeric',
            'degree' => 'Required | Between: 5,60',
            'school' => 'Required | Between: 1,60',
            'gpa' => 'Required | Between:1,4'
           ];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
    
    
  
}
