<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helper;
use Validator;
use Auth;


class Usercontroller extends Controller
{
    public function adduser(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'username' => 'required|string|max:20|min:4|unique:users',
            'password' => 'required|min:6|',

            'name' => 'required|array',
            'name.first' => 'required',
            'name.last' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
            'role' => 'required|in:admin,user',
            'access' => 'sometimes', 
            'status' => 'required|in:inactive,active', 
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $user = User::create([
            'id' => str_random(10),
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role' => $request->role,
            'access' => $request->access,
            'status' => $request->status
        ]);

        if($user){

            return response()->json([ "message" => "success" , "data" => $user], 200);
        } else{

            return response()->json([ "message" => "failed" , "data" => "unable to create login credentials" ], 500);
        }
        
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [ 
            'username' => 'required|exists:users',
            'password' => 'required'
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $credentials = $request->only(['username', 'password']);

        if(Auth::attempt(["username" => $credentials['username'], "password" => $credentials['password']])){

            $request->request->add([
                "grant_type" => "password",
                "client_id" => env('CLIENT_ID'),
                "client_secret" => env('CLIENT_SECRET'),
                "username" => $credentials['username'],
                "password" => $credentials['password'],
            ]);
    
            $authRequest = $request->create(
                env('APP_URL').'/oauth/token',
                'post'
            );

            $token = Helper::getToken($authRequest);

            return response()->json(["message" => $token['message'], "token" => $token['data']], $token['status']);

        }
        
    }

    public function refresh(Request $request){
        
        $token = Helper::refreshToken($request, $request->refreshtoken);

        return response()->json(["message" => $token['message'], "token" => $token['data']], $token['status']);
        
    }


}
