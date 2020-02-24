<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Job Module
 Authors: Jack Sidrak
 Date: 2/23/2020
 Synopsis: Module provides all methods needed for user JobHistory, and return views when requested
 Version#: 1
 References: N/A
  */

use App\Models\JobHistoryModel;
use App\Services\Business\JobHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//JobHistory controller hold basic methods to either route to other views or request JobHistoryservice for further user specific actions
class JobHistoryController extends Controller{
    //used to delete skills
    public function deleteJobHistory(Request $request){
        //get the id
        $id = $request->input('id');
        //create new JobHistory service
        $users = new JobHistoryService();
        $result = $users->deleteJobHistory($id);
        if($result == "true"){
            return redirect()->route('portfolio');
        }
        else{
            return view('profileDisplayError');
        }
    }
    
    public function addJobHistory(Request $request){
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
        if($result == "true"){
            return redirect()->route('portfolio');
        }
        else if($result=="connection"){
            return view('profileDisplayError')->with("data","connection");
        }
        else{
        return view('profileDisplayError')->with("data","JobHistoryInsertion");
        }
    }
    
    
    
  
}
