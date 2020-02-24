<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Porfolio Module
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/15/2020
 Synopsis: Displays all the data for the portfolio page
 Version#: 1
 References: N/A
  */
use App\Models\UserModel;
use App\Models\EducationModel;
use App\Services\Business\EducationSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class PortfolioController extends Controller{
    public function showPortfolio(Request $request){
        //get the user id
        $id = Session::get('User')->getId();
        //creat new service
        $users = new EducationSecurityService();
        //get the result from the service
        $result = array("0" ,$users->findAllEducation($id));
        //return the view with the data
        return view('portfolio')->with("result",$result);
    }
}
