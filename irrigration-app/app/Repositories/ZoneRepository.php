<?php

namespace App\Repositories;

use App\Models\Zone;

class ZoneRepository extends BaseRepository
{
    public function getModel(): Zone
    {
        return new Zone();
    }
}