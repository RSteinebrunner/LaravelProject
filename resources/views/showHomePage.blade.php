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
@section('head','HomePage')
@section('title','Home Page')

@section('content')
    @php
        echo "Weclome back, " . Session::get('User')->getUsername();
    @endphp
@endsection