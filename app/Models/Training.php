<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'scheduled_at',
        'location',
        'target_distance_km',
        'notes',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'target_distance_km' => 'decimal:2',
    ];
}
