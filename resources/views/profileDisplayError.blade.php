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
@section('head','Profile Display Failed')
@section('title', 'Profile Display Failed')
@section('content')

@isset($data)
	@if($data == "educationInsert")
	<p>Error Inserting Data to the education Table</p>
	@endif
	@if($data == "JobHistoryInsertion")
	<p>Error Inserting Data to the job history Table</p>
	@endif
	@if($data == "connection")
	<p>Error connecting to database</p>
	@endif
@endisset
@endsection