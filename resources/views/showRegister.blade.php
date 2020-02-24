<!--  
Project name/Version: LaravelCLC Version: 1
Module name: showRegister
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: View page that shows the registeration page when signing up for an account
Version#: 1
References: N/A
-->
@extends('layouts.appmaster')

@section('head','Sign Up')

@section('title')
@isset($error)
  	<div class="alert alert-warning">
    <strong>Warning!</strong> This user is a duplicate. Please try again with another username.
   </div>	
@endisset
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
@endsection
@section('content')

    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">  
<form action="doRegister" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    
    <div class="form-group">
		<label for="firstName"><b>First Name:</b></label>
    	<input type="text"class = "form-control" placeholder="Enter your first name" name="firstName" required>
    </div>
    
    <div class="form-group">
    	<label for="lastName"><b>Last Name:</b></label>
    	<input type="text"class = "form-control" placeholder="Enter your last name" name="lastName" required>
    </div>
    
    <div class="form-group">
    	<label for="username"><b>Username:</b></label>
    	<input type="text" class = "form-control"placeholder="Enter your username" name="username" required>
    </div>
    
    <div class="form-group">
   		<label for="password"><b>Password:</b></label>
    	<input type="password"class = "form-control" placeholder="Enter your password" name="password" required>
    </div>
    
    <div class="form-group">	
    	<label for="age"><b>Age:</b></label>
    	<input type="number"class = "form-control" placeholder="Enter your age" name="age" min="13" required>
	</div>
	
    <div class="form-group">
    	<label for="email"><b>Email:</b></label>
    	<input type="text"class = "form-control" placeholder="Enter your email" name="email" required>
	</div>
	
	<div class="form-group">
    	<label for="gender"><b>Gender:</b></label>
    	<input type="text" class = "form-control" placeholder="Enter your gender" name="gender" required>
    </div>
    
    <div class="form-group">
    	<label for="address"><b>Address:</b></label>
    	<input type="text" class = "form-control"placeholder="Enter your address" name="address" required>
    </div>
    
    <div class="form-group">
    	<label for="hometown"><b>Hometown:</b></label>
    	<input type="text" class = "form-control" placeholder="Enter where you are from" name="hometown" required>
    </div>
	
	<div class="form-group">
    	<label for="phoneNumber"><b>Phone Number:</b></label>
    	<input type="text" class = "form-control"placeholder="Enter your phone number" name="phoneNumber" required>
    </div>
	
    <hr>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
  </div>
  </div>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="login">Sign in</a>.</p>
  </div>
@endsection