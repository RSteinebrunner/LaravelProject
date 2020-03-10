<!--  
Project name/Version: LaravelCLC Version: 5
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
	<h3>Education</h3>
	<form method="post" action="addEducation">
		<b>Add More Education</b>
		<div class="form-group">
			<label for="years">Years Attended:</label> <input type="text"
				class="form-control"
				placeholder="Enter the number of years attended" name="years"
				>
		</div>
		{{$errors->first('years')}}
		<div class="form-group">
			<label for="degree">Degree Earned:</label> <input type="text"
				class="form-control" placeholder="Enter the degree earned"
				name="degree" >
		</div>
		{{$errors->first('degree')}}
		<div class="form-group">
			<label for="school">School Attended:</label> <input
				type="text" class="form-control"
				placeholder="Enter the school attended" name="school" >
		</div>
		{{$errors->first('school')}}
		<div class="form-group">
			<label for="gpa">GPA:</label> <input type="text"
				class="form-control"
				placeholder="Enter your average GPA during attendance" name="gpa"
				>
		</div>
		{{$errors->first('years')}}
		<input type="hidden" name="id"
			value="{{Session::get('User')->getId()}}"> <input type="hidden"
			name="_token" value="{{ csrf_token()}}" />
			
		<button class="btn btn-success" type="submit">Add</button>
	</form>
@endsection
