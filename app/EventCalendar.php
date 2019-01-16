<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCalendar extends Model
{
    protected $fillable = ['name', 'event_from', 'event_to', 'description'];

    public function event_location()
    {
        return $this->hasOne('App\EventLocation');
    }

    public function event_pictures()
    {
        return $this->hasMany('App\EventPicture');
    }
}
