<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'schedules';

    protected $fillable = ['zone_id', 'start_time', 'duration', 'days_of_week'];

    protected $casts = [
        'days_of_week' => 'array',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
