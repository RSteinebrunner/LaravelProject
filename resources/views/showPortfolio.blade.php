<!--  
Project name/Version: LaravelCLC Version: 5
Module name: Portfolio Module
Authors: Roland Steinebrunner, Anthony Clayton
Date: 3/9/2020
Synopsis: show all the information from the portfolio to the user, including skills, education and job history
Version#: 4
References: N/A
-->

@extends('layouts.appmaster') @section('head','Education')

@section('title') @isset($error)
<div class="alert alert-warning">
	<strong>Warning!</strong> Error adding education to the portfolio.
	Please try again.
</div>
@endisset
<h2>Portfolio</h2>
@endsection @section('content')
<!-- Education -->
<div class="container">
	<div class="row justify-content-center">
		<table class="table table-dark">
			<tr>
				<td>{{Session::get('User')->getFirstName()}}</td>
			</tr>
			<tr>
				<td>{{Session::get('User')->getLastName()}}</td>
			</tr>
			<tr>
				<td>{{Session::get('User')->getAge()}}</td>
			</tr>
			<tr>
				<td>{{Session::get('User')->getEmail()}}</td>
			</tr>
			<tr>
				<td>{{Session::get('User')->getPhoneNumber()}}</td>
			</tr>
		</table>
	</div>
	<div class="row justify-content-center">
		<div align="center">
			<h2>Education</h2>
			<hr>
		</div>
	</div>

	@foreach($result[0] as $array)
	<div class="row">
		<div class="col">
			<div class="card-deck">
				@foreach($array as $edu)
				<div class="card text-white bg-secondary mb-3"
					style="max-width: 15rem;">
					<div class="card-header">
						<h5>{{$edu->getSchool()}}</h5>
					</div>
					<div class="card-body">
						<h6 class="card-title">{{$edu->getDegree()}}</h6>
						<p class="card-text">Years attended: {{$edu->getEducationYears()}}
							| GPA: {{$edu->getGPA()}}</p>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#deleteEdu{{$edu->getEducationId()}}">Delete</button>
					</div>
				</div>
				
				<!-- The Modal -->
				<div class="modal fade" id="deleteEdu{{$edu->getEducationId()}}">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title text-center">Delete Education?</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body" >
								<form method="post" action="deleteEducation">
									<input type="hidden" name="id" value="{{$edu->getEducationId()}}">
									<input type="hidden" name="_token" value="{{ csrf_token()}}" />
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
	@endforeach
	<div class="row">
		<div class="col">
			<button class="btn btn-success"
				onclick="window.location.href = 'newEducation';">Add New</button>
		</div>
	</div>
</div>

<div class="container">
	<div class="row justify-content-center">
		<div align="center">
			<h2>Skills</h2>
			<hr>
		</div>
	</div>
	@foreach($result[1] as $array)
	<div class="row">
		<div class="col">
			<div class="card-deck">
				@foreach($array as $skill)
				<div class="card text-white bg-secondary mb-3"
					style="max-width: 12rem">
					<div class="card-body">
						<h6 class="card-title">{{$skill->getSkill()}}</h6>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#deleteSkill{{$skill->getSkillId()}}">Delete</button>
					</div>
				</div>
				
				<!-- The Modal -->
				<div class="modal fade" id="deleteSkill{{$skill->getSkillId()}}">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Delete Skill?</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body">
								<form method="post" action="deleteSkill">
									<input type="hidden" name="id" value="{{$skill->getSkillId()}}">
									<input type="hidden" name="_token" value="{{ csrf_token()}}" />
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
	@endforeach
	<div class="row">
		<div class="col">
			<button class="btn btn-success"
				onclick="window.location.href = 'newSkills';">Add New</button>
		</div>
	</div>
</div>


<div class="container">
	<div class="row justify-content-center">
		<div align="center">
			<h2>Job History</h2>
			<hr>
		</div>
	</div>
	@foreach($result[2] as $array)
	<div class="row">
		<div class="col">
			<div class="card-deck">
				@foreach($array as $job)
				<div class="card text-white bg-secondary mb-3"
					style="max-width: 22rem;">
					<div class="card-header">
						<h5>{{$job->getCompany()}}</h5>
					</div>
					<div class="card-body">
						<h6 class="card-title">{{$job->getPosition()}}</h6>
						<p class="card-text">Description: {{$job->getDescription()}}</p>
						<p class="card-text">Start Date: {{$job->getStartDate()}} | End
							Date: {{$job->getEndDate()}}</p>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#deleteJob{{$job->getId()}}">Delete</button>
					</div>
				</div>
					<!-- The Modal -->
				<div class="modal fade" id="deleteJob{{$job->getId()}}">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Delete Job History?</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body">
								<form method="post" action="deleteHistory">
							<input type="hidden" name="id" value="{{$job->getId()}}"> <input
								type="hidden" name="_token" value="{{ csrf_token()}}" />
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
	@endforeach
	<div class="row">
		<div class="col">
			<button class="btn btn-success"
				onclick="window.location.href = 'newJobHistory';">Add New</button>
		</div>
	</div>
</div>


@endsection
