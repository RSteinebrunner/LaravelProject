<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 5
 Module name: Group Module
 Authors: Anthony Clayton, Jack Setrak
 Date: 03/09/2020
 Synopsis: Module provides all methods needed for groups, and return views when requested
 Version#: 2
 References: N/A
  */
use App\Models\GroupModel;
use App\Services\Business\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class GroupController extends Controller{
    
  /**
   * Function that a user can use to search for a group
   * @param Request $request
   * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
   */
    public function searchForGroup(Request $request){
        try{
        $searched = $request->input('search');
        $service = new GroupService();
        //searching for particular groups
        $result = $service->findGroup($searched);
        //retuning the view with the groups
        return view('showGroups')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
        
    }
    
    /**
     *Function that will be used to show group memebers of a group
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showGroupMembers(Request $request){
        try{
        $group = $request->input('groupId');
        $service = new GroupService();
        //searching for particular groups
        $result = $service->findGroupMembers($group);
        //retuning the view with the group members
        return view('showGroupMembers')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
        
    }
    
    /**
     * Function that will allow a user or an admin to create a group
     * @param Request $request
     * @return |\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addGroup(Request $request){
        try{
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
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * Function used to allow a user to join a group
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function joinGroup(Request $request){
        try{
        //extract data to send to the service
        $groupID = $request->input('groupID');
        $userId = $request->input('userID');
        //pass the job object to the service
        $service = new GroupService();
        $result = $service->joinGroup($groupID, $userId);
        
        if($result == "true"){
            //if result was found then take user to show all groups page
            return $this->showAllGroups();
        }
        else{
            //otherwise take user to error page with error message
            return view('profileDisplayError')->with("data", "groupCreateError");
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
     * Method will save you changes after editing a group posting
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editGroupPosting(Request $request){
        try{
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
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * Method to delete Affinity groups
     * @param Request $request
     * @return |\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteGroup(Request $request){
        try{
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
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * Function used to leave a group
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function leaveGroup(Request $request){
        try{
        //get the id
        $userId = $request->input('userID');
        //get the group id
        $groupId = $request->input('groupID');
        //create new service
        $service = new GroupService();
        //call leave group from group service passing the groupID of the group you want to leave and your id so the database can remove you from the seleceted group
        $result = $service->leaveGroup($groupId, $userId);
        if($result){
            return $this->showAllGroups();
        }
        else{
            return view('profileDisplayError')->with("data", "groupLeaveError");
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
     * shows all Affinity groups
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAllGroups(){
        try{
        //creat new service
        $gs = new GroupService();
        //get the result from the service
        $result = $gs->findAllGroups();
        //return the view with the data
        return view('showGroups')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * show all groups owned by current logged in user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAllOwnerGroups(Request $request){
        try{
        //gets user id
        $id = $request->input('id');
        //creat new service
        $gs = new GroupService();
        //get the result from the service
        $result = $gs->findAllOwnerGroups($id);
        //return the view with the data
        return view('myGroups')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * method used to bring up the edit page for the desired group posting the admin or owner is looking to edit
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editGroup(Request $request){
        try{
        //gets group id
        $id = $request->input('id');
        //creat new service
        $groups = new GroupService();
        //get the result from the service
        $result = $groups->findGroup($id);
        //return the view with the data
        return view('editGroups')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    /**
     * Function used to show all members 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAllMembers(Request $request){
        try{
        //gets group id
        $groupID = $request->input('id');
        //creat new service
        $groups = new GroupService();
        //get the result from the service
        $result = $groups->findAllMembers($groupID);
        //returns array of groupmodels
        return view('showMembers')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * Function used to show all groups owned by the current logged in user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showMyGroups(){
        try{
        //get the user id
        $id = Session::get('User')->getId();
        //creat new services
        $service = new GroupService();
        //get the result from the service
        $result = array(0=>$service->findAllOwnerGroups($id), $service->findAllParticipation($id));
        return view('showMyGroups')->with("result", $result);
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
        // Setup Data Validation Rules for Group Form
        $rules = ['groupName' => 'Required | Between:1,50',
            'description' => 'Required | Between:1,150'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
    
}
    
    
    
  

