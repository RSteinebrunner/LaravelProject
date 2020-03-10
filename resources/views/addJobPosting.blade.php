<!--  
Project name/Version: LaravelCLC Version: 5
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 3/9/2020
Synopsis: shows the form to add a new job posting to the job board
Version#: 2
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
    		
    	<h3>Add Job Post</h3>
		<form method="post" action="addJobPosting">
    		<b>Add Job Post</b>
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		
    		<div class="form-group">
    			<label for="company">Company</label> 
    			<input type="text" class="form-control" name="company" >
    		</div>
    		{{$errors->first('company')}}
    		<div class="form-group">
    			<label for="position">Position</label> 
    			<input type="text" class="form-control"	 name="position" >
    		</div>
    		{{$errors->first('position')}}
    		<div class="form-group">
    			<label for="description">Description</label> 
    			<input type="text" class="form-control"	 name="description" >
    		</div>
    		{{$errors->first('description')}}
    		<div class="form-group">
    			<label for="requirements">Requirements</label> 
    			<input type="text" class="form-control"	name="requirements" >
    		</div>
    		{{$errors->first('requirements')}}
    		<div class="form-group">
    			<label for="pay">Pay</label> 
    			<input type="text" class="form-control"	 name="pay" >
    		</div>
    		{{$errors->first('pay')}}
    		<div class="form-group">
    			<label for="postingDate">Posting Date</label> 
    			<input type="text" class="form-control"name="postingDate" >
    		</div>
    		{{$errors->first('postingDate')}}
    		<button class="btn btn-success" type="submit">Add</button>
    	</form>
        </div>
     </div>
     </div>
     
@endsection