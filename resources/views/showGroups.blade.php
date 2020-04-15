<!--  
Project name/Version: LaravelCLC Version: 6
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 3/9/2020
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
        	@if(Session::get('Role') == "admin")
    		<th scope="col">*Actions*</th>    	
    		@endif 	    	
    	</tr>
        		@foreach($result as $group)
        		
        		<tr>
        			<td>{{$group->getName()}}</td>
        			<td>{{$group->getDescription()}}</td>
        			<td>Owner ID: {{$group->getUserId()}}</td> 

        			<td>
        			<form action="joinGroup" method="post">
        			    <input type="hidden" name="groupID" value="{{$group->getGroupId()}}" /> 
        			    <input type="hidden" name="userID" value="{{Session::get('User')->getId()}}" /> 
        			    <input type="hidden" name="_token" value="{{csrf_token()}}" />        			    
        			    <button class="btn btn-success" type="submit" >Join</button>
        			</form>
        			</td>
        			
        			<td>
        			@if(Session::get('Role') == "admin")   	
        			<form action="editGroup" method="post">
        			    <input type="hidden" name="id" value="{{$group->getGroupId()}}" /> 
        			    <input type="hidden" name="_token" value="{{csrf_token()}}" />        			    
        			    <button class="btn btn-warning" type="submit" >Edit</button>
        			</form>
      					<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#delete{{$group->getGroupId()}}">Delete</button>
      				
    					
        			</td>	
        			@endif
        		</tr>    
        		<!-- The Modal -->
				<div class="modal fade" id="delete{{$group->getGroupId()}}">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title text-center">Delete Group?</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body" >
								<form action="deleteGroupPosting" method="post">
      								<input type="hidden" name="id" value="{{$group->getGroupId()}}" />
      								<input type="hidden" name="_token" value="{{csrf_token()}}" />        			         					      					
      								<button class="btn btn-danger" type="submit">Delete</button>
      							</form>	
							</div>
						</div>
					</div>
				</div>    		
        		@endforeach
        </table>
        
		<a href="addGroups" class="btn btn-success">Create your own Group</a>
        
        </div>
     </div>
     
@endsection