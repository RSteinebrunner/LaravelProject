<!--  
Project name/Version: LaravelCLC Version: 1
Module name: showLogin
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: View page that shows the login page when a user attempts to sign into their account
Version#: 2
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Login')

@section('title')
    	<h2>Edit User</h2>
@endsection

@section('content')
<!-- action will point to the route -->
    <div class="container-fluid">
        <div class="row">
        <div class="col-5">       
        <h5>Fill out all of the fields and submit</h5>
            <form action="doEditUser">
           <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="userEmail" class = "form-control" value = " "></input>
            </div>
            <div class="form-group">
            	<label for="userPassword">User Password</label>
            	<input type="text" name="userPassword" class = "form-control" value = " "></input>
            </div>
            <div class="form-group">
            	<label for="userRole">User Role</label>
            	<input type="text" name="userRole" class = "form-control" value = ""></input>
            </div>
            <button class="btn btn-primary" type="submit">Submit Changes</button>
        </form>
        </div>
        </div>
        </div>
@endsection
