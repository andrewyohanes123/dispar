<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPicture extends Model
{
    protected $fillable = ['picture', 'event_calendar_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event_calendar()
    {
        return $this->belongsTo('App\EventCalendar');
    }
}
