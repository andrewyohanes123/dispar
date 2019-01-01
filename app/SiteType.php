<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteType extends Model
{
    public function sites()
    {
        return $this->hasMany('App\Site');
    }

    public function travel_type()
    {
        return $this->hasOne('App\TravelType');
    }
}
