<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class FacilityController extends Controller
{
    public $nama;

    public function index($nama) 
    {
        $this->nama = $nama;
        $this->nama = explode('-', $this->nama);
        $this->nama = title_case(implode(' ', $this->nama));
        $facilities = Site::whereNotIn('site_type_id', [5])->whereHas('site_type', function($q){
            $q->where('name', $this->nama);
        })->paginate(9);
        $facility = \App\SiteType::whereNotIn('id', [5])->get();

        return view('home.facilities', compact('facilities', 'facility'));
    }

    public function show($name, $slug)
    {
        $this->nama = $name;
        $this->nama = explode('-', $this->nama);
        $this->nama = implode(' ', $this->nama);
        $site = Site::where('slug', $slug)->get()->first();
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        $sites = Site::whereNotIn('site_type_id', [5])->whereNotIn('id', [$site->id])->whereHas('site_type', function($q){
            $q->where('name', $this->nama);
        })->take(5)->get();
        return view('home.travel-show', compact('sites', 'facility', 'site'));
    }
}
