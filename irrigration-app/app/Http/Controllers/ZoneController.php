<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Services\ZoneService;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    protected ZoneService $zoneService;

    public function __construct(ZoneService $service)
    {
        $this->zoneService = $service;
    }

    public function store(ZoneRequest $request)
    {
        $data = $this->zoneService->createZones($request->validated());
        if (!$data) {
            return response()->json(['message' => 'zone already exists'],  409);
        }
        return response()->json(['status' => true, $data], 201);
    }

    public function index()
    {
        $data = $this->zoneService->getAllZones();
        return response()->json($data, 200);
    }

    public function show(Request $request)
    {
        $data = $this->zoneService->getZone($request->zoneId);
        if (!$data) {
            return response()->json(['status' => true, 'message' => 'No data exists for this zone'], 404);
        }
        return response()->json(['status' => true, $data], 200);
    }

    public function update(ZoneRequest $request)
    {
        $data = $request->only(['name', 'area', 'watering_status']);
        $result = $this->zoneService->updateZone($data, $request->zoneId);
       
        if (!$result) {
            return response()->json(['message' => 'update failed'], 422);
        }
        return response()->json(['status' => true, 'message' => 'zone data updated successfully'], 200);
    }

    public function destroy(Request $request)
    {
        $result = $this->zoneService->deleteZone($request->zoneId);
        if (!$result) {
            return response()->json(['message' => 'item not deleted successfully'], 500);
        }
        return response()->json(['message'=>'zone deleted successfully']);
    }
}
