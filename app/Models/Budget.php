<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'category',
        'item',
        'estimated_amount',
        'actual_amount',
        'is_paid',
    ];

    protected $casts = [
        'estimated_amount' => 'decimal:2',
        'actual_amount' => 'decimal:2',
        'is_paid' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
