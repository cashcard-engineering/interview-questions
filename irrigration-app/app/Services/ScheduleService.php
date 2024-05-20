<?php

namespace App\Services;
use App\Repositories\ScheduleRepository;
use App\Repositories\ZoneRepository;

class ScheduleService
{
    protected $repo;
    protected $zoneRepo;

    public function __construct(ScheduleRepository $repo, ZoneRepository $zoneRepo)
    {
        $this->repo = $repo;
        $this->zoneRepo = $zoneRepo;
    }

    private function findZoneById($id)
    {
        return $this->zoneRepo->findById($id);
    }

    public function createSchedule($id, $schedule)
    {
        $zone = $this->findZoneById($id);
        if(!$zone)
        {
            return response()->json(['message'=> 'Zone does not exist'], 201);
        }
        $scheduleData = $this->repo->createZoneSchedule($zone, $schedule);
        return $scheduleData;
    }
}