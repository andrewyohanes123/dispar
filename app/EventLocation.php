<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    protected $fillable = ['location', 'latitude', 'longitude', 'event_calendar_id'];

    public function event_calendar()
    {
        return $this->belongsTo('App\EventCalendar');
    }
}
