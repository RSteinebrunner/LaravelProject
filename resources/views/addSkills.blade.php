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
@endsection
