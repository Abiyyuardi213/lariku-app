<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'distance_category',
        'location',
        'event_date',
        'registration_price',
        'early_bird_deadline',
        'status',
        'description',
        'website_url',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'early_bird_deadline' => 'date',
        'registration_price' => 'decimal:2',
    ];

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
}
