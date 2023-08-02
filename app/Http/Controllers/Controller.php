<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendJSONError($errorMessage, $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $errorMessage,
        ];

        return response()->json($response, $code);
    }

    public function sendJSONSuccess($data, $message = '', $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];


        return response()->json($response, $code);
    }
}
