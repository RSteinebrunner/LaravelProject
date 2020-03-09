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
@section('head','Job Posting')

@section('title')
    	<h2>Job Postings</h2>
@endsection

@section('content')
<!-- Education -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<table class="table table-dark">
    	<tr><th scope="col">Company</th>
    	<th scope="col">Position</th>
    	<th scope="col">Description</th>
    	<th scope="col">Requirements</th>
    	<th scope="col">Pay</th>
    	<th scope="col">Posting Date</th>
    	<th scope="col">Interested?</th>
    	<th scope="col">*Actions*</th>    	
    	
    	</tr>
        		@foreach($result as $job)
        		<tr>
        			<td>{{$job->getCompany()}}</td>
        			<td>{{$job->getPosition()}}</td>
        			<td>{{$job->getDescription()}}</td> 
        			<td>{{$job->getRequirements()}}</td>
        			<td>{{$job->getPay()}}</td>
        			<td>{{$job->getPostingDate()}}</td> 
        			<td>
    					<button class="btn btn-success" type="submit">Apply</button>
        			</td>
        			<td>
        			    <button class="btn btn-warning" type="submit">  Edit  </button>       			
    					<button class="btn btn-danger" type="submit">Delete</button>
        			</td>		
        		</tr>
        		
        		@endforeach
        </table>
        </div>
     </div>
     
@endsection