<?php

//always make sure this matches
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsMyNameController extends Controller
{
    public function index(Request $request)
    {
        //how to display the form data
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        echo "Your name is: " . $firstName. " ". $lastName;
        echo "<br>";
        
        //Render a view and pass the form data
        //add an associative array
        $data=['firstName' => $firstName, 'lastName' => $lastName];
        //pass the view with 'with' and the array
        return view('thatswhoiam') ->with($data);
    }
}
