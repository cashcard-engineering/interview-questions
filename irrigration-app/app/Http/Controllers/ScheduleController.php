<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function store(ScheduleRequest $request)
    {
        $scheduleData = $this->scheduleService->createSchedule($request->zoneId, $request->validated());
        return response()->json($scheduleData, 201);
    }
}
