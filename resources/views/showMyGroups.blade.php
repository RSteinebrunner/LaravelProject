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
    	<h2>My Groups</h2>
@endsection

@section('content')
<!-- Groups -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<h4>Groups I Own</h4>
    	</div>
    	<div class = "col">
    	<table class="table table-dark">
    	<tr>
        	<th scope="col">Group Name</th>
        	<th scope="col">Description</th>
        	<th scope="col">Owner</th>
    		<th scope="col">*Actions*</th>    	
    			    	
    	</tr>
        		@foreach($result[0] as $group)
        		
        		<tr>
        			<td>{{$group->getName()}}</td>
        			<td>{{$group->getDescription()}}</td>
        			<td>Owner ID: {{$group->getUserId()}}</td> 
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
    </div>
 </div>
        
        <div class="row justify-content-center">
        <div class = "col">
    	<h4>Groups I Am In</h4>
    	</div>
    	<div class = "col">
        <table class="table table-dark">
    	<tr>
        	<th scope="col">Group Name</th>
        	<th scope="col">Description</th>
        	<th scope="col">Owner</th>
    		<th scope="col">*Actions*</th>   	
    			    	
    	</tr>
        		@foreach($result[1] as $group)
        		
        		<tr>
        			<td>{{$group->getName()}}</td>
        			<td>{{$group->getDescription()}}</td>
        			<td>Owner ID: {{$group->getUserId()}}</td> 
        			<td>
        			
        			<form action="leaveGroup" method="post">
        			    <input type="hidden" name="userID" value="{{$group->getUserId()}}" /> 
        			    <input type="hidden" name="groupID" value="{{$group->getGroupId()}}" />
        			    <input type="hidden" name="_token" value="{{csrf_token()}}" />        			    
        			    <button class="btn btn-danger" type="submit" >Leave</button>
        			</form>
        			</td>	
        		</tr>        		
        		@endforeach
        </table>
        
        </div>
     </div>
</div>
     
@endsection