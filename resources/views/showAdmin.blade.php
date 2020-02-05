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
    	<h2>Administration</h2>
@endsection

@section('content')
<!-- action will point to the route -->
    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">
        <form action="doAdmin" method = "post">
        <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
        
        </form>
        </div>
        </div>
    </div>
@endsection