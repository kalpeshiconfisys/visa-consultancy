<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($success, $msg, $data = [], $code = 200)
    {
        if ($success) {
            return response()->json([
                'success' => $success,
                'message' => $msg,
                'data' => $data,
            ], $code);
        } else {
            return response()->json([
                'success' => $success,
                'message' => $msg,
            ], $code);
        }
    }

    public function error($msg = NULL, $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $msg,
        ], $code);
    }

    
}
