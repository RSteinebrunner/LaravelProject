<!--  
Project name/Version: LaravelCLC Version: 1
Module name: showUserDetails
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: View page that shows the user info page when viewing an account
Version#: 1
References: N/A
-->
@extends('layouts.appmaster')

@section('head','Details')

@section('title')
    <h1>{{$result->getUsername()}}'s Profile</h1>
@endsection
@section('content')
    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">  
<form action="" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    
    <div class="form-group">
		<label for="firstName"><b>First Name:</b></label>
    	<input type="text"class = "form-control" value="{{$result->getFirstName()}}" name="firstName" readonly>
    </div>
    
    <div class="form-group">
    	<label for="lastName"><b>Last Name:</b></label>
    	<input type="text"class = "form-control" value="{{$result->getLastName()}}" name="lastName" readonly>
    </div>
    
    <div class="form-group">
    	<label for="username"><b>Username:</b></label>
    	<input type="text" class = "form-control" value="{{$result->getUsername()}}" name="username" readonly>
    </div>
    
    <div class="form-group">
   		<label for="password"><b>Password:</b></label>
    	<input type="text"class = "form-control" value="{{$result->getPassword()}}" name="password" readonly>
    </div>
    
    <div class="form-group">	
    	<label for="age"><b>Age:</b></label>
    	<input type="text"class = "form-control" value="{{$result->getAge()}}" name="age" min="13" readonly>
	</div>
	
    <div class="form-group">
    	<label for="email"><b>Email:</b></label>
    	<input type="text"class = "form-control" value="{{$result->getEmail()}}" name="email" readonly>
	</div>
	
	<div class="form-group">
    	<label for="gender"><b>Gender:</b></label>
    	<input type="text" class = "form-control" value="{{$result->getGender()}}" name="gender" readonly>
    </div>
    
    <div class="form-group">
    	<label for="address"><b>Address:</b></label>
    	<input type="text" class = "form-control" value="{{$result->getAddress()}}" name="address" readonly>
    </div>
    
    <div class="form-group">
    	<label for="hometown"><b>Hometown:</b></label>
    	<input type="text" class = "form-control" value="{{$result->getHometown()}}" name="hometown" readonly>
    </div>
	
	<div class="form-group">
    	<label for="username"><b>Phone Number:</b></label>
    	<input type="text" class = "form-control" value="{{$result->getPhoneNumber()}}" name="phoneNumber" readonly>
    </div>
	
    <hr>
</form>
<table class = "table">
					<td style = "text-align:center">
        			<form method="post" action="deleteUser">
        			<input type = "hidden" name = "id" value = "{{$result->getId()}}">
        			<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        			<button class="btn btn-danger" type="submit">Delete</button>
        			</form>
        			</td>
        			
        			<td style = "text-align:center">
        			<form method="post" action="suspendUser">
        			<input type = "hidden" name = "id" value = "{{$result->getId()}}">
        			<input type = "hidden" name = "status" value = "{{$result->getStatus()}}">
        			<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        			@if($result->getStatus() == "false")
        			<button class="btn btn-warning" type="submit">Suspend</button>
        			@else
        			<button class="btn btn-success" type="submit">Reinstate</button>
        			@endif
        			</form>
        			</td>
</table>
  </div>
  </div>
  </div>
  
@endsection