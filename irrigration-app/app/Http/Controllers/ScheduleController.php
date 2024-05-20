<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $scheduleData = $this->scheduleService->getAllSchedules($request->zoneId);
        return response()->json($scheduleData, 200);
    }

    public function show(Request $request)
    {
        $scheduleData = $this->scheduleService->getScheduleById($request->scheduleId, $request->zoneId);
        return response()->json($scheduleData, 200);
    }

    public function update(ScheduleRequest $request)
    {
        $scheduleData = $this->scheduleService->updateSchedule($request->scheduleId, $request->zoneId, $request->validated());
        return response()->json($scheduleData, 200);
    }

    public function destroy(Request $request)
    {
        $result = $this->scheduleService->deleteSchedule($request->scheduleId, $request->zoneId);
        if($result)
        {
            return response()->json(['message'=>'record deleted successfully'], 200);
        }
    }
}
