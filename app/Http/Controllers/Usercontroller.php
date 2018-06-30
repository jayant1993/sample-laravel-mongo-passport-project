<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class Usercontroller extends Controller
{
    public function create(Request $request){
        $create = User::create([
            "name" => "Jayant Nirmalkar",
            "email" => "n.jayant7@gmail.com",
            "mobile" => "9589693757",
            "username" => "jayant",
            "password" => bcrypt("jayant")
        ]);

        if($create){
            return $create;
        } else{
            return "Something went wrong";
        }
    }

    public function list(Request $request){
        return User::get();   
    }
}
