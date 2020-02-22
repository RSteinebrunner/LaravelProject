<!--  
Project name/Version: LaravelCLC Version: 1
Module name: showLogin
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: View page that shows the login page when a user attempts to sign into their account
Version#: 2
References: N/A
-->

@extends('layouts.appmaster')
@section('head','Admin')

@section('title')
    	<h2>Administration</h2>
@endsection

@section('content')
<!-- action will point to the route -->
    <div class = "container-fluid">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<table class="table table-dark">
    	<tr><th scope="col">Id</th>
    	<th scope="col">Username</th>
    	<th scope="col">First Name</th>
    	<th scope="col">Last Name</th>
    	<th scope="col">Age</th>
    	<th scope="col">Email</th></tr>
        		@foreach($result as $user)
        		<tr>
        			<td>{{$user->getId()}}</td>
        			<td>{{$user->getUsername()}}</td>
        			<td>{{$user->getFirstName()}}</td>
        			<td>{{$user->getLastName()}}</td>
        			<td>{{$user->getAge()}}</td>
        			<td>{{$user->getEmail()}}</td>
        			<td>
        			<form method="post" action="deleteUser">
        			<input type = "hidden" name = "id" value = "{{$user->getId()}}">
        			<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        			<button class="btn btn-danger" type="submit">Delete</button>
        			</form>
        			</td>
        			<td>
        			<form method="post" action="changeRole">
        			<input type = "hidden" name = "id" value = "{{$user->getId()}}">
        			<input type = "hidden" name = "role" value = "{{$user->getRole()}}">
        			<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        			@if($user->getRole() == "user")
        			<button class="btn btn-warning" type="submit">Make Admin</button>
        			@else
        			<button class="btn btn-success" type="submit">Make User</button>
        			@endif
        			</form>
        			</td>
        			<td>
        			<form method="post" action="suspendUser">
        			<input type = "hidden" name = "id" value = "{{$user->getId()}}">
        			<input type = "hidden" name = "status" value = "{{$user->getStatus()}}">
        			<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        			@if($user->getStatus() == "false")
             		<button class="btn btn-warning" type="submit">Suspend</button>
        			@else
        			<button class="btn btn-success" type="submit">Reinstate</button>
        			@endif
        			</form>
        			</td>
        			<td>
        			<form method="post" action="userDetails">
        			<input type = "hidden" name = "id" value = "{{$user->getId()}}">
        			<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        			<button class="btn btn-primary" type="submit">Details</button>
        			</form>
        			</td>
        		</tr>
        		@endforeach
        </table>
       	</div>
     </div>
    </div>
@endsection