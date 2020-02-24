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

@section('title', 'My Profile')
    

@section('content')
    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">  
	<form action="updateDetails" method="post">
	<input type = "hidden" name = "id" value = "{{Session::get('User')->getId()}}">
	<input type = "hidden" name = "role" value = "{{Session::get('User')->getRole()}}">
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    
    <div class="form-group">
		<label for="firstName"><b>First Name:</b></label>
    	<input type="text"class = "form-control" value="{{Session::get('User')->getFirstName()}}" name="firstName" >
    </div>
    
    <div class="form-group">
    	<label for="lastName"><b>Last Name:</b></label>
    	<input type="text"class = "form-control" value="{{Session::get('User')->getLastName()}}" name="lastName" >
    </div>
    
    <div class="form-group">
    	<label for="username"><b>Username:</b></label>
    	<input type="text" class = "form-control" value="{{Session::get('User')->getUsername()}}" name="username" >
    </div>
    
    <div class="form-group">
   		<label for="password"><b>Password:</b></label>
    	<input type="text"class = "form-control" value="{{Session::get('User')->getPassword()}}" name="password" >
    </div>
    
    <div class="form-group">	
    	<label for="age"><b>Age:</b></label>
    	<input type="text"class = "form-control" value="{{Session::get('User')->getAge()}}" name="age" min="13" >
	</div>
	
    <div class="form-group">
    	<label for="email"><b>Email:</b></label>
    	<input type="text"class = "form-control" value="{{Session::get('User')->getEmail()}}" name="email" >
	</div>
	
	<div class="form-group">
    	<label for="gender"><b>Gender:</b></label>
    	<input type="text" class = "form-control" value="{{Session::get('User')->getGender()}}" name="gender" >
    </div>
    
    <div class="form-group">
    	<label for="address"><b>Address:</b></label>
    	<input type="text" class = "form-control" value="{{Session::get('User')->getAddress()}}" name="address" >
    </div>
    
    <div class="form-group">
    	<label for="hometown"><b>Hometown:</b></label>
    	<input type="text" class = "form-control" value="{{Session::get('User')->getHometown()}}" name="hometown" >
    </div>
	
	<div class="form-group">
    	<label for="username"><b>Phone Number:</b></label>
    	<input type="text" class = "form-control" value="{{Session::get('User')->getPhoneNumber()}}" name="phoneNumber" >
    </div>
	
    <button class="btn btn-success" type="submit">Update</button>
    <hr>
</form>

  </div>
  </div>
  </div>
  
@endsection