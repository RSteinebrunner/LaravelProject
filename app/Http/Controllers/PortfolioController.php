<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 6
 Module name: Porfolio Module
 Authors: Roland Steinebrunner, Jack Setrak, Anthony Clayton
 Date: 03/09/2020
 Synopsis: Displays all the data for the portfolio page
 Version#: 2
 References: N/A
  */
use App\Services\Business\EducationService;
use App\Services\Business\JobHistoryService;
use App\Services\Business\SkillsService;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class PortfolioController extends Controller{
    /**
     * Function that will show the user their own portfolio
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showPortfolio(){
        try{
        //get the user id
        $id = Session::get('User')->getId();
        //creat new services
        $edu = new EducationService();
        $skill = new SkillsService();
        $jobs = new JobHistoryService();

        //get the result from the services and align them into an array 
        $result = array(0=>$edu->findAllEducation($id),$skill->findAllSkills($id),$jobs->findAllJobHistory($id));
        //return the showPortfolio view with the data
        return view('showPortfolio')->with("result",$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
}
