<!--  
Project name/Version: LaravelCLC Version: 5
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
    	<table class="table table-dark">
    	<tr><th scope="col">Company</th>
    	<th scope="col">Position</th>
    	<th scope="col">Description</th>
    	<th scope="col">Requirements</th>
    	<th scope="col">Pay</th>
    	<th scope="col">Posting Date</th> 
    	<th scope="col">Interested?</th>
    	@if(Session::get('Role') == "admin")
    	<th scope="col">*Actions*</th>    	
    	@endif
    	
    	</tr>
        		<tr>
        			<td>{{$job->getCompany()}}</td>
        			<td>{{$job->getPosition()}}</td>
        			<td>{{$job->getDescription()}}</td> 
        			<td>{{$job->getRequirements()}}</td>
         			<td>{{$job->getPay()}}</td>
        			<td>{{$job->getPostingDate()}}</td>
        			<td>
    					<button class="btn btn-success" type="submit">Apply</button>
        			</td>
        			@if(Session::get('Role') == "admin")
        			<td>
        			<form action="adminJobPosting">
        				<input type="hidden" name="_token" value="{{csrf_token()}}" />
    					<input type="hidden" name="id" value="{{$job->getJobId()}}"> 
        			    <button class="btn btn-warning" type="submit">Edit</button>       			
        			</form>
        			<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#delete{{$job->getJobId()}}">Delete</button>
        			</td>	
        			@endif	
        		</tr>
        		<!-- The Modal -->
				<div class="modal fade" id="delete{{$job->getJobId()}}">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title text-center">Delete Job Posting?</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body" >
								<form method="post" action="deleteJobPosting">
    								<input type="hidden" name="_token" value="{{csrf_token()}}" />
    								<input type="hidden" name="id" value="{{$job->getJobId()}}"> 
    								<button class="btn btn-danger" type="submit">Delete</button>
    							</form>	
							</div>
						</div>
					</div>
				</div>
        </table>
        </div>
     </div>
     
@endsection