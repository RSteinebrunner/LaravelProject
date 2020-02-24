<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 2/23/2020
Synopsis: View page that shows the login page when a user attempts to sign into their account
Version#: 3
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Education')

@section('title')
@isset($error)
  	<div class="alert alert-warning">
    <strong>Warning!</strong> Error adding education to the portfolio. Please try again.
   </div>	
@endisset
    	<h2>Education</h2>
@endsection

@section('content')
<!-- Education -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<table class="table table-dark">
    	<tr><th scope="col">Years:</th>
    	<th scope="col">Degree</th>
    	<th scope="col">School</th>
    	</tr>
        		@foreach($result[0] as $edu)
        		<tr>
        			<td>{{$edu->getEducationYears()}}</td>
        			<td>{{$edu->getDegree()}}</td>
        			<td>{{$edu->getSchool()}}</td>  
        			<td>
        			<form method="post" action="deleteEducation">
        			<input type = "hidden" name = "id" value = "{{$edu->getEducationId()}}">
        			<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        			<button class="btn btn-danger" type="submit">Delete</button>
        			</form>
        			</td>     			
        		</tr>
        		
        		@endforeach
        </table>
        </div>
     </div>
     
     </div>
     <div align="center">
     <h2>Skills</h2>
     <hr>
     </div>
     <div class="container">
     <div class="row">
	 <table class="table table-dark">
     	@foreach($result[1] as $skill)
     	<tr>
       		<td>{{$skill->getSkill()}}</td>
       		<td>
            	<form method="post" action="deleteSkill">
                	<input type = "hidden" name = "id" value = "{{$skill->getSkillId()}}">
                	<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                	<button class="btn btn-danger" type="submit">Delete</button>
            	</form>
        	</td>    
        @endforeach
     </table>
     </div>
     </div>
     
         <div align="center">
     <h2>Job History</h2>
     <hr>
     </div>
     <div class="container">
     <div class="row">
	 <table class="table table-dark">
	 <tr><th scope="col">Company</th>
    	<th scope="col">Position</th>
    	<th scope="col">StartDate</th>
    	<th scope="col">EndDate</th>
    	<th scope="col">Description</th>
    	
    	</tr>
     	@foreach($result[2] as $job)
     	<tr>
       		<td>{{$job->getCompany()}}</td>
       		<td>{{$job->getPosition()}}</td>       		
       		<td>{{$job->getStartDate()}}</td>
       		<td>{{$job->getEndDate()}}</td>
       		<td>{{$job->getDescription()}}</td>
       		<td>
            	<form method="post" action="deleteHistory">
                	<input type = "hidden" name = "id" value = "{{$job->getId()}}">
                	<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                	<button class="btn btn-danger" type="submit">Delete</button>
            	</form>
        	</td>    
        @endforeach
     </table>
     </div>
     </div>
     	<button class="btn btn-success" onclick="window.location.href = 'editPortfolio';">Add new Data</button>
    
     
@endsection