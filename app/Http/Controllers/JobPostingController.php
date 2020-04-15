<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 6
 Module name: Job Posting Module
 Authors: Anthony Clayton, Jack Setrak
 Date: 03/12/2020
 Synopsis: Module provides all methods needed for job posting, and return views when requested
 Version#: 2
 References: N/A
  */
use App\Models\JobPostingModel;
use App\Services\Business\JobPostingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
//controller hold basic methods to either route to other views or request securityservice for further admin specific actions
class JobPostingController extends Controller{
    
  /**
   * Function that will add a job posting
   * @param Request $request
   * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
   */
    public function addPost(Request $request){
        try{
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
        //call addPost method in job service passing the new job model 
        $result = $service->addPost($newPost);
        
        if($result){
            //if result comes back as true then reutrn user to show all jobs view to see the new posting
            return $this->showAllJobs();
        }
        else{
            //otherwise take user to error page with error message
            return view('profileDisplayError')->with("data", "jobPostingError");
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
     * Function to delete a job posting
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deletePost(Request $request){
        try{
        //get the id
        $id = $request->input('id');
        //create new service
        $service = new JobPostingService();
        //call the delete job post using the passed Id
        $result = $service->deletePost($id);
        if($result){
            //if result is true then call showAllJobs method which will take aadmin back to the showAllJobs view to see newly added post 
            return $this->showAllJobs();
        }
        else{
            //otherwise take user to error page with error message
            return view('profileDisplayError')->with("data", "jobDeleteError");
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
     * Function will update the information a admin will change on a job posting 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPost(Request $request){
        try{
   
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
            return $this->showAllJobs();
        }
        else{
            return view('profileDisplayError')->with("data", "jobPostingError");
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
     * Shows postings to standard users
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAllJobs(){
        //creat new service
        $users = new JobPostingService();
        //get the result from the service
        $result = $users->findAllJobs();
        //return the view with the data
        return view('showJobPosting')->with("result",$result);
    }
    
    /**
     * Finds job posting by id
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function findJob(Request $request){
        //get id
        $id = $request->input('id');
        //creat new service
        $job = new JobPostingService();
        //get the result from the service
        $result = $job->findJobById($id);
        //return the view with the data
        return view('editJobPosting')->with("job",$result);
    }
    
    //show all jobs after the search term from the form
    public function searchJobs(Request $request){
        //get id
        $term = $request->input('terms');
        //create new service
        $job = new JobPostingService();
        //get the array from the service
        $result = $job->searchJobs($term);
        //return the view with the data
        return view('showJobSearchPosting')->with("job",$result);
    }
    
    //emulate the response for appling to a job
    public function applyJob(Request $request)
    {
        //get id for the job
        $id = $request->input('id');
        //for the future a service would be used to apply with the user's sesison id and the id from the form
        
        //currently just display a success page
        return view('applyJobSuccess');
    }
    public function showJobDetails(Request $request){
        //get id
        $id = $request->input('id');
        //creat new service
        $job = new JobPostingService();
        //get the result from the service
        $result = $job->findJobById($id);
        //return the view with the data
        return view('showJobPostingDetailed')->with("job",$result);
    }
    
    /**
     * Function that will validate information recieved from form
     * @param Request $request
     */
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for job posting Form
        $rules = ['company' => 'Required | Between:1,50',
            'position' => 'Required | Between:1,50',
            'description' => 'Required | Between:1,200',
            'requirements' => 'Required | Between:1,200',
            'pay' => 'Required | Between:1,12 ',
            'postingDate' => 'Required | Between: 8,10'
            ];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
    
    
    
  

