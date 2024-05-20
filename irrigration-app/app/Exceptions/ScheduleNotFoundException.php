<?php

namespace App\Exceptions;

use Exception;

class ScheduleNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => 'Schedule does not exist'
        ], 404);
    }
}