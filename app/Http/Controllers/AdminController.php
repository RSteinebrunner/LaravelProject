<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 1
 Module name: Controller
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 1/19/2020
 Synopsis: Module provides all methods needed to update/delete users, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class AdminController extends Controller{
    public function showAllUsers(Request $request){
        $id = Session::get('User')->getId();
        $users = new SecurityService();
        $result = $users->findAllUsers($id);
        return view('showAdmin')->with('result',$result);
    }
    
    public function deleteUser(Request $request){
        $id = $request->input('id');
        $users = new SecurityService();
        $result = $users->deleteUser($id);
        if($result){
            return redirect()->route('manageUsers');
        }
        else{
            return view('managerError');
        }
    }
    public function suspendUser(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $users = new SecurityService();
        $result = $users->suspendUser($id, $status);
        if($result){
            return redirect()->route('manageUsers');
        }
        else{
            return view('managerError');
        }
        
        
    }
    
    
  
}
