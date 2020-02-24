<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Education Moduke
 Authors: Roland Steinebrunner, Anthony Clayton
 Date: 2/23/2020
 Synopsis: Module provides all methods needed for user education, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\UserModel;
use App\Models\EducationModel;
use App\Services\Business\EducationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class EducationController extends Controller{
    
    public function deleteEducation(Request $request){
        //get the id
        $id = $request->input('id');
        //create new service
        $users = new EducationService();
        $result = $users->deleteEducation($id);
        if($result){
            return redirect()->route('portfolio');
        }
        else{
            return view('managerError');
        }
    }
    public function addEducation(Request $request){
        //pull form data to make user
        $id = $request->input('id');
        $years = $request->input('years');
        $degree = $request->input('degree');
        $school = $request->input('school');
        
        //create new object
        $newEdu = new EducationModel(NULL, $years, $degree, $school);
        //pass the person object to the security service
        $service = new EducationService();
        $result = $service->addEducation($newEdu, $id);
        $data = $service->findAllEducation($id);
        if($result == "true"){
            return redirect()->route('portfolio');
        }
        else {
            return view('profileDisplayError')->with("data","educationInsert");
        }
    }
    
    
    
  
}
