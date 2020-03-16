<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 5
 Module name: Job Module
 Authors: Jack Setrak
 Date: 03/09/2020
 Synopsis: Module provides all methods needed for user JobHistory, and return views when requested
 Version#: 2
 References: N/A
  */

use App\Models\JobHistoryModel;
use App\Services\Business\JobHistoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
//JobHistory controller hold basic methods to either route to other views or request JobHistoryservice for further user specific actions
class JobHistoryController extends Controller{
    /**
     * used to delete skills
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteJobHistory(Request $request){
        try{
        //get the id
        $id = $request->input('id');
        //create new JobHistory service
        $users = new JobHistoryService();
        $result = $users->deleteJobHistory($id);
        if($result){
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        else{
            return view('profileDisplayError');
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
     * Function that will return the job history of the user 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addJobHistory(Request $request){
        try{
        $this->validateForm($request);
        //pull form data to make JobHistory
        $userId = $request->input('userId');
        $company = $request->input('company');
        $position = $request->input('position');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $description = $request->input('description');

        //create new object
        $newJobHistory = new JobHistoryModel(NULL, $userId, $company, $position, $startDate, $endDate, $description);
        //pass the JobHistory object to the JobHistory service
        $service = new JobHistoryService();
        $result = $service->addJobHistory($newJobHistory);
        if($result){
            $portfolio = new PortfolioController();
            return $portfolio->showPortfolio();
        }
        else if($result=="connection"){
            return view('profileDisplayError')->with("data","connection");
        }
        else{
            return view('profileDisplayError')->with("data","JobHistoryInsertion");
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
     * Function that will validate information recieved from form
     * @param Request $request
     */
    private function validateForm(Request $request){
        // Setup Data Validation Rules for Job history Form
        $rules = ['company' => 'Required | Between:1,50',
            'position' => 'Required | Between:1,50',
            'startDate' => 'Required | Between:8,10',
            'endDate' => 'Required | Between:8,10',
            'description' => 'Required | Between:1,200 '];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
    
  
}
