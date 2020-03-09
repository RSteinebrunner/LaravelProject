<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Group Module
Authors: Jack Setrak, Roland Steinebrunner
Date: 2/23/2020
Synopsis: 
Version#: 3
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Edit Groups')

@section('title')
    	<h2>Edit Postings</h2>
@endsection

@section('content')
<!-- Edit Group Posting -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    		
    	<h3>Edit group</h3>
    	@foreach($result as $group)
    	<form method="post" action="editGroupPosting">
    		<b>Edit Group Post</b>
    		<input type="hidden" name="_token" value="{{csrf_token()}}" />
    		<input type="hidden" name="id" value="{{$group->getGroupId()}}" />
    		<input type="hidden" name="ownerId" value="{{$group->getUserId()}}" />
    		
    		<div class="form-group">
    			<label for="groupName">Group Name</label> 
    			<input type="text" class="form-control"	value="{{$group->getName()}}" name="groupName" required>
    		</div>    		
    		{{$errors->first('groupName')}}
    		
    		<div class="form-group">
    			<label for="position">Description</label> 
    			<input type="text" class="form-control"	value="{{$group->getDescription()}}" name="description" required>
    		</div>  		
    		{{$errors->first('description')}}
    		
    		<button class="btn btn-primary" type="submit">Save Changes</button>   		
    	</form>
    	<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#delete{{$group->getGroupId()}}">Delete</button>
    	
      			
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

        </div>
     </div>
     </div>
     
@endsection