<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    public function index(Request $request){
    	if($request->type == 'login'){
    		$this->validate($request, [
            	'email' => 'required|email|min:4',
            	'password' => 'required|string|min:8',            
        	]);
    	}

    	if($request->type == 'register'){
    		$this->validate($request, [
            	'name' => 'required|string|min:4|unique:users',
	            'email' => 'required|email|min:4|unique:users',
	            'password' => 'required|string|min:8|confirmed',            
	        ]);
    	}

    	return response()->json(['validate' => true], 200);
    	
    }

}
