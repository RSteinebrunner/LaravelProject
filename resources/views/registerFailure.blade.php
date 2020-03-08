<!--  
Project name/Version: LaravelCLC Version: 1
Module name: registerFailure
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: View page that shows when a user fails to register
Version#: 1
References: N/A
-->
@extends('layouts.appmaster')
@section('head','Registration Failed')
@section('title', 'There was an error registering your account')
@section('content')
@isset($result)
	{{$result}}
@endisset
<p>Click <a href="register">here</a> to try again.</p>
@endsection
