<!--  
Project name/Version: LaravelCLC Version: 6
Module name: Job Posting Module
Authors: Roland Steinebrunner, Jack Setrak
Date: 3/12/2020
Synopsis: View page that shows the login page when a user attempts to sign into their account
Version#: 3
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Job Detailed Posting')

@section('title')
    	<h2>Job Detailed Postings</h2>
@endsection

@section('content')
<!-- Job Posting -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
		<h3>{{$job->getCompany()}}</h3>
		<h5>{{$job->getPosition()}}</h5>
		<h6>Description:</h6>
		<p>{{$job->getDescription()}}</p> 
		<h6>Requirements:</h6>
        <p>{{$job->getRequirements()}}</p>
        <h6>Pay:</h6>
        <p>{{$job->getPay()}}</p>
        <h6>Date Posted:</h6>
        <p>{{$job->getPostingDate()}}</p>
    	<form method="post" action="applyJob">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
    	<input type="hidden" name="id" value = "{{$job->getJobId()}}"> 
        <button class="btn btn-success" type="submit">Apply</button>       			
        </form>
        </div>
     </div>
     
@endsection