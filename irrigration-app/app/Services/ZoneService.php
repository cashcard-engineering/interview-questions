<?php

namespace App\Services;

use App\Repositories\ZoneRepository;

class ZoneService
{
    protected $repo;

    public function __construct(ZoneRepository $repository)
    {
        $this->repo = $repository;
    }

    private function findZoneByName($zoneName)
    {
        return $this->repo->findByName($zoneName);
    }

    private function findZoneById($id)
    {
        return $this->repo->findById($id);
    }

    public function createZones($zone)
    {
        $zoneExists = $this->findZoneByName($zone["name"]);
        
        if (!$zoneExists) {
            return $this->repo->insert([
                "name" => $zone["name"],
                "area" => $zone["area"]
            ]);
        }
        return false;
    }


    public function updateZone($zone, $id)
    {
        $zoneDetails = $this->findZoneById($id);

        if($zoneDetails)
        {
            return $this->repo->update($zone, $zoneDetails->id);
        }
        return false;
    }

    public function getAllZones()
    {
        return $this->repo->findAll();
    }

    public function getZone($id)
    {
        $zone = $this->findZoneById($id);
        if(!$zone)
        {
            return false;
        }
        return $zone;
    }

    public function deleteZone($id)
    {
        $zone = $this->findZoneById($id);
        if($zone)
        {
            return $this->repo->deleteById($zone->id);
        }
        return false;
    }
}
