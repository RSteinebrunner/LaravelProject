<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 2/23/2020
Synopsis: 
Version#: 3
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Edit Groups')

@section('title')
    	<h2>Edit Postings</h2>
@endsection

@section('content')
<!-- Edit Group Posting -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    		
    	<h3>Edit group</h3>
    	@foreach($result as $group)
    	<form method="post" action="editGroupPosting">
    		<b>Edit Group Post</b>
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<input type="hidden" name="userId" value="{{$group->getUserId()}}" />
    		
    		<div class="form-group">
    			<label for="groupName">Group Name</label> 
    			<input type="text" class="form-control"	value="{{$group->getName()}}" name="groupName" required>
    		</div>    		
    		{{$errors->first('groupName')}}
    		
    		<div class="form-group">
    			<label for="position">Description</label> 
    			<input type="text" class="form-control"	value="{{$group->getDescription()}}" name="description" required>
    		</div>  		
    		{{$errors->first('description')}}
    		
    		<div class="form-group">
    			<label for="owner">Owner</label> 
    			<input type="text" class="form-control"	value="{{$group->getUserId()}}" name ="owner" required>
    		</div>
    		{{$errors->first('owner')}}
    		
    		<button class="btn btn-primary" type="submit">Save Changes</button>
    		
    	</form>
    	
    	<form method="post" action="deleteJobPosting">
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<input type="hidden" name="id" value="{{$job->getJobId()}}"> 
    		<button class="btn btn-danger" type="submit">Delete</button>
    	</form>
    	
		@endforeach		

        </div>
     </div>
     </div>
     
@endsection