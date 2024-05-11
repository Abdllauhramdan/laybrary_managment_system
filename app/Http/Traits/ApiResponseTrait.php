<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    // response with token (for login - register in auth)
    public function apiResponse($data,$token,$message,$status){

        $array = [
            'data' =>$data,
            'message' =>$message,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        return response()->json($array,$status);
    }

    // custome response for all request
    public function customeResponse($data, $message, $status) {
        $array = [
            'data'=>$data,
            'message'=>$message
        ];

        return response()->json($array, $status);
    }
}
