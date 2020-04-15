<!--  
Project name/Version: LaravelCLC Version: 6
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 3/9/2020
Synopsis: shows the form to edit a job posting
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
    	<form method="post" action="editJobPosting">
    		<b>Edit Job Post</b>
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<input type="hidden" name="id" value="{{$job->getJobId()}}" />
    		<div class="form-group">
    			<label for="company">Company</label> 
    			<input type="text" class="form-control"	value="{{$job->getCompany()}}" name="company" required>
    		</div>
    		{{$errors->first('company')}}
    		<div class="form-group">
    			<label for="position">Position</label> 
    			<input type="text" class="form-control"	value="{{$job->getPosition()}}" name="position" required>
    		</div>
    		{{$errors->first('position')}}
    		<div class="form-group">
    			<label for="description">Description</label> 
    			<input type="text" class="form-control"	value="{{$job->getDescription()}}" name ="description" required>
    		</div>
    		{{$errors->first('description')}}
    		<div class="form-group">
    			<label for="requirements">Requirements</label> 
    			<input type="text" class="form-control"	value="{{$job->getRequirements()}}" name="requirements" required>
    		</div>
    		{{$errors->first('requirements')}}
    		<div class="form-group">
    			<label for="pay">Pay</label> 
    			<input type="text" class="form-control"	value="{{$job->getPay()}}" name="pay" required>
    		</div>
    		{{$errors->first('pay')}}
    		
    		<div class="form-group">
    			<label for="postingDate">Posting Date</label> 
    			<input type="text" class="form-control"	value="{{$job->getPostingDate()}}" name="postingDate" required>
    		</div>
    		{{$errors->first('postingDate')}}
    		<button class="btn btn-primary" type="submit">Save Changes</button>
    	</form>
    	<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#delete{{$job->getJobId()}}">Delete</button>
    	
    	
		<!-- The Modal -->
				<div class="modal fade" id="delete{{$job->getJobId()}}">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title text-center">Delete Job Posting?</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body" >
								<form method="post" action="deleteJobPosting">
    								<input type="hidden" name="_token" value="{{csrf_token()}}" />
    								<input type="hidden" name="id" value="{{$job->getJobId()}}"> 
    								<button class="btn btn-danger" type="submit">Delete</button>
    							</form>
							</div>
						</div>
					</div>
				</div>
	
@endsection