<!--  
Project name/Version: LaravelCLC Version: 6
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
        echo Session::get('User')->toString();
    @endphp
@endsection