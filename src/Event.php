<?php

namespace DevOption\EventTracking;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'description', 
        'event_id', 
        'event_type',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];  
}
