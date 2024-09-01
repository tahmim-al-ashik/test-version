<?php

namespace App\Helpers;

class ApiResponse
{
    static function sendResponse($status = 200, $msg = null, $data = [])
    {
        $response = [
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ];

        return response()->json($response, $status);
    }
}

##########app->ApiResponse.php###############
