<?php

namespace App\Helpers;

class Restfull
{
    protected static $response = [
        'api' =>[
            'api_accsess_status' => 200,
            'data_status' => null,
            'message' => null,
        ],
        'data_response' =>[
        'data' => null,
        ],
    ];
    public static function createApi($code = null, $message = null, $data = null)
    {
        self::$response['api']['status'] = $code;
        self::$response['api']['message'] = $message;
        self::$response['data_response']['data'] = $data;

        return response()->json(self::$response, $code);
    }
}
