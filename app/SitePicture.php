<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SitePicture extends Model
{
    protected $fillable = ['photo', 'site_id'];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
