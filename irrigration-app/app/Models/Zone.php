<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'zones';

    protected $fillable = ['name', 'area', 'watering_status'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
