<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 2/23/2020
Synopsis: View page that shows the login page when a user attempts to sign into their account
Version#: 3
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Groups')

@section('title')
    	<h2>Group Postings</h2>
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
        	<th scope="col">Owner</th>
        	
        	<th scope="col">Interested?</th>
        	
        	<th scope="col">*Actions*</th>    	    	
    	</tr>
        		@foreach($result as $group)
        		
        		<tr>
        			<td>{{$group->getName()}}</td>
        			<td>{{$group->getDescription()}}</td>
        			<td>{{$group->getUserId()}}</td> 

        			<td>
    					<button class="btn btn-success" type="submit">Apply</button>
        			</td>
        			<td>
        				      	
        			<form action="editGroup" method="post">
        			    <input type="hidden" name="id" value="{{$group->getGroupId()}}" /> 
        			    <input type="hidden" name="_token" value="{{csrf_token()}}" />        			    
        			    <button class="btn btn-warning" type="submit" >Edit</button>
        			</form>
      					
      				<form action="deleteGroupPosting" method="post">
      					<input type="hidden" name="id" value="{{$group->getGroupId()}}" />
      					<input type="hidden" name="_token" value="{{csrf_token()}}" />        			         					      					
      					<button class="btn btn-danger" type="submit">Delete</button>
      				</form>
    					
        			</td>		
        		</tr>        		
        		@endforeach
        </table>
        
		<a href="addGroups" class="btn btn-success">Create your own Group</a>
        
        </div>
     </div>
     
@endsection