<?php

namespace appComercial\Http\Controllers\Api;

use Illuminate\Http\Request;

use appComercial\Http\Requests;
use appComercial\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function sendResponse($result, $message){
        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404){
        $response = [
            "success" => false,
            "error" => $error,
            "errorMessages" => $errorMessages
        ];

        return response()->json($response, $code);
    }
}
