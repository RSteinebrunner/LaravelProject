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
@php
	if(isset($data)){
	echo "data: ".$data;
	}
	else{
	echo "no data";
	}
@endphp
@endsection