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
    	<h2>Job Postings</h2>
@endsection

@section('content')
<!-- Education -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    		
    	<h3>Job Posts</h3>
    	@foreach($result as $job)
    	<form method="post" action="editJobPosting">
    		<b>Edit Job Post</b>
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<input type="hidden" name="id" value="{{$job->getJobId()}}" />
    		<div class="form-group">
    			<label for="company">Company</label> 
    			<input type="text" class="form-control"	value="{{$job->getCompany()}}" name="company" required>
    		</div>
    		<div class="form-group">
    			<label for="position">Position</label> 
    			<input type="text" class="form-control"	value="{{$job->getPosition()}}" name="postion" required>
    		</div>
    		<div class="form-group">
    			<label for="description">Description</label> 
    			<input type="text" class="form-control"	value="{{$job->getDescription()}}" required>
    		</div>
    		<div class="form-group">
    			<label for="requirements">Requirements</label> 
    			<input type="text" class="form-control"	value="{{$job->getRequirements()}}" name="requirements" required>
    		</div>
    		<div class="form-group">
    			<label for="pay">Pay</label> 
    			<input type="text" class="form-control"	value="{{$job->getPay()}}" name="pay" required>
    		</div>
    		<div class="form-group">
    			<label for="postingDate">Posting Date</label> 
    			<input type="text" class="form-control"	value="{{$job->getPostingDate()}}" name="description" required>
    		</div>
    		<button class="btn btn-primary" type="submit">Edit</button>
    	</form>
    	<form method="post" action="deleteJobPosting">
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<input type="hidden" name="id" value="{{$job->getJobId()}}"> 
    		<button class="btn btn-danger" type="submit">Delete</button>
    	</form>
		@endforeach
		
		
		<form method="post" action="addJobPosting">
    		<b>Add Job Post</b>
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<div class="form-group">
    			<label for="company">Company</label> 
    			<input type="text" class="form-control" name="company" required>
    		</div>
    		<div class="form-group">
    			<label for="position">Position</label> 
    			<input type="text" class="form-control"	 name="postion" required>
    		</div>
    		<div class="form-group">
    			<label for="description">Description</label> 
    			<input type="text" class="form-control"	 required>
    		</div>
    		<div class="form-group">
    			<label for="requirements">Requirements</label> 
    			<input type="text" class="form-control"	name="requirements" required>
    		</div>
    		<div class="form-group">
    			<label for="pay">Pay</label> 
    			<input type="text" class="form-control"	 name="pay" required>
    		</div>
    		<div class="form-group">
    			<label for="postingDate">Posting Date</label> 
    			<input type="text" class="form-control"name="description" required>
    		</div>
    		<button class="btn btn-success" type="submit">Add</button>
    	</form>
        </div>
     </div>
     </div>
     
@endsection