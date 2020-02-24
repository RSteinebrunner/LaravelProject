<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Education Moduke
 Authors: Anthony Clayton
 Date: 2/23/2020
 Synopsis: Module provides all methods needed for job posting, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\JobPostingModel;
use App\Models\EducationModel;
use App\Services\Business\JobPostingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class JobPostingController extends Controller{
    
  
    public function addPosting(Request $request){
        //pull form data to make a posting 
        //extract data to send to the service
        
        $company = $request->input('company');
        $position = $request->input('position');
        $description = $request->input('description');
        $requirements = $request->input('requirements');
        $pay = $request->input('pay');
        $postingDate = $request->input('postingDate');
        
        //create new object
        $newPost = new JobPostingModel(NULL, $company, $position, $description, $requirements,$pay, $postingDate);
        //pass the job object to the service
        $service = new JobPostingService();
        $result = $service->addPost($newPost);
        
        if($result == "true"){
            return redirect()->route('portfolio');
        }
        else{
            return view('profileDisplayError')->with("data", "jobPostingError");
        }
    }
    public function deletePost(Request $request){
        //get the id
        $id = $request->input('id');
        //create new service
        $service = new JobPostingService();
        $result = $service->deleteEducation($id);
        if($result){
            return redirect()->route('portfolio');
        }
        else{
            return view('profileDisplayError')->with("data", "jobDeleteError");
        }
    }
    
    public function showAllJobs(Request $request){
        //creat new service
        $users = new JobPostingService();
        //get the result from the service
        $result = array("0" ,$users->findAllEducation());
        //return the view with the data
        return view('portfolio')->with("result",$result);
    }
}
    
    
    
  
}
