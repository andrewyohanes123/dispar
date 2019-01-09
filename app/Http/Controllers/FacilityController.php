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
}
