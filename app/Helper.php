<?php

namespace App;

use App\User; 

class Helper
{
    public static function getToken($credentials){
        
        $response = (new GuzzleHttp\Client)->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'username' => $credentials['username'],
                'password' => $credentials['password'],
                'scope' => '',
            ]
        ]);
        
        return $response;
    }

    public function refreshToken(){

    }

    public function validateToken(){

    }
}