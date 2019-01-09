<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Site extends Model
{
    use SearchableTrait;

    protected $fillable = ['name', 'slug', 'latitude', 'longitude', 'description', 'site_type_id', 'address', 'travel_type_id'];
    protected $searchable = [
        'columns' => [
            'sites.name' => 10,
            'sites.description' => 5,
            'sites.address' => 4,
            // 'travel_types.name' => 2,
            // 'site_types.name' => 2,
        ],
        // 'joins' => [
        //     'travel_types' => ['travel_type_id', 'id'],
        //     'site_types' => ['site_type_id', 'id']
        // ]
    ];

    public function site_type()
    {
        return $this->belongsTo('App\SiteType');
    }

    public function travel_type()
    {
        return $this->belongsTo('App\TravelType');
    }

    public function site_pictures()
    {
        return $this->hasMany('App\SitePicture');
    }

    public function facilities()
    {
        return $this->hasMany('App\Facility');
    }
}
