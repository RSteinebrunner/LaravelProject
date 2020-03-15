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
@section('head','Job Search Posting')

@section('title')
    	<h2>Job Search Postings</h2>
@endsection

@section('content')
<!-- Job Posting -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<form method="post" action="searchJobs">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
    	<input type="text" name="terms" placeholder = "Enter something to search"> 
        <button class="btn btn-success" type="submit">Search</button>       			
        </form>
    	<table class="table table-dark">
    	<tr><th scope="col">Company</th>
    	<th scope="col">Position</th>
    	<th scope="col">Description</th>
<!--    <th scope="col">Requirements</th>
    	<th scope="col">Pay</th>
    	<th scope="col">Posting Date</th> -->
    	<th scope="col">Interested?</th>
    	@if(Session::get('Role') == "admin")
    	<th scope="col">*Actions*</th>    	
    	@endif
    	
    	<tbody id="myTable">   	    	
    	</tr>
        		@foreach($job as $job)
        		<tr>
        			<td>{{$job->getCompany()}}</td>
        			<td>{{$job->getPosition()}}</td>
        			<td>{{$job->getDescription()}}</td> 
<!--        		<td>{{$job->getRequirements()}}</td>
         			<td>{{$job->getPay()}}</td>
        			<td>{{$job->getPostingDate()}}</td>  -->
        			<form action="showDetailPage">   
        			<input type="hidden" name="_token" value="{{csrf_token()}}" />
    				<input type="hidden" name="id" value="{{$job->getJobId()}}">     			
        			<td>
    					<button class="btn btn-primary" type="submit">View</button>
        			</td>
        			</form>
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
        		@endforeach
        </tbody>                		
        </table>
        <script type="text/javascript">
         // Filter table
            $(document).ready(function(){
              $("#tableSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>
        </div>
     </div>
     
@endsection