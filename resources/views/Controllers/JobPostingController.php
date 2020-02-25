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
    
  
    public function addPost(Request $request){
        //pull form data to make a posting 
        //extract data to send to the service
        $this->validateForm($request);
        $company = $request->input('company');
        $position = $request->input('position');
        $description = $request->input('description');
        $requirements = $request->input('requirements');
        $pay = $request->input('pay');
        $postingDate = $request->input('postingDate');
        
        //create new object
        $newPost = new JobPostingModel(null, $company, $position, $description, $requirements,$pay, $postingDate);
        //pass the job object to the service
        $service = new JobPostingService();
        $result = $service->addPost($newPost);
        
        if($result == "true"){
            return redirect()->route('adminPosting');
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
        $result = $service->deletePost($id);
        if($result){
            return redirect()->route('adminPosting');
        }
        else{
            return view('profileDisplayError')->with("data", "jobDeleteError");
        }
    }
    public function editPost(Request $request){
   
        $this->validateForm($request);
        //pull form data to make a change
        //extract data to send to the service
        $id = $request->input('id');
        $company = $request->input('company');
        $position = $request->input('position');
        $description = $request->input('description');
        $requirements = $request->input('requirements');
        $pay = $request->input('pay');
        $postingDate = $request->input('postingDate');
        
        //create new object
        $newPost = new JobPostingModel($id, $company, $position, $description, $requirements,$pay, $postingDate);
        //pass the job object to the service
        $service = new JobPostingService();
        $result = $service->editPost($newPost);
        
        if($result == "true"){
            return redirect()->route('adminPosting');
        }
        else{
            return view('profileDisplayError')->with("data", "jobPostingError");
        }
    }
    
    //shows postings to standard users
    public function showAllJobs(Request $request){
        //creat new service
        $users = new JobPostingService();
        //get the result from the service
        $result = $users->findAllJobs();
        //return the view with the data
        return view('showJobPosting')->with("result",$result);
    }
    //show postings to admins
    public function adminAllJobs(Request $request){
        
        //if not a admin rereoute to login
        if(Session::get('Role') != "admin"){
            return redirect()->route('login');
        }
        //creat new service
        $users = new JobPostingService();
        //get the result from the service
        $result = $users->findAllJobs();
        //return the view with the data
        return view('editJobPosting')->with("result",$result);
    }
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['comapany' => 'Required | Between:1,24',
            'position' => 'Required | Between:1,24',
            'description' => 'Required | Between:1,24',
            'requirements' => 'Required | Between:1,24',
            'pay' => 'Required | Between:1,12 ',
            'postingDate' => 'Required | Between: 8,10'
            ];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
    
    
    
  

