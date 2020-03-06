<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 4
 Module name: Group Module
 Authors: Anthony Clayton
 Date: 3/2/2020
 Synopsis: Module provides all methods needed for groups, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\GroupModel;
use App\Services\Business\GroupService;
use Illuminate\Http\Request;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class JobPostingController extends Controller{
    
  /**
   * 
   * @param Request $request
   * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
   */
    public function searchForGroup(Request $request){
        $searched = $request->input('search');
        $service = new GroupService();
        //searching for particular groups
        $result = $service->findGroup($searched);
        //retuning the view with the groups
        return view('showGroups')->with("result",$result);
        
    }
    /**
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showGroupMembers(Request $request){
        $group = $request->input('groupId');
        $service = new GroupService();
        //searching for particular groups
        $result = $service->findGroupMembers($group);
        //retuning the view with the group members
        return view('showGroupMembers')->with("result",$result);
        
    }
    /**
     * 
     * @param Request $request
     * @return |\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addGroup(Request $request){
        //pull form data to make a posting 
        //extract data to send to the service
        $this->validateForm($request);
        $groupName = $request->input('groupName');
        $description = $request->input('description');
        $userId = $request->input('userId');
        
        //create new object
        $newGroup = new GroupModel(null, $groupName, $description, $userId);
        //pass the job object to the service
        $service = new GroupService();
        $result = $service->addGroup($newGroup);
        
        if($result == "true"){
            return $this->myGroups();
        }
        else{
            return view('profileDisplayError')->with("data", "groupCreateError");
        }
    }
    /**
     * 
     * @param Request $request
     * @return |\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteGroup(Request $request){
        //get the id
        $id = $request->input('groupId');
        //create new service
        $service = new GroupService();
        $result = $service->deletePost($id);
        if($result){
            return $this->myGroups();
        }
        else{
            return view('profileDisplayError')->with("data", "groupDeleteError");
        }
    }
  
    //shows groups to users
    /**
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAllGroups(Request $request){
        //creat new service
        $gs = new GroupService();
        //get the result from the service
        $result = $gs->findAllGroups();
        //return the view with the data
        return view('showGroups')->with("result",$result);
    }
    //show owned groups
    /**
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAllOwnerGroups(Request $request){
        //gets user id
        $id = $request->input('id');
        //creat new service
        $gs = new GroupService();
        //get the result from the service
        $result = $gs->findAllOwnerGroups($id);
        //return the view with the data
        return view('myGroups')->with("result",$result);
    }
    /**
     * 
     * @param Request $request
     */
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Group Creat Form
        $rules = ['groupName' => 'Required | Between:1,24',
            'description' => 'Required | Between:1,120',
            ];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
    
    
    
  

