<!--  
Project name/Version: LaravelCLC Version: 1
Module name: loginSuccess
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: View page that shows when a user successfully logs in
Version#: 1
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Login Success')
@section('title','You have logged in successfuly')


@section('content')
@php
    echo "ROLE: ". Session::get('Role');
    echo "USER: ". Session::get('User')->toString();
@endphp
<p>Click <a href="login">here</a> to return to the login page.</p>
@endsection