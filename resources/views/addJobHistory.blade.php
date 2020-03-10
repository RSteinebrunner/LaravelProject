<!--  
Project name/Version: LaravelCLC Version: 4
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 2/23/2020
Synopsis: View page that shows the login page when a user attempts to sign into their account
Version#: 3
References: N/A
-->

@extends('layouts.appmaster') @section('head','Education')

@section('title')
<h2>Edit Portfolio</h2>
@endsection @section('content')
	<h3>Job History</h3>
	<form method="post" action="addJobHistory">
		<b>Add More Job History</b>
		<input type="hidden" name="_token" value="{{ csrf_token()}}" />
		<input type="hidden" name="userId" value="{{Session::get('User')->getId()}}"> 
		<div class="form-group">
			<label for="company">Company</label> 
			<input type="text" class="form-control"	placeholder="Enter the company name" name="company" required>
		</div>
		{{$errors->first('company')}}
		<div class="form-group">
			<label for="position">Position</label> 
			<input type="text" class="form-control"	placeholder="Enter your position at the company" name="position" required>
		</div>
		{{$errors->first('position')}}
		<div class="form-group">
			<label for="startDate">Starting Date</label> 
			<input type="text" class="form-control"	placeholder="MM/DD/YYYY" name="startDate" required>
		</div>
		{{$errors->first('startDate')}}
		<div class="form-group">
			<label for="endDate">End Date</label> 
			<input type="text" class="form-control"	placeholder="MM/DD/YYYY" name="endDate" required>
		</div>
		{{$errors->first('endDate')}}
		<div class="form-group">
			<label for="description">Description</label> 
			<input type="text" class="form-control"	placeholder="Please enter a brief description of your role" name="description" required>
		</div>
		{{$errors->first('description')}}
		<button class="btn btn-success" type="submit">Add</button>
	</form>
@endsection
