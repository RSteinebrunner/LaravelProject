<!DOCTYPE html>
<html lang="en">
@php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
@endphp
<head>
	<title>@yield('head')</title>
	  <style type="text/css">
   body { background-color: #D4D3D3 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    @include('layouts.header')
    	<div align="center">
    		<h2>@yield('title')</h2>
    	</div>
    	<hr>
    	<div align="left">
    		@yield('content')
    	</div>
</body>

</html>