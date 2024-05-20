<?php
namespace App\Exceptions;

use Exception;

class ZoneNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => 'Zone does not exist'
        ], 404);
    }
}