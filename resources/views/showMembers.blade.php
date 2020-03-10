<!--  
Project name/Version: LaravelCLC Version: 5
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 3/9/2020
Synopsis: View page that shows the login page when a user attempts to sign into their account
Version#: 3
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Members')

@section('title')
    	<h2>Members</h2>
@endsection

@section('content')
<!-- Groups -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<table class="table table-dark">
    	<tr>
        	<th scope="col">Group Name</th>
        	<th scope="col">Description</th>
        	<th scope="col">Member Id</th>
        	    	
    	</tr>
        		@foreach($result as $member)
        		
        		<tr>
        			<td>{{$member->getName()}}</td>
        			<td>{{$member->getDescription()}}</td>
        			<td>{{$member->getUserId()}}</td> 
        
        		</tr>    
        		
        		@endforeach
        </table>
                
        </div>
     </div>
     
@endsection