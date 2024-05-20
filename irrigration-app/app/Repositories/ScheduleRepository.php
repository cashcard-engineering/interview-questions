<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Models\Zone;

class ScheduleRepository extends BaseRepository
{
    public function getModel(): Schedule
    {
        return new Schedule();
    }

    public function createZoneSchedule(Zone $zone, array $data)
    {
        return $zone->schedules()->create($data);
    }

    public function getZoneSchedule(Zone $zone)
    {
        return $zone->schedules()->get();
    }
}
