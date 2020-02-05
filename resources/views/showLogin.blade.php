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
    	<h2>Login</h2>
@endsection

@section('content')
<!-- action will point to the route -->
    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">
        <form action="doLogin" method = "post">
        <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
        <div class= "form-group">
            <label for="username">Username:</label>
            <input type="text" class = "form-control" name="username" placeholder = "Enter Username" ></input>
        </div>
        <div class= "form-group">
            <label for="login-password">Password:</label>
            <input type="password" class = "form-control" name="password" placeholder = "Enter Password"></input>
        </div>
            <button class="btn btn-primary" type="submit" name="login" >Login</button>
        </form>
        </div>
        </div>
    </div>
@endsection