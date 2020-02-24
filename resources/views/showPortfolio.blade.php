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
    	<h2>Education and Skills</h2>
@endsection

@section('content')
<!-- action will point to the route -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<table class="table table-dark">
    	<tr><th scope="col">Years:</th>
    	<th scope="col">Degree</th>
    	<th scope="col">School</th>
    	</tr>
        		@foreach($result as $edu)
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
        
        
        <form method="post" action="addEducation">
       	 <b><p>Add More Education</p></b>
        	<div class="form-group">
				<label for="years"><p>Years Attended:</p></label>
    			<input type="text"class = "form-control" placeholder="Enter the number of years attended" name="years" required>
    		</div>
    		<div class="form-group">
				<label for="degree"><p>Degree Earned:</p></label>
    			<input type="text"class = "form-control" placeholder="Enter the degree earned" name="degree" required>
    		</div>
    		<div class="form-group">
				<label for="school"><p>School Attended:</p></label>
    			<input type="text"class = "form-control" placeholder="Enter the school attended" name="school" required>
    		</div>
        			
        			
        			
        	<input type = "hidden" name = "id" value = "{{Session::get('User')->getId()}}">
        	<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        	<button class="btn btn-success" type="submit">Add</button>
        </form>
        			
       	</div>
     </div>
    </div>
@endsection