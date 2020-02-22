<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 1
 Module name: Controller
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/15/2020
 Synopsis: Module provides all methods needed for user education, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\UserModel;
use App\Models\EducationModel;
use App\Services\Business\EducationSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class EducationController extends Controller{
    public function showAllEducation(Request $request){
        //get the user id
        $id = Session::get('User')->getId();
        //creat new service
        $users = new EducationSecurityService();
        //get the result from the service
        $result = $users->findAllEducation($id);
        //return the view with the data
        return view('showPortfolio')->with('result',$result);
    }
    //used to delete education
    public function deleteEducation(Request $request){
        //get the id
        $id = $request->input('id');
        //create new service
        $users = new EducationSecurityService();
        $result = $users->deleteEducation($id);
        if($result){
            return redirect()->route('showPortfolio');
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
        $service = new EducationSecurityService();
        $result = $service->addEducation($newEdu, $id);
        $data = $service->findAllEducation($id);
        if($result == "true"){
            return view('showPortfolio')->with("result",$data);
        }
        return view('registerFailure')->with("result",$result);
    }
    
    
    
  
}
