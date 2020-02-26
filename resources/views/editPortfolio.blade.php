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
<div class="container">
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
	<br />
	<h3>Skills</h3>
	<form method="post" action="addSkill">
		<b>Add More Skills</b>
		<div class="form-group">
			<select id="skill" name="skill">
				<option value="AGILE">AGILE</option>
				<option value="Java">Java</option>
				<option value="Laravel Framework">Laravel Framework</option>
				<option value="C# .NET">C# .NET</option>
				<option value="Crying">Crying</option>
			</select>
		</div>
		<input type="hidden" name="id"
			value="{{Session::get('User')->getId()}}"> <input type="hidden"
			name="_token" value="{{ csrf_token()}}" />
		<button class="btn btn-success" type="submit">Add</button>
	</form>
	<br />
	
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
			<input type="text" class="form-control"	placeholder="Enter your position at the company" name="postion" required>
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

</div>
@endsection
