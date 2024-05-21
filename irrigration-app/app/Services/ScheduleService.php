<?php

namespace App\Services;

use App\Exceptions\ScheduleNotFoundException;
use App\Exceptions\ZoneNotFoundException;
use App\Mail\UpdateMail;
use App\Repositories\ScheduleRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Support\Facades\Mail;

class ScheduleService
{
    protected $repo;
    protected $zoneRepo;
    protected $zoneService;

    public function __construct(ScheduleRepository $repo, ZoneRepository $zoneRepo, ZoneService $zoneService)
    {
        $this->repo = $repo;
        $this->zoneRepo = $zoneRepo;
        $this->zoneService = $zoneService;
    }

    private function findZoneById($id)
    {
        return $this->zoneRepo->findById($id);
    }

    private function findScheduleById($id)
    {
        return $this->repo->findById($id);
    }

    private function sendEmail($data)
    {
        $reveiverEmailAddress = $data->email;

        Mail::to($reveiverEmailAddress)->send(new UpdateMail($data));
    }

    public function createSchedule($id, $schedule)
    {
        $zone = $this->findZoneById($id);
        throw_if(!$zone, ZoneNotFoundException::class);
        $scheduleData = $this->repo->createZoneSchedule($zone, $schedule);
        return $scheduleData;
    }

    public function getAllSchedules($id)
    {
        $zone = $this->findZoneById($id);

        $scheduleData = $this->repo->getZoneSchedule($zone);
        return $scheduleData;
    }

    public function getScheduleById($scheduleId, $zoneId)
    {
        $schedule = $this->findScheduleById($scheduleId);
        throw_if(!$schedule, ScheduleNotFoundException::class);
        $scheduleData = $this->repo->findFirst(['id' => $scheduleId, 'zone_id' => $zoneId]);
        return $scheduleData;
    }

    public function updateSchedule($scheduleId, $zoneId, $data)
    {
        $zone = $this->zoneRepo->findById($zoneId);
        $schedule = $this->repo->findById($scheduleId);
        $mailData = $this->zoneService->getZone($zoneId);
        throw_if($schedule->zone_id != $zone->id, new \Exception('Schedule is not part of this zone'));
        $schedule->update($data);
        $this->sendEmail($mailData);
        return $schedule;
    }

    public function deleteSchedule($scheduleId, $zoneId)
    {
        $zone = $this->zoneRepo->findById($zoneId);
        $schedule = $this->repo->findById($scheduleId);
        throw_if($schedule->zone_id != $zone->id, new \Exception('Schedule is not part of this zone'));
        $schedule->delete();
        return true;
    }
}
