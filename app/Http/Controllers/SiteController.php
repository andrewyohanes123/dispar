<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $sites = Site::where('site_type_id', 5)->paginate(6);
        if ($request->q) $sites = Site::search($request->q)->where('site_type_id', 5)->paginate(6);
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        return view('home.travel', compact('sites', 'facility'));
    }

    public function show($slug)
    {
        $site = Site::where('site_type_id', 5)->where('slug', $slug)->first();
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        return view('home.travel-show', compact('site', 'facility'));
    }
}
