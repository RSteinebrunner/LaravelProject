<!--  
Project name/Version: LaravelCLC Version: 1
Module name: loginFailure
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: View page that shows when a user fails to log in
Version#: 1
References: N/A
-->
@extends('layouts.appmaster')
@section('head','Login Failed')
@section('title', 'Login Failed')
@section('content')

@if($result == "Suspended")
<p>Your account is suspended</p>
@else
<p>Please check your credentials and try again</p>
@endif

@endsection