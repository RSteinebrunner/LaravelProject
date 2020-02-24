<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Profile Module
Authors: Roland Steinebrunner
Date: 2/23/2020
Synopsis: View page that shows when an error occurs on the profile page
Version#: 1
References: N/A
-->
@extends('layouts.appmaster')
@section('head','Login Failed')
@section('title', 'Login Failed')
@section('content')

@isset($data)
	@if($data == "educationInsert")
	<p>Error Inserting Data to the education Table</p>
	@endif
@endisset
@endsection