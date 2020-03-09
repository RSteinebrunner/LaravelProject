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
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class GroupController extends Controller{
    
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
        $userId = $request->input('id');
        
        //create new object
        $newGroup = new GroupModel(null, $groupName, $description, $userId);
        //pass the job object to the service
        $service = new GroupService();
        $result = $service->addGroup($newGroup);
        
        if($result == "true"){
            return $this->showAllGroups();
        }
        else{
            return view('profileDisplayError')->with("data", "groupCreateError");
        }
    }
    public function joinGroup(Request $request){
        //extract data to send to the service
        $groupID = $request->input('groupID');
        $userId = $request->input('userID');
        //pass the job object to the service
        $service = new GroupService();
        $result = $service->joinGroup($groupID, $userId);
        
        if($result == "true"){
            return $this->showAllGroups();
        }
        else{
            return view('profileDisplayError')->with("data", "groupCreateError");
        }
    }
    
    //method will save you changes after editing a group posting
    public function editGroupPosting(Request $request){
        
        $this->validateForm($request);
        //pull form data to make a change
        //extract data to send to the service
        $groupId = $request->input('id');
        $groupName = $request->input('groupName');
        $description = $request->input('description');
        $ownerId = $request->input('ownerId');
        
        //create new object
        $newGroup = new GroupModel($groupId, $groupName, $description, $ownerId);
        //pass the group object to the service
        $service = new GroupService();
        $result = $service->editGroup($newGroup);
        
        if($result == "true"){
            return $this->showAllGroups();
        }
        else{
            return view('profileDisplayError')->with("data", $result);
        }
    }
    
    /**
     * Method to delete Affinity groups
     * @param Request $request
     * @return |\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteGroup(Request $request){
        //get the id
        $groupId = $request->input('id');
        //create new service
        $service = new GroupService();
        $result = $service->deleteGroup($groupId);
        if($result){
            return $this->showAllGroups();
        }
        else{
            return view('profileDisplayError')->with("data", "groupDeleteError");
        }
    }
    public function leaveGroup(Request $request){
        //get the id
        $userId = $request->input('userID');
        //get the group id
        $groupId = $request->input('groupID');
        //create new service
        $service = new GroupService();
        $result = $service->leaveGroup($groupId, $userId);
        if($result){
            return $this->showAllGroups();
        }
        else{
            return view('profileDisplayError')->with("data", "groupLeaveError");
        }
    }
  

    /**
     * shows all Affinity groups
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAllGroups(){
        //creat new service
        $gs = new GroupService();
        //get the result from the service
        $result = $gs->findAllGroups();
        //return the view with the data
        return view('showGroups')->with("result",$result);
    }
    
    /**
     * show all groups owned by current logged in user
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
    
    //method used to bring up the edit page for the desired group posting the admin or owner is looking to edit
    public function editGroup(Request $request){
        //gets group id
        $id = $request->input('id');
        //creat new service
        $groups = new GroupService();
        //get the result from the service
        $result = $groups->findGroup($id);
        //return the view with the data
        return view('editGroups')->with("result",$result);
    }

    public function showAllMembers(Request $request){
        //gets group id
        $groupID = $request->input('groupID');
        //creat new service
        $groups = new GroupService();
        //get the result from the service
        $result = $groups->findAllMembers($groupID);
        //return the view
        return $this->showMyGroups();
    }
    public function showMyGroups(){
        //get the user id
        $id = Session::get('User')->getId();
        //creat new services
        $service = new GroupService();
        //get the result from the service
        $result = array(0=>$service->findAllOwnerGroups($id), $service->findAllParticipation($id));
        return view('showMyGroups')->with("result", $result);
    }
    
    /**
     * 
     * @param Request $request
     */
    private function validateForm(Request $request){
        // Setup Data Validation Rules for Group Creat Form
        $rules = ['groupName' => 'Required | Between:1,50',
            'description' => 'Required | Between:1,150'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
    
}
    
    
    
  

