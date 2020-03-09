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
@section('head','Adding Groups')

@section('title')
    	<h2>Add Group</h2>
@endsection

@section('content')
<!-- Group Posting -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
		
		<form method="post" action="addGroupPosting">
    		<b>Add Group Post</b>
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<input type = "hidden" name = "id" value = "{{Session::get('User')->getId() }}">        	
    		
    		
    		<div class="form-group">
    			<label for="groupName">Group Name</label> 
    			<input type="text" class="form-control" name="groupName" required>
    		</div>
    		{{$errors->first('groupName')}}
    		
    		<div class="form-group">
    			<label for="decription">Description</label> 
    			<input type="text" class="form-control"	 name="description" required>
    		</div>
    		{{$errors->first('description')}}
    		
    		{{$errors->first('owner')}}
    		
    		<button class="btn btn-success" type="submit">Add</button>
    		
    	</form>
    	
        </div>
     </div>
     </div>
     
@endsection